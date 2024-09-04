<?php
session_start();

require("config/commandes.php");

$cltid = $_SESSION['client']['id'];

vider_panier($cltid);

if (isset($_SESSION['client'])) {
    $_SESSION['client'] = array();
    session_destroy();
    header('location: se_connecter.php');
}
?>