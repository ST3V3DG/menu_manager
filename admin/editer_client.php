<?php

session_start();

if (!isset($_SESSION['administrateur'])) {
    header('location: ../se_connecter.php');
}

if (empty($_SESSION['administrateur'])) {
    header("location: ../se_connecter.php");
}

if (!isset($_GET['cltid'])) {
    header('location: modifier.php');
}

if (empty($_GET['cltid']) or !is_numeric($_GET['cltid'])) {
    header('location: modifier.php');
}

$id = $_GET['cltid'];

require("../config/commandes.php");

$client = clt($id);


switch ($client['sexe']) {
    case '1':
        $sexe = 'masculin';
        break;
    case '2':
        $sexe = 'feminin';
        break;
    
    default:
        $sexe = 'masculin';
        break;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour du compte client</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <script src="../assets/bootstrap.bundle.min.js"></script>
</head>

<body>

    <nav style="position: sticky; top: 0;" class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a rel="noreferrer" class="navbar-brand" href="">Panneau de contrôle</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a rel="noreferrer" class="nav-link" aria-current="page" href="index.php">Ajouter</a>
                    </li>
                    <li class="nav-item">
                        <a rel="noreferrer" class="nav-link" href="supprimer_produit.php">Supprimer</a>
                    </li>
                    <li class="nav-item">
                        <a rel="noreferrer" class="nav-link" href="modifier.php">Modifier</a>
                    </li>
                    <li class="nav-item">
                        <a rel="norefferrer" class="nav-link" href="commandes_clients.php">Commandes</a>
                    </li>
                    <li class="nav-item">
                        <a rel="no-referrer" class="nav-link" href="tables.php">Tables</a>
                    </li>
                </ul>
                <div style="display: flex; justify-content: flex-end;">
                    <a rel="noreferrer" class="btn btn-danger" href="deconnexion.php">Se deconnecter</a>
                </div>
            </div>
        </div>
    </nav>
    <br>
    <div class="album  py-Sbg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <form method="post" action="#">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nom de l'utilisateur</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nom" value="<?= ucfirst($client['nom']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mot de passe du client</label>
                        <input type="text" required class="form-control" name="motdepasse" value="<?= $client['motDePasse'] ?>" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Numéro du client</label>
                        <input type="tel" required class="form-control" name="tel" value="<?= $client['tel'] ?>" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Email du client</label>
                        <input type="email" required class="form-control" name="email" value="<?= $client['email'] ?>" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Sexe du client</label>
                        <select type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="sexe" value="<?= $sexe ?>" required>
                    
                            <option value="masculin">masculin</option>
                            <option value="feminin">feminin</option>

                        </select>
                        
                    </div>
                    <button type="submit" name="valider" class="btn btn-primary">Mettre à jour le compte</button>
                </form>
            </div>

            <div class="pro-container" style="display: flex; justify-content: space-between; padding-top: 20px; flex-wrap: wrap;">
                
            </div>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['valider'])) {

    if (!empty($_POST['nom']) and !empty($_POST['motdepasse']) and !empty($_POST['tel']) and !empty($_POST['email'])) {

        $nom = htmlspecialchars(strip_tags(strtolower($_POST['nom'])));
        $email = htmlspecialchars(strip_tags(strtolower($_POST['email'])));
        $motdepasse = htmlspecialchars(strip_tags(strtolower($_POST['motdepasse'])));
        $sexe = htmlspecialchars(strip_tags(strtolower($_POST['sexe'])));
        $tel = htmlspecialchars(strip_tags(strtolower($_POST['tel'])));

        if ($sexe == 'masculin') {
            $sx = true;
        } else {
            $sx = false;
        }
        
        modif_client($nom, $motdepasse, $tel, $sx, $email, $id);

    }
}

?>