<?php

session_start();

if (!isset($_SESSION['client'])) {
    header('location: se_connecter.php');
}

if (empty($_SESSION['client'])) {
    header("location: se_connecter.php");
}
require("config/commandes.php");

$mtnt = $_COOKIE['mtnt'];

if (($mtnt != 0)) {

    $i = 0;
    $cltid = $_SESSION['client']['id'];
    $paniers = panier($cltid);
    foreach ($paniers as $panier) :
        $pid = $panier["produit"];
        $produits = afficher_panier($pid);
        foreach ($produits as $produit) :
            $pt = $produit['prix']*$_COOKIE['qnt'.$i];
            commander($cltid, $produit['id'], $_COOKIE['qnt'.$i], $produit['prix'], $pt, $_SESSION['table']);
            $i += 1;
        endforeach;
    endforeach;

    echo("<script>alert('Commande enregistée !');</script>");

    header('location: cart.php');

}else{
    header('location: index.php');
}