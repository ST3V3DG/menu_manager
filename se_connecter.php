<?php
session_start();

include("config/commandes.php");

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="assets/se_connecter.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="login">
            <h2>Connexion</h2>
            <form method="post">

                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input placeholder="Entrez votre nom d'utilisateur" type="name" name="nom" required>
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input placeholder="Entrez votre mot de passe" type="password" name="motdepasse" required>
                </div>

                <div class="checkbox" style="color: #162938; margin-bottom: 10px; margin-top: -12px;">
                    <input id="admin" type="checkbox" name="admin">
                    <label for="admin" class="icon">Je suis un administrateur</label>
                </div>

                <input type="submit" class="btn" name="seconnecter" value="Se connecter">

                <div style="translate: 5px 10px;" class="oublie">
                    <a style="font-size: 15px; color: #162938; font-weight: bold; margin: -5px 0 15px;" href="#">Mot de passe oublié</a>
                </div>

                <div class="inscription">
                    <p>Vous n'avez pas de compte ? <a rel="noreferrer" href="s'inscrire.php" class="lien_inscription">Inscription</a></p>
                </div>

            </form>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['seconnecter'])) {

    if(!isset($_POST['admin'])){  
        if (!empty($_POST['nom']) and !empty($_POST['motdepasse'])) {

            $nom = htmlspecialchars(strip_tags($_POST['nom']));
            $motdepasse = htmlspecialchars(strip_tags($_POST['motdepasse']));
            $client = client($nom, $motdepasse);

            if ($client) {

                $_SESSION['client']['id'] = $client['id'];
                vider_panier($_SESSION['client']['id']);
                header('location: index.php');
            } else {

                echo '<script>alert("Nom ou mot de passe incorrect !");</script>';
            }
        }
    }else{
        if (!empty($_POST['nom']) and !empty($_POST['motdepasse'])) {

            $nom = htmlspecialchars(strip_tags($_POST['nom']));
            $motdepasse = htmlspecialchars(strip_tags($_POST['motdepasse']));
            $admin = admin($nom, $motdepasse);
    
            if ($admin) {
    
                $_SESSION['administrateur']['id'] = $admin['id'];
                header('location: admin/index.php');
            } else {
    
                echo '<script>alert("Nom ou mot de passe incorrect !");</script>';
            }
        }
    }
}

?>