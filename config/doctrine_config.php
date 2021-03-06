<?php
require LIB_PATH."/Doctrine/ORM/Tools/Setup.php";
require "database-config.php";

use Doctrine\ORM\Proxy\Autoloader;

//Guilherme fez isso para conseguir rodar no windows
$lib = LIB_PATH;
Doctrine\ORM\Tools\Setup::registerAutoloadDirectory($lib);

Doctrine\ORM\Tools\Setup::registerAutoloadPEAR();

$proxyDir = LIB_PATH . '/Proxies';
//nome do namespace dos proxys
$proxyNamespace = 'jci\Doctrine\Proxies';

$paths = array(MODEL_PATH);
$isDevMode = false;

/*OBS:Se mudar o diretório, os proxys devem ser gerados novamente(ou copiados de pasta)*/
//nome do diretório que vai conter os objetos proxys do doctrine
$proxyDir = LIB_PATH . '/Proxies';
//nome do namespace dos proxys
$proxyNamespace = 'jci\Doctrine\Proxies';

Autoloader::register($proxyDir, $proxyNamespace);
//agora o entity manager é criado apenas no DAO e cli-config
