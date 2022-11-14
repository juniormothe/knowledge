<?php
session_start();
ob_start();


$http_https = 'http://';
define('GETT', filter_input_array(INPUT_GET,  FILTER_DEFAULT));
define('POSTT', filter_input_array(INPUT_POST, FILTER_DEFAULT));
define('URL', '' . $http_https . 'localhost/knowledge/');
define('URL_ATUAL', $http_https . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
define('DIRECTORY', 'C:/xampp/localhost/knowledge/');
define('IMG', '' . $http_https . 'localhost/knowledge/image/');
define('TITULO', 'Development');
define('HOST', 'localhost');
define('PORT', '3306');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'knowledge');
define('LIMIT_PG', 15);


/*
$http_https = 'http://';
define('GETT', filter_input_array(INPUT_GET,  FILTER_DEFAULT));
define('POSTT', filter_input_array(INPUT_POST, FILTER_DEFAULT));
define('URL', '' . $http_https . '34.151.243.222/knowledge/');
define('URL_ATUAL', $http_https . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
define('DIRECTORY', 'C:/xampp/localhost/knowledge/');
define('IMG', '' . $http_https . '34.151.243.222/knowledge/image/');
define('TITULO', 'Development');
define('HOST', 'localhost');
define('PORT', '3306');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'take_care');
define('LIMIT_PG', 15);
*/