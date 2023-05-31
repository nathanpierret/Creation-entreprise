<?php

require_once "connexion-db.php";

function selectAllProducts () : array {
    $connexion = createConnection();
    $requeteSQL = "SELECT * FROM produit";
    $requete = $connexion->prepare($requeteSQL);
    $requete->execute();
    $produits = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $produits;
}

function selectProductById (int $id) : array {
    $connexion = createConnection();
    $requeteSQL = "SELECT * FROM produit WHERE id_prod = :id";
    $requete = $connexion->prepare($requeteSQL);
    $requete->bindValue(":id",$id);
    $requete->execute();
    $produit = $requete->fetch(PDO::FETCH_ASSOC);
    return $produit;
}

function selectAllDiceVariants () : array {
    $connexion = createConnection();
    $requeteSQL = "SELECT * FROM produit WHERE id_prod >= 900";
    $requete = $connexion->prepare($requeteSQL);
    $requete->execute();
    $produit = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $produit;
}

function selectAllDiceProducts () : array {
    $connexion = createConnection();
    $requeteSQL = "SELECT * FROM produit WHERE id_prod < 900";
    $requete = $connexion->prepare($requeteSQL);
    $requete->execute();
    $produits = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $produits;
}