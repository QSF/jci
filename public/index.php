<?php
/**
 * Inclui o arquivo de configuração.
 * @see config/config.php
 * @TODO: Incluir de uma forma mais elegante
 */
require_once("../config/config.php");  
require_once('spl_autoload_register.php');
session_start();

$dao = ServiceLocator::getInstance()->getDAO('UserDAO');

//Encapsulando a requição
$request = new Request();

//$auth = new Authorization($request);
//Passando um filtro para checar se o usuário tem permissão 
//$auth->authorizate();


$front_controller = new FrontController($request);
$front_controller->dispatch();

?>

