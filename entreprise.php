<?php
    session_start();

    if (!isset($_SESSION["panier"])) {
        //Création du panier dans la session
        $_SESSION["panier"] = [];
    }

    $image = null;
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $fiche = $_POST["fiche-poste"];
        $image = "images/Fiche_poste_$fiche.JPG";
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
    <title>Notre entreprise</title>
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

        <h2 class="title2">À propos de nous</h2>
        <div class="paragraphe">
            &nbsp &nbsp Paradice est, comme son nom l'indique, le paradis des amoureux des dés. Nous vous proposons une sélection
            extraordinaire de dés, du classique dé à 6 faces au mystique dé à 20 faces. Vous trouverez aussi nos dés uniques ainsi que des
            variantes de dés inspirées d'univers connus et célèbres. Créée le 10 mars 2022, notre entreprise à l'origine familiale
            a pu se développer s'étendre sur l'est de la France avec nos 43 magasins.
        </div>

        <h2 class="title2">Historique de l'entreprise</h2>
        <ul class="ul2">
            <li>10 mars 2022 : Création de l'entreprise familiale par Lucas et Gladys Masnot à Besançon.</li>
            <li>24 mai 2022 : Ouverture du site internet PARADICE.</li>
            <li>15 octobre 2022 : Agrandissement de l'entreprise et ouverture de 12 nouveaux magasins dans la région deFranche-Comté.</li>
            <li>8 décembre 2022 : Célébration du 1,000,000ème dé vendu et ouverture de 8 nouveaux magasins dans la région Rhône-Alpes.</li>
            <li>19 janvier 2023 : Célébration du 100ème salarié dans l'entreprise et ouverture de 13 nouveaux magasins dans la région de
            Bourgogne.</li>
            <li>22 janvier 2023 : Record de ventes dans l'entreprise : 545,468 dés vendus en une semaine.</li>
            <li>2 février 2023 : Célébration du 2,000,000ème dé vendu et ouverture de 9 nouveaux magasins dnas la région d'Alsace.</li>
        </ul>

        <div class="ligne">
            <div class="colonne">
                <h2 class="title2">Organigramme de notre entreprise</h2>
                <img src="images/Organigramme_PARADICE.png" alt="Organigramme de l'entreprise" class="image2">
            </div>

            <div class="colonne">
                <h2 class="title2">Fiches postes de l'organigramme</h2>
                <form method="post" class="fiches">
                    <select name="fiche-poste" id="fiche-poste">
                        <option value="1" <?php if (isset($_POST["fiche-poste"]) && $_POST["fiche-poste"] == "1") { ?> selected <?php } ?>>
                            Président-Directeur Général (PDG)</option>
                        <option value="2" <?php if (isset($_POST["fiche-poste"]) && $_POST["fiche-poste"] == "2") { ?> selected <?php } ?>>
                            Directeur marketing et ventes</option>
                        <option value="3" <?php if (isset($_POST["fiche-poste"]) && $_POST["fiche-poste"] == "3") { ?> selected <?php } ?>>
                            Directeur administratif et financier</option>
                        <option value="4" <?php if (isset($_POST["fiche-poste"]) && $_POST["fiche-poste"] == "4") { ?> selected <?php } ?>>
                            Directeur des ressources humaines</option>
                        <option value="5" <?php if (isset($_POST["fiche-poste"]) && $_POST["fiche-poste"] == "5") { ?> selected <?php } ?>>
                            Assistant marketing</option>
                        <option value="6" <?php if (isset($_POST["fiche-poste"]) && $_POST["fiche-poste"] == "6") { ?> selected <?php } ?>>
                            Chef comptable</option>
                    </select>
                    <button type="submit" name="check"><i class="fa-solid fa-arrow-right"></i></button>
                </form>
                <?php if (isset($image)) {?>
                    <img src="<?= $image?>" alt="Fiche de poste" class="image3">
                    <a href="<?= $image?>" class="bouton-fiche"><i class="fa-solid fa-file-arrow-down"></i> &nbspTélécharger</a>
                <?php } ?>
            </div>
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