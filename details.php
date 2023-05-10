<?php
    session_start();
    require_once "src/modele/produit-db.php";
    require_once "src/modele/choix-db.php";
    require_once "src/modele/couleur-db.php";

    $id = null;
    $couleurChoisie = null;
    $couleurNull = null;
    $quantiteMax = 0;
    $erreurURL = null;
    $erreurs = [];

    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $erreurURL = "URL demandée non valide";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["couleur-choix"])) {
            $quantiteMax = selectQuantityFromAllIds($id,$_POST["couleur"]);
        } else if (isset($_POST["ajout-panier"])) {
            var_dump($_POST);
            if (!isset($_POST["couleur2"])) {
                $erreurs["couleur"] = "Choisissez une couleur !";
            } else {
                $couleurChoisie = $_POST["couleur2"];
            }

        }
    }

    $deChoisi = selectProductById($id);
    $couleurs = selectAllColorsIdFromProductId($id);
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
        <?php if (isset($erreurURL)) { ?>
            <div class="erreur">Erreur : <?= $erreurURL?></div>
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
                <form method="post" class="choix-couleur">
                    <select name="couleur" id="couleur">
                        <option value="" disabled selected>Choisissez une couleur</option>
                        <?php foreach ($couleurs as $couleur) { ?>
                        <option value="<?= $couleur["id_couleur"] ?>"
                            <?php if (isset($_POST["couleur"]) && $_POST["couleur"] == $couleur["id_couleur"]) {?> selected <?php }?>>
                            <?= selectColorById($couleur["id_couleur"])["nom_couleur"] ?></option>
                        <?php } ?>
                    </select>
                    <input type="submit" value="Choisir" name="couleur-choix">
                </form>
                <form method="post" class="choix-produit">
                    <input type="hidden" name="couleur2" value="<?php if (isset($_POST["couleur"])) { echo $_POST["couleur"]; } else { echo $couleurNull; }?>">

                    <?php if (isset($erreurs["couleur"])) {?>
                        <p class="erreur-validation"><?= $erreurs["couleur"] ?></p>
                    <?php } ?>

                    <input type="number" max="<?= $quantiteMax["qte_stock"] ?>" min="1" name="quantite" value="1">
                    <input type="submit" value="Ajouter au panier" name="ajout-panier">
                </form>
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