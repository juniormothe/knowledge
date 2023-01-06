<?php
//Local

$http_https = 'http://';
define('GETT', filter_input_array(INPUT_GET,  FILTER_DEFAULT));
define('POSTT', filter_input_array(INPUT_POST, FILTER_DEFAULT));
define('URL', '' . $http_https . 'localhost/knowledge/webService/');
define('URL_ATUAL', $http_https . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
define('IMG', '' . $http_https . 'localhost/knowledge/webService/assets/images/');
define('TITULO', 'WebService');
define('HOST', 'localhost');
define('PORT', '3306');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'knowledge');
define('LIMIT_PG', 15);

/*
//PRODUÇÃO
$http_https = 'http://';
define('GETT', filter_input_array(INPUT_GET,  FILTER_DEFAULT));
define('POSTT', filter_input_array(INPUT_POST, FILTER_DEFAULT));
define('URL', '' . $http_https . '34.151.243.222/system/');
define('URL_ATUAL', $http_https . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
define('IMG', '' . $http_https . '34.151.243.222/images/');
define('TITULO', 'Take Care');
define('HOST', 'localhost');
define('PORT', '3306');
define('USER', 'root');
define('PASS', 'KP9Xh2Gm2DYLV1');
define('DBNAME', 'take_care');
define('LIMIT_PG', 15);
*/
