<?php 

require_once (DAO_PATH . "/DAO.php");

interface AdministratorDAO extends DAO{
	public function findByLogin($username);
}

?>