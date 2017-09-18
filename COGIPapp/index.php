<?php
try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=facturation;charset=utf8', 'root', 'user');
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}


$query_client = $bdd->query('SELECT * 
						     FROM personnes 
						     WHERE nom_personne = "Ranu" AND prenom_personne = "Jean-Christian"');

$tableauClient = [];

$donnees = $query_client->fetch();
$tableauClient[] = array('prenom_personne' => $donnees['prenom_personne'],
						 'nom_personne' => $donnees['nom_personne']);


//Get 5 invoices order by DESC date 
$query_invoices= $bdd->query('SELECT numero_facture 
						 	  FROM factures, societe, personnes
						 	  WHERE factures.id_personne = personnes.id_personne
						 	  AND factures.id_societe = societe.id_societe
						 	  ORDER BY date_facture DESC
						 	  LIMIT 5');

$invoices = [];
while ($donnees = $query_invoices->fetch()){
	$invoices[] = array('numero_facture' => $donnees['numero_facture']);
}


//Get les 5 derniéres personnes encodées dans la base de données 
$query_personnes= $bdd->query('SELECT *
						 	   FROM personnes
						 	   ORDER BY id_personne DESC
						 	   LIMIT 5');

$personnes = [];
while ($donnees = $query_personnes->fetch()){
	$personnes[$donnees['id_personne']] = array('nom_personne' => $donnees['nom_personne'],
												'prenom_personne' => $donnees['prenom_personne'],
												);
}

//Get les 5 derniéres entreprises encodées dans la base de données 
$query_societes= $bdd->query('SELECT *
						 	  FROM societe
						 	  ORDER BY id_societe DESC
						 	  LIMIT 5');

$societes = [];
while ($donnees = $query_societes->fetch()){
	$societes[$donnees['id_societe']] = array('nom_societe' => $donnees['nom_societe']);
}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Facturation</title>
</head>
<body>
	<a href="fournisseur.php">Fournisseurs</a>
	<a href="client.php">Clients</a>
	<a href="facture.php">Factures</a>
	<a href="annuaire.php">Annuaire</a>

  	<h1>Application RANU: Accueil</h1>

  <label>Bonjour </label><?= $tableauClient[0]["nom_personne"]." ".$tableauClient[0]["prenom_personne"];?>
  <br><br>
  <label>Voici la liste des 5 dernières factures, classées par date:</label>
	  <?php
	  		if(sizeof($invoices)==0) {
	  			echo "<br/> <strong><i>Il n'y a actuellement aucune factures..</i></strong><br/><br/>";
	  		}else{
		  		$compteur = 0;	
		  		foreach ($invoices as $key => $value) {
		  		$compteur++;
		  ?>
		  		<p><?= $compteur.") "?><a href="detailfacture.php?numero_facture=<?=$value["numero_facture"]?>"> <?= $value["numero_facture"]?> </a> </p>
	  <?php } }?>

  <hr/>
	<label>Voici la liste des 5 dernières personnes, encodées dans la base de données:</label>
	  <?php
	  		if (sizeof($personnes)==0) {
	  			echo "<br/> <strong><i>Il n'y a actuellement aucune personne encodées dans le systéme..</i></strong><br/><br/>";
	  		}else{	
		  		$compteur = 0;
		  		foreach ($personnes as $key => $value) {
		  		$compteur++;
		  ?>
		  		<p><?= $compteur.") "?><a href="detailcontact.php?id_personne=<?=$key?>"> <?= $value["nom_personne"]?> </a> <?= ", ".$value["prenom_personne"]?> </p>
	  <?php } } ?>
	
	<hr/>
	<label>Voici la liste des 5 dernières entreprises, encodées dans la base de données:</label>
	  <?php
	  		if (sizeof($societes)==0) {
	  			echo "<br/> <strong><i>Il n'y a actuellement aucune entreprise encodée dans le systéme..</i></strong><br/><br/>";
	  		}else{	
		  		$compteur = 0;
		  		foreach ($societes as $key => $value) {
		  		$compteur++;
		  ?>
		  		<p><?= $compteur.") "?><a href="detailsociete.php?id_societe=<?=$key?>"> <?= $value["nom_societe"]?> </a> </p>
	  <?php } } ?>


</body>
</html>