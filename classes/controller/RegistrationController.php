<?php

/**
 * Controller que realiza o CRUD 
 * 
 * Controller inicialmente com o método display que carrega o layout
 * Inicialmente com o método displayContent que colocará uma página html baseado no atributo page da requisicao
 * Todos os controller deverão herdar desse controller
 * Nome baseado no controller pai do Rails 
 */

class RegistrationController extends ApplicationController{

	private $dao;

	public function __construct(Request $request){
		parent::__construct($request);	
		$this->dao = ServiceLocator::getInstance()->getDAO("DAO");
	}

	
	public function create(){
		$user = $this->request->getUser();

		$this->dao->insert($user);

		$this->view->assignSuccess("Usuário criado com sucesso. Faça login");
		$this->display("Home");
	}

	//UpdateGET pega a página de formulário do usuário
	public function updatePOST(){
		$userUpdate = $this->request->getUser();
		echo $userUpdate->getPublic();
		
		$this->dao->update($userUpdate);

		$this->view->assignSuccess("Usuário editado");
		$this->display("Home");

	}

	public function updateGET(){
		$page = $this->request->get("form");
		
		//Por enquanto passado por parametro, mas depois pegar da session
		$userId = $this->request->get("user_id");
		
		$user = new Entity;
		$user->setId($userId);
		echo $user->getId();

		$userForm = $this->dao->findById($user);

		//Seta valores do usuario para ser mostrado na view
		$this->view->assign("user", $userForm);

		//Seta ação do form, pois o form é usado tanto para editar quanto para criar
		$this->view->assign("action","updatePOST");

		$this->view->display($page);
	}

}
?>