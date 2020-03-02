<?php $personne_co = unserialize($_SESSION["personne"]);
 if ($personne_co==null || $droit!=1){
   header ("Location:index.php?page=0");
   exit();
}?>
<h1>Modifier une ville</h1>
<?php
$pdo = new Mypdo();
$villeManager = new VilleManager($pdo);
$ville = new Ville($_POST);
$villes = $villeManager->listeVille($pdo);

if (empty($_GET["numv"])){
?>

<table>
  <tr><th>Numéro</th><th>Nom</th><th>Modifier</th></tr>
  <?php
  foreach ($villes as $ville){ ?>
    <tr><td><?php echo $ville->getVilleNum();?>
    </td><td><?php echo $ville->getVilleNom();?>
    </td><td><a href="index.php?page=11&numv=<?php echo $numv=$ville->getVilleNum()?>"><img class="modifVille" src="image/modifier.png" alt="modifier"/></a>
    </td></tr>
  <?php } ?>
</table>


<?php
} else {
  if (empty($_POST["vil_nom"])){
		$nom =$villeManager->getVille($_GET['numv']);
  ?>
  <form action="index.php?page=11&numv=<?php echo $_GET['numv']?>" id="insert" method="post">

  	Nom :  <input type="text" name="vil_nom" id="vil_nom" size="10" value='<?php echo $nom->vil_nom?>'>
  	<br /><br />
  	<input type="submit" value="Modifier"/>
  </form>
  <br />
  <?php
  }
  else{
  $retour=$villeManager->modifierVille($_GET['numv'], $_POST['vil_nom']);

  if ($retour)
   echo '<img src="image/valid.png" alt="valid">', "   La nom de la ville est désormais <b>\"", $_POST["vil_nom"], "\"</b>";
   else
   echo '<img src="image/erreur.png" alt="erreur">', "   Problème au moment de la modification";
 }
}

?>
