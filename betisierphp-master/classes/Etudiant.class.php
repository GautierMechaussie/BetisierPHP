<?php
class Etudiant
{
  private $pernum;
  private $depnum;
  private $divnum;
  private $votecitnum;
  private $votepernum;
  private $perprenom;
  private $permail;
  private $pertel;
  private $depnom;
  private $vilnom;



  public function __construct($valeurs = array()){
  	if (!empty($valeurs))
  			 $this->affecte($valeurs);
  }

  public function affecte($donnees){
    foreach ($donnees as $attribut => $valeur) {
      switch ($attribut){
              case 'per_num': $this->setPerNum($valeur); break;
              case 'dep_num': $this->setDepNum($valeur); break;
              case 'div_num' :$this->setDivNum($valeur); break;
              case 'vote_cit_num': $this->setVoteCitNum($valeur); break;
              case 'vote_per_num': $this->setVotePerNum($valeur); break;
              case 'per_prenom': $this->setPerPrenom($valeur); break;
              case 'per_mail': $this->setPerMail($valeur); break;
              case 'per_tel': $this->setPerTel($valeur); break;
              case 'dep_nom': $this->setDepNom($valeur); break;
              case 'vil_nom': $this->setVilNom($valeur); break;

      }
    }
  }

  public function getPerNum() {
          return $this->pernum;
      }
  public function setPerNum($pernum){
          $this->pernum = $pernum;
      }

  public function getDepNum(){
          return $this->depnum;
      }
  public function setDepNum($depnum){
          $this->depnum = $depnum;
      }

  public function getDivNum() {
          return $this->divnum;
      }
  public function setDivNum($divnum){
          $this->divnum = $divnum;
      }

  public function getVoteCitNum() {
          return $this->votecitnum;
      }
  public function setVoteCitNum($votecitnum){
          $this->votecitnum = $votecitnum;
      }

  public function getVotePerNum() {
          return $this->votepernum;
      }
  public function setVotePerNum($votepernum){
          $this->votepernum = $votepernum;
      }

  public function getDepNom() {
          return $this->depnom;
      }
  public function setDepNom($depnom){
          $this->depnom = $depnom;
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

  public function getVilNom() {
          return $this->vilnom;
      }
  public function setVilNom($vilnom){
          $this->vilnom = $vilnom;
      }
}
?>
