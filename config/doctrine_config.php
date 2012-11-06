<?php
require LIB_PATH."/Doctrine/ORM/Tools/Setup.php";
require "database-config.php";

//Guilherme fez isso para conseguir rodar no windows
$lib = LIB_PATH;
Doctrine\ORM\Tools\Setup::registerAutoloadDirectory($lib);

Doctrine\ORM\Tools\Setup::registerAutoloadPEAR();

$proxyDir = LIB_PATH . '/Proxies';
//nome do namespace dos proxys
$proxyNamespace = 'jci\Doctrine\Proxies';

$paths = array(MODEL_PATH);
$isDevMode = false;
//agora o entity manager é criado apenas no DAO e cli-config
