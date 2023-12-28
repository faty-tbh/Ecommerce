<html>
    <head>
        <title> Bijouterie </title>
    <link rel="stylesheet" href="../css/Bijoux.css">
    <style>
      
        body{background-color:black;
                     }
                form{padding: 40px;
                     margin: top 350px;
                     border-radius: 30px;
                     background-color:rgb(12, 36, 12);opacity: 1.3;
                    width: 30%;height: 350px;
                    margin-left: 500px; position: fixed 
                    ; }
                    .textCss{
                        color:rgb(192,192,192);
                    }
                    .button {
                        color:rgb(192,192,192);
                         padding: 10px 10px;
                         background-color:black;
                          border-radius: 15px;
              }
    </style>
    </head>
    <body>
    <center>
<h1 style="color:rgb(12, 36, 12) "> Ajouter un nouveau bijoux à votre site</hr><hr></h1>

<form   method="post" 
        enctype="multipart/form-data" 
        action="affichageDesBijoux.php">
    
    <label style="font-size: 1.5rem;" class="textCss" for="categorie">Categorie:</label><br>
    <input type="text" 
           id="categorie" 
           name="categorie" 
           placeholder="la categorie du bijoux" 
           required><br><br>
 
    <label style="font-size: 1.5rem;" class="textCss" for="description" >Description:</label><br>
    <textarea name="description" 
              id="description" 
              placeholder="details sur  le bijoux" 
              required></textarea><br><br>
   
   
    <label style="font-size: 1.5rem;" class="textCss" for="photo">Photo du bijoux:</label><br>
    <input class="textCss" 
           type="file" 
           id="photo" 
           name="photo" 
           required><br><br>
 
    <label style="font-size: 1.5rem;" class="textCss" for="prix">Prix:</label><br>
    <input type="text" 
           id="prix" 
           name="prix" 
           placeholder="le prix du produit" 
           required><br><br>
     
    <label style="font-size: 1.5rem;" class="textCss" for="stock">Votre stock :</label><br>
    <input type="text"
           id="stock" 
           name="stock" 
           placeholder="votre stock de bijoux" 
           required><br><br>
     
    <input class="button" 
           type="submit" 
           value="Ajout du bijoux">
    
              
               
</form>
</center>
</body>
</html>