<?php
global $routes;
$routes = array();

$routes['/users/login'] = '/users/login'; 
$routes['/users/new'] = '/users/new';
$routes['/users/view'] = '/users/view'; // add parameter token
$routes['/users/update'] = '/users/update'; // add parameter token
$routes['/users/delete'] = '/users/delete';  // add parameter token
$routes['/users/feed'] = '/users/feed';  // add parameter token
$routes['/users/photos'] = '/users/photos';  // add parameter token
$routes['/users/follow'] = '/users/follow';  // add parameter token

$routes['/photos/random'] = '/photos/random';
$routes['/photos/new'] = '/photos/new'; // add parameter token
$routes['/photos/view'] = '/photos/view'; // add parameter token
$routes['/photos/comment'] = '/photos/comment'; // add parameter token
$routes['/photos/like'] = '/photos/like'; // add parameter token



/**
* eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF91c2VyIjoiNSIsImlzcyI6ImxvY2FsaG9zdCIsImlhdCI6MTY3MzQ3ODAwMCwia2V5X3JlZmVyZW5jZSI6MX0.FsyGA-jAq46sUtQ57AMXXCaaLV73vebSpCl54Agc-S8
*/