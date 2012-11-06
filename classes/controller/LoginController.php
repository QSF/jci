<?php


/**
* Controller que realiza o login independente do usuario
*
*/
class LoginController extends ApplicationController
{
	
	public function login(){

		$username = $this->request->get("email");


		$dao = ServiceLocator::getInstance()->getDAO("UserDAO");
		$user = $dao->findByEmail($username);

		if ($user != null ){
			if(!($user instanceof Entity && $user->getSituation() == false))
				$this->setSession($user);
		}
		else
			$this->view->assignError("Nome de usuário ou senha inválidos");
		
		$this->view->display("Home");
	}

	private function setSession($user){
		$password = md5($this->request->get("password"));
		if($password === $user->getPassword()){
			if (!isset($_SESSION))
				session_start(); 

			$_SESSION["type"] = get_class($user);
			$_SESSION["user"] = serialize($user);
			//$this->view->setUserType(get_class($user));
			$this->view->assignSuccess("Bem-Vindo ");
			$this->redirect();
		}
		else{
			$this->view->assignError("Nome de usuário ou senha inválidos");
		}


	}

	public function getForm(){
		$typeUser = $this->request->get("type");
		if($typeUser == "User"){
			$this->view->assign("action", "login");
			$this->view->assign("inputType", "email");
			$this->view->assign("nameDisplay","Email");
		}
		else if("$typeUser" == "Admin"){
			$this->view->assign("action", "loginAdmin");
			$this->view->assign("inputType", "username");
			$this->view->assign("nameDisplay","Nome de Usuário");
		}

		$this->view->display("LoginForm");
	}

	public function loginAdmin(){
		$username = $this->request->get("username");
		$user = $this->getModOrAdmin($username);

		if ($user != null)
			$this->setSession($user);
		
		$this->view->display("Home");

	}

	private  function getModOrAdmin($username){
		$dao = ServiceLocator::getInstance()->getDAO("ModeratorDAO");
		$user = $dao->findByLogin($username);

		if($user == null){
			$dao = ServiceLocator::getInstance()->getDAO("AdministratorDAO");
			$user = $dao->findByLogin($username);

		}

		$this->view->assignError("Nome de usuário ou senha inválidos");
		return $user;
	}

	public function logout(){

		session_destroy();
		$_SESSION = array();

		$this->redirect("Home");
	}
}

?>