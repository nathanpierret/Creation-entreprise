<?php
    session_start();

    require_once "src/modele/couleur-db.php";

    if (!isset($_SESSION["panier"])) {
        //Création du panier dans la session
        $_SESSION["panier"] = [];
    }

    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        if (isset($_POST["btn-modifier"])) {
            $_SESSION["panier"][$_POST["nom-produit"]]["quantite"] = $_POST["quantite"];
        } else if (isset($_POST["btn-supprimer"])) {
            unset($_SESSION["panier"][$_POST["nom-produit"]]);
        } else if (isset($_POST["btn-vider"])) {
            $_SESSION["panier"] = [];
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
            <h1 class="title3">Votre panier</h1>
            <table class="Table">
                <thead>
                <tr>
                    <th>Produit</th>
                    <th>Couleur</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td colspan="4" class="total">Total</td>
                    <td class="prix-total"><?php $total = 0;
                        foreach ($_SESSION["panier"] as $produit) {
                            $total += $produit["prix"]*$produit["quantite"];
                        }
                        echo $total;
                        ?> €</td>
                    <td>
                        <form method="post" class="Suppr">
                            <input type="hidden" name="type-form" value="Vider">
                            <input type="submit" name="btn-vider" value="Vider le panier">
                        </form>
                    </td>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($_SESSION["panier"] as $produit) {?>
                    <tr>
                        <td><img src="images/<?=$produit["photo"]?>" alt="Photo de <?=$produit["nom"] ?>" class="photo-produit">
                            <div class="nom-produit"><?= $produit["nom"]?></div></td>
                        <td class="td2"><?php if ($produit["couleur"] == "---") {echo $produit["couleur"]; } else { $couleur = selectColorById($produit["couleur"]); echo $couleur["nom_couleur"]; }?></td>
                        <td><?= $produit["prix"]?> €</td>
                        <td class="td3">
                            <form method="post">
                                <input type="hidden" name="nom-produit" value="<?= $produit["nom"]?>">
                                <input type="number" name="quantite" min="1" max="<?= $produit["max"]["qte_stock"] ?>" value="<?= $produit["quantite"]?>">
                                <input type="submit" name="btn-modifier" value="Modifier">
                            </form>
                        </td>
                        <td class="td4"><?= $produit["prix"]*$produit["quantite"]?> €</td>
                        <td>
                            <form method="post" class="Suppr">
                                <input type="hidden" name="nom-produit" value="<?= $produit["nom"]?>">
                                <input type="submit" name="btn-supprimer" value="Supprimer">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="Boutons">
                <a href="produits.php" class="Bouton">Continuer mes achats</a>
                <?php if ($_SESSION["panier"] == []) { ?>
                    <div class="panier-vide">Votre panier est vide !</div>
                <?php } else { ?>
                    <a href="commande.php" class="Bouton">Passer ma commande</a>
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