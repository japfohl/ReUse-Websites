<?php

// setup
require_once __DIR__ . "/../vendor/autoload.php";
use MatthiasMullie\Minify;

// get reference to directory where CSS is currently stored
$cssDir = __DIR__ . "/../public_html/css/";

// create array of CSS files to be minified
$cssFiles = [
    $cssDir . "jumbotron-narrow.css",
    $cssDir . "publicsite.css"
];

// create the CSS minifier
$minifier = new Minify\CSS();

// add the css files to the minifier
foreach ($cssFiles as $file) {
    $minifier->add($file);
}

// output the minified CSS for no map
$minifier->minify($cssDir . "app.css");

// add the map css
$minifier->add($cssDir . "map.css");

// minify again
$minifier->minify($cssDir . "app_with_map.css");