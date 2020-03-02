<?php
$personne_co = unserialize($_SESSION["personne"]);
 if ($personne_co==null){
   header ("Location:index.php?page=0");
   exit();
}?>
  	<h1>Recherche des citations</h1>

<?php $db = new Mypdo;
      $citation = new CitationManager($db);
      $personne = new PersonneManager($db);
      $vote = new VoteManager($db);


  if (!isset($_GET["option"])) {?>
    <label name="nom" ><a href="index.php?page=13&option=1"> Recherche par nom </a></label>
    <br />
    <br />
    <label name="date"><a href="index.php?page=13&option=2"> Recherche par date </a></label>
    <br />
    <br />
    <label name="note"><a href="index.php?page=13&option=3"> Recherche par note </a></label>
<?php } else {

  if ($_GET["option"] == 1) {?>
    <form name="recherche" id="formulaire" action="#" method="post">
    <input type="search" id="maRecherche" name="search" placeholder="Recherche par nom..." required>
    <br />
    <input type=submit name=Rechercher value="Rechercher">
    </form>

<?php  if(isset($_POST["Rechercher"])) {
          $citations = $citation->getAllCitationRechercheNom($_POST["search"]);
          if ($citations != NULL){
          ?>
          <table>
      			<tr>
      				<th>Nom de l'enseignant</th>
      				<th>Libellé</th>
      				<th>Date</th>
      				<th>Moyenne des notes</th>
      			</tr>

      			<?php foreach ($citations as $citations){ ?>
      			<tr>
      				<td><?php echo $personne->avoirNomPrenom($citations->getPerNum());?></td>
      				<td><?php echo $citations->getCitLibelle();?></td>
      				<td><?php echo getEnglishDate($citations->getCitDate());?></td>
      				<td><?php echo $vote->avoirMoyenneVote($citations->getCitNum());?></td>
      			</tr>
          <?php } ?>
      		</table>
          <?php
      } else {
        echo "Pas de correspondance";
      }
    }
  }


  if ($_GET["option"] == 2) {?>
    <form name="recherche" id="formulaire" action="#" method="post">
    <input type="date" id="maRecherche" name="search" required>
    <br />
    <input type=submit name=Rechercher value="Rechercher">
    </form>
    <?php  if(isset($_POST["Rechercher"])) {
              $citations = $citation->getAllCitationRechercheDate($_POST["search"]);
              if ($citations != NULL){
              ?>
              <table>
          			<tr>
          				<th>Nom de l'enseignant</th>
          				<th>Libellé</th>
          				<th>Date</th>
          				<th>Moyenne des notes</th>
          			</tr>

          			<?php foreach ($citations as $citations){ ?>
          			<tr>
          				<td><?php echo $personne->avoirNomPrenom($citations->getPerNum());?></td>
          				<td><?php echo $citations->getCitLibelle();?></td>
          				<td><?php echo getEnglishDate($citations->getCitDate());?></td>
          				<td><?php echo $vote->avoirMoyenneVote($citations->getCitNum());?></td>
          			</tr>
              <?php } ?>
          		</table>
              <?php
          } else {
            echo "Pas de correspondance";
          }
        }
      }

  if ($_GET["option"] == 3) {?>
    <form name="recherche" id="formulaire" action="#" method="post">
    <input type="number" min=0 max=20 id="maRecherche" name="search" placeholder="Recherche par note..." required>
    <br />
    <input type=submit name=Rechercher value="Rechercher">
    </form>
    <?php  if(isset($_POST["Rechercher"])) {
              $citations = $citation->getAllCitationRechercheNote($_POST["search"]);
              if ($citations != NULL){
              ?>
              <table>
          			<tr>
          				<th>Nom de l'enseignant</th>
          				<th>Libellé</th>
          				<th>Date</th>
          				<th>Moyenne des notes</th>
          			</tr>

          			<?php foreach ($citations as $citations){ ?>
          			<tr>
          				<td><?php echo $personne->avoirNomPrenom($citations->getPerNum());?></td>
          				<td><?php echo $citations->getCitLibelle();?></td>
          				<td><?php echo getEnglishDate($citations->getCitDate());?></td>
          				<td><?php echo $vote->avoirMoyenneVote($citations->getCitNum());?></td>
          			</tr>
              <?php } ?>
          		</table>
              <?php
          } else {
            echo "Pas de correspondance";
          }
        }
      }

} ?>
