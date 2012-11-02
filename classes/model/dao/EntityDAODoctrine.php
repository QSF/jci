<?php

require_once (DAO_PATH . "/EntityDAO.php");


class EntityDAODoctrine extends UserDAODoctrine implements EntityDAO{
	/**
	*	@return repository repositório da tabela entity.
	*/
	protected function getRepository(){
		return $this->entityManager->getRepository('Entity');
	}
}

?>