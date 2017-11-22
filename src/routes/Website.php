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
    $catId = $app->request->get('category');
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

    $qLocs = Query::getLocations($itemType, ['catId' => $catId]);
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

$app->get('/locations', function() use ($app) {

    // get, validate, and parse type
    $type = strtolower($app->request->get('type'));
    if ($type === null) {
        $app->redirect("/");
    } else {
        $type = connectReuseDB()->real_escape_string($type);
        if (ctype_digit($type)) {
            $type = (int)$type;
        } else {
            $app->redirect("/");
        }
    }

    // get, validate, and parse category
    $category = strtolower($app->request->get('category'));
    if ($category !== null) {
        $category = connectReuseDB()->real_escape_string($category);
        if (ctype_digit($category)) {
            $category = (int)$category;
        } else {
            $category = null;
        }
    }

    // get, validate, and parse item
    $item = strtolower($app->request->get('item'));
    if ($item !== null) {
        $item = connectReuseDB()->real_escape_string($item);
        if (ctype_digit($item)) {
            $item = (int)$item;
        } else {
            $item = null;
        }
    }

    // create the side container title
    $title = "Locations";

    if ($item === null && $category === null) {
        $getType = Query::getTypeNameById($type)->fetch_row();
        if (count($getType) != 0) {
            $title = ucfirst(strtolower($getType[0])) . " Locations";
        }
    } else {
        // TODO: make this a bit more dynamic.  Possibley indicate how the locaiton relates to the item in the title
        $getItem = Query::getItemNameById($item)->fetch_row();
        $title = "Organizations Accepting " . ucfirst(strtolower($getItem[0]));
    }

    // do header queries
    list ( $qRepairCats, $qReuseCats, $qRecycleLocs ) = getReuseRepairRecycle();

    // TODO: get rid of this next check once the database makes use of the Resource_Type field for recycle items
    if ($type != 2) {
        // query for the locations matching the parameters
        $qLocs = Query::getLocations($type, [
            'catId' => $category,
            'itemId' => $item
        ]);
    } else {
        $qLocs = Query::getRecycleExclusiveLocations();
    }

    // set headers
    $app->response->headers->set('Content-Type', 'text/html');

    // render
    $app->render('app/appBase.php', array(
        'appTemplate' => 'locationListMap.php',
        'repairCats' => $qRepairCats->fetch_all(MYSQLI_ASSOC),
        'reuseCats' => $qReuseCats->fetch_all(MYSQLI_ASSOC),
        'recycleLocs' => $qRecycleLocs->fetch_all(MYSQLI_ASSOC),
        'hasMap' => true,
        'locations' => [
            [
                'type' => $type,
                'locations' => $qLocs->fetch_all(MYSQLI_ASSOC)
            ]
        ],
        'sideListTitle' => $title,
        'cssSpecial' => array(
            "https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
        )
    ));
});

$app->get('/location/:id', function($id) use ($app) {

    // validate incoming id
    $id = connectReuseDB()->real_escape_string($id);
    if (ctype_digit($id)) {
        $id = (int)$id;
    } else {
        $app->redirect("/");
    }

    // do queries
    list ( $qRepairCats, $qReuseCats, $qRecycleLocs ) = getReuseRepairRecycle();
    $location = Query::getLocationById($id)->fetch_all(MYSQLI_ASSOC);
    $locationItems = Query::getAllItemsForLocation($id);

    // set headers
    $app->response->headers->set('Content-Type', 'text/html');

    // render
    $app->render('app/appBase.php', array(
        'appTemplate' => 'location.php',
        'repairCats' => $qRepairCats->fetch_all(MYSQLI_ASSOC),
        'reuseCats' => $qReuseCats->fetch_all(MYSQLI_ASSOC),
        'recycleLocs' => $qRecycleLocs->fetch_all(MYSQLI_ASSOC),
        'hasMap' => true,
        'locItems' => $locationItems,
        'locInfo' => $location,
        'cssSpecial' => [
            "https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
        ]
    ));
});

$app->get('/search', function() use ($app) {

    // get and escape search term
    $searchTerm = $app->request->get('q');
    if ($searchTerm === null) {
        $app->redirect('/');
    } else {
        $searchTerm = connectReuseDB()->real_escape_string($searchTerm);
    }

    // do header queries
    list ( $qRepairCats, $qReuseCats, $qRecycleLocs ) = getReuseRepairRecycle();

    // get search results
    $results = Query::searchForLocationsByTerm($searchTerm)->fetch_all(MYSQLI_ASSOC);

    // set the side bar title
    if (count($results) == 0) {
        $title = "No results found for " . $searchTerm;
        $hasMap = false;
    } else {
        $title = "Results for " . $searchTerm;
        $hasMap = true;
    }

    // set headers
    $app->response->headers->set('Content-Type', 'text/html');

    // render
    $app->render('app/appBase.php', array(
        'appTemplate' => 'locationListMap.php',
        'repairCats' => $qRepairCats->fetch_all(MYSQLI_ASSOC),
        'reuseCats' => $qReuseCats->fetch_all(MYSQLI_ASSOC),
        'recycleLocs' => $qRecycleLocs->fetch_all(MYSQLI_ASSOC),
        'hasMap' => $hasMap,
        'locations' => [
            [
                'type' => 0,
                'locations' => $results
            ]
        ],
        'sideListTitle' => $title,
        'cssSpecial' => array(
            "https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
        )
    ));
});
