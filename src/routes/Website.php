<?php

/**
 * GET /
 * Route for the main website page
 * TODO: document
 */
$app->get('/', function() use ($app) {

    // perform queries
    $qDonor = Query::getAllUniqueDonors();
    $qRecycle = Query::getRecycleExclusiveLocations();
    $qRepair = Query::getRepairExclusiveCategories();
    $qReuse = Query::getReuseExclusiveCategories();

    // set the response type
    $app->response->headers->set('Content-Type', 'text/html');

    // render the page
    $app->render('home.php', array(
        'donors' => $qDonor->fetch_all(MYSQLI_ASSOC),
        'recycle' => $qRecycle->fetch_all(MYSQLI_ASSOC),
        'repair' => $qRepair->fetch_all(MYSQLI_ASSOC),
        'reuse' => $qReuse->fetch_all(MYSQLI_ASSOC),
        'isAdminTemplate' => false
    ));
});
