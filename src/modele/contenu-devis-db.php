<?php
require_once "connexion-db.php";

function addContenuDevis (int $idDevis, int $idProd, int $idCouleur, int $qteProd) {
    $connexion = createConnection();
    $requeteSQL = "INSERT INTO contenu_devis (id_prod, id_couleur, id_devis, qte_prod) 
                    VALUES (:idProd, :idCoul, :idDevis, :qteProd)";
    $requete = $connexion->prepare($requeteSQL);
    $requete->bindValue(":idProd",$idProd);
    $requete->bindValue(":idCoul",$idCouleur);
    $requete->bindValue(":idDevis",$idDevis);
    $requete->bindValue(":qteProd",$qteProd);
    $requete->execute();
}

function selectContenuDevisById (int $idDevis) {
    $connexion = createConnection();
    $requeteSQL = "SELECT * FROM contenu_devis WHERE id_devis = :idDevis";
    $requete = $connexion->prepare($requeteSQL);
    $requete->bindValue(":idDevis",$idDevis);
    $requete->execute();
    $devis = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $devis;
}