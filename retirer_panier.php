<?php

require("config/commandes.php");

if (isset($_GET['pid'])) {

    $pid = $_GET['pid'];
    retirer_panier($pid);
    header('location: cart.php');

}

?>