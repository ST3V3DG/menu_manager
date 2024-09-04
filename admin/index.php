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
    <title>Ajout de produit</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <script src="../assets/bootstrap.bundle.min.js"></script>
</head>

<body>

    <nav style="position: sticky; top: 0; z-index: 99;" class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a rel="no-referrer" class="navbar-brand" href="">Panneau de contrôle</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a rel="no-referrer" class="nav-link active" aria-current="page" href="index.php" style="font-weight: bold;">Ajouter</a>
                    </li>
                    <li class="nav-item">
                        <a rel="no-referrer" class="nav-link" href="supprimer_produit.php">Supprimer</a>
                    </li>
                    <li class="nav-item">
                        <a rel="no-referrer" class="nav-link" href="modifier.php">Modifier</a>
                    </li>
                    <li class="nav-item">
                        <a rel="norefferrer" class="nav-link" href="commandes_clients.php">Commandes</a>
                    </li>
                    <li class="nav-item">
                        <a rel="no-referrer" class="nav-link" href="tables.php">Tables</a>
                    </li>
                </ul>
                <div style="display: flex; justify-content: flex-end;">
                    <a rel="no-referrer" class="btn btn-danger" href="deconnexion.php">Se deconnecter</a>
                </div>
            </div>
        </div>
    </nav>
    <br>
    <section>
        <h1 style="margin-left: 100px;">Ajouter un produit</h1>
        <br>
        <div class="album  py-Sbg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <form method="post" action="#">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nom du produit</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Categorie du produit</label>
                            <select type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="categorie" required>
                                <option value="repas">repas</option>
                                <option value="boisson">boisson</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Adresse de l'image</label>
                            <input type="text" required class="form-control" name="image" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Prix</label>
                            <input type="number" required class="form-control" min="1" name="prix" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Description</label>
                            <textarea style="resize: none; height: 100px;" class="form-control" name="description" id="exampleInputPassword1" required></textarea>
                        </div>
                        <button type="submit" name="valider" class="btn btn-primary">Ajouter un nouveau produit</button>
                    </form>
                </div>

                <div class="pro-container" style="display: flex; justify-content: space-between; padding-top: 20px; flex-wrap: wrap;">
                    <?php
                    foreach ($produits as $produit) :
                        if ($produit['archiver'] == false) {
                    ?>
                            <div class="pro" style="width: 23%; min-width: 250px; padding: 10px 12px; border: 1px solid #cce7d0; border-radius: 20px; cursor: pointer; box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.1); margin: 15px 0; transition: 0.3 ease; position: relative;">
                                <div>
                                    <img style="width: 100%; border-radius: 10px;" src=" ../img/<?= $produit['image'] ?>" alt="<?= ucfirst($produit["nom"]) ?>">
                                    <div class="des" style="text-align: start; padding: 10px 0;">
                                        <h5 style="padding-top: 7px; color: #1a1a1a; font-size: 14px;"><?= $produit['id'], '-', ucfirst($produit["nom"]) ?></h5>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>

                            <div class="pro" style="width: 23%; min-width: 250px; padding: 10px 12px; border: 1px solid #cce7d0; border-radius: 20px; cursor: pointer; box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.1); margin: 15px 0; transition: 0.3 ease; position: relative; color: darkgrey;">
                                <div>
                                    <img style="opacity: 0.3; width: 100%; border-radius: 10px;" src=" ../img/<?= $produit['image'] ?>" alt="<?= ucfirst($produit["nom"]) ?>">
                                    <div class="des" style="text-align: start; padding: 10px 0;">
                                        <h5 style="padding-top: 7px; color: #1a1a1a; font-size: 14px;"><?= $produit['id'], '-', ucfirst($produit["nom"]) ?></h5>
                                    </div>
                                </div>
                            </div>

                    <?php
                        }
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </section>

    <br><br>

    <section></section>

</body>

</html>

<?php

if (isset($_POST['valider'])) {
    if (isset($_POST['nom']) and isset($_POST['image']) and isset($_POST['prix']) and isset($_POST['description'])) {
        if (!empty($_POST['nom']) and !empty($_POST['image']) and !empty($_POST['prix']) and !empty($_POST['description'])) {

            $nom = htmlspecialchars(strip_tags(strtolower($_POST['nom'])));
            $cat = htmlspecialchars(strip_tags(strtolower($_POST['categorie'])));
            switch ($cat) {
                case 'repas':
                    $categorie = 1;
                    break;
                case 'boisson':
                    $categorie = 2;
                    break;

                default:
                    $categorie = 1;
                    break;
            }
            $image = htmlspecialchars(strip_tags(strtolower($_POST['image'])));
            $prix = htmlspecialchars(strip_tags($_POST['prix']));
            $description = htmlspecialchars(strip_tags(strtolower($_POST['description'])));
            $prod = deja_produit($nom, $image, $description);
            if (!empty($prod)) {
                echo '<script>alert("Ce produit existe déjà !");</script>';
            } else {
                try {
                    ajouter_produit($nom, $categorie, $image, $prix, $description);
                    echo '<script>alert("Le produit a bien été ajouté !");</script>';
                } catch (Exception $e) {
                    echo '<script>alert("Le produit n\'a pu être ajouté !");</script>';
                    $e->getMessage();
                }
            }
        }
    }
}
?>