<?php

session_start();

if (!isset($_SESSION['administrateur'])) {
    header('location: ../se_connecter.php');
}

if (empty($_SESSION['administrateur'])) {
    header("location: ../se_connecter.php");
}

require("../config/commandes.php");

$produits = afficher();
$clients = afficher_clients();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <script src="../assets/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <nav style="position: sticky; top: 0; z-index: 99;" class="navbar navbar-expand-lg bg-body-tertiary">
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
                        <a rel="norefferrer" class="nav-link active" href="modifier.php" style="font-weight: bold;">Modifier</a>
                    </li>
                    <li class="nav-item">
                        <a rel="norefferrer" class="nav-link" href="commandes_clients.php">Commandes</a>
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
    <p style="font-size: 20px; text-align: center; font-weight: bold;">PRODUITS</p>
    <div class="album  py-Sbg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <table class="table" style="text-align: center;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">IMAGES</th>
                            <th scope="col">NOMS</th>
                            <th scope="col">CATEGORIES</th>
                            <th scope="col">PRIX</th>
                            <th scope="col">DESCRIPTIONS</th>
                            <th scope="col">EDITER</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($produits as $produit) :

                            switch ($produit['categorie']) {
                                case '1':
                                    $cate = 'repas';
                                    break;
                                case '2':
                                    $cate = 'boisson';
                                    break;
                                
                                default:
                                    $cate = 'repas';
                                    break;
                            }

                            if($produit['archiver'] == false){
                        ?>
                            <tr>
                                <th scope="row"><?= $produit['id'] ?></th>
                                <td><img style="width: 30%;" src="../img/<?= $produit['image'] ?>" alt="<?= $produit['nom'] ?>"></td>
                                <td style="width: 100px;"><?= ucfirst($produit['nom']) ?></td>
                                <td style="width: 100px;"><?= ucfirst($cate) ?></td>
                                <td style="width: 100px; font-weight: bold;"><?= number_format($produit["prix"], 0, '', ' ') ?> frs</td>
                                <td style="text-align: start;"><?= ucfirst(substr($produit['description'], 0, 100)) ?>...</td>
                                <td><a href="editer.php?pdt=<?= $produit['id'] ?>"><i class="fa fa-pencil"></i></a></td>
                            </tr>
                        <?php
                            }else{?>
                            
                            <tr style="color: darkgrey;">
                                <th scope="row"><?= $produit['id'] ?></th>
                                <td><img style="width: 30%; opacity: 0.3;" src="../img/<?= $produit['image'] ?>" alt="<?= $produit['nom'] ?>"></td>
                                <td style="width: 100px; color: darkgrey;"><?= ucfirst($produit['nom']) ?></td>
                                <td style="width: 100px; color: darkgrey;"><?= ucfirst($cate) ?></td>
                                <td style="width: 100px; color: darkgrey; font-weight: bold;"><?= number_format($produit["prix"], 0, '', ' ') ?> frs</td>
                                <td style="color: darkgrey; text-align: start;"><?= ucfirst(substr($produit['description'], 0, 100)) ?>...</td>
                                <td><a><i style="color: darkgrey;" class="fa fa-pencil"></i></a></td>
                            </tr>

                            <?php
                            }
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <p style="font-size: 20px; text-align: center; font-weight: bold;">CLIENTS</p>
    <div class="album  py-Sbg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <table class="table" style="text-align: center;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NOMS DES CLIENTS</th>
                            <th scope="col">MOTS DE PASSE</th>
                            <th scope="col">TÉlÉPHONES</th>
                            <th scope="col">EMAILS</th>
                            <th scope="col">SEXES</th>
                            <th scope="col">DATES D'INSCRIPTION</th>
                            <th scope="col">EDITER</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($clients as $client) :

                            switch ($client['sexe']) {
                                case '1':
                                    $sexe = 'MASCULIN';
                                    break;
                                case '2':
                                    $sexe = 'FEMININ';
                                    break;
                                
                                default:
                                    $sexe = 'MASCULIN';
                                    break;
                            }
                        ?>
                            <tr>
                                <th scope="row"><?= $client['id'] ?></th>
                                <td><?= ucfirst($client['nom']) ?></td>
                                <td style="width: 170px;"><?= $client['motDePasse'] ?></td>
                                <td style="width: 100px;"><?= $client['tel'] ?></td>
                                <td style="width: 100px; font-weight: bold;"><?= $client['email'] ?></td>
                                <td><?= $sexe ?></td>
                                <td style="width: 150px; font-weight: bold;"><?= $client['dateCreation'] ?></td>
                                <td><a href="editer_client.php?cltid=<?= $client['id'] ?>"><i class="fa fa-pencil"></i></a></td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>