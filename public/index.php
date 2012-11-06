<?php
/**
 * Inclui o arquivo de configuração.
 * @see config/config.php
 * @TODO: Incluir de uma forma mais elegante
 */
require_once("../config/config.php");  

/**
 * Script inicial que lida com autorização de visualização de páginas e
 * despacha para as ações designadas através do front controller.
 * <b>Obs: Todas as requisições passarão por esse script.</b>
 * 
 */
require_once('../config/spl_autoload_register.php');

//não sei ao certo, mas parece que para a session funcionar, devemos usar o session_start. Desta forma
//devomos escolher um lugar melhor do que aqui.
//session_start();

//Encapsulando a requição
$request = new Request();

//$auth = new Authorization($request);
//Passando um filtro para checar se o usuário tem permissão 
//$auth->authorizate();

$front_controller = new FrontController($request);
$front_controller->dispatch();

?>

