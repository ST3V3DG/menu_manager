<?php

session_start();

require("config/commandes.php");

if (isset($_GET['id'])) {

    $pid = $_GET['id'];
    $cltid = $_SESSION['client']['id'];
    $panier = deja_panier($cltid, $pid);
    if(!empty($panier)){

        header('location: index.php#product1');
        echo '<script>alert("Ce produit est déjà dans votre panier !");</script>';
        
    }else{
        ajouter_panier2($cltid, $pid);
        echo '<script>alert("Le produit a bien été ajouté à votre panier !");</script>';
        header('location: index.php#product1');

    }
}
