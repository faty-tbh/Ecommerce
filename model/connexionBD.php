<?php
        $serveur = 'localhost';
        $utilisateur = 'root';
        $mdp = '';
        $baseDedonne = 'storeBijoux';
       
       $connexion = new mysqli($serveur, $utilisateur,$mdp,$baseDedonne);
       if($connexion->connect_error){
        die('problème de connexion avec la base de données ' .$connexion->connect_error);
        }
?>