<h1>Liste des villes</h1>
<?php
$pdo = new Mypdo();
$villeManager = new VilleManager($pdo);
$nombreVille = $villeManager->nombreVille($pdo);
$villes = $villeManager->listeVille($pdo);

echo "Actuellement ", $nombreVille, " villes sont enregistrées";
?>

<br /> <br />

<table>
  <tr><th>Numéro</th><th>Nom</th></tr>
  <?php
  foreach ($villes as $ville){ ?>
    <tr><td><?php echo $ville->getVilleNum();?>
    </td><td><?php echo $ville->getVilleNom();?>
    </td></tr>
  <?php } ?>
</table>
<br />
