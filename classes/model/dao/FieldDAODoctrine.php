<?php

class FieldDAODoctrine extends DAODoctrine implements FieldDAO{
	/**
	*	@return repository repositório da tabela field.
	*/
	protected function getRepository(){
		return $this->entityManager->getRepository('Field');
	}
}

?>