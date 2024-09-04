<?php

session_start();

if (!isset($_SESSION['administrateur'])) {
    header('location: ../se_connecter.php');
}

if (empty($_SESSION['administrateur'])) {
    header("location: ../se_connecter.php");
}

if (!isset($_GET['pdt'])) {
    header('location: modifier.php');
}

if (empty($_GET['pdt']) and !is_numeric($_GET['pdt'])) {
    header('location: modifier.php');
}

$id = $_GET['pdt'];

require("../config/commandes.php");

$produit = produit($id);

if($produit['archiver'] == true){
    header('location: modifier.php');
}

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

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour du produit</title>
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
                        <label for="exampleInputEmail1" class="form-label">Nom du produit</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nom" value="<?= ucfirst($produit['nom']) ?>" required>
                        
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Categorie du produit</label>
                        <select type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="categorie" value="<?= ucfirst($cate) ?>" required>
                    
                        <option value="repas">repas</option>
                        <option value="boisson">boisson</option>

                        </select>
                        
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Adresse de l'image</label>
                        <input type="text" required class="form-control" name="image" value="<?= $produit['image'] ?>" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Prix</label>
                        <input type="number" required class="form-control" min="1" name="prix" value="<?= $produit['prix'] ?>" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Description</label>
                        <textarea style="resize: none; height: 100px;" class="form-control" name="description" id="exampleInputPassword1" required><?= ucfirst($produit['description']) ?></textarea>
                    </div>
                    <button type="submit" name="valider" class="btn btn-primary">Mettre à jour le produit</button>
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
    if (isset($_POST['nom']) and isset($_POST['categorie']) and isset($_POST['image']) and isset($_POST['prix']) and isset($_POST['description'])) {
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

            try {
                modifier($nom, $categorie, $image, $prix, $description, $id);
                echo '<script>alert("Le produit a bien été modifié !");</script>';
                header('location: modifier.php');
            } catch (Exception $e) {
                header('location: modifier.php');
                echo '<script>alert("Le produit n\'a pu être modifié !");</script>';
                $e->getMessage();
            }
        }
    }
}
?>