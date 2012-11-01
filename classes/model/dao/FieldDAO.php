<?php 

require_once (DAO_PATH . "/DAO.php");

interface FieldDAO extends DAO{

	/**
	*	Método que busca todos os campos macros.
	*	@todo fazer com opção de paginação.
	*	@return Collection<Field> campos macros.
	*/
	public function findAllMacros();

	/**
	*	Método que busca todos os campos filhos de um determinado campo.
	*	@todo fazer com opção de paginação.
	*	@return Collection<Field> campos filhos.
	*/
	public function findChildren($field);
}

?>