<?php
    session_start();

    require_once "./src/modele/devis-db.php";
    require_once "./src/modele/contenu-devis-db.php";
    require_once "./src/modele/produit-db.php";
    require_once "./src/modele/couleur-db.php";

    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $erreurURL = "URL demandée non valide";
    }

    $devis = selectDevisById($id);
    $contenuDevis = selectContenuDevisById($id);
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
    <title>Récapitulatif de votre devis</title>
</head>
<body>

<div class="devis">
    <div class="title-devis">Commande n°<?=$devis["id_devis"] ?> du <?= $devis["date_devis"] ?></div>
    <div class="nom-client">Client : <?= $devis["prenom_client"]." ".$devis["nom_client"] ?></div>
    <div class="email-client">Email : <?= $devis["mail_client"] ?></div>
    <div class="telephone-client">Téléphone : <?= $devis["telephone_client"]?></div>
    <table class="Table">
        <thead>
        <tr>
            <th>Produit</th>
            <th>Couleur</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Total</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="4" class="total">Total</td>
            <td class="prix-total"><?php $total = 0;
            foreach ($contenuDevis as $produit) {
                $contenuProduit = selectProductById($produit["id_prod"]);
                $total += $produit["qte_prod"]*$contenuProduit["prix_prod"];
            }
            echo $total;
            ?> €</td>
        </tr>
        </tfoot>
        <tbody>
        <?php foreach ($contenuDevis as $produit2) {
            $contenuProduit2 = selectProductById($produit2["id_prod"]);?>
            <tr>
                <td><img src="images/<?=$contenuProduit2["lib_photo"]?>" alt="Photo de <?=$contenuProduit2["nom_prod"] ?>" class="photo-produit">
                    <div class="nom-produit"><?= $contenuProduit2["nom_prod"]?></div></td>
                <td class="td2"><?php if ($produit2["id_couleur"] == null) {echo "---"; } else { $couleur = selectColorById($produit2["id_couleur"]); echo $couleur["nom_couleur"];}?></td>
                <td><?= $contenuProduit2["prix_prod"]?> €</td>
                <td class="td3"><?= $produit2["qte_prod"]?></td>
                <td class="td4"><?= $contenuProduit2["prix_prod"]*$produit2["qte_prod"]?> €</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="info-devis">Appuyez sur Ctrl + P pour imprimer votre devis.</div>
    <a href="index.php" class="retour-devis">Retour à l'accueil</a>
</div>

</body>
</html>