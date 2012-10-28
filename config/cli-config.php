<?php
require_once "config.php";

use Symfony\Component\Console\Helper\HelperSet;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;

$helperSet = new HelperSet(array(
   'em' => new EntityManagerHelper($em)
));
