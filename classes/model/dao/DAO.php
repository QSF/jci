<?php 
interface DAO{
	/** Método que persiste um objeto no banco.
	*	@param $object objeto a ser persistido.
	*/
	public function insert($object);
	/** Método que deleta uma tupla da tabela de acordo com o objeto passado por parâmetro.
	*	@param $id id(chave primária) da tupla que será buscada.
	*	@return object objeto referente a tupla com este id na tabela.
	*	@return null caso não tenha nenhuma tupla com este id.
	*/
	public function delete($id);
	/** Método que persiste um objeto no banco.
	*	@param $object objeto a ser persistido.
	*/
	public function update($object);
	/** Método que retorna o objeto equivalente à uma coluna do banco.
	*	@param $id id(chave primária) da tupla que será buscada.
	*	@return object objeto referente a tupla com este id na tabela.
	*	@return null caso não tenha nenhuma tupla com este id.
	*/
	public function findById($id);
}
?>