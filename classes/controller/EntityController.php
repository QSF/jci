<?php

class EntityController{

	private $request;
	private $view;

	public function __construct(Request $request){
		$this->request = $request;

		//$request->get_user_type serve para saber o tipo de usuario e montar a view customizada
		$this->view = new View($this->request->getUserType());
	}

	public function getForm(){
		//Sempre colocar o nome da view sem o tipo
		$this->view->display("FormEntity");
	}
}

?>