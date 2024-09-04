<?php

session_start();

$_SESSION['qnt_panier'] = 0;

if (!isset($_SESSION['client'])) {
    header('location: se_connecter.php');
}

if (empty($_SESSION['client'])) {
    header("location: se_connecter.php");
}

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 1;
}

require("config/commandes.php");

$produit = details($id);

switch ($produit['categorie']) {
    case '1':
        $categorie = "details du plat";
        break;

    case '2':
        $categorie = "details de la boisson";
        break;

    default:
        $categorie = "details du plat";
        break;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du produit</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;200;300;400;500;600;700;800;900&family=Roboto+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/single_product.css">
</head>

<body>

    <section id="header">

        <a rel="noreferrer" href="index.php"><img src="img/dk-logo-black.png" class="logo" alt="Logo"></a>

        <div>

            <ul id="navbar">
                <li><a rel="noreferrer" href="index.php">Menu</a></li>
                <li><a target="_blank" href="https://www.dkhotel.biz/a-propos">A propos</a></li>
                <li><a target="_blank" href="https://www.dkhotel.biz/contact">Contact</a></li>
                <li id="lg-bag"><a title="Mon panier" rel="noreferrer" href="cart.php"><i class="fas fa-shopping-bag"></i></a></li>
                <li id="lg-bag"><a title="Se déconnecter" rel="noreferrer" href="deconnexion.php"><i class="fa-solid fa-user-times"></i></a></li>
                <a href="#" id="close"><i class="fa fa-times"></i></a>
            </ul>

        </div>
        <div id="mobile">

            <a title="Mon panier" rel="noreferrer" href="cart.php"><i class="fas fa-shopping-bag"></i></a>
            <a title="Se déconnecter" rel="noreferrer" href="deconnexion.php"><i class="fa-solid fa-user-times"></i></a>
            <i id="bar" class="fas fa-bars"></i>

        </div>
    </section>

    <section id="prodetails" class="section-p1" slyle="margin-bottom: 60px;">

        <div class="single-pro-img">

            <img style="border-radius: 6px; margin-top: -30px;" src="img/<?= $produit['image'] ?>" width="100%" id="mainimg" alt="<?= ucfirst($produit["nom"]) ?>">

        </div>
        <div class="single-pro-details">

            <h6><?= ucfirst($categorie) ?></h6>
            <h4 class="name"><?= ucfirst($produit["nom"]) ?></h4>
            <h2><?= number_format($produit["prix"], 0, '', ' ') ?> frs</h2>
            <a href="ajouter_panier.php?id=<?= $produit['id'] ?>"><button name="ajouter" type="submit" class="normal">Ajouter au panier</button></a>
            <h4>Description du produit:</h4>
            <span><?= ucfirst($produit["description"]) ?></span>

        </div>

    </section>

    <footer class="section-p1" style="display: ruby-text-container;">

        <div class="col">

            <img src="img/logo.png" alt="Logo">
            
            <address>
                <span><b>Tel:</b> (+237) 683 94 39 41</span>
                <span><b>GSM:</b> (+237) 694 40 09 62</span>
                <span><b>Email:</b> contact@dkhotel.biz</span>
                <span><b>Adresse:</b> Bonabéri (Ancienne Route) Douala-Cameroun</span>
                <span><b>BP:</b> 9350 Douala</span>
            </address>

            <div class="follow">

                <div class="icon">

                    <a href="https://www.facebook.com/dkhotelbonaberi/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="http://www.dkhotel.biz/#" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="http://www.dkhotel.biz/#" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="http://www.dkhotel.biz/#" target="_blank"><i class="fab fa-google"></i></a>

                </div>

            </div>

        </div>

    </footer>

    <div class="copyright" style="text-align: center;">

        <p>Copyright 2022. DAH-KEN GROUP. All Rights Reserved.</p>
        <img src="img/tripadvisor.png" alt="Tripadvisor">

    </div>

    <script src="assets/script.js"></script>

</body>

</html>