<?php
    require_once "src/modele/produit-db.php";

    $des = selectAllDiceProducts();
    $vars = selectAllDiceVariants();
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
    <title>Magasin</title>
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
    <div class="content2">

        <h2 class="title2">Notre sélection de dés</h2>
        <div class="cartes">
            <?php foreach ($des as $de) {?>
            <div class="carte2">
                <img src="images/<?= $de["lib_photo"]?>" alt="Photo de dé à <?= $de["id_prod"]?> faces" class="image">
                <div class="nom-article">
                    <div><?= $de["nom_prod"]?></div>
                </div>
                <div class="prix-achat">
                    <div><?= $de["prix_prod"]?> €</div>
                </div>
                <div class="description-rapide">
                    <div><?= $de["description"]?></div>
                </div>
                <a href="#" class="bouton-achat3">Détails</a>
                <a href="#" class="bouton-achat4">Ajouter au panier</a>
            </div>
            <?php } ?>
        </div>

        <h2 class="title2">Nos choix de variantes</h2>
        <div class="cartes">
            <?php foreach ($vars as $var) {?>
            <div class="carte2">
                <img src="images/<?= $var["lib_photo"]?>" alt="Photo de dé avec un point d'interrogation" class="image">
                <div class="nom-article">
                    <div><?= $var["nom_prod"]?></div>
                </div>
                <div class="prix-achat">
                    <div><?= $var["prix_prod"]?> €</div>
                </div>
                <div class="description-rapide">
                    <div><?= $var["description"]?></div>
                </div>
                <a href="#" class="bouton-achat">Détails</a>
                <a href="#" class="bouton-achat2">Ajouter au panier</a>
            </div>
            <?php } ?>
        </div>
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