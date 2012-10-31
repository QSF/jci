<?php


/**
* Controller que realiza o login independente do usuario
*
*/
class LoginController extends ApplicationController
{
	
	public function login(){

		$username = $request->get("email");
		$password = md5($request->get("password"));

		$dao = ServiceLocator::getInstance()->getDAO("DAO");
		$user = $dao->findByEmail();

		if($password === $user->getPassword()){
			session_start(); 

			$_SESSION['user'] = $user;
			$_SESSION['type'] = class_type($user);
			$this->view->setUserType(class_type($user)); 
			$this->view->assignSuccess("Bem-Vindo ".$user->getName());
		}
		else{
			$this->view->assignError("Nome de usuário ou senha inválidos");
		}

		$this->view->display("Home");
	}

	public function logout(){
		session_destroy();
		$this->view->setUserType("Guest");
		$this->view->display("Home");
	}
}

?>