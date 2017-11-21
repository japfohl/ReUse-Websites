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

    $qRepairLocs = Query::getLocations(1);
    $qReuseLocs = Query::getLocations(0);
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

    // get, validate, and parse type
    $itemType = strtolower($app->request->get('type'));
    if ($itemType === null) {
        $app->redirect('/');
    } else {
        $itemType = connectReuseDB()->real_escape_string($itemType);
        if (ctype_digit($itemType)) {
            $itemType = (int)$itemType;
        } else {
            $app->redirect("/");
        }
    }

    // get, validate, and parse category
    $catId = $app->request->get('cat');
    if ($catId !== null) {
        $catId = connectReuseDB()->real_escape_string($catId);
        if (ctype_digit($catId)) {
            $catId = (int)$catId;
        } else {
            $catId = null;
        }
    }

    $sideTitle = null;

    // set title of side container based on type
    if ($itemType === 1) {
        $sideTitle = 'Organizations Repairing';
    } else if ($itemType === 0) {
        $sideTitle = 'Items Accepted';
    } else {
        $app->redirect('/');    // only current valid types are repair and reuse
    }

    $qLocs = Query::getLocations($itemType, $catId);
    $qItemsCounts = Query::getItemsCounts($itemType, $catId);

    // get page header required stuff
    list ( $qRepairCats, $qReuseCats, $qRecycleLocs ) = getReuseRepairRecycle();

    // set response headers
    $app->response->headers->set('Content-Type', 'text/html');

    // render
    $app->render('app/appBase.php', [
        'appTemplate' => 'itemMap.php',
        'repairCats' => $qRepairCats->fetch_all(MYSQLI_ASSOC),
        'reuseCats' => $qReuseCats->fetch_all(MYSQLI_ASSOC),
        'recycleLocs' => $qRecycleLocs->fetch_all(MYSQLI_ASSOC),
        'itemsCounts' => $qItemsCounts->fetch_all(MYSQLI_ASSOC),
        'hasMap' => true,
        'mapLocs' => [
            [
                'type' => $itemType,
                'locations' => $qLocs->fetch_all(MYSQLI_ASSOC)
            ]
        ],
        'sideListTitle' => $sideTitle,
        'showItemCats' => $catId === null ? true : false,
        'itemType' => $itemType
    ]);
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
