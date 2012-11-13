<?php

class GuestController extends ApplicationController{

	public function sendMail(){
		$name = $this->request->get("name");
		$email = $this->request->get("email");
		$content = $this->request->get("content");

		$subject = "Dúvida";
		$emailFrom = "From:". $email;
		$content = "Olá, sou o " . $name . $content; 
		//$this->sendMail(EmailJCI, $subject, $content, $emailFrom );

		$this->view->assignSuccess("E-mail enviado com sucesso.<br/> 
			Nossos moderadores irão respondê-lo em breve" );
		$this->view->display("Home");
	}
}