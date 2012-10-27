<?php 
//este arquivo será incluso no index. Ele possui todas as configurações do nosso projeto.
define("LIB_PATH"    		, realpath('../lib')          		);
define("VIEW_PATH"    		, realpath('../classes/view') 		); 
define("CONTROLLER_PATH"    , realpath('../classes/controller') );
define("MODEL_PATH"			, realpath('../classes/model')      ); 
define("CLASSES_PATH"		, realpath('../classes')      		); 

//criar um usuario jci no seu bd, que possa realizar o CRUD
/**
*@var dbParams possui as configurações do banco de dados.
*/
$dbParams = array(
    'dbname' => 'jci',
    'user' => 'root',
    'password' => 'toor',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
);

//arquivo que configura o doctrine
require_once "bootstrap.php";

?>