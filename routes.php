<?php

$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

$router->get('/notes', 'notes/NotesController@index')->only('auth');
$router->get('/note', 'notes/NotesController@show')->only('auth');
$router->delete('/note', 'notes/NotesController@destroy')->only('auth');

$router->get('/note/edit', 'notes/NotesController@edit')->only('auth');
$router->patch('/note', 'notes/NotesController@update')->only('auth');

$router->get('/notes/create', 'notes/NotesController@create')->only('auth');
$router->post('/notes', 'notes/NotesController@store')->only('auth');

$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');

$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');
