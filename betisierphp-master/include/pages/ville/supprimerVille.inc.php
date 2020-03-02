<?php $personne_co = unserialize($_SESSION["personne"]);
 if ($personne_co==null || $droit!=1){
   header ("Location:index.php?page=0");
   exit();
}?>

<h1>Supprimer une ville</h1>
<?php
$pdo = new Mypdo();
$villeManager = new VilleManager($pdo);
$ville = new Ville($_POST);
$villes = $villeManager->listeVille($pdo);

if (empty($_GET["numv"])){
?>


<table>
  <tr><th>Numéro</th><th>Nom</th><th>Supprimer</th></tr>
  <?php
  foreach ($villes as $ville){ ?>
    <tr><td><?php echo $ville->getVilleNum();?>
    </td><td><?php echo $ville->getVilleNom();?>
    </td><td><a href="index.php?page=12&numv=<?php echo $numv=$ville->getVilleNum()?>"><img class="supprVille" src="image/erreur.png" alt="erreur"/></a>
    </td></tr>
  <?php } ?>
</table>
<br />


<?php

} else {
  $nom = $villeManager->getVille($_GET['numv']);
  $presence = $villeManager->presenceDep($nom->vil_num);
  if ($presence == 0){
    $retour = $villeManager->supprimerVille($nom->vil_num);
    if ($retour) {
     echo '<img src="image/valid.png" alt="valid">', "   La ville <b>\"", $nom->vil_nom, "\"</b> a été supprimée";
    } else {
     echo '<img src="image/erreur.png" alt="erreur"',"   Problème lors de la suppression";
    }
  } else {
    echo '<img src="image/erreur.png" alt="erreur">',"   La ville <b>\"", $nom->vil_nom, "\"</b> ne peut pas être suprimée";
  }
}

?>
