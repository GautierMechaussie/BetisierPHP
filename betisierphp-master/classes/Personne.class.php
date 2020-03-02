<?php
class Personne {
// Attributs
private $pernum;
private $pernom;
private $perprenom;
private $pertel;
private $permail;
private $peradmin;
private $perlogin;
private $perpwd;


public function __construct($valeurs = array()){
    if (!empty($valeurs))
            $this->affecte($valeurs);
}

public function affecte($donnees){
            foreach ($donnees as $attribut => $valeur){
                    switch ($attribut){
                            case 'per_num': $this->setPerNum($valeur); break;
                            case 'per_nom': $this->setPerNom($valeur); break;
                            case 'per_prenom' :$this->setPerPrenom($valeur); break;
                            case 'per_tel': $this->setPerTel($valeur); break;
                            case 'per_mail': $this->setPerMail($valeur); break;
                            case 'per_admin': $this->setPerAdmin($valeur); break;
                            case 'per_login': $this->setPerLogin($valeur); break;
                            case 'per_pwd': $this->setPerPwd($valeur); break;
                    }
            }
    }


public function getPerNum() {
        return $this->pernum;
    }
public function setPerNum($pernum){
        $this->pernum = $pernum;
    }

public function connexion($nom_utilisateur){


}



public function getPerNom(){
        return $this->pernom;
    }
public function setPerNom($pernom){
        $this->pernom = $pernom;
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




public function getPerAdmin() {
        return $this->peradmin;
    }
public function setPerAdmin($peradmin){
        $this->peradmin = $peradmin;
    }




public function getPerLogin() {
        return $this->perlogin;
    }
public function setPerLogin($perlogin){
        $this->perlogin = $perlogin;
    }




public function getPerPwd() {
        return $this->perpwd;
    }
public function setPerPwd($perpwd){
        $this->perpwd = $perpwd;
    }

}
