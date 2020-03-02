<?php
class Division
{
  private $divnum;
  private $divnom;

  public function __construct($valeurs = array()){
  	if (!empty($valeurs))
  			 $this->affecte($valeurs);
  }

  public function affecte($donnees){
    foreach ($donnees as $attribut => $valeur) {
      switch ($attribut){
        case 'div_num' : $this->setDivNum($valeur);
          break;
        case 'div_nom' : $this->setDivNom($valeur);
          break;
      }
    }
  }

  public function getDivNum () {
    return $this->divnum;
  }

  public function setDivNum ($divnum) {
    $this->divnum = $divnum;
  }

  public function getDivNom () {
    return $this->divnom;
  }

  public function setDivNom ($divnom) {
    $this->divnom = $divnom;
  }
}
?>
