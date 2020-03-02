<?php
class Departement
{
  private $depnum;
  private $depnom;
  private $vilnom;

  public function __construct($valeurs = array()){
  	if (!empty($valeurs))
  			 $this->affecte($valeurs);
  }

  public function affecte($donnees){
    foreach ($donnees as $attribut => $valeur) {
      switch ($attribut){
        case 'dep_num' : $this->setDepNum($valeur);
          break;
        case 'dep_nom' : $this->setDepNom($valeur);
          break;
        case 'vil_nom' : $this->setVilleNom($valeur);
          break;
      }
    }
  }

  public function getDepNum () {
    return $this->depnum;
  }

  public function setDepNum ($depnum) {
    $this->depnum = $depnum;
  }

  public function getDepNom () {
    return $this->depnom;
  }

  public function setDepNom ($depnom) {
    $this->depnom = $depnom;
  }

  public function getVilleNom () {
    return $this->vilnom;
  }

  public function setVilleNom ($vilnom) {
    $this->vilnom = $vilnom;
  }
}
?>
