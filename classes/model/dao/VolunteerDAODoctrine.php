<?php

class VolunteerDAODoctrine extends UserDAODoctrine implements VolunteerDAO{
	/**
	*	@return repository repositório da tabela volunteer.
	*	@todo ver se este método realmente será preciso, ou seja, utilizado em algum método desta classe.
	*/
	protected function getRepository(){
		return $this->entityManager->getRepository('Volunteer');
	}

	public function getNews(){
		$page = $this->getPage("page");

		$pagePosition = $page * $this->maxResults;
		$dao = ServiceLocator::getInstance()->getDAO("DAO");
		$users = $dao->findAllPaginated($userType, $pagePosition, $this->maxResults);

		$this->request->setRequestAction("news", "getNews");
		$this->assignPagination($page, $users, $attributes);

		$this->display("NewsList");
	}

	public function getNewsByAuthorId(){

	}
}

?>