<?php
	
	//For DEBUGGING
	// TODO: turn off in production
	ini_set('display_errors', 'On');	

	// autoload everything we'll need to run the app
	require_once __DIR__ . '/../vendor/autoload.php';
	use \Slim\Slim;

	/**************************************************************************
	*				Routing set up
	***************************************************************************/

	// create the Slim app
	$app = new Slim(array(
		'debug' => true,				// TODO: Turn this off in production
		'view' => new ViewRenderer()
	));

	// Include all the route files
    foreach (glob('../src/routes/*.php') as $routeFile) {
    	require $routeFile;
    }

	// test route TODO: Remove this in production
    $app->get('/hello/:name', function ($name) {
    	echo "Hello, $name";
    });

	// run
	$app->run();
