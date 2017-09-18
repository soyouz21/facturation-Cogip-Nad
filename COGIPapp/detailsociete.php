<?php
try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=facturation;charset=utf8', 'root', 'user');
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}

if(isset($_GET["id_societe"])){
	$id_societe = $_GET["id_societe"];
}

$query_societe = $bdd->query('SELECT s.nom_societe, s.adresse_societe, s.tel_societe, s.tva_societe, s.compte_bancaire_societe
							  FROM societe s
							  WHERE s.id_societe ='.$id_societe);

/*
SELECT s.nom_societe, s.adresse_societe, s.tel_societe, s.tva_societe, s.compte_bancaire_societe, f.numero_facture, p.nom_personne
							  FROM societe s, factures f, personnes p
							  WHERE s.id_societe = f.id_societe
							  AND p.id_societe = s.id_societe
							  AND p.id_personne = f.id_personne'
*/

$tableauSociete = [];

$donnees = $query_societe->fetch();

$tableauSociete[] = array('nom_societe' => $donnees['nom_societe'],
						  'adresse_societe' => $donnees['adresse_societe'],
						  'tel_societe' => $donnees['tel_societe'],
						  'tva_societe' => $donnees['tva_societe'],
						  'compte_bancaire_societe' => $donnees['compte_bancaire_societe']
						 );

//liste des factures liées à la société
$query_factures_societe = $bdd->query('SELECT numero_facture 
									   FROM societe s, factures f 
									   WHERE s.id_societe ='.$id_societe.'
									   AND s.id_societe = f.id_societe');

$tableauFacturesSociete = [];
while($res = $query_factures_societe->fetch()){
	$tableauFacturesSociete[] = array('numero_facture' => $res['numero_facture']);
}

//liste des personnes de contact travaillant dans la société
$query_personnes_societe = $bdd->query('SELECT nom_personne
									    FROM societe s, personnes p
									    WHERE s.id_societe ='.$id_societe.'
									    AND s.id_societe = p.id_societe');

$tableauPersonnesSociete = [];
while($res = $query_personnes_societe->fetch()){
	$tableauPersonnesSociete[] = array('nom_personne' => $res['nom_personne']);
}



/*
$tableauSociete[] = array('nom_societe' => $donnees['nom_societe'],
						  'adresse_societe' => $donnees['adresse_societe'],
						  'tel_societe' => $donnees['tel_societe'],
						  'tva_societe' => $donnees['tva_societe'],
						  'compte_bancaire_societe' => $donnees['compte_bancaire_societe'],
						  'numero_facture' => $donnees['numero_facture'],
						  'prenom_personne' => $donnees['prenom_personne'],
						  'nom_personne' => $donnees['nom_personne']); */

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Facturation</title>
</head>
<body>
	<h1>Application RANU</h1>

	<label> Voici les informations concernant la société: </label> <strong><?= $tableauSociete[0]['nom_societe'] ?></strong>

	<div style="border:1px solid black; width:500px; height:400px">
		<p style="text-align:left"> <u>Adresse:</u> <?= $tableauSociete[0]["adresse_societe"] ?> </p>	
		<p style="text-align:left"> <u>Téléphone:</u> <?= $tableauSociete[0]["tel_societe"] ?> </p>
		<p style="text-align:left"> <u>TVA société:</u> <?= $tableauSociete[0]["tva_societe"] ?> </p>
		<p style="text-align:left"> <u>Compte bancaire:</u> <?= $tableauSociete[0]["compte_bancaire_societe"] ?> </p>
		<label>Voici toutes les factures lui appartenant:</u> </label>
		<?php
			if (sizeof($tableauFacturesSociete) ==0 ) {
				echo "<br/> <strong><i>Il n'y a actuellement aucune factures dédiées..</i></strong><br/><br/>";
			}else{
				$compteur=0;
				foreach ($tableauFacturesSociete as $key => $value) {
					$compteur++;
					echo "<p>".$compteur.") ".$value['numero_facture']."</p>";
				}
			}
		?>
		<label>Voici toutes les personnes travaillant dans la société:</u> </label>
		<?php
			if (sizeof($tableauPersonnesSociete) ==0 ) {
				echo "<br/> <strong><i>Il n'y a actuellement aucune personnes travaillant pour cette société..</i></strong>";
			}else{
				$compteur=0;
				foreach ($tableauPersonnesSociete as $key => $value) {
					$compteur++;
					echo "<p>".$compteur.") ".$value['nom_personne']."</p>";
				}
		}
		?>
	</div>




	<a href="index.php"> <button type="button">Retour</button> </a>

</body>
</html>





