  <?php
  $personne_co = unserialize($_SESSION["personne"]);
   if ($personne_co==null || ($droit==1 && $droit !=null)){
     header ("Location:index.php?page=0");
     exit();
 }
  $db = new Mypdo;
  $salarie = new SalarieManager($db);
  $personne = new PersonneManager($db);
  $mot = new MotManager($db);
  $citation = new CitationManager($db);

  $salaries = $salarie->getAllPersonnes();
  if(empty($_POST["valide"])){

  ?>

  <h1>Ajouter une citation</h1>

  <form name="FormulaireCitation" id="formulairecit" action="#" method="post">
      <label id=enseignant> Enseignant : </label>
      <select name="enseignant">
        <?php foreach ($salaries as $salaries) {
          $personnes = $personne->getPersonne( $salaries->getPerNum());?>
          <option value=<?php echo $salaries->getPerNum();?>> <?php echo $personnes->getPerNom();?></option>
        <?php  } ?>
      </select>
    <br>
    <label id=date> Date Citation : </label><input type="date" name="date" required>
    <br>
    <label id=citation>Citation : </label> <textarea name="citation"></textarea>
    <br>
      <input name=valide type=submit value="Valider">
  </form>
<?php
} else {

  $citation_corrige = $mot->transformerCitation($_POST["citation"]);
  if (empty($citation_corrige)) {
    ?>
    <h1>Ajouter une citation</h1>

    <p><img class="icone" src="image/valid.png"  alt="Valide"/> La citation a été ajouté</p>
    <?php

    $cit = new Citation(
      array('per_num' => $_POST["enseignant"],
            'per_num_etu' => $personne_connecte->getPerNum(),
            'cit_libelle' => $_POST["citation"],
            'cit_date' => $_POST["date"],
            'cit_date_depo' => date("Y-m-d H:i:s"))
    );

    $citation->ajouterCitation($cit);
    header ("Refresh: 2;URL=index.php?page=5");
  } else if (!empty($citation_corrige)) {

    ?>
    <h1>Ajouter une citation</h1>

    <form name="FormulaireCitation" id="formulairecit" action="#" method="post">
    <label id=enseignant> Enseignant : </label>
    <select name="enseignant">
      <?php foreach ($salaries as $salaries) {
        $personnes = $personne->getPersonne( $salaries->getPerNum());?>
        <option value=<?php echo $salaries->getPerNum();?>> <?php echo $personnes->getPerNom();?></option>
      <?php  } ?>
    </select>
    <br>
    <label id=date> Date Citation : </label><input type="date" name="date" value=<?php echo $_POST["date"] ?> placeholder="Ex : 21/04/2019" required>
    <br>
    <label id=citation>Citation : </label> <textarea name="citation"><?php echo $citation_corrige[0] ?></textarea>
    <br>
    <?php
        for($i = 1; $i < sizeof($citation_corrige); $i++){
          ?>
          <p><img class="icone" src="image/erreur.png"  alt="Erreur"/> Le mot <?php echo $citation_corrige[$i] ?> est interdit</p>
        <?php } ?>
    <input name=valide type=submit value="Valider">
    </form>

<?php } }  ?>
