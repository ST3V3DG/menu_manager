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
    <title>Suppression</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <script src="../assets/bootstrap.bundle.min.js"></script>
</head>

<body>

    <nav style="position: sticky; top: 0; z-index: 99;" class="navbar navbar-expand-lg bg-body-tertiary">
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
                        <a rel="noreferrer" class="nav-link active" href="supprimer_produit.php" style="font-weight: bold;">Supprimer</a>
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
                <div style="display: flex; justify-content: flex-end; margin: 5px;">
                    <a rel="noreferrer" class="btn btn-danger" href="vider_paniers.php">Vider les paniers</a>
                </div>
                <div style="display: flex; justify-content: flex-end; margin: 5px;">
                    <a rel="noreferrer" class="btn btn-danger" href="deconnexion.php">Se deconnecter</a>
                </div>
            </div>
        </div>
    </nav>
    <br>
    <section>
        <h1 style="margin-left: 100px;">Supprimer un produit</h1>
        <br>
        <div class="album  py-Sbg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <form method="post" action="#">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Identifiant du produit</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" min="1" name="id" required>
                        </div>
                        <button type="submit" name="supprimer" class="btn btn-primary">Supprimer le produit</button>
                    </form>
                </div>
                <div class="pro-container" style="display: flex; justify-content: space-between; padding-top: 20px; flex-wrap: wrap;">
                    <script>
                        var i = 0;
                    </script>
                    <?php
                    foreach ($produits as $produit) :
                        if ($produit['archiver'] == false) {
                    ?>
                            <div class="pro" style="width: 23%; min-width: 250px; padding: 10px 12px; border: 1px solid #cce7d0; border-radius: 20px; cursor: pointer; box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.1); margin: 15px 0; transition: 0.3 ease; position: relative;">
                                <div>
                                    <img style="width: 100%; max-heigth: 200px; border-radius: 10px;" src="../img/<?= $produit['image'] ?>" alt="<?= ucfirst($produit["nom"]) ?>">
                                    <div class="des" style="text-align: start; padding: 10px 0;">
                                        <h5 style="padding-top: 7px; color: #1a1a1a; font-size: 14px;"><?= $produit['id'], '-', ucfirst($produit["nom"]) ?></h5>
                                    </div>
                                </div>
                                <div>
                                    <a href="archiver_produit.php?pdt=<?= $produit['id'] ?>" style="margin-right: 26%; text-decoration: none; margin-left: 5%">Archiver</a>
                                </div>
                            </div>
                            <script>
                                <?= $i ?> = i;
                                i += 1;
                            </script>
                        <?php
                        } else {
                        ?>

                            <div class="pro" style="width: 23%; min-width: 250px; padding: 10px 12px; border: 1px solid #cce7d0; border-radius: 20px; cursor: pointer; box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.1); margin: 15px 0; transition: 0.3 ease; position: relative; color: darkgrey;">
                                <div>
                                    <img style="opacity: 0.3; width: 100%; max-heigth: 200px; border-radius: 10px;" src="../img/<?= $produit['image'] ?>" alt="<?= ucfirst($produit["nom"]) ?>">
                                    <div class="des" style="text-align: start; padding: 10px 0;">
                                        <h5 style="padding-top: 7px; color: #1a1a1a; font-size: 14px;"><?= $produit['id'], ' - ', ucfirst($produit["nom"]) ?></h5>
                                    </div>
                                </div>
                                <div>
                                <div>
                                    <a href="desarchiver_produit.php?pdt=<?= $produit['id'] ?>" style="text-decoration: none;">Désarchiver</a>
                                </div>
                                </div>
                            </div>
                            <script>
                                <?= $i ?> = i;
                                i += 1;
                            </script>

                    <?php
                        }
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </section>

    <br><br>

    <section>
        <h1 style="margin-left: 100px;">Supprimer un client</h1>
        <br>
        <div class="album  py-Sbg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <form method="post" action="#">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Identifiant du client</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" min="1" name="idC" required>
                        </div>
                        <button type="submit" name="supprimerC" class="btn btn-primary">Supprimer le client</button>
                    </form>
                </div>
                <div class="pro-container" style="display: flex; justify-content: space-between; padding-top: 20px; flex-wrap: wrap;">
                    <?php
                    foreach ($clients as $client) :
                    ?>
                        <a style="text-decoration: none;" href="commandes.php?id=<?= $client['id'] ?>">
                            <div class="pro" style="width: 23%; min-width: 250px; padding: 10px 12px; border: 1px solid #cce7d0; border-radius: 20px; cursor: pointer; box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.1); margin: 15px 0; transition: 0.3 ease; position: relative;">
                                <div>
                                    <div class="des" style="text-align: start; padding: 10px 0;">
                                        <h5 style="padding-top: 7px; color: #1a1a1a; font-size: 14px;"><?= $client['id'], ' - ', ucfirst($client["nom"]), ' : ', $client["motDePasse"] ?></h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </section>

</body>

</html>

<?php

if (isset($_POST['supprimer'])) {
    if (isset($_POST['id'])) {
        if (!empty($_POST['id']) and is_numeric($_POST['id'])) {

            $id = htmlspecialchars(strip_tags($_POST['id']));

            $produit = produit($id);

            if(!empty($produit)){

                try {
                    retirer_panier($id);
                    supprimer($id);
                    echo '<script>alert("Le produit a bien été supprimé !");</script>';
                } catch (Exception $e) {
                    echo '<script>alert("Le produit n\'a pas pu être supprimé !");</script>';
                    $e->getMessage();
                }

            }else{
                echo '<script>alert("Ce produit n\'existe pas !");</script>';
            }
        }
    }
}

if (isset($_POST['supprimerC'])) {
    if (isset($_POST['idC'])) {
        if (!empty($_POST['idC']) and is_numeric($_POST['idC'])) {

            $idC = htmlspecialchars(strip_tags($_POST['idC']));

            $client = suppClient($idC);

            if(!empty($client)){

                try {
                    supprimer_client($idC);
                    echo '<script>alert("Le client a bien été supprimé !");</script>';
                } catch (Exception $e) {
                    echo '<script>alert("Le client n\'a pas pu être supprimé !");</script>';
                    $e->getMessage();
                }

            }else{
                echo '<script>alert("Ce client n\'existe pas !");</script>';
            }
        }
    }
}

?>