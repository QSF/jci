<?php 
require_once('auto_load.php');

//Relembrando que a ordem de registro influi no desempenho (por ser uma fila), ou seja, registrar as classes mais usadas antes
spl_autoload_register(null, false);
spl_autoload_extensions('.php, .class.php');
spl_autoload_register('AutoLoad::autoload_classes');
spl_autoload_register('AutoLoad::autoload_controller');
spl_autoload_register('AutoLoad::autoload_model');
spl_autoload_register('AutoLoad::autoload_dao');
spl_autoload_register('AutoLoad::autoload_resource');
spl_autoload_register('AutoLoad::autoload_register');
spl_autoload_register('AutoLoad::autoload_view');
?>