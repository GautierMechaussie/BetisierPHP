<?php $personne_co = unserialize($_SESSION["personne"]);
 if ($personne_co==null || $droit!=1){
   header ("Location:index.php?page=0");
   exit();
}?>
  <h1>Supprimer des citations</h1>


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
  				<th>Supprimer</th>
  			</tr>

  			<?php if ($citations != NULL){
  						foreach ($citations as $citations){
  			?>
  			<tr>
  				<td><?php echo $personne->avoirNomPrenom($citations->getPerNum());?></td>
  				<td><?php echo $citations->getCitLibelle();?></td>
  				<td><?php echo getEnglishDate($citations->getCitDate());?></td>
  				<td><?php echo $vote->avoirMoyenneVote($citations->getCitNum());?></td>
  				<td> <a href="index.php?page=15&citNum=<?php echo $citations->getCitNum();?>"><img class="icone" src="image/erreur.png"  alt="Retirer"/></a></td>
  			</tr>
  			<?php  } }  ?>
  		</table>

  	<?php } else {

    $vote->supprimerVoteAvecCitNum($_GET["citNum"]);
    $citation->supprimerCitationAvecCitNum($_GET["citNum"]);
    header ("Refresh: 2;URL=index.php?page=15");
    ?>

    <p><img class="icone" src="image/valid.png"  alt="Valide"/> La citation a été supprimé</p>
    <p>Redirection ...</p>

    <?php  } ?>
