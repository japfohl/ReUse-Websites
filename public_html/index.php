<?php

// autoload everything
require_once dirname(__FILE__).'/../vendor/autoload.php';

//For DEBUGGING
ini_set('display_errors', 'On'); // TODO: turn of in production

/**************************************************************************
*				Routing set up
***************************************************************************/
$app = new \Slim\Slim(
    //More debugging
    array( 'debug' => true )
);

foreach (glob('../App/Api/*.php') as $routeFile) {
        require $routeFile;
}

// TODO: determine if we actually need to set the content type here
$app->response->headers->set('Content-Type', 'application/json');

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->run();
