<?php $personne_co = unserialize($_SESSION["personne"]);
 if ($personne_co==null || $droit!=1){
   header ("Location:index.php?page=0");
   exit();
}?>

  <h1>Valider des citations déposées</h1>

  <?php $db = new Mypdo;
				$citation = new CitationManager($db);
				$citations = $citation->getAllCitationNonValide();
				$personne = new PersonneManager($db);

if(empty($_GET["citNum"])) {
	?>
	 Actuellement 	<?php echo $citation->getNbCitationNonValide()?> citations sont enregistrées

	 	<table>
			<tr>
				<th>Nom de l'enseignant</th>
				<th>Libellé</th>
				<th>Date</th>
				<th>Valider</th>
        <th>Refuser</th>
			</tr>
			<?php
			if ($citations != NULL){
				foreach ($citations as $citations){ ?>
				<tr><td><?php echo $personne->avoirNomPrenom($citations->getPerNum());?>
				</td><td><?php echo $citations->getCitLibelle();?>
				</td><td><?php echo getEnglishDate($citations->getCitDate());?>
				</td><td> <a href="index.php?page=14&citNum=<?php echo $citations->getCitNum();?>&choix=1"><img class="icone" src="image/valid.png"  alt="Valider"/></a>
        </td><td> <a href="index.php?page=14&citNum=<?php echo $citations->getCitNum();?>&choix=0"><img class="icone" src="image/erreur.png"  alt="Retirer"/></a>
				</td></tr>
			<?php }
				}  ?>
	</table>

<?php } else {
  if($_GET["choix"] == 1){
    ?>

    <p><img class="icone" src="image/valid.png"  alt="Valider"/> La citation a été validé</p>
    <p>Redirection ...</p>

    <?php
    $citation->validerCitation($_GET["citNum"],$personne_connecte->getPerNum());
    header ("Refresh: 2;URL=index.php?page=8");

  } else {
    ?>

    <p><img class="icone" src="image/erreur.png"  alt="Supprimer"/> La citation a été refusé</p>
    <p>Redirection ...</p>

    <?php
    $citation->supprimerCitationAvecCitNum($_GET["citNum"]);
    header ("Refresh: 2;URL=index.php?page=8");
  }
}?>
