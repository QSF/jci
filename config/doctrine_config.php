<?php
require 'Doctrine/ORM/Tools/Setup.php';

Doctrine\ORM\Tools\Setup::registerAutoloadPEAR();

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array("Model");
$isDevMode = false;

// the connection configuration
$dbParams = array(
    'dbname' => 'jci',
    'user' => 'root',
    'password' => 'toor',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$em = EntityManager::create($dbParams, $config);

// or if you prefer yaml or xml
$config = Setup::createXMLMetadataConfiguration($paths, $isDevMode);
$config = Setup::createYAMLMetadataConfiguration($paths, $isDevMode);