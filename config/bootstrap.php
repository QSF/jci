<?php
require_once MODEL_PATH . "/User.php";

if (!class_exists(LIB_PATH . "\Doctrine\Common\Version", false)) {
    require_once "doctrine_config.php";
}