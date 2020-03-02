<?php $personne_co = unserialize($_SESSION["personne"]);
 if ($personne_co==null || $droit!=1){
   header ("Location:index.php?page=0");
   exit();
}

$db = new Mypdo;
$personne = new PersonneManager($db);
$etudiant = new EtudiantManager($db);
$salarie = new SalarieManager($db);
$fonction = new FonctionManager($db);
$division = new DivisionManager($db);
$departement = new DepartementManager($db);
$citation = new CitationManager($db);
$vote = new VoteManager($db);


 if(empty($_GET["numPer"]) && empty($_POST["OK"]) && empty($_POST["OK2"])){

 ?>
	<h1>Modifier une personne enregistrées</h1>

	<?php
	$personnes = $personne->getAllPersonne();
	?>

	 Actuellement 	<?php echo $personne->getNbPersonne()?> personnes sont enregistrées

		<table>
			<tr>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Modifier</th>
			</tr>
			<?php
			foreach ($personnes as $personnes){ ?>
			<tr><td><?php echo $personnes->getPerNom();?>
			</td><td><?php echo $personnes->getPerPrenom();?>
			</td><td> <a href="index.php?page=3&numPer=<?php echo $personnes->getPerNum();?>"><img class="icone" src="image/modifier.png"  alt="Modifier"/></a>
			</td></tr>
		<?php } ?>
	</table>

<?php
} else if(empty($_POST["OK"]) && empty($_POST["OK2"])){
	?>
	<h1>Modifier une personne</h1>
	<?php
				$personnes = $personne->getPersonne($_GET["numPer"]);
				$Etudiant = $personne->isEtudiant($_GET["numPer"]);
	?>

	<form name="FormulairePersonne" id="formulairePer" action="#" method="post">
			<label  for=nom> Nom : </label><input type="text" size=30 maxlength=50 name="nom" value=<?php echo $personnes->getPerNom() ?> required>
		</br>
			<label for=prenom> Prenom : </label><input type="text" size=30 maxlength=50 name="prenom" value=<?php echo $personnes->getPerPrenom() ?> required>
		</br>
			<label for=tel> Telephone : </label><input type="text" size=30 maxlength=50 name="tel" value=<?php echo $personnes->getPerTel() ?> required>
		</br>
			<label for=mail> Mail : </label><input type="text" size=30 maxlength=50 name="mail" value=<?php echo $personnes->getPerMail() ?> required>
		</br>
			<label for=log> Login : </label><input type="text" size=30 maxlength=50 name="log" value=<?php echo $personnes->getPerLogin() ?> required>
		</br>
			<label for=pwd> Mot de passe : </label><input type="password" size=30 maxlength=50 name="pwd" value=<?php echo $personnes->getPerPwd() ?> required>
		</br>
		<?php if ($Etudiant==1){
			?>
			<label for=categorie> Catégorie : </label> <input type="radio" value="etudiant" name="categorie" checked/>  Etudiant   <input type="radio" value="personnel" name="categorie"  /> Personnel
			<?php
		} else {
			?>
			<label for=categorie> Catégorie : </label> <input type="radio" value="etudiant" name="categorie" />  Etudiant   <input type="radio" value="personnel" name="categorie" checked/> Personnel
		<?php	} ?>
		</br>
		<input name="OK" type=submit value="Valider">
	</form>
<?php
} else if(empty($_POST["OK2"])){

    $_SESSION["personneModifier"] = serialize(new Personne(
    array('per_num' => $_GET["numPer"],
          'per_nom' =>  $_POST["nom"],
          'per_prenom' => $_POST["prenom"],
          'per_tel' => $_POST["tel"],
          'per_mail' => $_POST["mail"],
          'per_login' => $_POST["log"],
          'per_pwd' => $_POST["pwd"])
    ));

		$_SESSION["categorie"] = $_POST["categorie"];

		if($_SESSION["categorie"] == 'etudiant'){ ?>
			<h1>Modifier un étudiant</h1> <?php

				$departements = $departement->getAllDepartement();

				$divisions = $division->getAllDivision();
				?>
				<form name="Formulaire" id="formulaire" action="#" method="post">
						<label for=annee> Année : </label>
						<select name="spe1">
							<?php foreach ($divisions as $divisions) { ?>
									<option value=<?php echo $divisions->getDivNum();?>> <?php echo $divisions->getDivNom();?></option>
						<?php  } ?>
					</select>
						</br>
						<label for=dep> Département : </label>
							<select name="spe2">
								<?php foreach ($departements as $departements) { ?>
										<option value=<?php echo $departements->getDepNum();?>> <?php echo $departements->getDepNom();?></option>

							<?php  } ?>
						</select>
						</br>
						<input name="OK2" type=submit value="Valider">
				</form>

				<?php
		} else {
			?>
			<h1>Modifier un salarié</h1>
			<?php
			$fonctions = $fonction->getAllFonction();
			$salaries = $salarie->getSalarie($_GET["numPer"]);
			?>
			<form name="Formulaire" id="formulaire" action="#" method="post">
					<label for=telpro> Telephone professionnel : </label>
          <?php if ($personne->isEtudiant($_GET["numPer"]) != 1) {  ?>
					<input type="text" size=30 maxlength=50 name="spe1" value=<?php echo $salaries->getSalTelprof() ?> required>
        <?php } else {
          ?><input type="text" size=30 maxlength=50 name="spe1" required><?php
        } ?>

					</br>
					<label for=fonct> Fonction : </label>
					<select name="spe2">
						<?php foreach ($fonctions as $fonctions) { ?>
								<option value=<?php echo $fonctions->getFonNum();?>> <?php echo $fonctions->getFonLibelle();?></option>
					<?php  } ?>
				</select>
					</br>
					<input name="OK2" type=submit value="Valider">
			</form>

			<?php
		}
	} else {
      $per = unserialize($_SESSION["personneModifier"]);
      $personne->modifierPersonne($per);

			if($_SESSION["categorie"] == 'etudiant'){
				?>
				<h1>Modifier un étudiant</h1>
				<p><img class="icone" src="image/valid.png"  alt="Valide"/> L'étudiant <?php echo $per->getPerNom(); echo " "; echo $per->getPerPrenom(); ?> a été modifié</p>
				<?php

        $etu = new Etudiant(
          array('per_num' => $_GET["numPer"],
                'dep_num' => $_POST["spe2"],
                'div_num' => $_POST["spe1"])
          );

        if($personne->isEtudiant($_GET["numPer"]) == 1){
          	$etudiant->modifierEtudiant($etu);
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
            $etudiant->ajouterEtudiant($etu);
        }
        header ("Refresh: 2;URL=index.php?page=3");
			}else{
				?>
				<h1>Modifier un salarie</h1>
				<p><img class="icone" src="image/valid.png"  alt="Valide"/> Le salarié <?php echo $per->getPerNom(); echo " "; echo $per->getPerPrenom(); ?> a été modifié</p>
				<?php

        $sal = new Salarie(
          array('per_num' => $_GET["numPer"],
                'fon_num' => $_POST["spe2"],
                'sal_telprof' => $_POST["spe1"])
          );

        if($personne->isEtudiant($_GET["numPer"]) != 1){
				      $salarie->modifierSalarie($sal);
        } else {

            $vote->supprimerVoteAvecPerNum($_GET["numPer"]);
          	$citation->supprimerCitationAvecPerNumEtu($_GET["numPer"]);
          	$citation->modifierCitationAvecPerNumValide($_GET["numPer"]);
            $etudiant->supprimerEtudiant($_GET["numPer"]);
            $salarie->ajouterSalarie($sal);
        }
        header ("Refresh: 2;URL=index.php?page=3");
		}

      unset($_SESSION["personneModifier"]);
        unset($_SESSION["categorie"]);

	}


?>
