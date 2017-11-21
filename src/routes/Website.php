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

$app->get('/items', function() use ($app) {

    // get the type
    $itemType = strtolower($app->request->get('type'));
    $catId = $app->request->get('cat');

    // must provide the item type
    if ($itemType === null) {
        $app->redirect('/');
    }

    // validate catId
    if ($catId !== null) {
        $catId = connectReuseDB()->real_escape_string($catId);
        if (ctype_digit($catId)) {
            $catId = (int)$catId;
        } else {
            $catId = null;
        }
    }

    $qLocs = $sideTitle = $qItemsCounts = null;

    // perform locs query based on type
    if ($itemType == 'repair') {
        $qLocs = Query::getRepairExclusiveLocations($catId);
        $qItemsCounts = Query::getRepairExclusiveItemsCount($catId);
        $sideTitle = 'Organizations Repairing';
    } else if ($itemType == 'reuse') {
        $qLocs = Query::getReuseExclusiveLocations($catId);
        $qItemsCounts = Query::getReuseExclusiveItemsCounts($catId);
        $sideTitle = 'Items Accepted';
    } else {
        $app->redirect('/');    // only current valid types are repair and reuse
    }

    // get page header required stuff
    list ( $qRepairCats, $qReuseCats, $qRecycleLocs ) = getReuseRepairRecycle();

    // set response headers
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
                'type' => $itemType,
                'locations' => $qLocs->fetch_all(MYSQLI_ASSOC)
            )
        ),
        'sideListTitle' => $sideTitle
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
