<?php

session_start();

if (!isset($_SESSION['client'])) {
    header('location: se_connecter.php');
}

if (empty($_SESSION['client'])) {
    header("location: se_connecter.php");
}

require("config/commandes.php");

$plats = plats();
$boissons = boissons();

?>

<script>
    document.cookie = "qnt=" + 0;
</script>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon menu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;200;300;400;500;600;700;800;900&family=Roboto+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/style.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>

    <section id="header">

        <a rel="noreferrer" href="index.php"><img src="img/dk-logo-black.png" class="logo" alt="Logo"></a>

        <div>

            <ul id="navbar">
                <li><a rel="noreferrer" class="active" href="">Menu</a></li>
                <li><a target="_blank" href="https://www.dkhotel.biz/a-propos">A propos</a></li>
                <li><a target="_blank" href="https://www.dkhotel.biz/contact">Contact</a></li>
                <li id="lg-bag"><a title="Mon panier" rel="noreferrer" href="cart.php"><i class="fas fa-shopping-bag"></i></a></li>
                <li id="lg-bag"><a title="Se déconnecter" rel="noreferrer" href="deconnexion.php"><i class="fa-solid fa-user-times"></i></a></li>
                <a href="#" id="close"><i class="fa fa-times"></i></a>
            </ul>

        </div>
        <div id="mobile">

            <a rel="noreferrer" href="cart.php"><i class="fas fa-shopping-bag"></i></a>
            <a title="Se déconnecter" rel="noreferrer" href="deconnexion.php"><i class="fa-solid fa-user-times"></i></a>
            <i id="bar" class="fas fa-bars"></i>

        </div>

    </section>

    <section id="hero" style="background-image: url(img/bar.jpeg); 
    align-items: center;">

        <h4><img src="img/dk-logo-black.png" alt="logo"></h4>
        <h1>BIENVENUE DANS NOTRE RESTAURANT !</h1>
        <p>Toute la gastronomie d'un trois étoiles pour votre bien-être.</p>
        <div style="width: 160px;" onclick=" window.location.href='#product1'">
            VOIR LE MENU
        </div>

    </section>

    <section id="feature" class="section-p1">

        <div class="fe-box">
            <img class="piano" src="img/resto5.jpeg" alt="Service à table">
            <h6>Service à table</h6>
        </div>

        <div class="fe-box">
            <img class="piano" src="img/resto3.jpeg" alt="Design moderne">
            <h6>Design moderne</h6>
        </div>

        <div class="fe-box">
            <img class="piano" src="img/resto2.jpeg" alt="Piano bar">
            <h6>Piano bar</h6>
        </div>

        <div class="fe-box">
            <img class="piano" src="img/resto4.jpeg" alt="Service en terrasse">
            <h6>Service en terrasse</h6>
        </div>

    </section>

    <section class="section-p1" id="product1">

        <h2>Nos Repas</h2>
        <p>Des spécialités africaines, européennes et asiatiques.<br>
            Repas variés à base de produits bio et frais.
        </p>


        <div class="pro-container">
            <?php
            foreach ($plats as $plat) :
                if($plat['archiver'] == 0){
            ?>
                <div class="pro">
                    <div onclick="window.location.href='prodetails.php?id=<?= $plat['id'] ?>'">
                        <img id="proImg" src="img/<?= $plat['image'] ?>" alt="<?= ucfirst($plat["nom"]) ?>">
                        <div class="des">

                            <h5 id="proNom"><?= ucfirst($plat["nom"]) ?></h5>
                            <div class="star">

                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>

                            </div>
                            <span><?= substr(ucfirst($plat["description"]), 0, 75) ?>...</span>
                            <h4 id="proPrix"><span style="padding-top: 7px;font-size: 15px;font-weight: 700;color: rgb(121, 12, 12);"><?= number_format($plat["prix"], 0, '', ' ') ?></span> frs</h4>

                        </div>
                    </div>
                    <span onclick="window.location.href='ajouter_panier.php?id=<?= $plat['id'] ?>'"><i class="fa-solid fa-plus cart"></i></span>
                    <!-- <ion-icon name="bag-add-outline"></ion-icon> -->
                </div>
            <?php
                }
            endforeach;
            ?>
        </div>

    </section>

    <!-- <section id="banner" class="section-m1">

        <h4>Offres spéciales !</h4>
        <h2>Jusqu'à <span>10% de réduction</span> sur nos mets traditionnels</h2>
        <button class="normal">En savoir plus</button>

    </section> -->

    <section class="section-p1" id="product1">

        <h2> Nos Boissons</h2>
        <p>Des spécialités africaines, européennes et asiatiques.<br>
            Repas variés à base de produits bio et frais.
        </p>

        <div class="pro-container">
            <?php
            foreach ($boissons as $boisson) :
                if($boisson['archiver'] == false){
            ?>
                <div class="pro">
                    <div onclick="window.location.href='prodetails.php?id=<?= $boisson['id'] ?>'">
                        <img src="img/<?= $boisson['image'] ?>" alt="<?= ucfirst($boisson["nom"]) ?>">
                        <div class="des">

                            <h5><?= ucfirst($boisson["nom"]) ?></h5>
                            <div class="star">

                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>

                            </div>
                            <span><?= substr(ucfirst($boisson["description"]), 0, 75) ?>...</span>
                            <h4><?= $boisson["prix"] ?> frs</h4>

                        </div>
                    </div>
                    <span onclick="window.location.href='ajouter_panier.php?id=<?= $boisson['id'] ?>'"><i class="fa-solid fa-plus cart"></i></span>
                </div>
            <?php
                }
            endforeach;
            ?>
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