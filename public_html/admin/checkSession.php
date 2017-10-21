<?php
    if(!(isset($_SESSION['username'])) || $_SESSION['username'] == "") {
        header( 'Location: /admin/loginPage.php' ) ;
    }
    exit;
?>