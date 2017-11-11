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
    $app->render('app/appBase.php', array(
        'appTemplate' => 'home.php',
        'donors' => $qDonors->fetch_all(MYSQLI_ASSOC),
        'recycleLocs' => $qRecycleLocs->fetch_all(MYSQLI_ASSOC),
        'repairLocs' => $qRepairLocs->fetch_all(MYSQLI_ASSOC),
        'reuseLocs' => $qReuseLocs->fetch_all(MYSQLI_ASSOC),
        'repairCats' => $qRepairCats->fetch_all(MYSQLI_ASSOC),
        'reuseCats' => $qReuseCats->fetch_all(MYSQLI_ASSOC),
        'hasMap' => true,
        'mapCallback' => 'initIndexMap',
        'preJsSpecial' => array('js/home.js')
    ));
});

$app->get('/about', function() use ($app) {
    echo "About page";
});

$app->get('/contact', function() use ($app) {

    // do queries
    $qRepairCats = Query::getRepairExclusiveCategories();
    $qReuseCats = Query::getReuseExclusiveCategories();
    $qDonors = Query::getAllUniqueDonors();
    $qRecycleLocs = Query::getRecycleExclusiveLocations();

    // set headers
    $app->response->headers->set('Content-Type', 'text/html');

    // render
    $app->render('app/appBase.php', array(
        'appTemplate' => 'contact.php',
        'repairCats' => $qRepairCats->fetch_all(MYSQLI_ASSOC),
        'reuseCats' => $qReuseCats->fetch_all(MYSQLI_ASSOC),
        'donors' => $qDonors->fetch_all(MYSQLI_ASSOC),
        'recycleLocs' => $qRecycleLocs->fetch_all(MYSQLI_ASSOC),
        'hasMap' => false,
        'cssSpecial' => array(
            "https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
        )
    ));
});
