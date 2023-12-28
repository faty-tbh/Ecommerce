<?php 
require_once("../model/connexionBD.php");

$html='';

//--- INSERTION PRODUIT ---//
if(!empty($_POST))
{   
    $enregImgBD  = ""; 
    if(!empty($_FILES['photo']['name']))
    {   
        $nomDePhoto = $_FILES['photo']['name'];
    $enregImgBD = "/prjBijoux/images/". $nomDePhoto;	
    $stockerImg="C:/xampp/htdocs/prjBijoux/images/".$nomDePhoto;
    copy($_FILES['photo']['tmp_name'],$stockerImg);    
    }
    $requette="INSERT INTO bijoux (id_produit, categorie, detail_produit, photo, prix, stock)
    values ('', 
    '$_POST[categorie]',  
    '$_POST[description]',  
    '$enregImgBD',  
    '$_POST[prix]',
    '$_POST[stock]'
    )";
    $resultat=$connexion->query($requette);
   if ($resultat){echo '<div style="background:#99ff99;border-radius: 10% / 50%;padding: 5px;width:50%;margin-left:23%;">

    <center>le bijoux est ajouté à votre boutique</center></div>';
       $_GET['action'] = 'affichage';
   }
}
//--- SUPPRESSION PRODUIT ---//
if(isset($_GET['action']) && $_GET['action'] == "suppression")
{  
    $requette = "DELETE FROM bijoux WHERE id_produit=$_GET[id_produit]";
    $resultat=$connexion->query($requette);
    if ($resultat){
        echo '<div style="background:#E74C3C; border-radius: 10% / 50%;padding: 5px;width:50%;margin-left:23%">

        <center>le bijoux est supprimé de la base de donnée de votre boutique </center></div>';
        $_GET['action'] = 'affichage';
       }
    }

    //--- LIENS PRODUITS ---//
    $html.='<div class="circle"></div>';
    $html.='<body style="background:black"><center><h1><a style="color:rgb(12, 36, 12) " href="?action=affichageBijoux"> Votre Bijouterie</a></h1>';


    $html.= '<br></center>';
 //--- AFFICHAGE PRODUITS ---//

 if(isset($_GET['action']) && $_GET['action'] == "ajouterBijoux")
 { header("location:ajouterUnBijoux.php");}

 elseif((isset($_GET['action']) && $_GET['action'] == "affichageBijoux")||(isset($_GET['action']) && $_GET['action'] == "suprimmerBijoux"))
 {
     $requette = "SELECT * FROM bijoux";
     $resultat=$connexion->query($requette);
      
     
     $html .= '<center><p style="color: white ">Vous avez enregistrer ' . $resultat->num_rows.' bijoux </p><br>';
     $html .= '<table border="1"style="background:#333"><tr>';
      
     while($colonne = $resultat->fetch_field())
     {    
        $html .= '<th style="color: white">' . $colonne->name . '</th>';
     }
     $html .= '<th style="color: white">Modification</th>';
     $html .= '<th style="color: white">Supression</th>';
     
     $html .= '</tr>';
  
     while ($ligne = $resultat->fetch_assoc())
     {
        $html .= '<tr style="color:white">';
         foreach ($ligne as $indice => $info)
         {
             if($indice == "photo")
             {
                $html .= '<td><img style="width: 150px; height:100px;" src="' . $info . '" ></td>';
             }
             else
             {
                $html .= '<td>' . $info . '</td>';
             }
         }
         $html .= '<td><a href="saisirLaModification.php?action=modification&id_produit=' . $ligne['id_produit'] .'"OnClick="return(confirm(\'Voulez vous modifier ce bijoux\'));"><center><button style="background-color:#E3D651;padding: 10px 10px;">modifier le bijoux </button><center></a></td>';
         $html .= '<td><a href="?action=suppression&id_produit=' . $ligne['id_produit'] .'" OnClick="return(confirm(\'Voulez vous supprimer ce bijoux ?\'));"><button style="background-color:red;padding: 10px 10px;">supprimer le bijoux </button><center></a></td>';

         $html .= '</tr>';
     }
     $html .= '</table><br><br></center></body>';
     $html.='<center><a href="ajouterUnBijoux.php' .'" OnClick="return(confirm(\'Voulez vous ajouter un nouveau bijoux\'));"><button style="display: inline-block;
     margin-top: 20px;
     padding: 8px 20px;
     background:  rgb(12, 36, 12);
     color: #fff;
     border-radius: 40px;
     font-weight: 500;
     letter-spacing: 1px;
     text-decoration: none;">Ajout d\'un bijoux </button><center></a>';
 }
 echo $html;

?>