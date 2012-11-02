<?php
//classe teste, por isso não está comentada
require_once (REGISTERS_PATH . "/Register.php");
require_once (VIEW_PATH . "/View.php");
require_once (VIEW_PATH . "/VolunteerView.php");
require_once (VIEW_PATH . "/GuestView.php");
require_once (VIEW_PATH . "/EntityView.php");
require_once (VIEW_PATH . "/ModeratorView.php");
require_once (VIEW_PATH . "/AdministratorView.php");

/** Classe que cria todos as views 
* 	Esta classe cria as views de acordo com o tipo de usuário
*/
class ViewFactory implements Register
{

	/** Método que instancia os objetos View
	*	
	* 	Este método cria um objeto do tipo $name+View.
	*	Ex: Se $name = DAO e o nome do costrutor é Entity
	*	o método tentará instanciar um objeto do tipo EntityView.	
	*
	*	@param $name nome da View a ser criado.
	*	@return $view Uma instância de uma view.
	*	@return null Caso não exista View com o nome passado.
	*
	*	@todo lançar Exceptions
	*/	
	public function create ($name){

		if(strpos($name,"Volunteer") !== false){
			return new VolunteerView();
		}
		else{
			$className = $name."View";
			return new $className;
		}
	}
}
?>