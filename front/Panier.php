<?php
require_once("functions.php");// pour inclure le fichier fonctions.php
require_once("../model/connexionBD.php");// pour inclure le fichier fonctions.php
session_start();//crée une session, fonction
$aff='';

//ajouter dans le panier//
if(isset($_POST['ajout_panier'])) 
{	
	
	$Requette = "SELECT * FROM bijoux WHERE id_produit='$_POST[id_produit]'";// selectioner le produit avec son id et afficher le donne panier 
	$resultat=$connexion->query($Requette );// executer la requet
	$produit = $resultat->fetch_assoc();// transformer en tableau associatif
	
	//création du panier------

	if (!isset($_SESSION['Panier']))//vérifie si une variable est définie 
	{
	   $_SESSION['Panier']=array();//stockant les informations utilisateur à utiliser sur plusieurs pages 
	   $_SESSION['Panier']['titre'] = array();
	   $_SESSION['Panier']['id_produit'] = array();
	   $_SESSION['Panier']['quantite'] = array();
	   $_SESSION['Panier']['prix'] = array();
	}
//------ajout du produit dans le panier------
//pour ajouter une quantite a un produt qui exicte déja 
	$position_produit = array_search($_POST['id_produit'],  $_SESSION['Panier']['id_produit']); 
    if ($position_produit !== false)
    {
         $_SESSION['Panier']['quantite'][$position_produit] += $_POST['quantite'] ;
    }
    else 
	// ajouter un nouveau produit dans le panier
    {
        $_SESSION['Panier']['titre'][] = $produit['categorie'];
        $_SESSION['Panier']['id_produit'][] = $_POST['id_produit'];
        $_SESSION['Panier']['quantite'][] = $_POST['quantite'];
		$_SESSION['Panier']['prix'][] = $produit['prix'];
    }}


//--


if(isset($_GET['action']) && $_GET['action'] == "retirer")//La fonction isset() vérifie si une variable est définie

{
	$position_produit = array_search($_GET['id_produit'],  $_SESSION['Panier']['id_produit']);//cherche dans le tableau une valeur donnée et renvoie la première clé correspondante
	if ($position_produit !== false)
    {
		//supprimer un seul element dont l'indice est position produit
		array_splice($_SESSION['Panier']['titre'], $position_produit, 1);//supprime les éléments sélectionnés d'un tableau
		array_splice($_SESSION['Panier']['id_produit'], $position_produit, 1);
		array_splice($_SESSION['Panier']['quantite'], $position_produit, 1);
		array_splice($_SESSION['Panier']['prix'], $position_produit, 1);
	}
}

	//-----------

//vider le panier//
if(isset($_GET['action']) && $_GET['action'] == "vider")
{
	unset($_SESSION['Panier']);
}
//paiement//verofier les produit qui trouve dans le panier et les calculers et aussi verficatyion par a port le stock
if(isset($_POST['payer']))
{
	for($i=0 ;$i < count($_SESSION['Panier']['id_produit']) ; $i++) 
	{
		$Requette = "SELECT * FROM bijoux WHERE id_produit=" . $_SESSION['Panier']['id_produit'][$i];
		$resultat=$connexion->query($Requette );
		$produit = $resultat->fetch_assoc();
		if($produit['stock'] < $_SESSION['Panier']['quantite'][$i])
		{
			$aff .= '<hr /><div>Stock Restant: ' . $produit['stock'] . '</div>';
			$aff .= '<div>Quantité demandée: ' . $_SESSION['Panier']['quantite'][$i] . '</div>';
			if($produit['stock'] > 0)
			{
				$aff .= '<div >la quantité du produit ' . $_SESSION['Panier']['id_produit'][$i] . ' a été réduite car notre stock était insuffisant, veuillez vérifier vos achats.</div>';
				$_SESSION['Panier']['quantite'][$i] = $produit['stock'];
			}
			else
			{
				$aff .= '<div>le produit ' . $_SESSION['Panier']['id_produit'][$i] . ' a été retiré de votre panier car nous sommes en rupture de stock, veuillez vérifier vos achats.</div>';
				retirerproduitDuPanier($_SESSION['Panier']['id_produit'][$i]);
				$i--;
			}
			$erreur = true;
		}
	}
	//information sur la commande 
	if(!isset($erreur))
	{
		$req="INSERT INTO Cmd (id_membre, montant, date_enregistrement) VALUES (" . $_SESSION['membre']['id_membre'] . "," . montantTotal() . ", NOW())";
		$resultat=$connexion->query($req);
		$id_commande = $connexion->insert_id;
		
		
		for($i = 0; $i < count($_SESSION['Panier']['id_produit']); $i++)
		{
			$req="INSERT INTO details_commande (id_commande, id_produit, quantite, prix)
			 VALUES ($id_commande, " . $_SESSION['Panier']['id_produit'][$i] . "," . $_SESSION['Panier']['quantite'][$i] . "," . $_SESSION['Panier']['prix'][$i] . ")";
			
			$resultat=$connexion->query($req);
			$x=$_SESSION['Panier']['quantite'][$i];

			//mise a jour de stock dans la base de données-------------

			$req = "SELECT * FROM bijoux WHERE id_produit=" . $_SESSION['Panier']['id_produit'][$i];
			$resultat=$connexion->query($req);
			$produit = $resultat->fetch_assoc();
			$y=$produit['stock'];
		
			$req="UPDATE bijoux set  stock=$y-$x WHERE id_produit=" . $_SESSION['Panier']['id_produit'][$i];
   			$res=$connexion->query($req);

//----------------------

		}
		unset($_SESSION['Panier']);
		$aff .= "<div class='validation'>Merci pour votre commande. votre numéro de suivi est le $id_commande</div>";
	}
}

//--------------------------------- AFFICHAGE HTML ---------------------------------//

echo $aff;



echo "<table border='1' style='border-collapse: collapse' cellpadding='7'>";
echo "<tr style='background:green'><td colspan='5'>Panier</td></tr>";
echo "<tr><th>Catégorie</th><th>id_produit</th><th>Quantité</th><th>Prix Unitaire</th><th>Action</th></tr>";
if(empty($_SESSION['panier']['id_produit'])) // panier vide
{
	echo "<tr style='background:red'><td colspan='5'>Aucun article a votre panier</td></tr>";
}
else
{
	for($i = 0; $i < count($_SESSION['Panier']['id_produit']); $i++) 
	
	{
		echo "<tr>";
		echo "<td>" . $_SESSION['Panier']['titre'][$i] . "</td>";
		echo "<td>" . $_SESSION['Panier']['id_produit'][$i] . "</td>";
		echo "<td>" . $_SESSION['Panier']['quantite'][$i] . "</td>";
		echo "<td>" . $_SESSION['Panier']['prix'][$i] . "</td>";
		echo '<td><a href="?action=retirer&id_produit=' . $_SESSION['panier']['id_produit'][$i] .'">retirer</a></td>';
		echo "</tr>";
	}
	echo "<tr><th colspan='3'>Total</th><td colspan='2'>" . montantTotal() . " dollars</td></tr>";
	if(internauteEstConnecte()) 
	{
		echo '<form method="post" action="">';
		echo '<tr><td colspan="5"><input type="submit" name="payer" value="Valider  le paiement" /></td></tr>';
		echo '</form>';	
}
	else 
	{
		echo '<tr><td colspan="3">Veuillez vous <a href="inscription.php"><b><u>inscrire</b></u></a> ou vous <a href="authentification.php"><b><u>connecter</b></u></a> afin de pouvoir payer</td></tr>';
	}
	echo "<tr><td colspan='5'><a href='?action=vider'>Vider mon panier</a></td></tr>";
	echo "<tr><td colspan='5'><a href='boutique.php'>continuer vos achats</a></td></tr>";
}
echo "</table><br />";