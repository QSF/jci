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
		$page = $this->request->get("page");

		if($page === null)
			$page = 0;
		$maxResults = 10;

		//Saber qual a posição que essas páginas estão no DAO
		$pagePosition = $page * $maxResults;
		$dao = ServiceLocator::getInstance()->getDAO("EntityDAO");
		$users = $dao-> getEntitiesNegativeSituation($pagePosition, $maxResults);

		$pagesNum = floor(count($users)/$maxResults);

		//setar a url para ser usada na view
		$this->view->assign("url", "./index.php?controller=moderator&action=getEntitiesWaitingApproval");
		
		//Número de paginas totais 
		$this->view->assign("pagesNum", $pagesNum);

		//Página atual que o usuário está 
		$this->view->assign("currentPage", $page);

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
}
?>