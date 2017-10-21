<?php

/**
 * GET /
 * Route for the main website page
 * TODO: document
 */
$app->get('/', function() use ($app) {

    // perform queries
    $qDonors = Query::getAllUniqueDonors();
    $qRecycleLocs = Query::getRecycleExclusiveLocations();
    $qRepairLocs = Query::getRepairExclusiveLocations();
    $qReuseLocs = Query::getReuseExclusiveLocations();
    $qRepairCats = Query::getRepairExclusiveCategories();
    $qReuseCats = Query::getReuseExclusiveCategories();

    // set the response type
    $app->response->headers->set('Content-Type', 'text/html');

    // render the page
    $app->render('home.php', array(
        'donors' => $qDonors->fetch_all(MYSQLI_ASSOC),
        'recycleLocs' => $qRecycleLocs->fetch_all(MYSQLI_ASSOC),
        'repairLocs' => $qRepairLocs->fetch_all(MYSQLI_ASSOC),
        'reuseLocs' => $qReuseLocs->fetch_all(MYSQLI_ASSOC),
        'repairCats' => $qRepairCats->fetch_all(MYSQLI_ASSOC),
        'reuseCats' => $qReuseCats->fetch_all(MYSQLI_ASSOC),
        'isAdminTemplate' => false
    ));
});

$app->get('/about', function() use ($app) {
    // TODO: render the about page
});

$app->get('/contact', function() use ($app) {
    // TODO: render contact page
});
