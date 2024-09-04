<?php

session_start();

setcookie("mtnt", 0);

if (!isset($_SESSION['client'])) {
    header('location: se_connecter.php');
}

if (empty($_SESSION['client'])) {
    header("location: se_connecter.php");
}
require("config/commandes.php");

$cltid = $_SESSION['client']['id'];

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon panier</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;200;300;400;500;600;700;800;900&family=Roboto+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <section id="header">

        <a rel="noreferrer" href="index.php"><img src="img/dk-logo-black.png" class="logo" alt="Logo"></a>

        <div>

            <ul id="navbar">
                <li><a rel="noreferrer" href="index.php">Menu</a></li>
                <li><a target="_blank" href="https://www.dkhotel.biz/a-propos">A propos</a></li>
                <li><a target="_blank" href="https://www.dkhotel.biz/contact">Contact</a></li>
                <li id="lg-bag"><a title="Mon panier" class="active" rel="noreferrer" href="cart.php"><i class="fas fa-shopping-bag"></i></a></li>
                <li id="lg-bag"><a title="Se déconnecter" rel="noreferrer" href="deconnexion.php"><i class="fa-solid fa-user-times"></i></a></li>
                <a href="#" id="close"><i class="fa fa-times"></i></a>
            </ul>

        </div>
        <div id="mobile">

            <a rel="noreferrer" title="Mon panier" href="cart.php"><i class="fas fa-shopping-bag np"></i></a>
            <a rel="noreferrer" title="Se déconnecter" href="deconnexion.php"><i class="fa-solid fa-user-times"></i></a>
            <i id="bar" class="fas fa-bars"></i>

        </div>
    </section>

    <section id="page-header">

        <h2>Mon panier <i class="fas fa-shopping-bag"></i></h2>
        <p>Toute la gastronomie d'un trois étoiles pour votre bien-être.</p>
    </section>

    <section id="cart" class="section-p1">

        <table width="100%" style="border-bottom: 1.7px solid black;">

            <thead>

                <tr>

                    <td>Retirer</td>
                    <td>Images</td>
                    <td>produits</td>
                    <td>Prix Unitaire</td>
                    <td>Quantités</td>
                    <td>Prix Totaux</td>

                </tr>

            </thead>
            <tbody>

                <script>
                    document.cookie = "qnt0=" + 1;
                    document.cookie = "qnt1=" + 1;
                    document.cookie = "qnt2=" + 1;
                    document.cookie = "qnt3=" + 1;
                    document.cookie = "qnt4=" + 1;
                    document.cookie = "qnt5=" + 1;
                    var i = 0;
                    var total = 0;
                    var prx = [];
                </script>

                <?php
                setcookie("qnt", 0);
                $i = 0;
                $prod = [];
                $paniers = panier($cltid);
                foreach ($paniers as $panier) :
                    $pid = $panier["produit"];
                    $produits = afficher_panier($pid);
                    foreach ($produits as $produit) :
                ?>

                        <span class="id" style="visibility: hidden;"><?= $produit['id'] ?></span>

                        <tr>

                            <td><a onclick="window.location.href='retirer_panier.php?pid=<?= $produit['id'] ?>'" href="#"><i class="far fa-times-circle"></i></a></td>
                            <td><img style="border-radius: 5px;" src="img/<?= $produit['image'] ?>" alt="<?= ucfirst($produit['nom']) ?>"></td>
                            <td style="font-weight: bold; font-size: 15px;"><?= ucfirst($produit['nom']) ?></td>
                            <td><?= number_format($produit["prix"], 0, '', ' ') ?></td>
                            <td>
                                <span class="moins" style="font-size: large; font-weight: 900; color: rgb(121, 12, 12); cursor: pointer; margin-right: 10px;">-</span>
                                <span class="qnt">1</span>
                                <span class="plus" style="font-size: large; font-weight: 900; color: rgb(121, 12, 12); cursor:pointer; margin-left: 10px;">+</span>
                            </td>

                            <script>
                                prx[i] = <?= $produit["prix"] ?>;
                            </script>

                            <td id="prixTotal" style="text-align: center;">
                                <span class="prixtotal">
                                    <Script>
                                        document.write(prx[i]);
                                    </Script>
                                </span>
                            </td>
                        </tr>
                        <span class="prix" style="visibility: hidden;"><?= $produit['prix'] ?></span>
                        <script>
                            i += 1;
                            total += <?= $produit['prix'] ?>;
                        </script>

                <?php
                        $prod[$i] = $produit['id'];
                        $i += 1;
                    endforeach;
                endforeach;
                $_SESSION['qnt_panier'] = $i;
                ?>

            </tbody>

        </table>

    </section>

    <section id="cart-add" class="section-p1">

        <div id="total">

            <h3 style="padding-bottom: 7px; margin-top: -20px;">Net à payer</h3>
            <table>

                <tr>

                    <td style="font-size: large; text-align: center;">Montant total</td>
                    <td style="text-align: center; color: rgb(121, 12, 12); font-weight: 900; font-size: medium;">
                        <span id="tl"></span> FCFA
                    </td>

                    <form method="post">
                        <input type="hidden" id="mtnt" name="mtnt">
                    </form>
                </tr>

            </table>
                <a rel="noreferrer" href="commander.php"><div id="commander" style="float: right; font-size: 14px; font-weight: 600; padding: 15px 30px; color: white; background-color: rgb(121, 12, 12); border-radius: 4px; cursor: pointer; border: none; outline: none; transition: 0.2s;">COMMANDER</div></a>

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

    <style>
        @media (max-width: 799px) {

        div#total {
            padding: 30px 3% 3% 3%;
        }

        div#commander {
            margin-left: 10em;
        }

        }
    </style>

</body>

<script>
    var qnt = document.querySelectorAll('.qnt');
    var plus = document.getElementsByClassName('plus');
    var moins = document.getElementsByClassName('moins');
    var prix = document.querySelectorAll('.prix');
    var prixTotal = document.querySelectorAll('.prixtotal');
    var tl = document.getElementById('tl');
    var commander = document.getElementById('commander');
    var mtnt = document.getElementById('mtnt');

    tl.textContent = total;
    document.cookie = "mtnt=" + parseFloat(tl.textContent);

    plus[0].addEventListener('click', () => {
        var qt = parseInt(qnt[0].textContent);
        qt += 1;
        qnt[0].textContent = qt;
        var prixtl = qt * parseInt(prix[0].textContent);
        prixTotal[0].textContent = prixtl;
        tl.textContent = parseInt(tl.textContent) + parseInt(prix[0].textContent);
        mtnt.value = parseInt(tl.textContent);
        document.cookie = "mtnt=" + parseFloat(tl.textContent);
        document.cookie = "qnt0=" + qt;
    });

    moins[0].addEventListener('click', () => {
        var qt = parseInt(qnt[0].textContent);
        if (qt > 1) {
            qt -= 1;
            qnt[0].textContent = qt;
            var prixtl = qt * parseInt(prix[0].textContent);
            prixTotal[0].textContent = prixtl;
            tl.textContent = parseInt(tl.textContent) - parseInt(prix[0].textContent);
            document.cookie = "qnt0=" + qt;
        }
    });

    plus[1].addEventListener('click', () => {
        var qt = parseInt(qnt[1].textContent);
        qt += 1;
        qnt[1].textContent = qt;
        var prixtl = qt * parseInt(prix[1].textContent);
        prixTotal[1].textContent = prixtl;
        tl.textContent = parseInt(tl.textContent) + parseInt(prix[1].textContent);
        document.cookie = "qnt1=" + qt;
    });

    moins[1].addEventListener('click', () => {
        var qt = parseInt(qnt[1].textContent);
        if (qt > 1) {
            qt -= 1;
            qnt[1].textContent = qt;
            var prixtl = qt * parseInt(prix[1].textContent);
            prixTotal[1].textContent = prixtl;
            tl.textContent = parseInt(tl.textContent) - parseInt(prix[1].textContent);
            document.cookie = "qnt1=" + qt;
        }
    });

    plus[2].addEventListener('click', () => {
        var qt = parseInt(qnt[2].textContent);
        qt += 1;
        qnt[2].textContent = qt;
        var prixtl = qt * parseInt(prix[2].textContent);
        prixTotal[2].textContent = prixtl;
        tl.textContent = parseInt(tl.textContent) + parseInt(prix[2].textContent);
        document.cookie = "qnt2=" + qt;
    });

    moins[2].addEventListener('click', () => {
        var qt = parseInt(qnt[2].textContent);
        if (qt > 1) {
            qt -= 1;
            qnt[2].textContent = qt;
            var prixtl = qt * parseInt(prix[2].textContent);
            prixTotal[2].textContent = prixtl;
            tl.textContent = parseInt(tl.textContent) - parseInt(prix[2].textContent);
            document.cookie = "qnt2=" + qt;
        }
    });

    plus[3].addEventListener('click', () => {
        var qt = parseInt(qnt[3].textContent);
        qt += 1;
        qnt[3].textContent = qt;
        var prixtl = qt * parseInt(prix[3].textContent);
        prixTotal[3].textContent = prixtl;
        tl.textContent = parseInt(tl.textContent) + parseInt(prix[3].textContent);
        document.cookie = "qnt3=" + qt;
    });

    moins[3].addEventListener('click', () => {
        var qt = parseInt(qnt[3].textContent);
        if (qt > 1) {
            qt -= 1;
            qnt[3].textContent = qt;
            var prixtl = qt * parseInt(prix[3].textContent);
            prixTotal[3].textContent = prixtl;
            tl.textContent = parseInt(tl.textContent) - parseInt(prix[3].textContent);
            document.cookie = "qnt3=" + qt;
        }
    });

    plus[4].addEventListener('click', () => {
        var qt = parseInt(qnt[4].textContent);
        qt += 1;
        qnt[4].textContent = qt;
        var prixtl = qt * parseInt(prix[4].textContent);
        prixTotal[4].textContent = prixtl;
        tl.textContent = parseInt(tl.textContent) + parseInt(prix[4].textContent);
        document.cookie = "qnt4=" + qt;
    });

    moins[4].addEventListener('click', () => {
        var qt = parseInt(qnt[4].textContent);
        if (qt > 1) {
            qt -= 1;
            qnt[4].textContent = qt;
            var prixtl = qt * parseInt(prix[4].textContent);
            prixTotal[4].textContent = prixtl;
            tl.textContent = parseInt(tl.textContent) - parseInt(prix[4].textContent);
            document.cookie = "qnt4=" + qt;
        }
    });

    plus[5].addEventListener('click', () => {
        var qt = parseInt(qnt[5].textContent);
        qt += 1;
        qnt[5].textContent = qt;
        var prixtl = qt * parseInt(prix[5].textContent);
        prixTotal[5].textContent = prixtl;
        tl.textContent = parseInt(tl.textContent) + parseInt(prix[5].textContent);
            document.cookie = "qnt5=" + qt;
    });

    moins[5].addEventListener('click', () => {
        var qt = parseInt(qnt[5].textContent);
        if (qt > 1) {
            qt -= 1;
            qnt[5].textContent = qt;
            var prixtl = qt * parseInt(prix[5].textContent);
            prixTotal[5].textContent = prixtl;
            tl.textContent = parseInt(tl.textContent) - parseInt(prix[5].textContent);
            document.cookie = "qnt5=" + qt;
        }
    });
</script>

<script src="assets/script.js"></script>

</html>