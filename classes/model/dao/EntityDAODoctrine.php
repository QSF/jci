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

	public function getEntitiesNegativeSituation($positionResults, $maxResults){
		//return $this->getRepository()->findBy(array('situation'=>false));

		$dql = "SELECT e FROM Entity e  WHERE e.situation = false";
		$query = $this->entityManager->createQuery($dql)
	                       	->setFirstResult($positionResults)
	                        ->setMaxResults($maxResults);

		$paginator = new Paginator($query, $fetchJoinCollection = false);

		return $paginator;
	}

	public function validateEntity($entity){

		$entity = $this->findById($entity);
		$entity->setSituation(true);
		$this->entityManager->merge($entity);
		$this->entityManager->flush();
	}
}

?>