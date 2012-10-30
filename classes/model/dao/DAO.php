<?php 

/** Interface geral do DAO.
* Esta interface possui o CRUD básico utilizado no nosso sistema, sendo que qualquer DAO implementa ela.
*
*/
interface DAO{
	
	/** Método que persiste um objeto no banco.
	*	@param $object objeto a ser persistido.
	*/
	public function insert($object);

	/** Método que deleta uma tupla da tabela de acordo com o objeto passado por parâmetro.
	*	@param $object objeto que contém o id(chave primária) da tupla que será buscada.
	*	@todo Jogar exceptions
	*/
	public function delete($object);

	/** Método que atualiza um objeto no banco.
	* 	Séra atualizada a tupla que contém o id do objeto passado, com os valores dete objeto.
	*	@param $object objeto a ser atualizado.
	*
	*	@todo Jogar exceptions	
	*/
	public function update($object);

	/** Método que retorna o objeto equivalente à uma coluna do banco que possui o id passado.
	*
	*	@param $object objeto que contém o id(chave primária) da tupla que será buscada.
	*	@return object objeto referente a tupla com este id na tabela.
	*	@return null caso não tenha nenhuma tupla com este id.
	*
	*	@todo Jogar exceptions	
	*/
	public function findById($object);
}
?>