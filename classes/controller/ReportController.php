<?php

include_once CLASSES_PATH."/PDF.php";

/**  Função que faz a comparação entre usuários no relatório por campos
	*
	* Essa função compara todos os usuários de acordo com sua quantidade de campos
	* Quanto menos campos, mais bem rankeado ele fica
	*
*/
function fieldCompare($a,$b){
	if(count($a->getActingArea())  == count($b->getActingArea()))
		return 0;
	   return (count($a->getActingArea()) < count($b->getActingArea()) ? -1 : 1);
}


/**  Função que faz a comparação entre usuários no relatório por usuário
	*
	* Essa função compara todos os usuários de acordo com sua pontuação 
	*
*/
function pontuationCompare($a,$b){
	if($a['pontuation']  == $b['pontuation'])
		return 0;
		
	   return ($a['pontuation'] < $b['pontuation'] ? 1 : -1);
}



/** Classe que tem a responsabilidade de gerar um relatório
*
*	Está classe é responsável por gerar o cruzamento de dados do sistema
*   Ela é composta de dois tipos de cruzamentos:
*	Por campos e por usuários.
*	Lembrete: Campo é a mesma coisa que área de atuação
*	O relatório por campos é aquele que
*   exibe todos os usuários com o mesmo tipo de campo.
*	O relatório por usuário pega todos os campos do usuário requisitado e 
*	relaciona com os usuários que tem os mesmos campos
*   É dada preferência absoluta a sub-campos enquanto campos macro não são "valorizados".
*/

class ReportController extends ApplicationController{

	/** Método que redireciona para a escolha de campos do usuário
	*
	* Esse método seta a variável fields na view e redireciona para generateReport
	*/
	public function redirectSet(){
		
		$fieldDao = ServiceLocator::getInstance()->getDAO("FieldDAO");
		$fields = $fieldDao->findAllMacros();//pega todos os campos macros
		//Todos os campos serão exibidos na view.
		$this->view->assign("fields", $fields);

		$this->display("GenerateReport");
	}


	/** Método que gera relatório por campos
	*
	* Esse método gera o relatório em PDF do campo
	* Ele usa o BD para pegar todos os usuários com o campo selecionado
	* Em seguida faz a separação por voluntários e entidades
	* Depois disso, rankeia pelos usuário com menos campos e gera o pdf
	*/
	public function generateReportField(){
		$fieldId = $this->request->get("id");

		$field = new Field;
		$field->setId($fieldId);

		$dao = ServiceLocator::getInstance()->getDAO("DAO");
		$field = $dao->findById($field);

		$userDao = ServiceLocator::getInstance()->getDAO("UserDAO");

		//Pegando usuários que tem o mesmo campo
		$users = $userDao->getUsersByField($field);

		//dois arrays para manipulação dos dados
		$volunteersArray = array();
		$entitiesArray = array();

		//Separando as entidades dos voluntários
		foreach($users as $user){
			if(get_class($user) == "Entity"){
				array_push($entitiesArray,$user);
			}
			else{
				array_push($volunteersArray,$user);
			}
		}

		//Ordenando por numero de campos que o usuario tem
		//Quanto mais campos, mais baixo no ranking fica
		usort($entitiesArray, 'fieldCompare');
		usort($volunteersArray, 'fieldCompare');

		//Verificando se é moderator
		$moderator = $this->request->getUserSession();
		if(get_class($moderator) != "Moderator")
			exit();

		$pdf = new PdfGenerator($moderator);
		$pdf->generateReportField($volunteersArray, $entitiesArray, $field); 
	}

	/** Método que gera relatório por usuários
	*
	* Lembrete: Usuário alvo/$userTarget é o usuário que o moderador escolheu 
	* Algoritmo:
	* 1. Usa o BD para pegar todos os usuários com todos os campos do usuário alvo.
	* 2. Remove os tipos iguais. 
	* Se, por exemplo, o usuário escolhido for entidade, todas as entidades serão retiradas.
	* 3. Cria um array de pontuação, que consiste em um 
	* array que guarda um array com valores pontuação => 0 e usuário => user. 
	* Diogão compareceu aqui. Vão lá na doc que tem um exemplo.
	* 4. Insere a pontuação de acordo com os campos que os usuários tem em comum.
	* Se o campo em comum for sub-campo tem uma pontuação de 2000. Se for macro, tem 50.
	* O intuito da pontuação do sub-campo ser tão alta é que o campo macro pouco mostra do usuário alvo.
	* 5. Faz-se a pontuação dos públicos.
	* A cada público relacionado, soma-se 150 da pontuação do usuário.
	* 6. Aproximação por CEPs. Não é muito exata, então não terá um peso muito grande.
	* 7. Ordenação por pontuação dos usuários.
	* 8. Gerar o pdf com os usuário ordenados pela pontuação
	*/
	public function generateReportUser(){
		$userId = $this->request->get("user_id");
		$userType = $this->request->get("user_type");

		$user = new $userType();
		$user->setId($userId);

		$dao = ServiceLocator::getInstance()->getDAO("DAO");
		$user = $dao->findById($user);

		$userDao = ServiceLocator::getInstance()->getDAO("UserDAO");
		$users = $userDao->getUsersByUserField($user);

		$this->removeSameType(get_class($user), $users);

		$moderator = $this->request->getUserSession();

		if(get_class($moderator) != "Moderator")
			exit();

		$usersPontuation = array();
		foreach($users as $userIter){
			if($userIter->getId() != $user->getId())
				array_push($usersPontuation,array('pontuation' => 0,'user'=>$userIter));			
		}

		$this->countPontuationField($usersPontuation, $user);
		$this->countPontuationPublic($usersPontuation, $user);

		//Quando CEP com formato de string eu faco
		//Tava pensando que uma forma simples era fazer por somas e subs
		//$this->evaluateCEP($usersPontuation, $user);

		usort($usersPontuation,'pontuationCompare');
		
		$users = array();

		foreach($usersPontuation as $userIter)
			array_push($users, $userIter['user']);

		$pdf = new PdfGenerator($moderator);
		$pdf->generateReportUser($user, $users); 
	}

	private function countPontuationField( &$usersPontuation, $user){
		
		$fieldsUserTarget = $user->getActingArea();
		$fieldsTargetId = array();

		foreach($fieldsUserTarget as $field){
			array_push($fieldsTargetId, $field->getId());
		}
		
		foreach($usersPontuation as &$pontuationArray){
			$userReport = $pontuationArray['user'];

			//Checando os campos dos usuarios que tem o mesmo campo que o usuario em questao
			foreach($userReport->getActingArea() as $field){

				if(in_array($field->getId(), $fieldsTargetId))
					
					if($field->getParent() != null)
						$pontuationArray['pontuation'] += 2000;
					else
						$pontuationArray['pontuation'] += 50;
			}
		}
	}

	private function countPontuationPublic(	&$usersPontuation, $user){

		$publicUserTarget = $user->getPublic();
		$publicTargetId = array();

		foreach($publicUserTarget as $public){
			array_push($publicTargetId, $public->getId());
		}		

		foreach($usersPontuation as &$pontuationArray){
			$userReport = $pontuationArray['user'];

			//Checando os campos dos usuarios que tem o mesmo campo que o usuario em questao
			foreach($userReport->getPublic() as $public){

				if(in_array($public->getId(), $publicTargetId))
						$pontuationArray['pontuation'] += 150;
			}
		}

	}	

	private function removeSameType($type, & $users){
		if($type == "Entity"){
			for($i = 0; $i < count($users); $i++)
				if(get_class($users[$i]) == "Entity")
					unset($users[$i]);
			}
		else
			foreach($users as $key => &$userIter){
				if(get_class($userIter) == "VolunteerNaturalPerson" || 
						get_class($userIter) == "VolunteerLegalPerson"){
					unset($users[$key]);
			}
		}
	}
		
}