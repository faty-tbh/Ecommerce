<?php

require_once("connexionBD.php");
    
    

        $Requette= "CREATE TABLE IF NOT EXISTS bijoux (
            id_produit INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
            categorie VARCHAR(20) NOT NULL ,
            detail_produit TEXT NOT NULL ,
            photo VARCHAR(250) NOT NULL ,
            prix INT(3) NOT NULL ,
            stock INT(3) NOT NULL )";
        $connexion->query($Requette);


$Requette= "CREATE TABLE IF NOT EXISTS  membres (
    id_membre INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    pseudo VARCHAR(20) NOT NULL ,
    mdp VARCHAR(32) NOT NULL ,
    nom VARCHAR(20) NOT NULL ,
    prenom VARCHAR(20) NOT NULL ,
    email VARCHAR(50) NOT NULL ,
    ville VARCHAR(20) NOT NULL ,
    adresse VARCHAR(50) NOT NULL )";
    
    $connexion->query($Requette);


    $Requette= "CREATE TABLE IF NOT EXISTS  Cmd (
        id_commande INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        id_membre INT(3) NULL DEFAULT NULL,
        montant INT(3) NOT NULL,
        date_enregistrement DATETIME NOT NULL,
        etat ENUM('en cours de traitement', 'envoyé', 'livré') NOT NULL
    ) ";
    $connexion->query($Requette);

$Requette= "CREATE TABLE IF NOT EXISTS  details_commande (
id_details_commande INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_commande INT(3) NULL DEFAULT NULL,
id_produit INT(3) NULL DEFAULT NULL,
quantite INT(3) NOT NULL,
prix INT(3) NOT NULL
)";
$connexion->query($Requette);
?>