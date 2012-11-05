<?php

/**
 * Controller que contém as ações do moderador
 * 
 * Esse controller terá ações como pegar as entidades que estão esperando validação e validar entidade
 * Esse controller também faz uso da paginação.
 */

class ModeratorController extends ApplicationController
{

	/** 
	* Método que mostra as entidades que estão esperando validação
	* Ele utiliza o método getEntitiesNegativeSituation do ModeratorDAO.
	* Para mostrar os resultados ele seta o numero de paginas totais e a página atual que usuário está. 
	*/
	public function getEntitiesWaitingApproval(){
		
		//Pegando pagina enviada pelo usuario no AppController
		$page = $this->getPage();

		//Saber qual a posição que essas páginas estão no DAO
		$pagePosition = $page * $this->maxResults;
		$dao = ServiceLocator::getInstance()->getDAO("EntityDAO");
		$users = $dao-> getEntitiesNegativeSituation($pagePosition, $this->maxResults);

		$pagesNum = floor(count($users)/$this->maxResults);

		//setar a url para ser usada na view
		$this->view->assign("url", "./index.php?controller=moderator&action=getEntitiesWaitingApproval");
		
		//Número de paginas totais 
		$this->view->assign("pagesNum", $pagesNum);

		//Página atual que o usuário está 
		$this->view->assign("currentPage", $page);

		//Variavel que precisa ser setada para mostrar a acao de validar no UsersList
		$this->view->assign("validateAction",true);

		//Lista de usuários para nossa view iterar sobre
		$this->view->assign("users", $users);

		$this->display("UsersList");
	}

	/** 
	* Método que efetivamente valida as entidades
	* Esse método seta o campo situation do usuário
	*/
	public function validateEntity(){
		$userId = $this->request->get("user_id");
	
		$entity = new Entity;
		$entity->setId($userId);
		
		$dao = ServiceLocator::getInstance()->getDAO("EntityDAO");
		$dao->validateEntity($entity);

		$this->view->display("Home");
	}

	public function findAll(){

		$page = $this->getPage("page");
		$userType = $this->request->get("userType");

		$dao = ServiceLocator::getInstance()->getDAO("VolunteerDAO");
		$volunteers = $dao->findAllPaginated($userType, $page, $this->maxResults);

		$pagesNum = floor(count($volunteers)/$this->maxResults);

		//setar a url para ser usada na view
		$this->view->assign("url", "./index.php?controller=moderator&action=findAllVolunteer");
		
		$this->view->assign("pagesNum", $pagesNum);
		$this->view->assign("currentPage", $page);
		$this->view->assign("users", $volunteers);

		$this->display("UsersList");
	}
}
?>