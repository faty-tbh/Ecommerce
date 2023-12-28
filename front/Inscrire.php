<?php
 require_once("../model/connexionBD.php");
 
//si $_POST existe
if($_POST)
{
        $Requette = "SELECT * FROM membres WHERE pseudo='$_POST[pseudo]'"; 
        $resultat=$connexion->query($Requette);
        //num_rows Retourne le nombre de lignes
		if($resultat->num_rows > 0)
		{
            
			$affichage .= "<div style='background:red'> Ce pseudo existe deja Veuillez entrer un autre.</div>";
		}
		else
		{
			
			$Requette= "INSERT INTO membres (pseudo, mdp, nom, prenom, email,ville, adresse)
             VALUES ('$_POST[pseudo]','$_POST[mdp]', '$_POST[nom]', '$_POST[prenom]',
              '$_POST[email]', '$_POST[ville]','$_POST[adresse]')";

             $resultat=$connexion->query($Requette);
             $affichage .= "<div style='background:rgb(12, 36, 12); color:white'>Maintenant, Vous etes inscrit a FHO.
			 <a href='connexion.php'><u>Se connecter</u></a></div>";
		}
	
}



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



<form style="color:white" method="POST" action="">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" name="pseudo"><br><br>
         
    <label for="mot de passe">Mot de passe</label><br>
    <input type="password" name="mdp" ><br><br>
         
    <label for="Lastname">Nom</label><br>
    <input type="text"  name="nom" ><br><br>
         
    <label for="Firstname">Prénom</label><br>
    <input type="text" name="prenom"><br><br>
 
    <label for="email">Email</label><br>
    <input type="email" name="email" ><br><br>
         
    <label for="city">Ville</label><br>
    <input type="text" name="ville"><br><br>
         
    <label for="adresse">Adresse</label><br>
    <textarea name="adresse">
	</textarea><br><br>
 
    <input  style="display: inline-block;
        margin-top: 20px;
        padding: 8px 20px;
        background:  gray;
        color: rgb(12, 36, 12);
        border-radius: 40px;
        font-weight: 500;
        letter-spacing: 1px;
        text-decoration: none;"
        type="submit" name="inscription" value="S'inscrire" >
</form>
</section>
</body>
 
