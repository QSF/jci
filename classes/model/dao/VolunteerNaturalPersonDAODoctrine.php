<?php

require_once (DAO_PATH . "/VolunteerNaturalPersonDAO.php");


class VolunteerNaturalPersonDAODoctrine extends VolunteerDAODoctrine implements VolunteerNaturalPersonDAO{
	/**
	*	@return repository repositório da tabela volunteer_natural_person.
	*/
	protected function getRepository(){
		return $this->entityManager->getRepository('VolunteerNaturalPerson');
	}
}

?>