<?php 
//demarre
session_start();
$affichage= '<h1 style=color:"white">Vos informations :</h1><br>';

$affichage .= '<h2 style=color:"white">Bonjour,Notre cher client <strong style="color:white">' . $_SESSION['membres']['pseudo'] . '</strong></h2>';
$affichage .= '<h2 style=color:"white"> votre email est: <strong style="color:white">' . $_SESSION['membres']['email'] . '</strong></h2>';
$affichage .= '<h2>votre ville est: <strong style="color:white">' . $_SESSION['membres']['ville'] . '</strong><br></h2>';
$affichage .= '<h2>votre adresse est: <strong style="color:white">' . $_SESSION['membres']['adresse'] . '</strong></h2>';

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
            <div style="color:gray ">
            <?php echo$affichage ?>

</div>

        
            </section>

</body>
</html>




