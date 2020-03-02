<?php $personne_co = unserialize($_SESSION["personne"]);
 if ($personne_co==null || $droit!=1){
   header ("Location:index.php?page=0");
   exit();
}?>
	<h1>Supprimer des personnes enregistrées</h1>

	<?php $db = new Mypdo;
				$personne = new PersonneManager($db);
				$vote = new VoteManager($db);
				$citation = new CitationManager($db);
				$etudiant = new EtudiantManager($db);
				$salarie = new SalarieManager($db);

				$personnes = $personne->getAllPersonne();

if(empty($_GET["numPer"])){
	?>

	 Actuellement 	<?php echo $personne->getNbPersonne()?> personnes sont enregistrées

		<table>
			<tr>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Supprimer</th>
			</tr>
			<?php
			foreach ($personnes as $personnes){ ?>
			<tr><td><?php echo $personnes->getPerNom();?>
			</td><td><?php echo $personnes->getPerPrenom();?>
			</td><td> <a href="index.php?page=4&numPer=<?php echo $personnes->getPerNum();?>"><img class="icone" src="image/erreur.png"  alt="Supprimer"/></a>
			</td></tr>
		<?php } ?>
	</table>

<?php } else {
?>
<p><img class="icone" src="image/valid.png"  alt="Valide"/> La personne <?php echo $personne->avoirNomPrenom($_GET["numPer"]) ?> a été supprimé</p>
<?php
if($personne->isEtudiant($_GET["numPer"]) == 1){


	$vote->supprimerVoteAvecPerNum($_GET["numPer"]);
	$citation->supprimerCitationAvecPerNumEtu($_GET["numPer"]);
	$citation->modifierCitationAvecPerNumValide($_GET["numPer"]);
	$etudiant->supprimerEtudiant($_GET["numPer"]);
	$personne->supprimerPersonne($_GET["numPer"]);
	header ("Refresh: 2;URL=index.php?page=4");
} else {

	$citations = $citation->getAllCitationFromOnePersonne($_GET["numPer"]);
	if(!$citations == NULL){
		foreach ($citations as  $citations){
			$vote->supprimerVoteAvecCitNum($citations->getCitNum());
		}
	}
	$citation->supprimerCitationAvecPerNum($_GET["numPer"]);
	$citation->supprimerCitationAvecPerNumEtu($_GET["numPer"]);
	$citation->modifierCitationAvecPerNumValide($_GET["numPer"]);
	$salarie->supprimerSalarie($_GET["numPer"]);
	$personne->supprimerPersonne($_GET["numPer"]);
	header ("Refresh: 2;URL=index.php?page=4");
}

}?>
