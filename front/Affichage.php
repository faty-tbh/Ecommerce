<?php
require_once("../model/connexionBD.php");


if(isset($_GET['id_produit'])) 
	{
		$Requette="SELECT * FROM bijoux WHERE id_produit = '$_GET[id_produit]'";
		
		$resultat=$connexion->query($Requette);
	 }
//récuperation d'une ligne de résultat sous forme de tableau associatif
$bijoux =$resultat->fetch_assoc();

$affichage= "<h4 style='font-size:2rem; font-weight:700;'> $bijoux[categorie]</h4><br>";
$affichage.= "<img src='$bijoux[photo]' width='300' height='300' /><br>";
$affichage.= "Prix:$bijoux[prix] $<br>";


if(!($bijoux['stock'] < 0))
{
	$affichage .= "<i 
	style='display: inline-block;
    margin-top: 20px;
    padding: 8px 20px;
    background:#333;
    color: #fff;
    font-weight: 500;
    letter-spacing: 1px;'>Stock: $bijoux[stock] Articles </i><br /><br />";

	$affichage .= '<form method="POST" action="Panier.php">';

	$affichage .= '<label
	style="display: inline-block;
    padding: 4px 20px;
    background:  #333;
    color: #fff;
    font-weight: 500;
    letter-spacing: 1px;" for="quantite">Quantité désirée: </label>  ';

	$affichage .= '<select id="qnt" name="quantite">';
	
			for($nb = 1; $nb <=$bijoux['stock'] && $nb <= $bijoux['stock']; $nb++)
			{
				$affichage .= "<option>$nb</option>";
			}

			$affichage .= '</select><br><input
			style="display: inline-block;
			margin-top: 20px;
			padding: 8px 20px;
			background: rgb(12, 36, 12);
			color: #fff;
			border-radius: 40px;
			font-weight: 500;
			letter-spacing: 1px;"  type="submit" name="panier" value="Ajouter a votre panier" /></form>';
			
}
else
{
	$affichage .= 'Sold out !';
}
$affichage .= "<br><a
 style='color:white ;display: inline-block;
margin-top: 20px;
padding: 8px 20px;
background:rgb(12, 36, 12);
color: #fff;
border-radius: 40px;
font-weight: 500;
letter-spacing: 1px;' href='Shop.php?categorie=" .$bijoux['categorie'] . "'>Retour à la collection ". "</a>";

?>

<html>
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
            <div style="color:white ">
            <?php echo $affichage ?>

</div>
</section>

</body>
</html>


