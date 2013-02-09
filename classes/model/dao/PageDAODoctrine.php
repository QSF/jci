<?php
require_once (DAO_PATH . "/PageDAO.php");

class PageDAODoctrine extends DAODoctrine implements PageDAO{

	/**
	*	@return repository repositório da tabela page.
	*/
	protected function getRepository(){
		return $this->entityManager->getRepository('Page');
	}

	public function findById($page){
		return $this->entityManager->find(get_class($page),$page->getName());		
	}
}

?>