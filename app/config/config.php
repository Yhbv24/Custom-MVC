<?php

require_once('password.php');

// Database parameters
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', $password);
define('DB_NAME', 'custom_mvc');
define('DB_CHARSET', 'utf8_general_ci');

// App root
define('APP_ROOT', dirname(dirname(__FILE__)));

// URL root
define('URL', 'http://localhost:8888/custom_mvc');

// Site name
define('SITE_NAME', 'My Custom MVC');