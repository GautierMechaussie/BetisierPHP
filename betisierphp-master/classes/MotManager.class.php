<?php

class MotManager {
	private $dbo;

		public function __construct($db){
			$this->db = $db;
		}

		public function getAllMot(){
            $listeMot = array();

            $sql = 'select * FROM mot';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($mot = $requete->fetch(PDO::FETCH_OBJ))
                $listeMot[] = new Mot($mot);

            $requete->closeCursor();
            return $listeMot;
		}

		public function transformerCitation($citation){
			$citation_corrige = array();
			$ptr = 0;
			$citation_corrige[$ptr] = '';
			$ptr++;
			
			$membre = explode(' ',$citation);

				for($j = 0; $j < sizeof($membre); $j++){
					$sql = 	"select mot_interdit from mot where match(mot_interdit) against ('$membre[$j]')" ;

					$requete = $this->db->prepare($sql);
					$requete->execute();

					$mot = $requete->fetch(PDO::FETCH_OBJ);
					$requete->closeCursor();

					if(!empty($mot)){
						$citation_corrige[$ptr] = $membre[$j];
						$ptr++;
						$membre[$j] = "---";
					}
				}

			$citation_corrige[0] = $membre[0];

			for($g = 1; $g < sizeof($membre); $g++){
					$citation_corrige[0] = $citation_corrige[0].' '.$membre[$g];
			}

			if($citation ==  $citation_corrige[0]){
				return false;
			}
			else {
				return $citation_corrige;
			}
		}

}
?>
