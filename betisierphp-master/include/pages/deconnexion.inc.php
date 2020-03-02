<h1>Déconnexion</h1>

<?php $_SESSION["personne"] = NULL;
echo '<img src="image/valid.png">', "   Vous avez bien été déconnecté.";
?> </br> </br> <?php
echo "Redirection automatique dans 2 secondes.";
header("Refresh:2, URL=index.php?page=0");
?>
