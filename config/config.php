<?php 
//este arquivo será incluso no index. Ele possui todas as configurações do nosso projeto.
define("LIB_PATH"    		, realpath('../lib')          					);
define("PUBLIC_PATH"        , $_SERVER['SERVER_NAME']."/public"          	);
define("VIEW_PATH"    		, realpath('../classes/view') 					); 
define("CONTROLLER_PATH"    , realpath('../classes/controller') 			);
define("MODEL_PATH"			, realpath('../classes/model')      			); 
define("DAO_PATH"			, realpath('../classes/model/dao')      		); 
define("RESOURCE_PATH"		, realpath('../classes/resource')   			); 
define("REGISTERS_PATH"		, realpath('../classes/resource/registers')     ); 
define("CLASSES_PATH"		, realpath('../classes')      					); 
define("PAGES_PATH"		    , realpath('../classes/view/pages')      		);
define("HELPER_PATH"		, realpath('../classes/view/helpers') 	);
define("CONFIG_PATH"		, realpath('../config') 						);    

//arquivo que configura o doctrine
require_once "bootstrap.php";

?>
