<?php
define('CONTROLLERS', '../app/controllers/');
define('VIEWS', '../app/views/');
define('MODELS', '../app/models/');

require_once('../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

require_once('../app/config.php');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
require_once('../system/System.php');
require_once('../system/Controller.php');
require_once('../system/Model.php');

spl_autoload_register(function($file){
    if (file_exists(MODELS . $file . '.php')) {
        require_once( MODELS . $file . '.php');
    } else if (file_exists('../app/services/' . $file . '.php')) {
        require_once('../app/services/' . $file . '.php');
    } else if (file_exists('../app/observers/' . $file . '.php')) {
        require_once('../app/observers/' . $file . '.php');
    } else if (file_exists('../app/listeners/' . $file . '.php')) {
        require_once('../app/listeners/' . $file . '.php');
    } else if (file_exists('../system/' . $file . '.php')) {
        require_once('../system/' . $file . '.php');
    }
});

// Register Example Listeners
EventManager::listen('user.created', function($data) {
    (new WelcomeEmailListener())->handle($data);
});

$start = new System();
$start->run();
