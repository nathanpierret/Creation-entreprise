<?php
    session_start();

    if (!isset($_SESSION["panier"])) {
        //Création du panier dans la session
        $_SESSION["panier"] = [];
    }

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

    $deChoisi = selectProductById($id);
    $couleurs = selectAllColorsIdFromProductId($id);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($id < 900) {
            if (isset($_POST["couleur-choix"])) {
                if (!isset($_POST["couleur"])) {
                    $erreurs["couleur"] = "Choisissez une couleur !";
                } else {
                    $quantiteMax = selectQuantityFromAllIds($id,$_POST["couleur"]);
                }
            } else if (isset($_POST["ajout-panier"])) {
                if (!isset($_POST["couleur2"])) {
                    $erreurs["couleur"] = "Choisissez une couleur !";
                } else {
                    $nomProduit = $deChoisi["nom_prod"];
                    $photoProduit = $deChoisi["lib_photo"];
                    $prixProduit = $deChoisi["prix_prod"];
                    $couleurChoisie = $_POST["couleur2"];
                    $quantiteMax = selectQuantityFromAllIds($id,$_POST["couleur2"]);
                    if ($_POST["quantite"] == "" or $_POST["quantite"] < 1) {
                        $qteChoisie = 1;
                    } else if ($_POST["quantite"] > $quantiteMax["qte_stock"]) {
                        $qteChoisie = $quantiteMax["qte_stock"];
                    } else {
                        $qteChoisie = $_POST["quantite"];
                    }
                    if (array_key_exists($nomProduit.$couleurChoisie,$_SESSION["panier"])) {
                        //Le produit est déjà présent
                        if ($_SESSION["panier"][$nomProduit.$couleurChoisie]["quantite"]+$qteChoisie > $quantiteMax["qte_stock"]) {
                            $_SESSION["panier"][$nomProduit.$couleurChoisie]["quantite"] = $quantiteMax["qte_stock"];
                        } else {
                            $_SESSION["panier"][$nomProduit.$couleurChoisie]["quantite"] += $qteChoisie;
                        }
                    } else {
                        //Le produit n'est pas présent
                        //Il faut créer le produit
                        $produit = [
                            "id" => $id,
                            "photo" => $photoProduit,
                            "nom" => $nomProduit,
                            "couleur" => $couleurChoisie,
                            "prix" => $prixProduit,
                            "quantite" => $qteChoisie,
                            "max" => $quantiteMax
                        ];
                        //Ajout du produit dans le panier
                        $_SESSION["panier"][$nomProduit.$couleurChoisie] = $produit;
                    }
                }
            }
        } else {
            $nomProduit = $deChoisi["nom_prod"];
            $photoProduit = $deChoisi["lib_photo"];
            $prixProduit = $deChoisi["prix_prod"];
            $quantiteMax = selectQuantityFromAllIds($id,1);
            if ($_POST["quantite"] == "" or $_POST["quantite"] < 1) {
                $qteChoisie = 1;
            } else if ($_POST["quantite"] > $quantiteMax["qte_stock"]) {
                $qteChoisie = $quantiteMax["qte_stock"];
            } else {
                $qteChoisie = $_POST["quantite"];
            }
            if (array_key_exists($nomProduit,$_SESSION["panier"])) {
                //Le produit est déjà présent
                if (($_SESSION["panier"][$nomProduit]["quantite"]+$qteChoisie) > $quantiteMax["qte_stock"]) {
                    $_SESSION["panier"][$nomProduit]["quantite"] = $quantiteMax["qte_stock"];
                } else {
                    $_SESSION["panier"][$nomProduit]["quantite"] += $qteChoisie;
                }
            } else {
                //Le produit n'est pas présent
                //Il faut créer le produit
                $produit = [
                    "id" => $id,
                    "photo" => $photoProduit,
                    "nom" => $nomProduit,
                    "couleur" => "---",
                    "prix" => $prixProduit,
                    "quantite" => $qteChoisie,
                    "max" => $quantiteMax
                ];
                //Ajout du produit dans le panier
                $_SESSION["panier"][$nomProduit] = $produit;
            }
        }
    }

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
        <a href="panier.php" class="bouton-panier"><i class="fa-solid fa-cart-shopping"></i></a>
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
                <?php if ($id < 900) { ?>
                <form method="post" class="choix-couleur">
                    <select name="couleur" id="couleur">
                        <option value="" disabled selected>Choisissez une couleur</option>
                        <?php foreach ($couleurs as $couleur) { ?>
                        <option value="<?= $couleur["id_couleur"] ?>"
                            <?php if (isset($_POST["couleur"]) && $_POST["couleur"] == $couleur["id_couleur"]) {?> selected <?php }?>>
                            <?= selectColorById($couleur["id_couleur"])["nom_couleur"]." - Stock : ".selectQuantityFromAllIds($id,$couleur["id_couleur"])["qte_stock"] ?></option>
                        <?php } ?>
                    </select>
                    <input type="submit" value="Choisir" name="couleur-choix">
                </form>

                <?php if (isset($erreurs["couleur"])) {?>
                    <p class="erreur-validation"><?= $erreurs["couleur"] ?></p>
                <?php } ?>

                <form method="post" class="choix-produit">
                    <input type="hidden" name="couleur2" value="<?php if (isset($_POST["couleur"])) { echo $_POST["couleur"]; } else { echo $couleurNull; }?>">
                    <input type="number" name="quantite" value="1">
                    <?php if (isset($_POST["couleur"])) {?>
                        <button type="submit" name="ajout-panier"><i class="fa-solid fa-cart-plus"></i></button>
                    <?php } else { ?>
                        <div class="erreur-val">Choisissez une couleur !</div>
                    <?php } ?>
                </form>
                <?php } else { ?>
                <form method="post" class="choix-pack">
                    <input type="number" name="quantite" value="1">
                    <button type="submit" name="ajout-panier"><i class="fa-solid fa-cart-plus"></i></button>
                </form>
                <?php } ?>
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