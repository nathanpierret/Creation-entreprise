<?php

require_once "connexion-db.php";

function selectQuantityFromAllIds (int $productId, int $colorId) : array {
    $connexion = createConnection();
    $requeteSQL = "SELECT qte_stock FROM choix WHERE id_prod = :id AND id_couleur = :id2";
    $requete = $connexion->prepare($requeteSQL);
    $requete->bindValue(":id",$productId);
    $requete->bindValue(":id2",$colorId);
    $requete->execute();
    $stock = $requete->fetch(PDO::FETCH_ASSOC);
    return $stock;
}

function selectAllColorsIdFromProductId (int $productId) : array {
    $connexion = createConnection();
    $requeteSQL = "SELECT id_couleur FROM choix WHERE id_prod = :id1";
    $requete = $connexion->prepare($requeteSQL);
    $requete->bindValue(":id1",$productId);
    $requete->execute();
    $couleurs = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $couleurs;
}
