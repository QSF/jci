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

	public function create(){
		//pega o tipo de usuário
		$user = $this->request->getUser();

		$dao = ServiceLocator::getInstance()->getDAO("DAO");
		echo $user->getEmail();
		$dao->insert($user);

		$this->view->assignSuccess("Usuário criado com sucesso. Faça login");
		$this->display("Home");
	}

}

?>