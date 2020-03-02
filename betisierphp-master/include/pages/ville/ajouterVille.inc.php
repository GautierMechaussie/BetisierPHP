<?php $personne_co = unserialize($_SESSION["personne"]);
 if ($personne_co==null){
   header ("Location:index.php?page=0");
   exit();
}?>
<h1>Ajouter une ville</h1>
<?php
$pdo=new Mypdo();
$villeManager = new VilleManager($pdo);
$ville = new Ville($_POST);

if (empty($_POST["vil_nom"])){
?>
<form action="index.php?page=7" id="insert" method="post">

	Nom :  <input type="text" name="vil_nom" id="vil_nom" size="10">
	<br /><br />
	<input type="submit" value="Valider"/>
</form>
<br />
<?php
} else{
	$existe=$villeManager->getVilleParNom($_POST['vil_nom']);

	if (!$existe){
		$retour=$villeManager->ajouterVille($ville);
		if ($retour !=0) {
		 echo '<img src="image/valid.png">', "   La ville <b>\"", $_POST["vil_nom"], "\"</b> a été ajoutée";
	  } else {
		 echo '<img src="image/erreur.png">', "   Problème au moment de l'insertion";
		}
	} else {
		echo '<img src="image/erreur.png">', "   La ville <b>\"", $_POST["vil_nom"], "\"</b> existe déjà";
	}
}
?>
