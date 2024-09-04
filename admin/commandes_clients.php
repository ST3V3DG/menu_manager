<?php

session_start();

if (!isset($_SESSION['administrateur'])) {
    header('location: ../se_connecter.php');
}

if (empty($_SESSION['administrateur'])) {
    header("location: ../se_connecter.php");
}

require("../config/commandes.php");

$clients = afficher_clients();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listes des commandes</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <script src="../assets/bootstrap.bundle.min.js"></script>
</head>

<body>

    <nav style="position: sticky; top: 0;" class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="">Panneau de contrôle</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a rel="norefferrer" class="nav-link" aria-current="page" href="index.php">Ajouter</a>
                    </li>
                    <li class="nav-item">
                        <a rel="norefferrer" class="nav-link" href="supprimer_produit.php">Supprimer</a>
                    </li>
                    <li class="nav-item">
                        <a rel="norefferrer" class="nav-link" href="modifier.php">Modifier</a>
                    </li>
                    <li class="nav-item">
                        <a rel="norefferrer" class="nav-link active" href="commandes_clients.php" style="font-weight: bold;">Commandes</a>
                    </li>
                    <li class="nav-item">
                        <a rel="no-referrer" class="nav-link" href="tables.php">Tables</a>
                    </li>
                </ul>
                <div style="display: flex; justify-content: flex-end;">
                    <a rel="norefferrer" class="btn btn-danger" href="deconnexion.php">Se deconnecter</a>
                </div>
            </div>
        </div>
    </nav>
    <br>

    <?php
    foreach ($clients as $client) :
    ?>

    <p style="text-align: center; font-weight: 700; font-size: 20px;"><?= ucfirst($client['nom']) ?></p>

    <table class="table table-striped" style="text-align: center;">

        <thead>

            <tr>

                <td style="font-weight: 700; text-transform: uppercase; font-size: 13px; padding: 18px 0;">noms</td>
                <td style="font-weight: 700; text-transform: uppercase; font-size: 13px; padding: 18px 0;">prix unitaires</td>
                <td style="font-weight: 700; text-transform: uppercase; font-size: 13px; padding: 18px 0;">quantités</td>
                <td style="font-weight: 700; text-transform: uppercase; font-size: 13px; padding: 18px 0;">prix totaux</td>
                <td style="font-weight: 700; text-transform: uppercase; font-size: 13px; padding: 18px 0;">dates</td>
                <td style="font-weight: 700; text-transform: uppercase; font-size: 13px; padding: 18px 0;">opérations</td>

            </tr>

        </thead>

        <tbody>

            <?php
            $mtnt = mtnt_cmd($client['id']);
            $cltid = $client["id"];
            $commandes = afficher_commandes($cltid);
            foreach ($commandes as $commande) :
            $pid = $commande["produit"];
            $produit = produit($pid);
            if($mtnt['mtnt'] != 0){
            ?>
                <tr>
                    <td><?= ucfirst($produit['nom']) ?></td>
                    <td><?= number_format($produit["prix"], 0, '', ' ') ?> frs</td>
                    <td><?= $commande['quantite'] ?></td>
                    <td style="font-weight: bold;"><?= number_format($commande['prixTotal'], 0, '', ' ') ?> frs</td>
                    <td><?= $commande['dateCmd'] ?></td>
                    <td>
                        <div style="justify-content: center;">
                            <a style="margin-right: 5px;" rel="noreferrer" class="btn btn-danger" href="supp_commande.php?id=<?= $commande['id'] ?>&cltid=<?= $client['id'] ?>">Supprimer</a>
                            <input style="margin-left: 5px;" type="checkbox" name="solde" checked>  Soldé
                        </div>
                    </td>
                </tr>
            <?php
            }else{
            ?>
                <tr>
                    <td colspan="6" style="text-align: center; font-weight: bold;">Aucune commande n'a encore été enregistré !</td>
                </tr>
            <?php
            }
            endforeach;
            ?>
            
            <tr>
                <td colspan="4" style="font-weight: bold; font-size: 20px;">DÉPENSES TOTALES :</td>
                <td></td>
                <td colspan="2" style="color: green; font-weight: bold; font-size: 20px;"><?= number_format($mtnt['mtnt'], 0, '', ' ') ?> frs</td>
            </tr>

        </tbody>

    </table>
    <br><br>

    <?php
    endforeach;
    ?>
    
</body>
</html>