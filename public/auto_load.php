<?php
/**
* spl __autoload é um método mágico do php que é chamado quando o operador new 
* ou uma chamada stática é utilizada. É preciso criar métodos que fazem os include das classes 
* (utilizando a estrutura de diretórios) e registrar esses métodos no spl_autoload_register().
* Ele carrega a classe instanciada na primeira vez que é chamada, buscando o respectivo método  
* include EM ORDEM (fila) de registro.
*/ 

require_once("../config/config.php");
 
class AutoLoad {
	//Authorization, ObjectBuilder, Request
	public static function autoload_classes($class) {
		$file = CLASSES_PATH . "/{$class}.php";

		//O arquivo existe e pode ser lido?
		if(is_readable($file)) {
			require_once($file);
		}
	}

	//ApplicationController, FrontController, LoginController, RegistrationController
	public static function autoload_controller($class) {
		$file = CONTROLLER_PATH . "/{$class}.php";
		
		if(is_readable($file)) {
			require_once($file);
		}
	}

	//Administrator, Entity, Moderator, User, Volunteer, VolunteerLegalPerson, VolunteerNaturalPerson
	public static function autoload_model($class) {
		$file = MODEL_PATH . "/{$class}.php";
		
		if(is_readable($file)) {
			require_once($file);
		}
	}

	//DAO, DAODoctrine, ModeratorDAO, ModeratorDAODoctrine, UserDAO, UserDAODoctrine
	public static function autoload_dao($class) {
		$file = DAO_PATH . "/{$class}.php";
		
		if(is_readable($file)) {
			require_once($file);
		}
	}

	//Cache, ResourceRegisters, ServiceLocator
	public static function autoload_resource($class) {
		$file = RESOURCE_PATH . "/{$class}.php";
		
		if(is_readable($file)) {
			require_once($file);
		}
	}

	//DAODoctrineFactory, DAOFactory, Register, ViewFactory
	public static function autoload_register($class) {
		$file = REGISTERS_PATH . "/{$class}.php";
		
		if(is_readable($file)) {
			require_once($file);
		}
	}

	//View
	public static function autoload_view($class) {
		$name = ucfirst($class);
		$file = VIEW_PATH . "/{$class}.php";
		
		if(is_readable($file)) {
			require_once($file);
		}
	}
}
?>