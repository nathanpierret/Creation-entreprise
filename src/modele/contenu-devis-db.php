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