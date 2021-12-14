<?php

use Routes\Route;

include 'Routes/Route.php';

define('BASEPATH','/');

Route::add('/', function() {
    echo 'Welcome :-)';
});

Route::add('/api/v1/([a-z-0-9-]*)', function($slug) {
    include("locator.php");
});


Route::pathNotFound(function($path) {
    header('HTTP/1.0 404 Not Found');
    echo 'Error 404 :-(<br>';
    echo 'The requested path "'.$path.'" was not found!';
});

Route::methodNotAllowed(function($path, $method) {

    header('HTTP/1.0 405 Method Not Allowed');
    echo 'Error 405 :-(<br>';
    echo 'The requested path "'.$path.'" exists. But the request method "'.$method.'" is not allowed on this path!';
});



Route::run(BASEPATH);
