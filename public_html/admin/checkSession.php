<?php

if(!(isset($_SESSION['id'])) || $_SESSION['id'] == "") {
    header( 'Location: /admin/loginPage.php' ) ;
    exit;
}
