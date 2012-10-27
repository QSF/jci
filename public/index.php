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

require_once CONTROLLER_PATH . "/FrontController.php";
require_once CLASSES_PATH    . "/Authorization.php";
require_once CLASSES_PATH    . "/Request.php";

//Encapsulando a requição
$request = new Request();


//*****************MOSTRA DO USO DO DOCTRINE****************
$user = new User();
$user->setName('Adilson God');

//$em é do tipo entity manager e gerencia o ciclo de vida de nossas  entidades
//Guardar ess $em na registry
$em->persist($user);
$em->flush();

echo "Created User with ID " . $user->getId() . "\n";


//Se usássemos Active Record, o seguinte código salvaria nosso user no bd
//$user->save();

//Doctrine2 foi feito pra funcionar com data mapper
//Checar se com Active Record teremos todas as funcionalidades do doctrine
//Links Interessantes:
//http://www.doctrine-project.org/blog/your-own-orm-doctrine2.html#doctrine2-and-activerecord

// http://stackoverflow.com/questions/2169832/data-mapper-vs-active-record

/*
$auth = new Authorization($request);
//Passando um filtro para checar se o usuário tem permissão 
$auth->authorizate();


$front_controller = new FrontController($request);
$front_controller->dispatch();*/

?>
