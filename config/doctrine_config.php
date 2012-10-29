<?php
require LIB_PATH."/Doctrine/ORM/Tools/Setup.php";
require "database-config.php";

//Guilherme fez isso para conseguir rodar no windows
$lib = LIB_PATH;
Doctrine\ORM\Tools\Setup::registerAutoloadDirectory($lib);

Doctrine\ORM\Tools\Setup::registerAutoloadPEAR();

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array(MODEL_PATH);
$isDevMode = false;

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$em = EntityManager::create($dbParams, $config);
