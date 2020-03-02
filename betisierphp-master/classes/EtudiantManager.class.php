<?php

class EtudiantManager {
	private $dbo;

		public function __construct($db){
			$this->db = $db;
		}

		public function testEtudiant($numeroPersonne){
						$estEtudiant = array();

						$sql = 'SELECT * FROM etudiant WHERE per_num = :numero';

						$requete = $this->db->prepare($sql);
						$requete->bindValue(':numero',$numeroPersonne);
						$requete->execute();

						while ($etudiant = $requete->fetch(PDO::FETCH_OBJ))
								$estEtudiant[] = new Etudiant($etudiant);

						$requete->closeCursor();
						return count($estEtudiant);
					}

		public function detailEtudiant($numeroPersonne){
						$detailEtudiant = array();

						$sql = 'SELECT per_prenom, per_mail, per_tel, dep_nom, vil_nom FROM etudiant e
										JOIN personne p ON p.per_num = e.per_num
										JOIN departement d ON d.dep_num = e.dep_num
										JOIN ville v ON v.vil_num = d.vil_num
										WHERE p.per_num = :numero';

						$requete = $this->db->prepare($sql);
						$requete->bindValue(':numero',$numeroPersonne);
						$requete->execute();

						while ($etudiant = $requete->fetch(PDO::FETCH_OBJ))
								$detailEtudiant[] = new Etudiant($etudiant);

						$requete->closeCursor();
						return $detailEtudiant;
					}


		public function getEtudiant($num){
				$requete = $this->db->prepare(
				"SELECT * FROM etudiant WHERE per_num = '$num'");

				$requete->execute();

				$etudiant = $requete->fetch(PDO::FETCH_OBJ);
				return $etudiant;
		}
		public function ajouterEtudiant($etu){
				$sql = "INSERT INTO etudiant(per_num,dep_num,div_num) VALUES(:perNum,:depNum,:divNum)";

				$requete = $this->db->prepare($sql);
				$requete->bindValue(':perNum', $etu->getPerNum(), PDO::PARAM_INT);
				$requete->bindValue(':depNum', $etu->getDepNum(), PDO::PARAM_INT);
				$requete->bindValue(':divNum', $etu->getDivNum(), PDO::PARAM_INT);
				$requete->execute();
			}
			public function supprimerEtudiant($num){
				$sql = "delete from etudiant
								WHERE per_num = $num";

				$requete = $this->db->prepare($sql);
				$requete->execute();
			}
}

?>
