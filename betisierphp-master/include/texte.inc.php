<div id="texte">
<?php
if (!empty($_GET["page"])){
	$page=$_GET["page"];}
	else
	{$page=0;
	}
switch ($page) {
//
// Personnes
//

case 0:
	// inclure ici la page accueil photo
	include_once('pages/accueil.inc.php');
	break;
case 1:
	// inclure ici la page insertion nouvelle personne
	include("pages/personne/ajouterPersonne.inc.php");
    break;

case 2:
	// inclure ici la page liste des personnes
	include_once('pages/personne/listerPersonnes.inc.php');
    break;
case 3:
	// inclure ici la page modification des personnes
	include("pages/personne/modifierPersonne.inc.php");
    break;
case 4:
	// inclure ici la page suppression personnes
	include_once('pages/personne/supprimerPersonne.inc.php');
    break;
//
// Citations
//
case 5:
	// inclure ici la page ajouter citations
    include("pages/citation/ajouterCitation.inc.php");
    break;

case 6:
	// inclure ici la page liste des citations
	include("pages/citation/listerCitation.inc.php");
    break;
//
// Villes
//

case 7:
	// inclure ici la page ajouter ville
	include("pages/ville/ajouterVille.inc.php");
    break;

case 8:
// inclure ici la page lister  ville
	include("pages/ville/listerVilles.inc.php");
    break;

//

//
case 9:
	include("pages/connexion.inc.php");
    break;
case 10:
  include("pages/deconnexion.inc.php");
    break;

case 11:
// inclure ici la page...
	include("pages/ville/modifierVille.inc.php");
    break;

case 12:
// inclure ici la page...
	include("pages/ville/supprimerVille.inc.php");
    break;

case 13:
	include("pages/citation/rechercherCitation.inc.php");
    break;

case 14:
	include("pages/citation/validerCitation.inc.php");
		break;
		
case 15:
	include("pages/citation/supprimerCitation.inc.php");
		break;
default : 	include_once('pages/accueil.inc.php');
}

?>
</div>
