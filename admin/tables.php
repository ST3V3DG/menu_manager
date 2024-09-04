<?php

session_start();

if (!isset($_SESSION['administrateur'])) {
    header('location: ../se_connecter.php');
}

if (empty($_SESSION['administrateur'])) {
    header("location: ../se_connecter.php");
}

include('../config/commandes.php');

$tbls = afficher_tables();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tables</title>
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
                        <a rel="no-referrer" class="nav-link active" style="font-weight: bold;" href="tables.php">Tables</a>
                    </li>
                </ul>
                <div style="display: flex; justify-content: flex-end;">
                    <a rel="noreferrer" class="btn btn-danger" href="deconnexion.php">Se deconnecter</a>
                </div>
            </div>
        </div>
    </nav>

    <section>
        <h1 style="margin-left: 7%;">Ajouter une table</h1>
        <br>
        <div class="album  py-Sbg-light" style="margin-top: -40px;">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Numéro de la table</label>
                            <input type="number" class="form-control id" id="exampleInputEmail1" aria-describedby="emailHelp" min="1" name="id" required>
                        </div>
                        <div class="checkbox" style="color: #162938; margin-bottom: 10px; margin-top: -12px;">
                            <input id="new" type="checkbox" name="new">
                            <label for="new">Ajouter une nouvelle table</label>
                        </div>
                        <button type="submit" name="creer" class="btn btn-primary" style="margin: 2px;">Générer le QR code</button>
                        <button type="submit" name="supp" class="btn btn-danger" style="margin: 2px;">Supprimer la table</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="pro-container" style="display: flex; justify-content: space-between; padding: 20px 10px; flex-wrap: wrap;">
            <?php
            foreach ($tbls as $tbl) :
            ?>
                <div class="pro" style="width: 23%; max-width: 200px; min-width: 100px; padding: 10px 12px; border: 1px solid #cce7d0; border-radius: 20px; cursor: pointer; box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.1); margin: 15px 0; transition: 0.3 ease; position: relative;">
                    <div>
                        <div class="des" style="text-align: center; padding: 10px 0;">
                            <h5 style="padding-top: 7px; color: #1a1a1a; font-size: 14px;">Table : <?= $tbl["numero"] ?></h5>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
            ?>
        </div>

    </section>
    <?php

    if (isset($_POST['creer'])) {
        if (isset($_POST['id'])) {
            if (!empty($_POST['id']) and is_numeric($_POST['id'])) {

                $num = htmlspecialchars(strip_tags(trim($_POST['id'])));
                $url = 'http://localhost/projet/tables.php?id=' . $num;

                if (isset($_POST['new'])) {
                    $table = table($num);
                    if (empty($table)) {
                        creer_table($num);
                        echo ('<script>alert("La table a bien été créée !");</script>');
                        } else {
                        echo ('<script>alert("Cette table existe déjà !");</script>');
                    }
                }
                $table = table($_POST['id']);
                if (!empty($table)) {

                    echo ('<img style="margin-left: 4.5%;" src="https://chart.googleapis.com/chart?chs=350x350&cht=qr&chl=' . $url . '&choe=UTF-8">
                    <p style="margin-left: 13%; margin-top: -30px;">Table numéro <b>' . $_POST['id'] . '</b></p>');
                } else {
                    echo ('<script>alert("Cette table n\'existe pas !");</script>');

                }
            }
        }
    }

    if (isset($_POST['supp'])) {
        if (!empty($_POST['id']) and is_numeric($_POST['id'])) {
            $num = htmlspecialchars(strip_tags(trim($_POST['id'])));
            $table = table($num);
            if (!empty($table)) {
                supp_tbl($num);
                echo ('<script>alert("La table à bien été supprimée !");</script>');
            } else {
                echo ('<script>alert("Cette table n\'existe pas !");</script>');
            }
        }
    }

    ?>
</body>

</html>