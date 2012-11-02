<?php

class VolunteerLegalPersonDAODoctrine extends VolunteerDAODoctrine implements VolunteerLegalPersonDAO{
	/**
	*	@return repository repositório da tabela volunteer_legal_person.
	*/
	protected function getRepository(){
		return $this->entityManager->getRepository('VolunteerLegalPerson');
	}
}

?>