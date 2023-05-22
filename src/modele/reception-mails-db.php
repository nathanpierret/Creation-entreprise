<?php

require_once "connexion-db.php";

function addMail (string $prenom, string $nom, string $mail, string $telephone, string $motif, string $message, string|null $libPhoto): void {
    $timestmp = new DateTimeImmutable();
    $heureTraitement = $timestmp->format("Y-m-d H:i:s");
    $connexion = createConnection();
    $requeteSQL = "INSERT INTO reception_mails (prenom_emetteur, nom_emetteur, email_emetteur, telephone_emetteur, objet_email, message_email, lib_photo, date_envoi) 
                    VALUES (:prenom, :nom, :email, :telephone, :motif, :message, :libPhoto, :heure)";
    $requete = $connexion->prepare($requeteSQL);
    $requete->bindValue(":prenom",$prenom);
    $requete->bindValue(":nom",$nom);
    $requete->bindValue(":email",$mail);
    $requete->bindValue(":telephone",$telephone);
    $requete->bindValue(":motif",$motif);
    $requete->bindValue(":message",$message);
    $requete->bindValue(":libPhoto",$libPhoto);
    $requete->bindValue(":heure", $heureTraitement);
    $requete->execute();
}