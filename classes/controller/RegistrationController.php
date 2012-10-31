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
	public function updatePOST(){
		
		//TODO: checar se o usuário tem permissão de editar
		$userUpdate = $this->request->getUser();

		$userUpdate->setId($this->request->get("user_id"));
		
		$this->dao->update($userUpdate);

		$this->view->assignSuccess("Usuário editado");
		$this->display("Home");

	}

	/** 
	* Método que redireciona para o formulário de edição do usuário.
	* É necessário setar o nome do usuario pela variável form.
	* Como é preciso instanciar um usuário, esse atributo TEM QUE ser um nome idêntico ao model.
	* Para popular os campos do formulário, é necessário passar como parâmetro o id do usuário.
	*/
	public function updateGET(){
		$userType = $this->request->get("form");
		
		//Checar se o usuário tem permissão.
		//Ver se for admin ou moderador. Se não o id tem que ser igual
		$userId = $this->request->get("user_id");
		
		$user = new $userType();
		$user->setId($userId);

		$userForm = $this->dao->findById($user);

		//Seta valores do usuario para ser mostrado na view
		$this->view->assign("user", $userForm);

		//Seta ação do form, pois o form é usado tanto para editar quanto para criar
		$this->view->assign("action","updatePOST");

		$page = $userType."Form";
		$this->view->display($page);
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

		$user = $this->dao->findById($user);

		$this->dao->delete($user);

		$this->view->assignSuccess("Usuário deletado com sucesso");
		$this->display("Home");
	}

}
?>