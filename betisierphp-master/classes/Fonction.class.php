<?php
class Fonction
{
  private $fonnum;
  private $fonlibelle;

  public function __construct($valeurs = array()){
  	if (!empty($valeurs))
  			 $this->affecte($valeurs);
  }

  public function affecte($donnees){
    foreach ($donnees as $attribut => $valeur) {
      switch ($attribut){
        case 'fon_num' : $this->setFonNum($valeur);
          break;
        case 'fon_libelle' : $this->setFonLib($valeur);
          break;
      }
    }
  }

  public function getFonNum () {
    return $this->fonnum;
  }

  public function setFonNum ($fonnum) {
    $this->fonnum = $fonnum;
  }

  public function getFonLibelle () {
    return $this->fonlibelle;
  }

  public function setFonLib ($fonlibelle) {
    $this->fonlibelle = $fonlibelle;
  }
}
?>
