<?php
require_once "connexion-db.php";

function addDevis (DateTime $date, string $nom, string $prenom, string $email, string $telephone, string $rue, int $cp, string $ville) {
    $connexion = createConnection();
    $requeteSQL = "INSERT INTO devis (date_devis, nom_client, prenom_client, mail_client, telephone_client, adr_rue_client, adr_CP_client, adr_ville_client) 
                    VALUES (:date, :nom, :prenom, :email, :telephone, :rue, :cp, :ville)";
    $requete = $connexion->prepare($requeteSQL);
    $requete->bindValue(":date",$date->format("Y-m-d H:i:s"));
    $requete->bindValue(":nom",$nom);
    $requete->bindValue(":prenom",$prenom);
    $requete->bindValue(":email",$email);
    $requete->bindValue(":telephone",$telephone);
    $requete->bindValue(":rue",$rue);
    $requete->bindValue(":cp",$cp);
    $requete->bindValue(":ville",$ville);
    $requete->execute();
}

function selectIdDevisFromNameAndDate (string $nomClient, string $prenomClient, DateTime $dateDevis) : array {
    $connexion = createConnection();
    $requeteSQL = "SELECT id_devis FROM devis WHERE nom_client = :nomClient AND prenom_client = :prenomClient AND date_devis = :dateDevis";
    $requete = $connexion->prepare($requeteSQL);
    $requete->bindValue(":nomClient",$nomClient);
    $requete->bindValue(":prenomClient",$prenomClient);
    $requete->bindValue(":dateDevis",$dateDevis->format("Y-m-d H:i:s"));
    $requete->execute();
    $id = $requete->fetch(PDO::FETCH_ASSOC);
    return $id;
}

function selectDevisById (int $idDevis): array {
    $connexion = createConnection();
    $requeteSQL = "SELECT * FROM devis WHERE id_devis = :idDevis";
    $requete = $connexion->prepare($requeteSQL);
    $requete->bindValue(":idDevis",$idDevis);
    $requete->execute();
    $devis = $requete->fetch(PDO::FETCH_ASSOC);
    return $devis;
}