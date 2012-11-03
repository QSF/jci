<?php

class ModeratorController extends ApplicationController
{

	public function getEntitiesWaitingApproval(){
		$page = $this->request->get("page");

		if($page === null)
			$page = 0;
		$maxResults = 2;

		$pagePosition = $page * $maxResults;
		$dao = ServiceLocator::getInstance()->getDAO("EntityDAO");
		$users = $dao-> getEntitiesNegativeSituation($pagePosition, $maxResults);

		$pagesNum = floor(count($users)/$maxResults);

		$this->view->assign("pagesNum", $pagesNum);
		$this->view->assign("page", $page);
		$this->view->assign("users", $users);
		$this->display("UsersList");
	}

	public function validateEntity(){
		$userId = $this->request->get("user_id");
		

		$entity = new Entity;
		$entity->setId($userId);
		
		$dao = ServiceLocator::getInstance()->getDAO("EntityDAO");
		$dao->validateEntity($entity);

		$this->view->display("Home");
		//$this->authorize()
	}
}
?>