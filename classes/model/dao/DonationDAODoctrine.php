<?php

require_once (DAO_PATH . "/DonationDAO.php");


class DonationDAODoctrine extends DAODoctrine implements DonationDAO{
	/**
	*	@return repository repositório da tabela donation.
	*/
	protected function getRepository(){
		return $this->entityManager->getRepository('Donation');
	}
}

?>