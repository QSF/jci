<?php
require_once (DAO_PATH . "/PublicServedDAO.php");
require_once (DAO_PATH . "/DAODoctrine.php");


class PublicServedDAODoctrine extends DAODoctrine implements PublicServedDAO{
	/**
	*	@return repository repositório da tabela public.
	*/
	protected function getRepository(){
		return $this->entityManager->getRepository('PublicServed');
	}
}

?>