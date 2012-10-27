<?php
// cli-config.php
require_once "bootstrap.php";

$helperSet = new \LIB_PATH\Symfony\Component\Console\Helper\HelperSet(array(
    'em' => new \LIB_PATH\Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));
