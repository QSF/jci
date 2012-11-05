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

	public function findAllPaginated($userType, $positionResults, $maxResults);
}
?>