<?php

require('../vendor/autoload.php');

use mvc\Config\core;
use mvc\Router;
use mvc\Request;
use mvc\Dispatcher;

define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

//require(ROOT . 'Config/Core.php');
//require(ROOT . 'Router.php');
//require(ROOT . 'Request.php');
//require(ROOT . 'Dispatcher.php');

$dispatch = new Dispatcher();
$dispatch->dispatch();

