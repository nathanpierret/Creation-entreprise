<?php
require_once "connexion-db.php";

function selectColorById (int|null $id) : array|string {
    if (!isset($id)) {
        return "---";
    } else {
        $connexion = createConnection();
        $requeteSQL = "SELECT nom_couleur FROM couleur WHERE id_couleur = :id";
        $requete = $connexion->prepare($requeteSQL);
        $requete->bindValue(":id",$id);
        $requete->execute();
        $couleur = $requete->fetch(PDO::FETCH_ASSOC);
        return $couleur;
    }
}