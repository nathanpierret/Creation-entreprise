<?php
    session_start();

    if (!isset($_SESSION["panier"])) {
        //Création du panier dans la session
        $_SESSION["panier"] = [];
    }

    require_once "src/modele/produit-db.php";

    $des = selectAllDiceProducts();
    $packs = selectAllDiceVariants();
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
            <li><a href="index.php">Accueil</a></li>
            <li><a href="entreprise.php">Notre entreprise</a></li>
            <li><a href="produits.php">Nos produits</a></li>
            <li><a href="contacts.php">Contactez-nous</a></li>
        </ul>
        <a href="panier.php" class="bouton-panier"><i class="fa-solid fa-cart-shopping"></i></a>
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
                <a href="details.php?id=<?= $de['id_prod']?>" class="bouton-achat3">Détails</a>
            </div>
            <?php } ?>
        </div>

        <h2 class="title2">Nos packs surprises</h2>
        <div class="cartes">
            <?php foreach ($packs as $pack) {?>
            <div class="carte2">
                <img src="images/<?= $pack["lib_photo"]?>" alt="Photo de dé avec un point d'interrogation" class="image">
                <div class="nom-article">
                    <div><?= $pack["nom_prod"]?></div>
                </div>
                <div class="prix-achat">
                    <div><?= $pack["prix_prod"]?> €</div>
                </div>
                <div class="description-rapide">
                    <div><?= $pack["description"]?></div>
                </div>
                <a href="details.php?id=<?= $pack['id_prod']?>" class="bouton-achat">Détails</a>
            </div>
            <?php } ?>
        </div>
    </div>
    </div>
    <footer class="footer">
        <div>
            <div><i class="fa-regular fa-copyright"></i> Paradice, Inc.</div>
            <div class="contacts">
                <a href="https://www.twitter.com/" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.linkedin.com/" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
        </div>

        <div class="liens">
            <a href="entreprise.php">Notre entreprise</a>
            <a href="contacts.php">Contacts</a>
            <a href="Mentions%20légales%20et%20politique%20de%20confidentialité.pdf">Politique de confidentialité</a>
        </div>

        <div class="infos">
            <div>Coordonnées :</div>
            <div><i class="fa-solid fa-phone"></i> : +33 3 84 48 97 32</div>
            <div><i class="fa-solid fa-at"></i> : support.paradice@gmail.com</div>
            <div><i class="fa-solid fa-location-dot"></i> : 45 Boulevard commercial</div>
            <div>25000 Besançon</div>
        </div>
    </footer>
</div>

</body>
</html>