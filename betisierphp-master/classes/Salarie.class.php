<?php
class Salarie
{
  private $pernum;
  private $telpro;
  private $fonnum;
  private $perprenom;
  private $permail;
  private $pertel;
  private $fonlibelle;
  private $saltelprof;

  public function __construct($valeurs = array()){
  	if (!empty($valeurs))
  			 $this->affecte($valeurs);
  }

  public function affecte($donnees){
    foreach ($donnees as $attribut => $valeur) {
      switch ($attribut){
              case 'per_num': $this->setPerNum($valeur); break;
              case 'sal_telprof': $this->setTelPro($valeur); break;
              case 'fon_num' :$this->setFonNum($valeur); break;
              case 'per_prenom' :$this->setPerPrenom($valeur); break;
              case 'per_tel': $this->setPerTel($valeur); break;
              case 'per_mail': $this->setPerMail($valeur); break;
              case 'fon_libelle': $this->setFonLib($valeur); break;
              case 'sltelprof' : $this->setSalTelprof($valeur);break;
      }
    }
  }

  public function getPerNum() {
          return $this->pernum;
      }
  public function setPerNum($pernum){
          $this->pernum = $pernum;
      }

  public function getSalTelprof(){
          return $this->saltelprof;
      }
  public function setSalTelprof($saltelprof){
          $this->saltelprof = $saltelprof;
      }

  public function getFonNum() {
          return $this->fonnum;
      }

  public function setFonNum($fonnum){
          $this->fonnum = $fonnum;
      }

  public function getPerPrenom() {
          return $this->perprenom;
      }
  public function setPerPrenom($perprenom){
          $this->perprenom = $perprenom;
      }

  public function getPerTel() {
          return $this->pertel;
      }
  public function setPerTel($pertel){
          $this->pertel = $pertel;
      }

  public function getPerMail() {
          return $this->permail;
      }
  public function setPerMail($permail){
          $this->permail = $permail;
      }

  public function getTelPro() {
          return $this->telpro;
      }
  public function setTelPro($telpro){
          $this->telpro = $telpro;
      }

  public function getFonLibelle() {
          return $this->fonlibelle;
      }
  public function setFonLibelle($fonlib){
          $this->fonlibelle = $fonlib;
      }
}
?>
