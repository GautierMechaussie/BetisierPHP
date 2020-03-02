
<?php
class Vote {
	private $cit_num;
	private $vot_valeur;
	private $per_num;


    public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
           $this->affecte($valeurs);
    }

	 public function affecte($donnees){
        foreach ($donnees as $attribut => $valeur){
            switch ($attribut){
								case 'cit_num': $this->setCitNum($valeur); break;
								case 'vot_valeur': $this->setVotValeur($valeur); break;
                case 'per_num': $this->setPerNum($valeur); break;
            }
        }
    }

    public function getCitNum()
    {
        return $this->cit_num;
    }

    public function setCitNum($cit_num)
    {
        $this->cit_num = $cit_num;

        return $this;
    }

    public function getVotValeur()
    {
        return $this->vot_valeur;
    }

    public function setVotValeur($vot_valeur)
    {
        $this->vot_valeur = $vot_valeur;

        return $this;
    }

    public function getPerNum()
    {
        return $this->per_num;
    }

    public function setPerNum($per_num)
    {
        $this->per_num = $per_num;

        return $this;
    }

}
?>
