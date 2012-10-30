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

require_once RESOURCE_PATH   . "/ServiceLocator.php";
require_once CONTROLLER_PATH . "/FrontController.php";
require_once CONTROLLER_PATH . "/ApplicationController.php";
require_once CLASSES_PATH    . "/Authorization.php";
require_once CLASSES_PATH    . "/Request.php";
require_once CLASSES_PATH    . "/UsersEnum.php";

require_once (MODEL_PATH . "/VolunteerNaturalPerson.php");
/*
$volunterr = new VolunteerNaturalPerson();
$volunterr->setCpf(rand());
$volunterr->setName('Joaose');
$volunterr->setReceiveNotification(true);
$volunterr->setEmail('asdasdas');
$volunterr->setPassword('123123');
$volunterr->setPhone(123123);
$volunterr->setHowYouKnow('sadfasd');
$volunterr->setPublic('asdasdas');
$volunterr->setCep(123123);
$volunterr->setExperience('asdas');
$em->persist($volunterr);
$em->flush();*/
/*} catch (Exception $e) {
	echo $e->getMessage();
}*/

//Encapsulando a requição
$request = new Request();

//$auth = new Authorization($request);
//Passando um filtro para checar se o usuário tem permissão 
//$auth->authorizate();


$front_controller = new FrontController($request);
$front_controller->dispatch();

?>
