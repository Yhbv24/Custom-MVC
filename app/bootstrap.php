<?php

// Load dependencies
require_once('../vendor/autoload.php');

// Load config
require_once('config/config.php');

// Libraries autoloader
spl_autoload_register(function($className) {
    require_once('libraries/' . $className . '.php');
});