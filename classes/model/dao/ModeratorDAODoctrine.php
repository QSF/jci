<?php 

require_once (DAO_PATH . "/ModeratorDAO.php");
require_once (DAO_PATH . "/DAODoctrine.php");

require_once (MODEL_PATH . "/Moderator.php");

class ModeratorDAODoctrine extends DAODoctrine implements ModeratorDAO{


	/** Método que retorna o objeto equivalente à uma coluna do banco que possui o id passado.
	*
	*	É necessário tomar cuidado com as entidades gerenciadas pelo entity manager.
	*	Aqui o tipo de id é diferente, agora vai ser um login
	*
	*	@param $object objeto que contém o login(chave primária) da tupla que será buscada.
	*	@return object objeto referente a tupla com este id na tabela.
	*	@return null caso não tenha nenhuma tupla com este id.
	*
	*/
	public function findById($object){
		return $this->entityManager->find(get_class($object),$object->getLogin());
	}

	/**
	*	@return repository repositório da tabela moderador.
	*/
	protected function gerRepository(){
		return $this->entityManager->getRepository('Moderator');
	}
}

?>