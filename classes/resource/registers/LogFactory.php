<?php

require_once (REGISTERS_PATH . "/Register.php");
require_once (CLASSES_PATH   . "/Log.php");

//classe que cria os logs, caso quisermos usar mais de tipo de log (cadastro, erro, etc)
class LogFactory implements Register {
	
	public function create ($name) {
		//.. if
		return new $name;
	}
}

?>