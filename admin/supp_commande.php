<?php

session_start();

if (!isset($_SESSION['administrateur'])) {
    header('location: ../se_connecter.php');
}

if (empty($_SESSION['administrateur'])) {
    header("location: ../se_connecter.php");
}

if (!isset($_GET['id'])) {
    header('location: commandes.php');
}

if (empty($_GET['id']) and !is_numeric($_GET['id'])) {
    header('location: commandes.php');
}

require("../config/commandes.php");

supp_cmd($_GET['id']);
header('location: commandes.php?id='.$_GET['cltid']);

?>