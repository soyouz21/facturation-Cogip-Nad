<?php
try{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=facturation;charset=utf8', 'root', 'user');
}catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

if(isset($_GET["id_personne"])){
	$id_personne = $_GET["id_personne"];
}

$query_personnes = $bdd->query('SELECT *
							                 FROM personnes p, societe s
							                 WHERE p.id_societe = s.id_societe 
                               AND id_personne ='.$id_personne);

$personnes = [];

$donnees = $query_personnes->fetch();
$personnes[] = array('nom_personne' => $donnees['nom_personne'],
					           'prenom_personne' => $donnees['prenom_personne'],
                     'tel_personne' => $donnees['tel_personne'],
                     'email_personne' => $donnees['email_personne'],
                     'nom_societe' => $donnees['nom_societe'],
                     'adresse_societe' => $donnees['adresse_societe']);


//liste des factures traitées par la personne
$query_liste_factures = $bdd->query('SELECT numero_facture
                                     FROM personnes p, factures f
                                     WHERE p.id_personne = f.id_personne 
                                     AND p.id_personne ='.$id_personne);
$liste_factures = [];

while($donnees = $query_liste_factures->fetch()){
  $liste_factures[] = array('numero_facture' => $donnees['numero_facture']);
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

  <label>Voici les détails du contact: </label><?php echo "<strong>".$personnes[0]["nom_personne"]." ".$personnes[0]["prenom_personne"]."</strong>";?>
  <br><br>
  <label>Email:</label>	<?= $personnes[0]["email_personne"];?> <br/>
  <label>Numéro de téléphone:</label> <?= $personnes[0]["tel_personne"];?> <br/>
  <label>Travaille pour la société: </label> <?= $personnes[0]["nom_societe"];?> siégeant à <?= $personnes[0]["adresse_societe"];?> <br/>
  <label>Voici la liste des factures qui lui sont liées:</label>
   <?php
      if (sizeof($liste_factures) == 0) {
        echo "<br/> <strong><i>Il n'y a actuellement aucune facture..</i></strong><br/>";
      }else{
        $compteur = 0;
        foreach ($liste_factures as $key => $value) {
        $compteur++;
      ?>
        <p><?= $compteur.") "?> <a href="detailfacture.php?numero_facture=<?=$value["numero_facture"]?>"> <?= $value["numero_facture"]?> </a> </p>
   <?php } } ?>

  <br/>  
  <a href="index.php"> <button type="button">Retour</button> </a>

</body>
</html>


