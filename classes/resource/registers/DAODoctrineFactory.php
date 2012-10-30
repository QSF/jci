<?php
/** @todo ver com urgência algo que não precise ficar incluindo toda vez arquivos que estão na mesma pasta. */
require_once (REGISTERS_PATH . "/DAOFactory.php");

/** Classe que cria todos os DAOs do doctrine.
* 	Está classe é um padrão de projetos abstract factory que apenas cria DAOs do doctrine.
* 
*/
class DAODoctrineFactory extends DAOFactory 
{
	/** Método que retorna o nome do padrão do DAO.
	*	
	* 	Este método é chamado em DAOFactory::create.
	*	Desta forma, ficaria assim o create:
	* 	Se $name = DAO, o método tentará instancia um objeto do tipo DAODoctrine.	
	*
	*	@return 'Doctrine' Padrão do nome do DAO
	*/	
	protected function getDAOPatternName(){
		return 'Doctrine';
	}
}
?>