<?php
global $routes;
$routes = array();

// method POST
// parameters (email, pass)
$routes['/users/login'] = '/users/login';

// method POST
// parameters (name, email, pass)
$routes['/users/new'] = '/users/new';

// method GET
// parameters (token)
$routes['/users/view'] = '/users/view';

// method PUT
// parameters (token, [name, email, pass])
$routes['/users/update'] = '/users/update';

// method POST
// parameters (token, [avatar=image_file])
$routes['/users/avatar'] = '/users/avatar';

// method DELETE
// parameters (token)
$routes['/users/delete'] = '/users/delete';

// method GET
// parameters (token)
$routes['/users/photos'] = '/users/photos';

// method POST
// parameters (token, [id_user])
$routes['/users/follow'] = '/users/follow';

// method POST
// parameters (token, [id_user])
$routes['/users/unfollow'] = '/users/unfollow';

// method GET
// parameters (token)
$routes['/users/following'] = '/users/following';

// method GET
// parameters (token)
$routes['/users/followers'] = '/users/followers';

// method POST
// parameters (token, [photo=image_file])
$routes['/photos/new'] = '/photos/new';

$routes['/photos/comment'] = '/photos/comment';

$routes['/photos/comment'] = '/photos/uncomment';

$routes['/photos/like'] = '/photos/like';

$routes['/photos/unlike'] = '/photos/unlike';

$routes['/users/feed'] = '/users/feed';
