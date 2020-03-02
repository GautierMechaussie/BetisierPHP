<?php

class SalarieManager {
	private $dbo;

		public function __construct($db){
			$this->db = $db;
		}

		public function detailSalarie($numeroPersonne){
						$detailSalarie = array();

						$sql = 'SELECT per_prenom, per_mail, per_tel, sal_telprof, fon_libelle FROM salarie s
										JOIN personne p ON p.per_num = s.per_num
										JOIN fonction f ON f.fon_num = s.fon_num
										WHERE p.per_num = :numero';

						$requete = $this->db->prepare($sql);
						$requete->bindValue(':numero',$numeroPersonne);
						$requete->execute();

						while ($salarie = $requete->fetch(PDO::FETCH_OBJ))
								$detailSalarie[] = new Salarie($salarie);

						$requete->closeCursor();
						return $detailSalarie;
					}

					public function getAllPersonnes(){
						$listePersonne = array();
							$sql = "SELECT per_num,per_nom FROM personne where per_num in (Select per_num from salarie)";
						$data = $this->db->prepare($sql);
						$data -> execute();

						while ($Personne = $data->fetch(PDO::FETCH_OBJ))
							$listePersonne[] = new Personne($Personne);

						$data->closeCursor();
						return $listePersonne;
					}

					public function listeSalarie(){
						$listeSalarie = array();
						$sql = 'SELECT * FROM salarie';
						$requete = $this->db->prepare($sql);
						$requete -> execute();

						while ($salarie = $requete->fetch(PDO::FETCH_OBJ))
							$listeSalarie[] = new Salarie($salarie);

						$requete->closeCursor();
						return $listeSalarie;
					}

					public function ajouterSalarie($num, $numtelpro, $fonnum){
							$requete = $this->db->prepare(
							'INSERT INTO salarie (per_num, sal_telprof, fon_num) VALUES (:numero, :numtelpro, :fonnum);');

							$requete->bindValue(':numero',$num);
							$requete->bindValue(':numtelpro',$numtelpro);
							$requete->bindValue(':fonnum',$fonnum);

							$retour=$requete->execute();
							return $retour;
					}
					public function getSalarie($numPer){
				$sql = "select * FROM salarie  where per_num=$numPer";

				$requete = $this->db->prepare($sql);
				$requete->execute();

				$sal = $requete->fetch(PDO::FETCH_OBJ);

				$sal_trouve = new Salarie($sal);

				return $sal_trouve;
			}
			public function supprimerSalarie($num){
				$sql = "delete from salarie
								WHERE per_num = $num";

				$requete = $this->db->prepare($sql);
				$requete->execute();
			}
			public function modifierSalarie($sal){
				$sql = "Update salarie
								set sal_telprof = :telpro, fon_num = :fonNum
								WHERE per_num = :perNum";

				$requete = $this->db->prepare($sql);
				$requete->bindValue(':perNum', $sal->getPerNum(), PDO::PARAM_INT);
				$requete->bindValue(':telpro', $sal->getSalTelprof(), PDO::PARAM_STR);
				$requete->bindValue(':fonNum', $sal->getFonNum(), PDO::PARAM_INT);
				$requete->execute();
			}
}

?>
