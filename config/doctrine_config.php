<?php
require LIB_PATH."/Doctrine/ORM/Tools/Setup.php";
require "database-config.php";

//Guilherme fez isso para conseguir rodar no windows
$lib = LIB_PATH;
Doctrine\ORM\Tools\Setup::registerAutoloadDirectory($lib);

Doctrine\ORM\Tools\Setup::registerAutoloadPEAR();

$paths = array(MODEL_PATH);
$isDevMode = false;
//agora o entity manager é criado apenas no DAO e cli-config
