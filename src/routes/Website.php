<?php

function getReuseRepairRecycle() {
    return array (
        Query::getRepairExclusiveCategories(),
        Query::getReuseExclusiveCategories(),
        Query::getRecycleExclusiveLocations()
    );
}

/**
 * GET /
 * Route for the main website page
 * TODO: document
 */
$app->get('/', function() use ($app) {

    // perform queries
    list ( $qRepairCats, $qReuseCats, $qRecycleLocs ) = getReuseRepairRecycle();

    $qRepairLocs = Query::getRepairExclusiveLocations();
    $qReuseLocs = Query::getReuseExclusiveLocations();
    $qDonors = Query::getAllUniqueDonors();

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
        'hasMap' => true
    ));
});

$app->get('/about', function() use ($app) {

    // do queries
    list ( $qRepairCats, $qReuseCats, $qRecycleLocs ) = getReuseRepairRecycle();
    $qDonors = Query::getAllUniqueDonors();

    // set headers
    $app->response->headers->set('Content-type', 'text/html');

    // render
    $app->render('app/appBase.php', array(
        'appTemplate' => 'about.php',
        'repairCats' => $qRepairCats->fetch_all(MYSQLI_ASSOC),
        'reuseCats' => $qReuseCats->fetch_all(MYSQLI_ASSOC),
        'donors' => $qDonors->fetch_all(MYSQLI_ASSOC),
        'recycleLocs' => $qRecycleLocs->fetch_all(MYSQLI_ASSOC),
        'hasMap' => false,
    ));
});

$app->get('/contact', function() use ($app) {

    // do queries
    list ( $qRepairCats, $qReuseCats, $qRecycleLocs ) = getReuseRepairRecycle();

    // set headers
    $app->response->headers->set('Content-Type', 'text/html');

    // render
    $app->render('app/appBase.php', array(
        'appTemplate' => 'contact.php',
        'repairCats' => $qRepairCats->fetch_all(MYSQLI_ASSOC),
        'reuseCats' => $qReuseCats->fetch_all(MYSQLI_ASSOC),
        'recycleLocs' => $qRecycleLocs->fetch_all(MYSQLI_ASSOC),
        'hasMap' => false,
        'cssSpecial' => array(
            "https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
        )
    ));
});

$app->get('/repair', function() use ($app) {

    // do queries
    list ( $qRepairCats, $qReuseCats, $qRecycleLocs ) = getReuseRepairRecycle();
    $qRepairLocs = Query::getRepairExclusiveLocations();

    // set headers
    $app->response->headers->set('Content-Type', 'text/html');

    // render
    $app->render('app/appBase.php', array(
        'appTemplate' => 'itemMap.php',
        'repairCats' => $qRepairCats->fetch_all(MYSQLI_ASSOC),
        'reuseCats' => $qReuseCats->fetch_all(MYSQLI_ASSOC),
        'recycleLocs' => $qRecycleLocs->fetch_all(MYSQLI_ASSOC),
        'mapLocs' => array(
            array(
                'type' => 'repair',
                'locations' => $qRepairLocs->fetch_all(MYSQLI_ASSOC)
            )
        ),
        'hasMap' => true,
        'sideListTitle' => 'Organizations Repairing'
    ));
});

$app->get('/reuse', function() use ($app) {

    // do queries
    list ( $qRepairCats, $qReuseCats, $qRecycleLocs ) = getReuseRepairRecycle();
    $qReuseLocs = Query::getReuseExclusiveLocations();
    $qItemsCounts = Query::getExclusiveReuseItemsCounts();

    // set headers
    $app->response->headers->set('Content-Type', 'text/html');

    // render
    $app->render('app/appBase.php', array(
        'appTemplate' => 'itemMap.php',
        'repairCats' => $qRepairCats->fetch_all(MYSQLI_ASSOC),
        'reuseCats' => $qReuseCats->fetch_all(MYSQLI_ASSOC),
        'recycleLocs' => $qRecycleLocs->fetch_all(MYSQLI_ASSOC),
        'itemsCounts' => $qItemsCounts->fetch_all(MYSQLI_ASSOC),
        'hasMap' => true,
        'mapLocs' => array(
            array(
                'type' => 'reuse',
                'locations' => $qReuseLocs->fetch_all(MYSQLI_ASSOC)
            )
        ),
        'sideListTitle' => 'Items Accepted'
    ));
});

$app->get('/recycle', function() use ($app) {

    // do queries
    list ( $qRepairCats, $qReuseCats, $qRecycleLocs ) = getReuseRepairRecycle();

    // set headers
    $app->response->headers->set('Content-Type', 'text/html');

    // render
    $app->render('app/appBase.php', array(
        'appTemplate' => 'locationMap.php',
        'repairCats' => $qRepairCats->fetch_all(MYSQLI_ASSOC),
        'reuseCats' => $qReuseCats->fetch_all(MYSQLI_ASSOC),
        'recycleLocs' => $qRecycleLocs->fetch_all(MYSQLI_ASSOC),
        'hasMap' => true,
        'sideListTitle' => 'Organizations Accepting Recycle'
    ));
});

/*

$app->get('/template', function() use ($app) { // TODO: CHANGE ROUTE NAME

    // do queries
    list ( $qRepairCats, $qReuseCats, $qRecycleLocs ) = getReuseRepairRecycle();

    // set headers
    $app->response->headers->set('Content-Type', 'text/html');

    // render
    $app->render('app/appBase.php', array(
        'appTemplate' => , // TODO: SET THIS
        'repairCats' => $qRepairCats->fetch_all(MYSQLI_ASSOC),
        'reuseCats' => $qReuseCats->fetch_all(MYSQLI_ASSOC),
        'recycleLocs' => $qRecycleLocs->fetch_all(MYSQLI_ASSOC),
        'hasMap' => // TODO: SET THIS
    ));
});

*/
