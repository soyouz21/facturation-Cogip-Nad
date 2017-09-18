<?php
try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=facturation;charset=utf8', 'root', 'user');
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}


$query_societe_type_fournisseur= $bdd->query('SELECT * 
											  FROM societe, type 
											  WHERE type = "Fournisseur" 
											  AND societe.id_type = type.id_type');

$societe_type_fournisseur = [];

while ($donnees = $query_societe_type_fournisseur->fetch()){
	$societe_type_fournisseur[$donnees['id_societe']] = array('nom_societe' => $donnees['nom_societe']);
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Facturation</title>
</head>
<body>


  <h1>Application RANU</h1>

  <label></label>
  <br><br>
  <label>Voici la liste de toutes les sociétés de type <strong>fournisseur</strong> :</label>
  <?php
  		$compteur = 0;	
  		foreach ($societe_type_fournisseur as $key => $value) {
  		$compteur++;
  ?>
  		<p><?= $compteur.") "?><a href="detailsociete.php?id_societe=<?=$key?>"> <?= $value["nom_societe"]?> </a> </p>

  		
  <?php } ?>

  <a href="index.php"> <button type="button">Retour</button> </a>

</body>
</html>