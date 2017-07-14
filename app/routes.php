<?php

$router = new \Kernel\Router();

$router->get('/post', 'PostController@index');
$router->post('/post/upload', 'PostController@upload');
$router->post('/post/submit', 'PostController@submit');
$router->get('/post/edit', 'PostController@edit');
$router->post('/post/update', 'PostController@update');
$router->get('/post/delete', 'PostController@delete');

return $router;