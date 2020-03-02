
	<h1>Liste des citations déposées</h1>

	<?php $db = new Mypdo;
				$citation = new CitationManager($db);
				$citations = $citation->getAllCitation();
				$personne = new PersonneManager($db);
				$vote = new VoteManager($db);

	if(empty($_GET["citNum"])) { ?>

	 Actuellement 	<?php echo $citation->getNbCitation()?> citations sont enregistrées

	 	<table>
			<tr>
				<th>Nom de l'enseignant</th>
				<th>Libellé</th>
				<th>Date</th>
				<th>Moyenne des notes</th>
				<?php if(isset($_SESSION["connexion"])){
							if($personne->isEtudiant($personne_connecte->getPerNum()) == 1) {
				?>
				<th>Noter</th>
				<?php } }?>
			</tr>

			<?php if ($citations != NULL){
						foreach ($citations as $citations){
			?>
			<tr>
				<td><?php echo $personne->avoirNomPrenom($citations->getPerNum());?></td>
				<td><?php echo $citations->getCitLibelle();?></td>
				<td><?php echo getEnglishDate($citations->getCitDate());?></td>
				<td><?php echo $vote->avoirMoyenneVote($citations->getCitNum());?></td>
				<?php if(isset($_SESSION["connexion"])){
							if($personne->isEtudiant($personne_connecte->getPerNum()) == 1) {
							if($vote->AVoter($citations->getCitNum(),$personne_connecte->getPerNum()) == 	1) {
				?>
				<td> <a><img class="icone" src="image/erreur.png"  alt="Retirer"/></a></td>
				<?php } else { ?>
				<td> <a href=index.php?page=6&citNum=<?php echo $citations->getCitNum();?>><img class="icone" src="image/modifier.png"  alt="Modifier"/></a></td>
				<?php } } }?>
			</tr>
			<?php  } }  ?>
		</table>

	<?php } else if(!isset($_POST["note"])) {
				$citation_note = $citation->getCitation($_GET["citNum"]);
	?>

		<table>
			<tr>
				<th>Nom de l'enseignant</th>
				<th>Libellé</th>
				<th>Date</th>
				<th>Moyenne des notes</th>
			</tr>
				<tr><td><?php echo $personne->avoirNomPrenom($citation_note->getPerNum());?>
				</td><td><?php echo $citation_note->getCitLibelle();?>
				</td><td><?php echo getEnglishDate($citation_note->getCitDate());?>
				</td><td><?php echo $vote->avoirMoyenneVote($_GET["citNum"]);?>
				</td></tr>
		</table>

		<form name="Formulaire" id="formu" action="#" method="post">
		<label id=note> Note : </label><input type="number" min="0" max="20" name="note"  required>
		<br />
		<input type=submit value="Noter">
		</form>

	<?php } else { ?>

		<p><img class="icone" src="image/valid.png"  alt="Valide"/> Vous avez noté la citation</p>
		<p>Redirection ...</p>

		<?php $vote->ajouterVote($_GET["citNum"],$personne_connecte->getPerNum(),$_POST["note"]);
					header ("Refresh: 2;URL=index.php?page=6");
				}
		?>
