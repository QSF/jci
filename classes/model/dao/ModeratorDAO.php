<?php 

require_once (DAO_PATH . "/DAO.php");

interface ModeratorDAO extends DAO{
	public function findByLogin($username);
}

?>