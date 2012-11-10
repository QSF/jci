<?php
require_once (DAO_PATH . "/NewsDAO.php");

class NewsDAODoctrine extends DAODoctrine implements NewsDAO{
	/**
	*	@return repository repositório da tabela news.
	*/
	protected function getRepository(){
		return $this->entityManager->getRepository('News');
	}

	public function getNews($positionResults, $maxResults){
		$dql = "SELECT n FROM news n";
		return $this->resultPaginated($dql, $positionResults, $maxResults, false);
	}
}

?>