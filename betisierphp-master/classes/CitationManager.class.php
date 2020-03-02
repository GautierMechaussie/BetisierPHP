<?php

class CitationManager {
	private $dbo;

		public function __construct($db){
			$this->db = $db;
		}

		public function getAllCitation(){

            $sql = 'select * from citation where cit_valide = 1 AND cit_date_valide is not null';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($citation = $requete->fetch(PDO::FETCH_OBJ))
                $listeCitations[] = new Citation($citation);

            $requete->closeCursor();
						if(empty($listeCitations)){
							$listeCitations = NULL;
						}
            return $listeCitations;
		}

		public function getAllCitationNonValide(){

						$sql = 'select * from citation where cit_valide = 0 AND cit_date_valide is null';

						$requete = $this->db->prepare($sql);
						$requete->execute();

						while ($citation = $requete->fetch(PDO::FETCH_OBJ))
								$listeCitations[] = new Citation($citation);

						$requete->closeCursor();
						if(empty($listeCitations)){
							$listeCitations = NULL;
						}
						return $listeCitations;
		}

		public function getCitation($cit_num){

						$sql = "select * from citation where cit_num = $cit_num";

						$requete = $this->db->prepare($sql);
						$requete->execute();

						$citation = $requete->fetch(PDO::FETCH_OBJ);

						$listeCitations = new Citation($citation);

						$requete->closeCursor();
						if(empty($listeCitations)){
							$listeCitations = NULL;
						}
						return $listeCitations;
		}

		public function getAllCitationFromOnePersonne($numPer){

						$sql = "select * from citation where per_num = $numPer";

						$requete = $this->db->prepare($sql);
						$requete->execute();

						while ($citation = $requete->fetch(PDO::FETCH_OBJ))
								$listeCitations[] = new Citation($citation);

						$requete->closeCursor();
						if(empty($listeCitations)){
							$listeCitations = NULL;
						}
						return $listeCitations;
		}

    public function getNbCitation(){

        $sql = 'select count(*) as TOTAL FROM citation
        where cit_valide = 1 AND cit_date_valide is not null';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        $citation = $requete->fetch(PDO::FETCH_OBJ);

        return $citation->TOTAL;
    }

		public function getNbCitationNonValide(){

        $sql = 'select count(*) as TOTAL FROM citation
        where cit_valide = 0 AND cit_date_valide is null';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        $citation = $requete->fetch(PDO::FETCH_OBJ);

        return $citation->TOTAL;
    }


		public function supprimerCitationAvecPerNumEtu($per_num){
			$sql = "delete from citation
							WHERE per_num_etu = $per_num";

			$requete = $this->db->prepare($sql);
			$requete->execute();
		}

		public function supprimerCitationAvecPerNum($per_num){
			$sql = "delete from citation
							WHERE per_num = $per_num";

			$requete = $this->db->prepare($sql);
			$requete->execute();
		}

		public function supprimerCitationAvecCitNum($cit_num){
			$sql = "delete from citation
							WHERE cit_num = $cit_num";

			$requete = $this->db->prepare($sql);
			$requete->execute();
		}

		public function modifierCitationAvecPerNumValide($per_num){
			$sql = "Update citation
							set per_num_valide = NULL
							WHERE per_num_valide = $per_num";

			$requete = $this->db->prepare($sql);
			$requete->execute();
		}

		public function ajouterCitation($citation){
			$sql = "INSERT INTO citation(cit_num,per_num,per_num_valide,per_num_etu,cit_libelle,cit_date,cit_valide,cit_date_valide,cit_date_depo) VALUES(:cit_num,:per_num,NULL,:per_num_etu,:cit_lib,:cit_date,0,NULL,:cit_date_depo)";
			$requete = $this->db->prepare($sql);
			$requete->bindValue(':cit_num',$citation->getCitNum(),PDO::PARAM_INT);
			$requete->bindValue(':per_num',$citation->getPerNum(), PDO::PARAM_INT);
			$requete->bindValue(':per_num_etu',$citation->getPerNumEtu(), PDO::PARAM_INT);
			$requete->bindValue(':cit_lib',$citation->getCitLibelle(), PDO::PARAM_STR);
			$requete->bindValue(':cit_date',$citation->getCitDate(), PDO::PARAM_STR);
			$requete->bindValue(':cit_date_depo',$citation->getCitDateDepo(), PDO::PARAM_STR);
			$requete->execute();
		}

		public function validerCitation($citNum,$perNum){
			$date = date("Y-m-d");
			$sql = "Update citation
							set per_num_valide = $perNum, cit_valide = 1, cit_date_valide = '$date'
							WHERE cit_num = $citNum";

			$requete = $this->db->prepare($sql);
			$requete->execute();

		}

		public function getAllCitationRechercheNom($nom){

						$sql = "select * from citation c join personne p on c.per_num=p.per_num
										where cit_valide = 1 AND cit_date_valide is not null AND per_nom='$nom'";

						$requete = $this->db->prepare($sql);
						$requete->execute();

						while ($citation = $requete->fetch(PDO::FETCH_OBJ))
								$listeCitations[] = new Citation($citation);

						$requete->closeCursor();
						if(empty($listeCitations)){
							$listeCitations = NULL;
						}
						return $listeCitations;
		}

		public function getAllCitationRechercheDate($date){

						$sql = "select * from citation c
										where cit_valide = 1 AND cit_date_valide is not null AND cit_date='$date'";

						$requete = $this->db->prepare($sql);
						$requete->execute();

						while ($citation = $requete->fetch(PDO::FETCH_OBJ))
								$listeCitations[] = new Citation($citation);

						$requete->closeCursor();
						if(empty($listeCitations)){
							$listeCitations = NULL;
						}
						return $listeCitations;
		}

		public function getAllCitationRechercheNote($note){

						$listeCitations = $this->getAllCitation();

						foreach ($listeCitations as $citations){
							$num = $citations->getCitNum();
							$sql = "select AVG(vot_valeur) as moyenne FROM vote
						 					where cit_num = $num group by cit_num";

							$requete = $this->db->prepare($sql);
							$requete->execute();

							$moyVote = $requete->fetch(PDO::FETCH_OBJ);
							$requete->closeCursor();

							if(!empty($moyVote)){
								if($note == $moyVote->moyenne){
									$liste[] = $citations;
								}
							}
						}

						if(empty($liste)){
							$liste = NULL;
						}
						return $liste;
		}

} ?>
