<?php
require_once("../model/connexionBD.php");
$affichage='<div>
<strong><h2 style="color: rgb(12, 36, 12);
font-size: 3em;
font-weight: 900;
font-style:italic;
">FHO SHOP</h2></strong><br><br> ';
$Requette= "SELECT DISTINCT categorie FROM bijoux";
$resultat=$connexion->query($Requette);
$affichage.= '<ul>';
//récuperation d'une ligne de résultat sous forme de tableau associatif
while($categorie = $resultat->fetch_assoc())
{
    
    $affichage.= "<strong><li style='display: inline-block;
    margin-top: 20px;
    padding: 8px 20px;
    background:  rgb(12, 36, 12);
    color: #fff;
    border-radius: 40px;
    font-weight: 500;
    letter-spacing: 1px;
    text-decoration: none;' ><a style='color:white' href='?categorie=" . $categorie['categorie'] . "'>" . $categorie['categorie'] . "</a></li> </strong>";
    
}
$affichage .= "</ul></div>";

$affichage .= '<div ">';
//Verification si categorie existe
if(isset($_GET['categorie']))
{
     $Requette= "SELECT id_produit,categorie,detail_produit,photo,prix,stock FROM bijoux WHERE categorie='$_GET[categorie]'";
     $data=$connexion->query($Requette);
    while($bijoux = $data->fetch_assoc())
    {
        $affichage .= '<div>';
        $affichage .= "<h2 >$bijoux[categorie]</h2>";
        $affichage .= "<img src='$bijoux[photo]' ='300' height='300'></a>";
        $affichage .= "<h3><p style='color:white'>$bijoux[prix] $</p></h3>";
        $affichage .= '<a 
        style="display: inline-block;
        margin-top: 20px;
        padding: 8px 20px;
        background:  gray;
        color: rgb(12, 36, 12);
        border-radius: 40px;
        font-weight: 500;
        letter-spacing: 1px;
        text-decoration: none;" href="affichage.php?id_produit=' . $bijoux['id_produit'] . '">Acheter ce produit</a>';
        $affichage .= '</div>';
    }
}
$affichage .= '</div>';

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


    
            