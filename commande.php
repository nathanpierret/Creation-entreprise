<?php
    session_start();
    require_once "./src/modele/devis-db.php";
    require_once "./src/modele/contenu-devis-db.php";
    require_once "./src/modele/choix-db.php";

    if (!isset($_SESSION["panier"])) {
        //Création du panier dans la session
        $_SESSION["panier"] = [];
    }

    $idDevis = null;
    $nomClient = null;
    $prenomClient = null;
    $email = null;
    $telephone = null;
    $rue = null;
    $codePostal = null;
    $ville = null;
    $idProd = null;
    $idCouleur = null;
    $qteProd = null;
    $erreurs = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (empty(trim($_POST["prenom"]))) {
        $erreurs["prenom"] = "Le prénom est obligatoire !";
    } else {
        $prenomClient = trim($_POST["prenom"]);
    }

    if (empty(trim($_POST["nom"]))) {
        $erreurs["nom"] = "Le nom est obligatoire !";
    } else {
        $nomClient = trim($_POST["nom"]);
    }

    if (empty(trim($_POST["rue"]))) {
        $erreurs["rue"] = "La rue est obligatoire !";
    } else {
        $rue = trim($_POST["rue"]);
    }

    if (empty(trim($_POST["code-postal"]))) {
        $erreurs["codePostal"] = "Le code postal est obligatoire !";
    } else {
        $codePostal = trim($_POST["code-postal"]);
    }

    if (empty(trim($_POST["ville"]))) {
        $erreurs["ville"] = "La ville est obligatoire !";
    } else {
        $ville = trim($_POST["ville"]);
    }

    if (empty(trim($_POST["mail"]))) {
        $erreurs["mail"] = "L'e-mail est obligatoire !";
    } elseif (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
        $erreurs["mail"] = "Il faut que l'adresse mail soit valide (avec un @ et un nom de domaine valide) !";
    } else {
        $email = trim($_POST["mail"]);
    }

    if (empty(trim($_POST["telephone"]))) {
        $erreurs["telephone"] = "Le numéro de téléphone est obligatoire !";
    } else {
        $telephone = trim($_POST["telephone"]);
    }

    if (empty($erreurs)) {
        $dateDevis = new DateTime("now");
        addDevis($dateDevis,$nomClient,$prenomClient,$email,$telephone,$rue,$codePostal,$ville);
        $idDevis = selectIdDevisFromNameAndDate($nomClient,$prenomClient,$dateDevis);
        foreach ($_SESSION["panier"] as $produit) {
            $idProd = $produit["id"];
            if ($produit["couleur"] == "---") {
                $idCouleur = 1;
            } else {
                $idCouleur = $produit["couleur"];
            }
            $qteProd = $produit["quantite"];
            addContenuDevis($idDevis["id_devis"],$idProd,$idCouleur,$qteProd);
            updateQuantityFromAllIdsAndProdQuantity($idProd,$idCouleur,$qteProd);
        }
        unset($_SESSION["panier"]);
        header("Location: index.php");
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
    <title>Commande</title>
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
            <h2 class="title2">Finalisez votre commande</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="prenom">Prénom <span class="etoile">*</span></label>
                <label for="nom">Nom <span class="etoile">*</span></label>

                <input type="text" name="prenom" id="prenom">
                <input type="text" name="nom" id="nom">

                <?php if (isset($erreurs["prenom"])) {?>
                    <p class="erreur-validation2"><?= $erreurs["prenom"] ?></p>
                <?php } ?>

                <?php if (isset($erreurs["nom"])) {?>
                    <p class="erreur-validation2"><?= $erreurs["nom"] ?></p>
                <?php } ?>

                <label for="rue">Rue <span class="etoile">*</span></label>
                <label for="code-postal">Code Postal <span class="etoile">*</span></label>

                <input type="text" name="rue" id="rue">
                <input type="text" name="code-postal" id="code-postal">

                <?php if (isset($erreurs["rue"])) {?>
                    <p class="erreur-validation2"><?= $erreurs["rue"] ?></p>
                <?php } ?>

                <?php if (isset($erreurs["codePostal"])) {?>
                    <p class="erreur-validation2"><?= $erreurs["codePostal"] ?></p>
                <?php } ?>

                <label for="ville">Ville <span class="etoile">*</span></label>
                <label for="mail">E-mail <span class="etoile">*</span></label>

                <input type="text" name="ville" id="ville">
                <input type="text" name="mail" id="mail">

                <?php if (isset($erreurs["ville"])) {?>
                    <p class="erreur-validation2"><?= $erreurs["ville"] ?></p>
                <?php } ?>

                <?php if (isset($erreurs["mail"])) {?>
                    <p class="erreur-validation2"><?= $erreurs["mail"] ?></p>
                <?php } ?>

                <label for="telephone">Téléphone <span class="etoile">*</span></label>
                <div> </div>

                <input type="text" name="telephone" id="telephone">
                <div> </div>

                <?php if (isset($erreurs["telephone"])) {?>
                    <p class="erreur-validation2"><?= $erreurs["telephone"] ?></p>
                <?php } ?>

                <input type="submit" value="Envoyer">

                <div><span class="etoile">*</span> : Ce champ est obligatoire.</div>
            </form>
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
