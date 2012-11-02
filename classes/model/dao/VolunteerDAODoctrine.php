<?php

class VolunteerDAODoctrine extends UserDAODoctrine implements VolunteerDAO{
	/**
	*	@return repository repositório da tabela volunteer.
	*	@todo ver se este método realmente será preciso, ou seja, utilizado em algum método desta classe.
	*/
	protected function getRepository(){
		return $this->entityManager->getRepository('Volunteer');
	}
}

?>