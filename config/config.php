<?php 
//este arquivo será incluso no index. Ele possui todas as configurações do nosso projeto.
define("LIB_PATH"    		, realpath('../lib')          		);
define("VIEW_PATH"    		, realpath('../classes/view') 		); 
define("CONTROLLER_PATH"    , realpath('../classes/controller') );
define("MODEL_PATH"			, realpath('../classes/model')      ); 
define("CLASSES_PATH"		, realpath('../classes')      		); 

//arquivo que configura o doctrine
require_once "bootstrap.php";

?>
