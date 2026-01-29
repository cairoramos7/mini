<?php
define('CONTROLLERS', '../app/controllers/');
define('VIEWS', '../app/views/');
define('MODELS', '../app/models/');

require_once('../app/config.php');
require_once('../system/system.php');
require_once('../system/controller.php');
require_once('../system/model.php');

spl_autoload_register(function($file){
    if (file_exists(MODELS . $file . '.php')) {
        require_once( MODELS . $file . '.php');
    }
});

$start = new System();
$start->run();
