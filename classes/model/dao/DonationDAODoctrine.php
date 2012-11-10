<?php

require_once (DAO_PATH . "/DonationDAO.php");


class DonationDAODoctrine extends DAODoctrine implements DonationDAO{
	/**
	*	@return repository repositório da tabela donation.
	*/
	protected function getRepository(){
		return $this->entityManager->getRepository('Donation');
	}

	/**
	*	Método que retorna as doações para paginação, dado um início e um máximo de resultados.
	*	@param $positionResults Posição inicial dos resultados.
	*	@param $maxResults Número máximo de resultados.
	*/
	public function findDonations($positionResults, $maxResults){
		$dql = "SELECT d FROM Donation d ORDER BY d.date DESC";
		return $this->resultPaginated($dql, $positionResults, $maxResults, false);
	}
}

?>