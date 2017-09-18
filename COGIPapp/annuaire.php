<?php
try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=facturation;charset=utf8', 'root', 'user');
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}


$query_personnes= $bdd->query('SELECT *
							   FROM personnes
							   ORDER BY nom_personne ASC');

$personnes = [];



while ($donnees = $query_personnes->fetch()){
	$personnes[$donnees['id_personne']] = array('nom_personne' => $donnees['nom_personne'],
						           'prenom_personne' => $donnees['prenom_personne']);
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
  <label>Voici la liste de toutes les personnes de contact de la base de données, par ordre alphabétique: </label>
  <?php
  		$compteur = 0;	
  		foreach ($personnes as $key => $value) {
  		$compteur++;
  ?>
  		<p><?= $compteur.") "?><a href="detailcontact.php?id_personne=<?=$key?>"> <?= $value["nom_personne"]?> </a> <?= ", ".$value["prenom_personne"]?> </p>

  		
  <?php } ?>

  <a href="index.php"> <button type="button">Retour</button> </a>

</body>
</html>