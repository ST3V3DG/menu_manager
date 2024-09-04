<?php

include("config/commandes.php");

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="assets/se_connecter.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <div class="wrapper" style="height: auto; background-color: grey;">
        <div class="login">
            <h2>Inscription</h2>
            <form method="post">

                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input placeholder="Entrez votre nom d'utilisateur" type="name" name="nom" required>
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="call"></ion-icon></span>
                    <input placeholder="Entrez votre numéro de téléphone" minlength=9 maxlength=9 type="tel" name="tel" required>
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon style="font-weight: 900; font-size: 25px;" name="male-female"></ion-icon></span>
                    <select name="sexe" style="width: 100%; height: 100%; background: transparent; border: none; outline: none; font-size: 18px; color: #162938; font-weight: 600; padding: 0 35px 0 5px;" name="nom" required>
                        <option>MASCULIN</option>
                        <option>FEMININ</option>
                    </select>
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input placeholder="Entrez votre email" type="email" name="email" required>
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input placeholder="Entrez votre mot de passe" type="password" name="motdepasse" required minlength=4>
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input placeholder="Confirmez votre mot de passe" type="password" name="mdp" required>
                </div>

                <input type="submit" class="btn" id="btn" name="inscription" value="S'inscrire">

                <div class="inscription">
                    <p>Vous avez déjà un compte ? <a rel="noreferrer" href="se_connecter.php" class="lien_inscription">Se connecter</a></p>
                </div>

            </form>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['inscription'])) {

    if (!empty($_POST['nom']) and !empty($_POST['motdepasse']) and !empty($_POST['tel']) and !empty($_POST['email'])) {

        $nom = htmlspecialchars(strip_tags(strtolower($_POST['nom'])));
        $email = htmlspecialchars(strip_tags(strtolower($_POST['email'])));
        $motdepasse = htmlspecialchars(strip_tags(strtolower($_POST['motdepasse'])));
        $mdp = htmlspecialchars(strip_tags(strtolower($_POST['mdp'])));
        $sexe = htmlspecialchars(strip_tags(strtolower($_POST['sexe'])));
        $phn = (int)htmlspecialchars(strip_tags(strtolower($_POST['tel'])));

        if($phn == true){

            $tel = htmlspecialchars(strip_tags(strtolower($_POST['tel'])));
            if ($sexe == 'masculin') {
                $sx = true;
            } else {
                $sx = false;
            }
            $Client1 = verif_email($email);
            $Client2 = verif_mdp($motdepasse);
            $Client3 = verif_tel($tel);
            $Client4 = verif_nom($nom);

            if(!empty($Client1) || !empty($Client2) || !empty($Client3) || !empty($Client4)){
                if (!empty($Client4)) {
                    
                    echo ('<script>alert("Ce nom d\'utilisateur a déjà été enregistré, veillez en choisir un autre !");</script>');
                }
                if (!empty($Client2)) {
                    
                    echo ('<script>alert("Ce mot de passe a déjà été enregistré, veillez en choisir un autre !");</script>');

                }
                if (!empty($Client3)) {
                    
                    echo ('<script>alert("Ce numéro de téléphone a déjà été enregistré, veillez en choisir un autre !");</script>');
                }
                if (!empty($Client1)) {
                    
                    echo ('<script>alert("Cet email a déjà été enregistré, veillez en choisir un autre !");</script>');

                }

            } else {
            
                if ($motdepasse == $mdp) {
            
                    ajouter_client($nom, $email, $sx, $tel, $motdepasse);
                    header('location: se_connecter.php');

                } else {
                
                    echo '<script>alert("Veuillez vérifier votre mot de passe !");</script>';
                }
            }
        } else{

            echo '<script>alert("Veuillez entrer un numéro de téléphone correct !");</script>';
        }
    }
}

?>
