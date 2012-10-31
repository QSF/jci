<?php 

require_once (DAO_PATH . "/DAO.php");

require_once (MODEL_PATH . "/Moderator.php");

interface ModeratorDAO extends DAO{
	/**
	*	@return repository repositório da tabela moderador.
	*/
	protected function gerRepository(){
		return $this->getRepository('Moderator');
	}
}

?>