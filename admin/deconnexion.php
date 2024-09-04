<?php

session_start();

if (isset($_SESSION['administrateur'])) {

    $_SESSION['administrateur'] = array();
    session_destroy();
    header('location: ../se_connecter.php');

} else {

    header('location: ../se_connecter.php');
    
}
