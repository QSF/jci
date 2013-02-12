<?php

require_once (DAO_PATH . "/EntityDAO.php");

use Doctrine\ORM\Tools\Pagination\Paginator;

class EntityDAODoctrine extends UserDAODoctrine implements EntityDAO{
	/**
	*	@return repository repositório da tabela entity.
	*/
	protected function getRepository(){
		return $this->entityManager->getRepository('Entity');
	}

	/**
	*	Método que retorna uma lista de entidades que ainda não foram aprovadas.
	*	@param $positionResults posição inicial dos resultados.
	*	@param $maxResults número máximo de resultados.
	*	@return $entities Lista de entidades que ainda não foram aprovadas.
	*/
	public function getEntitiesNegativeSituation($positionResults, $maxResults){

		$dql = "SELECT e FROM Entity e  WHERE e.situation = false AND e.inactive = false";

		return $this->resultPaginated($dql, $positionResults, $maxResults, false);
	}

	/**
	*	Método que retorna uma lista com todas entidades que  foram aprovadas.
	*	@return $entities Lista de entidades aprovadas.
	*/
	public function findAllEntitiesApproved(){

		$dql = "SELECT e FROM Entity e  WHERE e.inactive = false AND e.situation = true";
		$query = $this->entityManager->createQuery($dql);

		return $query->getResult();
	}

	/**
	*	Método que valida uma entidade
	*	@param $entity Validade a ser validada.
	*/
	public function validateEntity($entity){

		$entity = $this->findById($entity);
		$entity->setSituation(true);
		$this->entityManager->merge($entity);
		$this->entityManager->flush();
	}
}

?>