<?php

class VoteManager {
	private $dbo;

		public function __construct($db){
			$this->db = $db;
		}

		public function getAllVote(){
            $listeVote = array();

            $sql = 'select * from vote';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($vote = $requete->fetch(PDO::FETCH_OBJ))
                $listeVote[] = new Vote($vote);

            $requete->closeCursor();
            return $listeVote;
		}

		public function avoirMoyenneVote($cit_num){
			$sql = "select AVG(vot_valeur) as moyenne FROM vote
			where cit_num = $cit_num group by cit_num";

			$requete = $this->db->prepare($sql);
			$requete->execute();

			$moyVote = $requete->fetch(PDO::FETCH_OBJ);

			if(empty($moyVote)){
				return "--";
			}

			return $moyVote->moyenne;
		}

		public function AVoter($cit, $etu){
			$sql = "select vot_valeur from vote where per_num = $etu and cit_num = $cit";

			$requete = $this->db->prepare($sql);
			$requete->execute();

			$vote = $requete->fetch(PDO::FETCH_OBJ);

			if(!isset($vote->vot_valeur)){
				return -1;
			} else {
				return 1;
			}
		}

		public function ajouterVote($cit_num,$per_num,$note){
			$sql = "insert into vote values ($cit_num,$per_num,$note)";

			$requete = $this->db->prepare($sql);
			$requete->execute();

		}

		public function supprimerVoteAvecPerNum($per_num){
			$sql = "delete from vote
							WHERE per_num = $per_num";

			$requete = $this->db->prepare($sql);
			$requete->execute();
		}

		public function supprimerVoteAvecCitNum($cit_num){
			$sql = "delete from vote
							WHERE cit_num = $cit_num";

			$requete = $this->db->prepare($sql);
			$requete->execute();
		}



}
?>
