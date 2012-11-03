<?php

require_once (DAO_PATH . "/FieldDAO.php");
require_once (DAO_PATH . "/DAODoctrine.php");

class FieldDAODoctrine extends DAODoctrine implements FieldDAO{
	/**
	*	@return repository repositório da tabela field.
	*/
	protected function getRepository(){
		return $this->entityManager->getRepository('Field');
	}

	/**
	*	Método que busca todos os campos macros.
	*	@todo fazer com opção de paginação.
	*	@return Collection<Field> campos macros.
	*/
	public function findAllMacros(){
		return $this->getRepository()->findBy(array('parent' => NULL));
	}

	/**
	*	Método que busca todos os campos filhos de um determinado campo.
	*	@todo fazer com opção de paginação.
	*	@return Collection<Field> campos filhos.
	*/
	public function findChildren($field){
		return $this->getRepository()->findBy(array('parent' => $field))->toArray();
	}
}

?>