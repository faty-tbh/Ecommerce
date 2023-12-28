<?php
require_once("../model/connexionBD.php");
if(isset($_GET['id_produit']) && $_GET['action'] == "modification")
{  
    $requette ="select * FROM bijoux WHERE id_produit=$_GET[id_produit]";
    $resultat =$connexion->query($requette);
    $bijoux=$resultat->fetch_assoc() ;
    
    ?>
    <body style="background-color:black;">
    <center>
 <h1 style="color:rgb(12, 36, 12)"> Modifier le bijoux </h1>
<form  style="padding: 40px;
      margin: top 350px;
      border-radius: 30px;
      background-color:rgb(12, 36, 12);
      opacity: 1.3;
      width: 30%;
      height: 400px;
       margin-left: 500px; position: fixed  ;"
      method="post"
      enctype="multipart/form-data" 
      action=<?php echo "modifierUnBijoux.php?id_produit=".$bijoux["id_produit"]?>>
    
    <label style="color:rgb(192,192,192); font-size: 1.5rem;" 
           for="categorie">Categorie :</label><br>
    <input type="text"
           id="categorie"
           name="categorie" 
           placeholder="la categorie de produit" 
           value = <?php echo "'". $bijoux["categorie"] . "'" ?> ><br><br>
 
    <label style="color:rgb(192,192,192); font-size: 1.5rem;" 
           for="description">Description :</label><br>
    <textarea name="description" 
              id="description" 
              placeholder="la description du produit"  
              value = <?php echo "'". $bijoux["detail_produit"] . "'" ?> ></textarea><br><br>
   
    
    <label style="color:rgb(192,192,192); font-size: 1.5rem;" 
           for="photo">Photo du bijoux</label><br>
    <input type="file" 
           id="photo" 
           name="photo" 
           value = <?php echo "'".$bijoux["photo"]. "'" ?>><br><br>
 
    <label style="color:rgb(192,192,192); font-size: 1.5rem;" 
           for="prix">Prix du Bijoux</label><br>
    <input type="text" 
           id="prix" 
           name="prix" 
           value = <?php echo "'".$bijoux["prix"]. "'" ?> 
           placeholder="le prix du produit"><br><br>
     
    <label style="color:rgb(192,192,192); font-size: 1.5rem;" for="stock"> Votre stock</label><br>
    <input type="text"
           id="stock" 
           name="stock" 
           placeholder="le stock du produit" 
           value = <?php echo "'".$bijoux["stock"]. "'" ?>required><br><br>
     
    <input  style="color:rgb(192,192,192);
                   padding: 10px 10px;
                   background-color:black;
                   border-radius: 15px;"
                   type="submit" 
                   value="modifier un bijoux">
</form>
</center>
</body>
<?php } 
?>