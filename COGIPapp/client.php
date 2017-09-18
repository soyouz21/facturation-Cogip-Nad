<?php
try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=facturation;charset=utf8', 'root', 'user');
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}


$query_societe= $bdd->query('SELECT s.nom_societe
							 FROM societe s, type t
							 WHERE s.id_type = t.id_type
							 AND t.type = "client" ');

$societes = [];

while ($donnees = $query_societe->fetch()){
	$societes[] = array('nom_societe' => $donnees['nom_societe']);
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

  	<label>Voici la liste de toutes les sociétés de type client: </label>
  	<br><br>
 	  <?php
	  	$compteur = 0;
	  	foreach ($societes as $key => $value) {
	  	$compteur++;
	  ?>

  		<p><?= $compteur.") "?><a href="detailsociete.php?id_societe=<?=$key?>"> <?= $value["nom_societe"]?> </a> </p>

  <?php } ?>

	<a href="index.php"> <button type="button">Retour</button> </a>

</body>
</html>





