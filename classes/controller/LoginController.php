<?php

/**
* Controller que realiza o login independente do usuario
*
*/
class LoginController extends ApplicationController
{
	
	public function login() {

		$username = $this->request->get("email");


		$dao = ServiceLocator::getInstance()->getDAO("UserDAO");
		$user = $dao->findByEmail($username);

		if ($user != null ){
			if($user instanceof Entity && $user->getSituation() == false)
				$this->view->assignError("Erro. Entidade ainda não foi aceita.");
			else $this->setSession($user);
		}
		else
			$this->view->assignError("Nome de usuário ou senha inválidos");
		
		$this->view->display("Home");
	}

	public function passwordRecovery() {
		$username = $this->request->get("email");
		$dao = ServiceLocator::getInstance()->getDAO("UserDAO");
		$user = $dao->findByEmail($username);

		if ($user == null) {
			$this->view->assignError("Usuário não cadastrado");
		}

		else {
			// Pear é um framework que possibilita enviar emails com autenticação smtp. É necessário instalá-lo e 
			// depois baixar o package Pear Mail
			// Sobre o Pear: http://pear.php.net/index.php
			// Pear Mail: http://pear.php.net/package/Mail/
			require_once "Mail.php";
			$to = $user->getEmail();
			$from = "sean.alvarenga@gmail.com";
			$subject = 'JCI - Recuperação de Senha';
			$password = $this->createRandomPassword(12);
			// Seta nova senha no objeto, mas ainda não grava no banco
			$user->setPassword(md5($password));
			//Mensagem do e-mail
			$body = "Sua nova senha é: $password\n" . 'Para sua segurança, em seu próximo login, troque sua senha';
			//smpt e porta do provedor de email
			$host = "ssl://smtp.gmail.com";
			$port = "465";
			//email e senha
			$username = "sean.alvarenga@gmail.com";
			$pw = "";
			$headers = array(
				'From' => $from, 
				'To' => $to,  
				'Subject' => $subject);
			//Parametros do smtp
			$params = array(
				'host' => $host,
				'port' => $port,
				'auth' => true,
				'username' => $username,
				'password' => $pw);

			$smtp = Mail::factory('smtp', $params);
			$result = $smtp->send($to, $headers, $body);

			if (PEAR::IsError($result)) {
				$this->view->assignError("Não foi possível enviar o Email");
			}
			
			else {
				$dao->update($user);
				$this->view->assignSuccess("Email com a senha enviado com sucesso"); 
			}
		}
		$this->view->display("Home");
	}

	private function createRandomPassword($size = 8, $_upperCase = true, $_numbers = true, $_simbols = true) {
		$lowerCase = 'abcdefghijklmnopqrstuvwxyz';
		$upperCase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$numbers = '0123456789';
		$simbols = '!@#$%*-';
		$characters = $lowerCase;
		$password = '';
		
		if ($_upperCase)
			$characters .= $upperCase;

		if ($_numbers)
			$characters .= $numbers;

		if ($_simbols)
			$characters .= $simbols;

		$length = strlen($characters);

		for ($i = 1; $i <= $size; $i++) {
			$rand = mt_rand(1, $length);
			$password .= $characters[$rand - 1];
		}

		return $password;
	}

	private function setSession($user){
		$password = md5($this->request->get("password"));

		if($password === $user->getPassword()) {
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
		else
			$this->view->assignError("Nome de usuário ou senha inválidos");
		
		$this->view->display("Home");

	}

	private  function getModOrAdmin($username){
		$dao = ServiceLocator::getInstance()->getDAO("ModeratorDAO");
		$user = $dao->findByLogin($username);

		if($user == null){
			$dao = ServiceLocator::getInstance()->getDAO("AdministratorDAO");
			$user = $dao->findByLogin($username);
		}
		return $user;
	}

	public function logout(){

		session_destroy();
		$_SESSION = array();

		$this->redirect("Home");
	}
}

?>