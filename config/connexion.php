<?php

try {
    //Connexion à la basede données
    $access = new PDO("mysql:host=localhost;dbname=projet;charset=utf8", "root", "");

    //Vérification d'erreur
    $access->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "<h1>Problème de connexion à la base de données !</h1>";
    $e->getMessage();
}

?>