<?php 

require_once (DAO_PATH . "/DAO.php");

/** Está interface contém todos os métodos de acesso ao banco referentes ao usuário geral.
*/
interface UserDAO extends DAO{

	/** Método que retorna o objeto equivalente à uma coluna do banco que possui o email passado.
	*
	*	@param $email email do usuário que será procurado.
	*	@return object objeto referente a tupla com este email na tabela.
	*	@return null caso não tenha nenhuma tupla com este email.
	*
	*	@todo Jogar exceptions	
	*/
	public function findByEmail($email);

	/** 
	*	Método que retorna o objeto equivalente à uma coluna do banco que possui o id passado.
	*
	*
	*	@param $id id do usuário que será procurado.
	*	@return object objeto referente a tupla com este id na tabela.
	*	@return null caso não tenha nenhuma tupla com este id.
	*
	*/
	public function findOneById($id);

	/** 
	*	Método que retorna os usuários
	*
	*	@return Lista de usuários que tem a coluna inactive como falso
	*/
	public function findInactiveUsers($positionResults, $maxResults);

	/** 
	*	Método que ativa o usuário
	*	Seta a coluna do inactive como false
	*
	*	@param usuário que se setará o inactive
	*/
	public function activateUser($user);

	/** 
	*	Método que desativa os usuários
	*	Seta a coluna inactive como true
	*	
	*	@param usuário que se setará o inactive
	*/
	public function desactivateUser($user);
}
?>