<?php

class PublicServedDAODoctrine extends DAODoctrine implements PublicServedDAO{
	/**
	*	@return repository repositório da tabela public.
	*/
	protected function getRepository(){
		return $this->entityManager->getRepository('PublicServed');
	}
}

?>