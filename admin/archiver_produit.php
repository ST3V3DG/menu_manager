<?php

session_start();

if (!isset($_SESSION['administrateur'])) {
    header('location: ../se_connecter.php');
}

if (empty($_SESSION['administrateur'])) {
    header("location: ../se_connecter.php");
}

if (!isset($_GET['pdt'])) {
    header('location: supprimer_produit.php');
}

if (empty($_GET['pdt']) and !is_numeric($_GET['pdt'])) {
    header('location: supprimer_produit.php');
}

$id = $_GET['pdt'];

require("../config/commandes.php");

archiver($id);
header('location: supprimer_produit.php');

?>

<script>
    alert('Le produit a bien été archivé !');
</script>