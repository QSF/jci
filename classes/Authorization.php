<?php
/**
 * Gerencia a permissão dos recursos 
 *
 * Classe que checa se o usuário está autorizado a visualizar o recurso requisitado.
 * A ideia é ter em todas requisições o atributo user, que representará o papel do usuário.
 * Checa em um arquivo xml se o tipo de usuário que está na sessão pode ter acesso ao controller  
 *
 */
class Authorization{
	
	/**
	* Constante DENIED consiste que o usuário não tem permissão para accessar o recurso
	*/
	const DENIED = 0;

	/**
	* Constante CHECK_ID consiste na verificação se o id do usuário da requisição,
	* que se encontra em "user_id", é o mesmo do usuário que está na sessão.
	* Para casos em que o usuário só pode se editar ou se excluir
	*/
	const CHECK_ID = 1;

	/**
	* Usuário está permitido para ver o recurso
	*/
	const ALLOWED = 2;

	/**
	* Classe que representa a requisição
	* @see Request
	*/
	private $request;
	
	/**
	* Código que representa o código de autorização do usuário
	* OBS: Só pode ter os valores das constantes
	*/
	private $authorizationCode;

	/**
	 * Construtor da classe Authorization
	 * 
	 * Construtor que seta o nome do controller, da action, a variável de instância request
	 * e o código de autorização para negado
	 *
	 * @param Request request
	 */
	public function __construct(Request $request){
		$this->request = $request;

		$this->controllerName = strtoupper($request->getControllerName());
		$this->actionName = strtoupper($request->getActionName());
		$this->authorizationCode = self::DENIED;
	}		


	/**
	 * Realiza toda a lógica que verifica se o usuário pode ver o recurso
	 *
	 * O tipo de usuário é conseguido através do request do usuário que está na sessão  
	 *
	 * @return boolean
	 */
	public function authorizate(){

		$userType = $this->findUserType($this->request->getUserType());

		$roles = $this->findRoles($userType);
		
		foreach($roles as $role){

			$this->checkAuthorization($role);
		
		}

		return $this->checkAction();
	}

	/**
	* Encontra a hierarquia dos usuários de acordo com o arquivo hierarchy.xml
	*
	* Encontra de forma recursiva a hierarquia dos objetos da nossa aplicação.
	* O parâmetro é o tipo de usuário que pegará todos os seus roles "inferiores"
	* e chamará recursivamente até retornar a lista de todos os papéis que ele representa
	*
	* Nossa aplicação consiste na seguinte hierarquia:
	* Admin > Moderator > User > Guest 
	* 
	* O papel pai tem todos os poderes de seus papéis filhos.
	* Portanto, o moderador tem todas as autorizações do user e do guest, mas não do admin
	*
	* @return Array de strings 
	*/
	private function findRoles($userType){

		$hierarchyFile = $this->openFile("hierarchy");

		$arrayRoles = array();
		array_push($arrayRoles, $userType);

		foreach($hierarchyFile->children() as $roles){

			if($roles["name"] == $userType ){

				foreach($roles->children() as $underRole){
					// $stringRole = (string) $underRole;
					// $underRoles = $this->findRoles($stringRole);
					$arrayRoles = array_merge($this->findRoles((string) $underRole), $arrayRoles);
				}
			}
		}
		
		return $arrayRoles;
	}

	/**
	* Abre o arquivo xml seguindo a lib simplexml 
	*/
	private function openFile($fileName){
		return simplexml_load_file(CONFIG_PATH."/security/".$fileName.".xml");
	}

	/**
	* Método simples que retorna o tipo de usuário em LETRA MAIÚSCULA.
	* Se o usuário for VNP, VLP ou Entity ele retorna a string user para generalização de papéis
	*/
	private function findUserType($userTypeName){
		
		if($userTypeName === "VolunteerLegalPerson" 
			|| $userTypeName === "VolunteerNaturalPerson"
			|| $userTypeName === "Entity"
			){
			$userTypeName = "user";
		}

		return strtoupper($userTypeName);
	}

	/**
	* Método responsável pela abertura do arquivo XML 
	* e por orquestrar a ordem de verificação dos papéis segundo o arquivo
	*/
	private function checkAuthorization($userType){
		$authorizationFile = $this->openFile(strtolower($userType));

		foreach($authorizationFile->children() as $authRules){

			$this->checkForAll($authRules);
			$this->checkForIsolatedController($authRules);
		}
	
	}

	/**
	* Método que checa simplesmente a seção dos controllers
	* Se encontrar como filho um action, envia o nó XML para o checkForIsolatedAction
	*
	* @see Authorization::checkForIsolatedAction
	*/
	private function checkForIsolatedController($nodeAuth){

		
		if($nodeAuth->getName() === "controller"
				&& ( (string) $nodeAuth["name"] ) == $this->controllerName){

				foreach($nodeAuth->children() as $action){
					$this->checkForIsolatedAction($action);
				}
		}

	}

	/**
	* Método que checa a seção da action.
	* Se o nó não tiver filhos, o processo entende o usuário como autorizado
	* Se ele tiver filhos, o nó XML é enviado para o método checkForIsolatedActionOptions
	*
	* @see Authorization::checkForIsolatedActionOptions
	*/
	private function checkForIsolatedAction($nodeAuth){

		if($nodeAuth["name"] == $this->actionName){

			if( count($nodeAuth->children()) == 0 ){

				$this->authorizationCode = self::ALLOWED;
				return;

			}

			foreach($nodeAuth->children() as $options){

				$this->checkForIsolatedActionOptions($options);
			
			}
		}
	}

	/**
	* Método que processa as opções que o nó action pode ter
	*
	* Se for encontrado um nó com o nome de "check_id", o código é mudado para CHECK_ID
	* Se for encontrado um nó com o nome de "allow", o código é mudado para ALLOW
	* Se for encontrado um nó com o nome de exception, é checado seus nós filhos
	* A exception é usada para quando o atributo for igual
	* Por exemplo, papel USER não pode ver o form=Moderator porque ele não tem esse direito
	*/
	private function checkForIsolatedActionOptions($nodeAuth){

		if($nodeAuth->getName() == "check_id"){

			$this->authorizationCode = self::CHECK_ID;

		}
		else if($nodeAuth->getName() == "allow"){

			$this->authorizationCode = self::ALLOWED;

		}
		else if($nodeAuth->getName() == "exception"){

			$authOption = $nodeAuth["action"];

			foreach( $nodeAuth->children() as $attribute){
				
				$attributeName = strtoupper($this->request->get( $attribute->getName() ));

				if($attributeName === (string) $attribute){

					$this->authorizationCode = $this->returnActionException($authOption);
					
				}
			}

		}
		
	}

	/**
	* Método simples que verifica qual constante corresponde a string passada
	*
	*@return self::DENIED || self::ALLOWED || self::CHECK_ID
	*/
	private function returnActionException($actionString){
		
		$optionString = self::DENIED;

		switch($actionString){
			case "CHECK_ID":
				return self::CHECK_ID;
			case "ALLOW":
				return self::ALLOW;
		}
		return $optionString;
	}

	/**
	* Método que transforma o código em booleando
	* 
	* Se o código for ALLOWED ou se a checagem de id confere, o método retorna true
	* Se o código for DENIED, ele retorna false
	*
	* @return boolean
	*/
	private function checkAction(){
		if($this->authorizationCode === self::ALLOWED){

			return true;

		}
		else if($this->authorizationCode === self::DENIED){

			return false;

		}
		else if($this->authorizationCode === self::CHECK_ID){

			$userSessionId = $this->request->getUserSession()->getId();
			$userRequestId = (int) $this->request->get("user_id");

			if($userSessionId === $userRequestId){
				return true;
			}
		}

		return false;
	}

	/**
	* Método que checa os controller que são filhos do nó all
	*
	* Se o nome do controller estiver aí dentro, 
	* significa que o usuário tem acesso a todos os métodos do controller
	*/
	private function checkForAll( $nodeAuth ){

		if($nodeAuth->getName() == "all"){

			foreach($nodeAuth->children() as $controller){

				if( ((string) $controller) == $this->controllerName ){
					$this->authorizationCode = self::ALLOWED;
				}
			}
		}	
	}
}

?>
