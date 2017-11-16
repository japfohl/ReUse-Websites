<?php
/**********************************************************************
 *          Session set up
 **********************************************************************/

/* error check */
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* start session */
session_start();
include("checkSession.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Corvallis Reuse and Repair Directory: Web Portal</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/customStylesheet.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Rubik:700' rel='stylesheet' type='text/css'>
</head>
<body>
<!-- Main container -->
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <br><h3>Do you want to Logout?</h3><hr><br>
            <!-- main instruction set -->
            <p align="center">
                <a href="endSession.php" type="button" class="btn btn-primary">Logout</a>
            </p>
            <!-- Hidden row for displaying login errors -->
            <div class="row">
                <div class="col-xs-12 cold-md-8" Id="output2"></div>
            </div class="row"><!-- end inner row -->
        </div>
    </div>
</div> <!-- end container-->

</body>
</html>
