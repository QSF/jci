<?php

/**
 * Controller que realiza a busca por usuarios
 * 
 * Nesse Controller são implementadas as buscas por usuarios
 */

class UsersController extends ApplicationController{


	/** 
	* Dao para realizar a busca 
	*/
	private $dao;
	private $view;

	public function __construct(Request $request){
		$this->dao = ServiceLocator::getInstance()->getDAO("UserDAO");
		$this->view = ServiceLocator::getInstance()->getView("listVoluntiers");
	}




	public function findUsers(){
		$users = $this->dao->findVolunteers();
		$this->view->assign(listVolunteers,$users);
		$this->view->display("viewUsers");
	}




}

