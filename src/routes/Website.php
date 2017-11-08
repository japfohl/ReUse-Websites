<?php

/**
 * GET /
 * Route for the main website page
 * TODO: document
 */
$app->get('/', function() use ($app) {

    // perform queries
    $qDonor = Query::getAllUniqueDonors();

    // set the response type
    $app->response->headers->set('Content-Type', 'text/html');

    // render the page
    $app->render('home.php', array(
        'donors' => $qDonor->fetch_all(MYSQLI_ASSOC),
        'isAdminTemplate' => false
    ));
});

$app->get('/about', function() use ($app) {
    // TODO: render the about page
});

$app->get('/contact', function() use ($app) {
    // TODO: render contact page
});


