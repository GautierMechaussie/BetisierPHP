<?php
class Ville
{
  public $vilnum;
  public $vilnom;

  public function __construct($valeurs = array()){
  	if (!empty($valeurs))
  			 $this->affecte($valeurs);
  }

  public function affecte($donnees){
    foreach ($donnees as $attribut => $valeur) {
      switch ($attribut){
        case 'vil_num' : $this->setVilleNum($valeur);
          break;
        case 'vil_nom' : $this->setVilleNom($valeur);
          break;
      }
    }
  }

  public function getVilleNum () {
    return $this->vilnum;
  }

  public function setVilleNum ($vilnum) {
    $this->vilnum = $vilnum;
  }

  public function getVilleNom () {
    return $this->vilnom;
  }

  public function setVilleNom ($vilnom) {
    $this->vilnom = $vilnom;
  }
}
?>
