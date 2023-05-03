<?php

require_once "connexion-db.php";

function selectQuantityFromProductId (int $productId) : array {
    $connexion = createConnection();
    $requeteSQL = "SELECT SUM(qte_stock) FROM choix WHERE id_prod = :id";
    $requete = $connexion->prepare($requeteSQL);
    $requete->bindValue(":id",$productId);
    $requete->execute();
    $stock = $requete->fetch(PDO::FETCH_ASSOC);
    return $stock;
}

function selectAllVariantsIdFromProductId (int $productId) : array {
    $connexion = createConnection();
    $requeteSQL = "SELECT DISTINCT id_variante FROM choix WHERE id_prod = :id";
    $requete = $connexion->prepare($requeteSQL);
    $requete->bindValue(":id",$productId);
    $requete->execute();
    $variantes = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $variantes;
}

function selectAllColorsIdFromProductIdAndVariantId (int $productId, int $variantId) : array {
    $connexion = createConnection();
    $requeteSQL = "SELECT id_couleur FROM choix WHERE id_prod = :id1 AND id_variante = :id2";
    $requete = $connexion->prepare($requeteSQL);
    $requete->bindValue(":id1",$productId);
    $requete->bindValue("id2",$variantId);
    $requete->execute();
    $couleurs = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $couleurs;
}

function selectQuantityFromAllIds (int $productId, int $variantId, int $colorId) : array {
    $connexion = createConnection();
    $requeteSQL = "SELECT qte_stock FROM choix WHERE id_prod = :id1 AND id_variante = :id2 AND id_couleur = :id3";
    $requete = $connexion->prepare($requeteSQL);
    $requete->bindValue(":id1",$productId);
    $requete->bindValue(":id2",$variantId);
    $requete->bindValue(":id3",$colorId);
    $requete->execute();
    $quantite = $requete->fetch(PDO::FETCH_ASSOC);
    return $quantite;
}