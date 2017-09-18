<?php
try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=facturation;charset=utf8', 'root', 'user');
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}


//Display all invoices 
$query_invoices= $bdd->query('SELECT numero_facture 
							  FROM factures
							  ORDER BY date_facture DESC');

$invoices = [];

while ($donnees = $query_invoices->fetch()){
	$invoices[] = array('numero_facture' => $donnees['numero_facture']);
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
  	<label>Voici la liste des numéros de toutes les factures par date la plus récente vers la date la plus lointaine:</label>
  <?php
  		$compteur = 0;	
  		foreach ($invoices as $key => $value) {
  		$compteur++;
  ?>
  		<p><?= $compteur.") "?> <a href="detailfacture.php?numero_facture=<?=$value["numero_facture"]?>"> <?= $value["numero_facture"]?> </a> </p>

  		
  <?php } ?>

  <a href="index.php"> <button type="button">Retour</button> </a>
      
</body>
</html>