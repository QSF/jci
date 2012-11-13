<?php 

require_once (DAO_PATH . "/DAO.php");

interface DonationDAO extends DAO{

	/**
	*	Método que retorna as doações para paginação, dado um início e um máximo de resultados.
	*	@param $positionResults Posição inicial dos resultados.
	*	@param $maxResults Número máximo de resultados.
	*/
	public function findDonations($positionResults, $maxResults);

	/**
	*	Método que procura doações dado um determinado campo
	*	@param $field campo que serve como filtro.
	*	@return $donations lista de doações que é feita com este campo.
	*/
	public function findByField($field);
}

?>