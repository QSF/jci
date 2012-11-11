<?php 

interface EntityDAO extends UserDAO{

	/**
	*	Método que retorna uma lista de entidades que ainda não foram aprovadas.
	*	@param $positionResults posição inicial dos resultados.
	*	@param $maxResults número máximo de resultados.
	*	@return $entities Lista de entidades que ainda não foram aprovadas.
	*/
	public function getEntitiesNegativeSituation($positionResults, $maxResults);

	/**
	*	Método que retorna uma lista com todas entidades que  foram aprovadas.
	*	@return $entities Lista de entidades aprovadas.
	*/
	public function findAllEntitiesApproved();	

	/**
	*	Método que valida uma entidade
	*	@param $entity Validade a ser validada.
	*/
	public function validateEntity($entity);
}

?>