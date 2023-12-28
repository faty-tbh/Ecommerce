<?php
require_once("../model/connexionBD.php");
//stocker la nouvelle photo lors de la modification

if(!empty($_FILES['photo']['name']))
{   
    $nomDePhoto = $_FILES['photo']['name'];
    $enregImgBD = "/prjBijoux/images/". $nomDePhoto;	
    $stockerImg="C:/xampp/htdocs/prjBijoux/images/".$nomDePhoto;
    copy($_FILES['photo']['tmp_name'],$stockerImg);     
}

$categorie=$_POST["categorie"];
$description=$_POST["description"];
$photo=$enregImgBD;
$prix=$_POST["prix"];
$stock=$_POST["stock"];

//la requette sql pour modifier le bijoux choisie 
$requette="UPDATE bijoux set categorie='$categorie',
           detail_produit='$description',
           photo='$photo',
           prix='$prix', 
           stock='$stock'
          where id_produit=$_GET[id_produit]";

$resultat=$connexion->query($requette);
if ($resultat)
{
    header("location:AffichageDesBijoux.php?action=affichageBijoux");

}
?>