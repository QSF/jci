<?php
require_once "config.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
//Novo local dos objetos do proxy
$config->setProxyDir($proxyDir);
//Nome do namespace
$config->setProxyNamespace($proxyNamespace);
$em = EntityManager::create($dbParams, $config);

use Symfony\Component\Console\Helper\HelperSet;
use Doctrine\ORM\Tools\Console\Helper;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;

$helperSet = new HelperSet(array(
   'em' => new EntityManagerHelper($em)
));
