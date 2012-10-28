<?php
require 'Doctrine/ORM/Tools/Setup.php';
require "database-config.php";

Doctrine\ORM\Tools\Setup::registerAutoloadPEAR();

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array(MODEL_PATH);
$isDevMode = false;

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$em = EntityManager::create($dbParams, $config);
