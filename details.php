<?php
    session_start();
    require_once "src/modele/produit-db.php";
    require_once "src/modele/choix-db.php";
    require_once "src/modele/variantes-db.php";
    require_once "src/modele/couleur-db.php";

    $id = null;
    $erreur = null;

    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $erreur = "URL demandée non valide";
    }

    $deChoisi = selectProductById($id);
    $quantite = selectQuantityFromProductId($id);
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
    <title>Détails sur le produit</title>
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
    </div>

    <div class="content2">
        <?php if (isset($erreur)) { ?>
            <div class="erreur">Erreur : <?= $erreur?></div>
        <?php } else { ?>
            <div class="carte-detail">
                <img src="images/<?= $deChoisi["lib_photo"]?>" alt="Photo de dé à 20 faces" class="image4">
                <div class="nom-article2">
                    <div><?= $deChoisi["nom_prod"]?></div>
                </div>
                <div class="prix-achat2">
                    <div><?= $deChoisi["prix_prod"]?> €</div>
                </div>
                <div class="description-rapide2">
                    <div><?= $deChoisi["description"]?></div>
                </div>
                <div class="stock-commande">
                    <?php if ($quantite > 0) { ?>
                        <div class="vert">En stock</div>
                    <?php } else { ?>
                        <div class="rouge">Indisponible</div>
                    <?php } ?>
                    <a href="commande.php?id=<?=$id?>" class="bouton-commande">Commander</a>
                </div>
                <a href="produits.php" class="bouton-retour">Retour aux produits</a>
            </div>
        <?php } ?>
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
            <a href="#">Politique de confidentialité</a>
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