
<?php
class Citation {
	private $cit_num;
	private $per_num;
  private $per_num_valide;
  private $per_num_etu;
	private $cit_libelle;
	private $cit_date;
	private $cit_valide;
	private $cit_date_valide;
	private $cit_date_depo;


    public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
           $this->affecte($valeurs);
    }

	 public function affecte($donnees){
        foreach ($donnees as $attribut => $valeur){
            switch ($attribut){
                case 'cit_num': $this->setCitNum($valeur); break;
                case 'per_num': $this->setPerNum($valeur); break;
                case 'per_num_valide': $this->setPerNumValide($valeur); break;
                case 'per_num_etu': $this->setPerNumEtu($valeur); break;
								case 'cit_libelle': $this->setCitLibelle($valeur); break;
                case 'cit_date': $this->setCitDate($valeur); break;
                case 'cit_valide': $this->setCitValide($valeur); break;
                case 'cit_date_valide': $this->setCitDateValide($valeur); break;
								case 'cit_date_depo': $this->setCitDateDepo($valeur); break;
            }
        }
    }

		public function getCitDateDepo(){
			return $this->cit_date_depo;
		}

		public function setCitDateDepo($dateDepo){
			$this->cit_date_depo = $dateDepo;
		}

		public function getCitDateValide(){
			return $this->cit_date_valide;
		}

		public function setCitDateValide($dateValide){
			$this->cit_date_valide = $dateValide;
		}

		public function getCitValide(){
			return $this->cit_valide;
		}

		public function setCitValide($valide){
			$this->cit_valide = $valide;
		}

		public function getCitDate(){
			return $this->cit_date;
		}

		public function setCitDate($date){
			$this->cit_date = $date;
		}

		public function getCitLibelle(){
			return $this->cit_libelle;
		}

		public function setCitLibelle($libelle){
			$this->cit_libelle = $libelle;
		}

	public function getCitNum(){
		return $this->cit_num;
	}

	public function setCitNum($num){
		$this->cit_num = $num;
	}

  public function getPerNum(){
    return $this->per_num;
  }

  public function setPerNum($perNum){
    $this->per_num = $perNum;
  }

	public function getPerNumValide(){
    return $this->per_num;
  }

  public function setPerNumValide($perNumValide){
    $this->per_num_valide = $perNumValide;
  }

	public function getPerNumEtu(){
    return $this->per_num_etu;
  }

  public function setPerNumEtu($perNumEtu){
    $this->per_num_etu = $perNumEtu;
  }

}
?>
