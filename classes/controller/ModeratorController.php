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

		$this->setRequest("moderator", "getEntitiesWaitingApproval");
		$this->assignPagination($page, $users, null);

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
		$users = $dao->findAllPaginated($userType, $page, $this->maxResults);

		$this->setRequest("moderator", "findAll");
		$attributes['userType'] = "Volunteer";
		$this->assignPagination($page, $users, $attributes);

		$this->display("UsersList");
	}

	public function search(){

		$searchOption = $this->request->get("searchOption");
		$searchWord = $this->request->get("searchField");

		$currentPage = $this->getPage();

		$dao = ServiceLocator::getInstance()->getDAO("UserDAO");
		if($searchOption == 'documents'){}
			//$this->setDocuments();
		
		$users = $dao->search($searchWord, $searchOption, $currentPage, $this->maxResults);

		$this->setRequest("moderator", "search");
		$this->assignPagination($currentPage, $users, null);

		$this->display("UsersList");
	}

}
?>