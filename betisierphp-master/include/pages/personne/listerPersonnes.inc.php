<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$etudiantManager = new EtudiantManager($pdo);
$salarieManager = new SalarieManager($pdo);
$nombrePersonnes = $personneManager->nombrePersonnes($pdo);
$personnes = $personneManager->listePersonnes($pdo);

if (empty($_GET["nump"])){

  ?> <h1>Liste des personnes enregistrées</h1> <?php
  echo "Actuellement ", $nombrePersonnes, " personnes sont enregistrées";
  ?>

  <br /> <br />

  <table>
    <tr><th>Numéro</th><th>Nom</th><th>Prénom</th></tr>
    <?php
    foreach ($personnes as $personne){
      $numpers = $personne->getPerNum(); ?>
      <tr><td><b><a href="index.php?page=2&nump=<?php echo $nump = $numpers?>"><?php echo $numpers;?></a></b>
      </td><td><?php echo $nomp = $personne->getPerNom();?>
      </td><td><?php echo $personne->getPerPrenom();?>
      </td></tr>
    <?php } ?>
  </table>
  <p> Cliquez sur le numéro de la personne pour obtenir plus d'informations</p>
<?php
} else {
  $testEtudiant = $etudiantManager->testEtudiant($_GET["nump"]);
  $nomPersonne = $personneManager->nomPersonne($_GET["nump"]);
  if ($testEtudiant == 1){
    ?> <h1> Détail sur l'étudiant <?php foreach ($nomPersonne as $personne) echo $personne->getPerNom();?> </h1>

    <br />

    <table>
      <tr><th>Prénom</th><th>Mail</th><th>Tel</th><th>Département</th><th>Ville</th></tr>
      <?php
      $detetudiant = $etudiantManager->detailEtudiant($_GET["nump"]);

      foreach ($detetudiant as $etudiant){ ?>
        <tr><td><?php echo $etudiant->getPerPrenom();?>
        </td><td><?php echo $etudiant->getPerMail();?>
        </td><td><?php echo $etudiant->getPerTel();?>
        </td><td><?php echo $etudiant->getDepNom();?>
        </td><td><?php echo $etudiant->getVilNom();?>
        </td></tr>
      <?php } ?>
    </table>

    <?php
  } else {
    ?> <h1> Détail sur le salarié <?php foreach ($nomPersonne as $personne) echo $personne->getPerNom();?> </h1>

    <br />

    <table>
      <tr><th>Prénom</th><th>Mail</th><th>Tel</th><th>Tel Pro</th><th>Fonction</th></tr>
      <?php
      $detsalarie = $salarieManager->detailSalarie($_GET["nump"]);

      foreach ($detsalarie as $salarie){ ?>
        <tr><td><?php echo $salarie->getPerPrenom();?>
        </td><td><?php echo $salarie->getPerMail();?>
        </td><td><?php echo $salarie->getPerTel();?>
        </td><td><?php echo $salarie->getTelPro();?>
        </td><td><?php echo $salarie->getFonLib();?>
        </td></tr>
      <?php } ?>
    </table>
    <?php
  }
}
?>
