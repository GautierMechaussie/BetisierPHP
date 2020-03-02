<?php session_start();?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <?php
		$title = "Bienvenue sur le site du bétisier de l'IUT.";?>
		<title>
		<?php echo $title ?>
		</title>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />

</head>
	<body>
	<div id="header">
		<div id="connect">
      <?PHP
       if(empty($_SESSION["personne"])){?>
         <a href="index.php?page=9">Connexion</a><?php
       } else{
           $personne_connecte = unserialize($_SESSION["personne"]);
           echo "Utilisateur : ".$personne_connecte->getPerLogin();
           ?><a href="index.php?page=10">&nbsp;&nbsp;&nbsp;Deconnexion</a><?php
           }?>
		</div>

		<div id="entete">
			<div id="logo">
        <?PHP
        $droit ="";
        if(!empty($_SESSION["personne"])){
        	 $droit = $personne_connecte->getPerAdmin();
           if ($droit >= 0){?>
             <img src="image/smile.jpg"class="hautImage" alt="smile" />
           <?php }
        } else { ?>
          <img src="image/lebetisier.gif" class="hautImage" alt="betisier" />
        <?php }?>
			</div>
			<div id="titre">
				Le bétisier de l'IUT,<br />Partagez les meilleures perles !!!
			</div>
		</div>
	</div>
