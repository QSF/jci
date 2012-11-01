<?php

class NewsDAODoctrine extends UserDAODoctrine implements VolunteerDAO{
	/**
	*	@return repository repositório da tabela volunteer.
	*	@todo ver se este método realmente será preciso, ou seja, utilizado em algum método desta classe.
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