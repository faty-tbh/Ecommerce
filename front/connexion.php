<?php
//on demarre la session 
session_start();
 require_once("../model/connexionBD.php");
 //$Post existe
if($_POST)
{
    $Requette = "SELECT * FROM membres WHERE pseudo='$_POST[pseudo]'";
    $resultat=$connexion->query($Requette);
    
    if(!($resultat->num_rows == 0))
    {
        //récuperation d'une ligne de résultat sous forme de tableau associatif
        $membres = $resultat->fetch_assoc();
        if($membres['mdp'] == $_POST['mdp'])
        {
            //foreach assignera en plus la clé de membres courant à la variable $indice à chaque itération.
            foreach($membres as $clef => $champ)
            {
                if($clef != 'mdp')
                {
                    //$_SESSION permet de stocker des informations pour un utilisateur pendant la durée de sa visite sur le site.
                    $_SESSION['membres'][$clef] = $champ;
                }
            }
            header("location:profil.php"); 
        }
        else
        {
            $affichage.= '<div>Votre mot de passe est incorrect</div>';
        }       
    }
    else
    {
        $affichage.= '<div>Votre pseudo est incorrect</div>';
    }
    echo$affichage;
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
?>
<head>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<section>
            <div class="circle"></div>
            <header>
                <a href="#" >
                    <img src="img/v--1140663248__1123074009_2000x-removebg-preview.png" class="logo"  alt="FHO Shop">

                </a>
                <ul>
                    <li><a href="Site.php">Home</a></li>
                    <li><a href="Shop.php">Shop</a></li>
                    <li><a href="connexion.php">connexion</a></li>
                    <li><a href="Inscrire.php">S'inscrire</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="Panier.php">
                        <img src="img/panier.png" width="20px" height="20px">
                    </a></li>
                </ul>
            </header>
 
<form style="color:white" method="POST" action="" >
    <label  for="pseudo">Pseudo</label><br />
    <input type="text" id="psd" name="pseudo" /><br /> <br />
         
    <label for="mdp">Mot de passe</label><br />
    <input type="password" id="psw" name="mdp" /><br /><br />
 
     <input
     style="display: inline-block;
        margin-top: 20px;
        padding: 8px 20px;
        background:  gray;
        color: rgb(12, 36, 12);
        border-radius: 40px;
        font-weight: 500;
        letter-spacing: 1px;
        text-decoration: none;"
        type="submit" value="Se connecter"/>
</form>
 