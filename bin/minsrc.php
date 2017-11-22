<?php

// setup
require_once __DIR__ . "/../vendor/autoload.php";
use MatthiasMullie\Minify;

// create the minifiers
$cssMinifier = new Minify\CSS();
$jsMinifier = new Minify\JS();

// add CSS to minifier
foreach (glob(__DIR__ . "/../src/css/*.css") as $css) {
    $cssMinifier->add($css);
}

// add js to minifier
foreach (glob(__DIR__ . "/../src/js/*.js") as $js) {
    $jsMinifier->add($js);
}

// output the minified CSS for no map
$cssMinifier->minify(__DIR__ . "/../public_html/css/app.min.css");

// output the minified js
$jsMinifier->minify(__DIR__ . "/../public_html/js/app.min.js");
