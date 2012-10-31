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

		if ($user != null)
			$this->setSession($user);
		
		$this->view->display("Home");
	}

	private function setSession($user){
		$password = md5($this->request->get("password"));
		if($password === $user->getPassword()){
			session_start(); 

			$_SESSION["type"] = get_class($user);
			$_SESSION["user"] = serialize($user);
			//$this->view->setUserType(get_class($user));

			$this->view->assignSuccess("Bem-Vindo ".$user->getName());
		}
		else{
			$this->view->assignError("Nome de usuário ou senha inválidos");
		}

	}

	public function logout(){
		unset($_SESSION);
		session_destroy();
		$this->view->setUserType("Guest");
		$this->view->display("Home");
	}
}

?>