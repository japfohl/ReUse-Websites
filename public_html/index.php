<?php
	
	//For DEBUGGING	
	ini_set('display_errors', 'On');	

	// autoload everything we'll need to run the app
	require_once '../vendor/autoload.php';
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

	// test route
    $app->get('/hello/:name', function ($name) {
    	echo "Hello, $name";
    });

	// run
	$app->run();
