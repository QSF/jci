<?php
require_once (REGISTERS_PATH . "/Register.php");
require_once (DAO_PATH . "/DAODoctrine.php");

/** Classe pai das factorys do DAO
* 	Está classe é um padrão de projetos abstract factory que apenas cria DAOs, chamando um método para completar o nome do DAO.
*	Desta forma, ela se torna abstrata, sendo que o que determina o tipo de DAO criado vai ser suas subclasses
* 
*/
abstract class DAOFactory implements Register
{
	/** Método que instancia os objetos DAO.
	*	
	* 	Este método cria um objeto do tipo $name+Nome padrão da subclasse.
	*	Ex: Se $name = DAO e o nome padrão da subclasse é PDO
	*	o método tentará instancia um objeto do tipo DAOPDO.	
	*
	*	@param $name nome do DAO a ser criado.
	*	@return dao Uma instância de um DAO(lembre-se da herança).
	*	@return null Caso não exista DAO com o nome passado.
	*
	*	@todo lança Exceptions
	*/	
	public function create ($name){
		//aqui pode ser feito o include, pq não?
		$name = $name . $this->getDAOPatternName();
		return (new $name);
	}
	/** Método que retorna o padrão do nome do DAO.
	*	
	*	Utilizado no método create desta mesma classe.
	*
	*	@see DAOFactory::create()
	*/	
	protected function getDAOPatternName(){
	}
}
?>