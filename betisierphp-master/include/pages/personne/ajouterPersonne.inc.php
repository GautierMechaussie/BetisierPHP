<?php
$personne_co = unserialize($_SESSION["personne"]);
 if ($personne_co==null){
   header ("Location:index.php?page=0");
   exit();
}?>
<?php
$pdo=new Mypdo();
$personneManager = new PersonneManager($pdo);
$departementManager = new DepartementManager($pdo);
$divisionManager = new DivisionManager($pdo);
$fonctionManager = new FonctionManager($pdo);
$etudiantManager = new EtudiantManager($pdo);
$salarieManager = new SalarieManager($pdo);
$personne = new Personne($_POST);
$departement = new Departement($_POST);
$division = new Division($_POST);
$fonction = new Fonction($_POST);
$etudiant = new Etudiant($_POST);
$salarie = new Salarie($_POST);

if (empty($_POST["per_nom"]) && empty($_POST["div_nom"]) && empty($_POST["fon_lib"])){
?>
<h1>Ajouter une personne</h1>

<form action="index.php?page=1" id="insert" method="post">

	Nom :  <input type="text" name="per_nom" id="per_nom" size="10" required>
	<br /><br />
	Prénom :  <input type="text" name="per_prenom" id="per_prenom" size="10" required>
	<br /><br />
	Numéro de téléphone :  <input type="text" name="per_tel" id="per_tel" size="10" required>
	<br /><br />
	Adresse mail :  <input type="text" name="per_mail" id="per_mail" size="10" required>
	<br /><br />
	Login :  <input type="text" name="per_login" id="per_login" size="10" required>
	<br /><br />
	Mot de passe :  <input type="password" name="per_pwd" id="per_pwd" size="10" required>
	<br /><br />
	Catégorie : <input type="radio" id="choixCategorie1" name="categorie" value="etudiant"> Etudiant
	<input type="radio" id="choixCategorie2" name="categorie" value="personnel" required> Personnel

	<br />
	<br />
	<input type="submit" value="Valider"/>
</form>
<br />
<?php
} else {
			 if (!empty($_POST["per_nom"])){
				$retour=$personneManager->ajouterPersonne($personne);
				$personnes = $personneManager->listePersonnes();
				foreach ($personnes as $personne){
		      $numpers = $personne->getPerNum();
				}
				if ($retour == 0) {
				 echo "Problème au moment de l'insertion";
			  }
				elseif ($_POST["categorie"] == "etudiant") {
					 ?>
					 <h1>Ajouter un étudiant</h1>

					 <form action ="index.php?page=1&nump=<?php echo $nump = $numpers ?>" id="insert" method="post">

						 <b> Année : </b>  <select name="div_nom" id="div_nom">
							 <?php
							   $listeDivision = $divisionManager->listeDivision();
									 foreach ($listeDivision as $division) {
										 ?>
										 <option value=<?php echo $division->getDivNum(); ?> selected="div_nom"><?php echo $division->getDivNom(); ?>
										 </option>
										 <?php
									 }
								 ?>
						 </select>
					   <br/><br/>

						 <b> Département : </b>  <select name="dep_nom" id="dep_nom">
							 <?php
							   $listeDepartement = $departementManager->listeDepartement();
									 foreach ($listeDepartement as $departement) {
										 ?>
										 <option value=<?php echo $departement->getDepNum(); ?> selected="NomDepartement"><?php echo $departement->getDepNom(); ?>
										 </option>
										 <?php
									 }
								 ?>
						 </select>
						 <br />
						 <br />
					 	<input type="submit" value="Valider"/>
					 </form>
					 <br />
					 <?php
			 } elseif ($_POST["categorie"] == "personnel") {
				 ?>
				 <h1>Ajouter un salarié</h1>

				 <form action ="index.php?page=1&nump=<?php echo $nump = $numpers ?>" id="insert" method="post">

					 <b> Téléphone professionnel : </b> <input type="text" name="sal_telprof" id="sal_telprof" size="10" required>
	 				 <br /><br />

					 <b> Fonction : </b>  <select name="fon_lib" id="fon_lib">
						 <?php
						 $listeFonction = $fonctionManager->listeFonction();
							 foreach ($listeFonction as $fonction) {
								 ?>
								 <option value=<?php echo $fonction->getFonNum(); ?> selected="NomFonction"><?php echo $fonction->getFonLib(); ?>
								 </option>
								 <?php
							 }
						 ?>
					 </select>
					 <br />
					 <br />
					<input type="submit" value="Valider"/>
				 </form>
				 <br />
				 <?php
		 	}
		} else {
			if (empty($_POST["per_nom"])){
				if (empty($_POST["div_nom"])){
					?> <h1>Ajouter un salarié</h1> <?php
					$retourSal=$salarieManager->ajouterSalarie($_GET["nump"],$_POST["sal_telprof"],$_POST["fon_lib"]);
				if ($retourSal == 0)
					echo "Problème au moment de l'insertion du salarié";
				else
					echo '<img src="image/valid.png">', "   Le salarié à bien été créé !";
				}
				}else{
					?> <h1>Ajouter un étudiant</h1> <?php
					$retourEtu=$etudiantManager->ajouterEtudiant($_GET["nump"],$_POST["dep_nom"],$_POST["div_nom"]);
			 	if ($retourEtu == 0)
					echo "Problème au moment de l'insertion de l'étudiant";
			 	else
					echo '<img src="image/valid.png">', "   L'étudiant à bien été créé !";
				}
			}
		}


?>
