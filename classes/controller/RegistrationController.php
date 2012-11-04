<?php

/**
 * Controller que realiza o CRUD 
 * 
 * Nesse controller é implementado o CRUD que todas as entidades usarão.
 * Juntamente com o dao, ele implementa
 */

class RegistrationController extends ApplicationController{

	/** 
	* Dao que realiza o crud que nossas classes irão usar
	*/
	private $dao;

	public function __construct(Request $request){
		parent::__construct($request);	
		$this->dao = ServiceLocator::getInstance()->getDAO("DAO");
	}

	
	/** 
	* Método que realiza a criacao de objetos
	* Se o cadastro do usuário obteve sucesso, uma mensagem de sucesso é mostrada.
	* Se não, é impressa uma mensagem de erro.
	* Depois disso, é redirecionada para a página Home.
	* No formulário, é obrigatória a passagem do atributo user, com o tipo de usuário.
	*/
	public function create(){
		$user = $this->request->getUser();
		foreach ($user->getPublic() as $p) {
			echo "\n " . $p->getName();
		}

		$this->dao->insert($user);

		$this->view->assignSuccess("Usuário criado com sucesso. Faça login");
		$this->display("Home");
	}

	/** 
	* Método que realiza a edição dos usuários, a partir de um formulário.
	* O método updatePOST faz a edição efetiva do usuário no banco de dados.
	* Depois disso, é redirecionada para a página Home.
	* A permissão da edição é necessário e é feita do seguinte modo:
	* Checar se o usuário é moderador ou admin. 
	* Se não for checar se o user_id passado como parâmetro no atributo é o mesmo.
	*/
	public function update(){
		
		//TODO: checar se o usuário tem permissão de editar
		$userUpdate = $this->request->getUser();
		$userUpdate->setId($this->request->get("user_id"));
		echo 'aqui';
		$this->dao->clear();
		$this->dao->update($userUpdate);

		$this->view->assignSuccess("Usuário editado");
		$this->display("Home");

	}

	/**
	*	Método que redireciona para uma página de atualizar os dados de um usuário, de acordo
	*	com o tipo de usuário e id de usuário.
	*	@param $userType Indica o formulário que será incluso.
	*	@param $userId Determina qual usuário vai ser editado.
	*/
	protected function redirectUpdate($userType, $userId){
		if ($userType === null || $userId === null){
			$this->view->assignError('Erro ao editar!');
			//carregar no log de erros, com informações para o dev.
			$view->display("404");
			return;
		}

		if ($userType == 'Guest'){
			$this->view->assignError('Erro, Guest não é usuário!');
			//carregar no log de erros, com informações para o dev.
			$view->display("404");
			return;
		}

		$user = new $userType();
		$user->setId($userId);

		$this->authorize($user);

		$user = $this->dao->findById($user);

		if ($user === null){//nem encontrou o user
			$this->view->assignError('Erro, usuário não existe!');
			//carregar no log de erros, com informações para o dev.
			$this->view->display('Home');
			return;
		}
		//Seta valores do usuario para ser mostrado na view
		$this->view->assign("user", $user);

		//Seta ação do form, pois o form é usado tanto para editar quanto para criar
		$this->view->assign("action","update");

		$fieldDao = ServiceLocator::getInstance()->getDAO("FieldDAO");
		$fields = $fieldDao->findAllMacros();//pega todos os campos macros
		//Todos os campos serão exibidos na view.
		$this->view->assign("fields", $fields);

		$publicDao = ServiceLocator::getInstance()->getDAO("PublicServedDAO");
		$publicArray = $publicDao->findAll();
		//A ação vai ser criar.
		$this->view->assign("publicArray",$publicArray);

		$page = $userType."Form";
		$this->view->display($page);
	}

	/**
	*	Método que redireciona para uma página de edição de um usuário está logado.
	*	Os dados são pego de acorco com a session.
	*	@see self::redirectUpate
	*/
	public function redirectLoggedUserUpdate(){
		$userType = $this->request->getUserType();//e se for guest?
		$user = $this->request->getUserSession();
		$this->redirectUpdate($userType, $user->getId());
	}

	/** 
	* Método que redireciona para o formulário de edição de usuário que não seja o logado.
	* É necessário setar o nome do usuario pela variável form.
	* Como é preciso instanciar um usuário, esse atributo TEM QUE ser um nome idêntico ao model.
	* Para popular os campos do formulário, é necessário passar como parâmetro o id do usuário.
	*/
	public function redirectUserUpdate(){
		$userType = $this->request->get("form");
		$userId = $this->request->get("user_id");

		$this->redirectUpdate($userType, $userId);
	}

	/** 
	* Método que deleta o usuário do BD.
	* A permissão é feita do mesmo modo que na ação de edição.
	* É necessário se passar o tipo de usuário que irá ser deletado
	*/
	public function delete(){

		$userId = $this->request->get("user_id");
		$userType = $this->request->get("user_type");

		//Checar Permissão
		//TODO:
		$user = new $userType();
		$user->setId($userId);
	
		$this->authorize($user);

		$user = $this->dao->findById($user);
		echo $user->getEmail();
		$this->dao->delete($user);

		$this->view->assignSuccess("Usuário deletado com sucesso");
		$this->display("Home");
	}

	/** 
	* Carrega lista de campos e público e redireciona para página de cadastro.
	*/
	public function redirectCreate(){
		$fieldDao = ServiceLocator::getInstance()->getDAO("FieldDAO");
		$fields = $fieldDao->findAllMacros();//pega todos os campos macros
		//Todos os campos serão exibidos na view.
		$this->view->assign("fields", $fields);

		$publicDao = ServiceLocator::getInstance()->getDAO("PublicServedDAO");
		$publicArray = $publicDao->findAll();
		//A ação vai ser criar.
		$this->view->assign("publicArray",$publicArray);
		//O FieldForm vai ser usado tanto no upate quando no cadastro.
		
		$this->view->display($this->request->get('page'));
	}


	public function authorize($user){
		//Futuramente terá autorizacao
		//To pensando em fazer por sql
	}

}
?>