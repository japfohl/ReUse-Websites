<?php

// import the Util class
require_once __DIR__ . "/../../src/lib/Util.php";

session_start();

//unset session variables
$_SESSION = [];

//unset cookie
unset($_COOKIE[session_name()]);

//destroy session
session_destroy();

Util::redirect("loginPage.php");