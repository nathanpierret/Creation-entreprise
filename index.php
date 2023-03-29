<?php
    require_once "src/modele/produit-db.php";

    $de6 = selectProductById(6);
    $de20 = selectProductById(20);
    $varAll = selectProductById(900);
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>PARADICE</title>
</head>
<body>
    <div class="container">
        <div class="nav">
            <img src="images/Logo.png" alt="Logo">
            <ul>
                <li><a href="index.php">Page d'accueil</a></li>
                <li><a href="entreprise.php">Notre entreprise</a></li>
                <li><a href="produits.php">Nos produits</a></li>
                <li><a href="contacts.php">Contactez-nous</a></li>
            </ul>
        </div>
        <div class="background">
        <div class="content">
            <h2 class="titre">À propos de nous</h2>
            <div class="vide1"></div>
            <div class="paragraphe1">
                &nbsp &nbsp Paradice est, comme son nom l'indique, le paradis des amoureux des dés. Nous vous proposons une sélection
                extraordinaire de dés, du classique dé à 6 faces au mystique dé à 20 faces. Vous trouverez aussi nos dés uniques ainsi que des
                variantes de dés classiques inspirées d'univers connus et célèbres. Créée le 10 mars 2022, notre entreprise a pu se développer
                durant la pandémie grâce à notre site Web. Avec la stabilisation de cette situation, nous avons pu nous étendre sur l'est de la
                France avec nos 43 magasins.</div>
            <img src="images/Image_accueil_des.jpeg" alt="Lot de dés de tailles différentes" class="img1">
            <div class="vide"></div>
            <a href="entreprise.php" class="button1"><div class="bouton1">En savoir plus</div></a>
            <div class="vide2"></div>
            <h2 class="titre2">Notre sélection de dés</h2>
            <div class="grille">
                <div class="carte">
                    <img src="images/<?= $de6["lib_photo"]?>" alt="Photo de dé à 6 faces" class="image">
                    <div class="nom-article">
                        <div><?= $de6["nom_prod"]?></div>
                    </div>
                    <div class="prix-achat">
                        <div><?= $de6["prix_prod"]?> €</div>
                    </div>
                    <div class="description-rapide">
                        <div><?= $de6["description"]?></div>
                    </div>
                    <a href="#" class="bouton-achat">Détails</a>
                    <a href="#" class="bouton-achat2">Ajouter au panier</a>
                </div>
                <div class="carte">
                    <img src="images/<?= $de20["lib_photo"]?>" alt="Photo de dé à 20 faces" class="image">
                    <div class="nom-article">
                        <div><?= $de20["nom_prod"]?></div>
                    </div>
                    <div class="prix-achat">
                        <div><?= $de20["prix_prod"]?> €</div>
                    </div>
                    <div class="description-rapide">
                        <div><?= $de20["description"]?></div>
                    </div>
                    <a href="#" class="bouton-achat">Détails</a>
                    <a href="#" class="bouton-achat2">Ajouter au panier</a>
                </div>
                <div class="carte">
                    <img src="images/<?= $varAll["lib_photo"]?>" alt="Photo de dé avec un point d'interrogation" class="image">
                    <div class="nom-article">
                        <div><?= $varAll["nom_prod"]?></div>
                    </div>
                    <div class="prix-achat">
                        <div><?= $varAll["prix_prod"]?> €</div>
                    </div>
                    <div class="description-rapide">
                        <div><?= $varAll["description"]?></div>
                    </div>
                    <a href="#" class="bouton-achat">Détails</a>
                    <a href="#" class="bouton-achat2">Ajouter au panier</a>
                </div>
            </div>
            <div class="vide3"></div>
            <a href="produits.php" class="button1"><div class="bouton2">Plus d'articles</div></a>
            <div class="vide4"></div>
            <h2 class="titre3">Certains chiffres</h2>
            <div class="bulle1"><span class="gras">2022</span>Date de création de l'entreprise</div>
            <div class="bulle2"><span class="gras">128</span>Salariés passionnés de dés</div>
            <div class="bulle3"><span class="gras">240,000+</span>Dés vendus dans toute la France</div>
        </div>
        </div>
        <footer class="footer">
            <div>
                <div class="title">Nos réseaux sociaux :</div>
                <div class="contacts">
                    <a href="https://www.twitter.com/" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                    <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <div><i class="fa-regular fa-copyright"></i> Paradice, Inc.</div>
            </div>
            <div class="horaires">
                <div class="title">Horaires :</div>
                <div>Lundi : Fermé</div>
                <div>Mardi au Vendredi : 8:00 - 18:00</div>
                <div>Samedi : 9:00 - 17:00</div>
                <div>Dimanche : 8:30 - 12:30</div>
            </div>
        </footer>
    </div>
</body>
</html>