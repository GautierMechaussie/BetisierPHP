
<h1>Pour vous connecter</h1>
<?php
$pdo=new Mypdo();
$personneManager = new PersonneManager($pdo);
$personne = new Personne($_POST);
if (empty($_POST["envoyerNom"])){
?>
<form  id="insert" action="#" method="post">

  <label>Nom d'utilisateur :</label> <input type="text" name="per_login" id="per_login" size="10" required>
  <br/><br/>
<label>  Mot de passe :</label> <input type="password" name="per_pwd" id="per_pwd" size="10" required>
  <br /><br />

  <?PHP $img1= mt_rand(1,9);  $img2=mt_rand(1,9)?>
    <img class="TestNb" src="image/nb/<?PHP echo $img1?>.jpg"></img>
  <label>  + </label>
    <img class="TestNb"src="image/nb/<?PHP echo $img2?>.jpg"></img>
  <label>  = </label>
<?PHP  $result=$img1+$img2;
  $_SESSION["resultat"]=$result;
?>
  <input type="number" name="Test" id="Test" size="10" required>
  <br /><br />
	<input type="submit" name="envoyerNom" value="Valider"/>
</form>
<br />
<?php

}
if(!empty($_POST["envoyerNom"])){
  if($_POST["Test"]!=$_SESSION["resultat"]){
    echo '<img src="image/erreur.png">', "   Erreur du test !";
    header("Refresh:2; URL=index.php?page=9");
  }
  else{
   $personneLog=$_POST["per_login"];
   $mdp = $_POST["per_pwd"];
   $salt ="48@!alsd";
   $pwd_crypte=sha1(sha1($mdp).$salt);
   $testPersonne = $personneManager->testPersonne($_POST["per_login"]);
   if ($testPersonne == 0){
     echo '<img src="image/erreur.png">', "   Login ou mot de passe invalide !";
     header("Refresh:2; URL=index.php?page=9");
   } else {
     $testPersonneLogin = $personneManager->testPersonneLog($_POST["per_login"]);
     foreach ($testPersonneLogin as $personne) {
       $mdpPersonne = $personne->getPerPwd();
     }
     if ($pwd_crypte == $mdpPersonne){
       $_SESSION["personne"]=serialize($personne);
       echo '<img src="image/valid.png">', "   Vous avez bien été connecté !";
       ?> </br> </br> <?php
       echo "Redirection automatique dans 2 secondes.";
       header("Refresh:2, URL=index.php?page=0");
     } else {
       echo '<img src="image/erreur.png">', "   Login ou mot de passe invalide !";
       header("Refresh:2; URL=index.php?page=9");
     }
   }

/*
   if($pwd_crypte==$personne->getPerPwd()&&$personneLog==$personne->getPerLogin()){
     echo $personne->getPerPwd();
    /* $_SESSION["personne"]=serialize("personne");
      header("Refresh:2, URL=index.php?page=0");*/
    /*}else{
      echo "Login ou mot de passe invalide!";
      echo $pwd_crypte;
      echo $personne->getPerPwd();
      //header("Refresh:2; URL=index.php?page=9");
    }
    */
  }
}


?>
