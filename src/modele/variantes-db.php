<?php
require_once "connexion-db.php";

function selectVariantById (int $id) : array {
    $connexion = createConnection();
    $requeteSQL = "SELECT nom_variante FROM variantes WHERE id_variante = :id";
    $requete = $connexion->prepare($requeteSQL);
    $requete->bindValue(":id",$id);
    $requete->execute();
    $variante = $requete->fetch(PDO::FETCH_ASSOC);
    return $variante;
}