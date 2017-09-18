<?php
try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=facturation;charset=utf8', 'root', 'user');
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

if(isset($_GET['numero_facture'])){
	$numero_facture = $_GET['numero_facture'];
}

//Details of the invoice selected 
$query_invoices= $bdd->query('SELECT f.numero_facture, f.date_facture, f.date_echeance_facture, p.nom_personne, p.prenom_personne, s.nom_societe, t.type  
							  FROM factures f, societe s, personnes p, type t 
							  WHERE f.id_personne = p.id_personne 
							  AND f.id_societe = s.id_societe 
							  AND t.id_type =s.id_type
							  AND numero_facture = '. $bdd->quote($numero_facture) );
$invoices = [];

while ($donnees = $query_invoices->fetch()){
	$invoices[] = array('numero_facture' => $donnees['numero_facture'],
						'date_facture' => $donnees['date_facture'],
						'date_echeance_facture' => $donnees['date_echeance_facture'],
						'nom_personne' => $donnees['nom_personne'],
						'prenom_personne' => $donnees['prenom_personne'],
						'nom_societe' => $donnees['nom_societe'],
						'type' => $donnees['type']
						);
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

	<label>Détails de la facture numéro </label><strong><?= $numero_facture;?></strong>
	<div style="border:1px solid black; width:500px; height:300px">
		<p style="text-align:left"> Société <strong> <?= $invoices[0]["nom_societe"] ?> </strong> - Type <strong> <?= $invoices[0]["type"] ?> </strong> </p>
  		<p style="text-align:center"> <?= $invoices[0]["nom_personne"].", ".$invoices[0]["prenom_personne"] ?> </p>
		<br/><br/>

		<?php
            $date = $invoices[0]["date_facture"];
            $date = explode("-", $date);
            $annee = $date[0];
            $mois = $date[1];
            $jour = $date[2];

            $date = $jour."/".$mois."/".$annee;

            $dateEcheance = $invoices[0]["date_echeance_facture"];
            $dateEcheance = explode("-", $dateEcheance);
            $anneeEcheance = $dateEcheance[0];
            $moisEcheance = $dateEcheance[1];
            $jourEcheance = $dateEcheance[2];

            $dateEcheance = $jourEcheance."/".$moisEcheance."/".$anneeEcheance;

        ?>

		<p> <?= "Date démission: ".$date ?> </p>
		<p> <?= "Date d'échéance: ".$dateEcheance ?> </p>

  	</div>

	<a href="index.php"> <button type="button">Retour</button> </a>
  
</body>
</html>



