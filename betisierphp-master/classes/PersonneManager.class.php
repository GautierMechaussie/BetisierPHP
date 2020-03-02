<?php

class PersonneManager {
	private $dbo;

		public function __construct($db){
			$this->db = $db;
		}

		public function getAllPersonne(){
            $listePersonnes = array();

            $sql = 'select * FROM personne';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($personne = $requete->fetch(PDO::FETCH_OBJ))
                $listePersonnes[] = new Personne($personne);

            $requete->closeCursor();
            return $listePersonnes;
		}

		public function getNbPersonne(){

        $sql = 'select count(*) as TOTAL FROM personne';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        $personne = $requete->fetch(PDO::FETCH_OBJ);

        return $personne->TOTAL;
   		}

		public function listePersonnes(){
						$listePersonnes = array();

						$sql = 'SELECT per_num, per_nom, per_prenom FROM personne';

					$requete = $this->db->prepare($sql);
						$requete->execute();

						while ($personne = $requete->fetch(PDO::FETCH_OBJ))
								$listePersonnes[] = new Personne($personne);

						$requete->closeCursor();
						return $listePersonnes;
					}

public function isEtudiant($numPer){
				$sql = "select per_num FROM etudiant where per_num=$numPer";
				$requete = $this->db->prepare($sql);
				$requete->execute();

				$etudiant = $requete->fetch(PDO::FETCH_OBJ);

				if(empty($etudiant->per_num)){
					return -1;
				}

				return 1;
			}

		public function nombrePersonnes(){
						$nombrePersonnes = array();

						$sql = 'SELECT * FROM personne';

						$requete = $this->db->prepare($sql);
						$requete->execute();

						while ($personne = $requete->fetch(PDO::FETCH_OBJ))
								$nombrePersonnes[] = new Personne($personne);

						$requete->closeCursor();
						return count($nombrePersonnes);
					}

		public function ajouterPersonne($personne){
				$requete = $this->db->prepare(
				'INSERT INTO personne (per_num, per_nom, per_prenom, per_tel, per_mail, per_admin, per_login, per_pwd) VALUES (:numero, :nom, :prenom, :telephone, :mail, :admin, :login, :pwd);');

				$salt="48@!alsd";

				$requete->bindValue(':numero',$personne->getPerNum());
				$requete->bindValue(':nom',$personne->getPerNom());
				$requete->bindValue(':prenom',$personne->getPerPrenom());
				$requete->bindValue(':telephone',$personne->getPerTel());
				$requete->bindValue(':mail',$personne->getPerMail());
				$requete->bindValue(':admin',0);
				$requete->bindValue(':login',$personne->getPerLogin());
				$requete->bindValue(':pwd',sha1(sha1($personne->getPerPwd()).$salt));

				$retour=$requete->execute();
				return $retour;
		}

		public function nomPersonne($numeroPersonne){
						$nomPersonne = array();

						$sql = 'SELECT per_nom FROM personne WHERE per_num = :numero';

						$requete = $this->db->prepare($sql);
						$requete->bindValue(':numero',$numeroPersonne);
						$requete->execute();

						while ($personne = $requete->fetch(PDO::FETCH_OBJ))
								$nomPersonne[] = new Personne($personne);

						$requete->closeCursor();
						return $nomPersonne;
					}

		public function testPersonne($loginPersonne){
									$estPersonne = array();

									$sql = 'SELECT * FROM personne WHERE per_login = :login';

									$requete = $this->db->prepare($sql);
									$requete->bindValue(':login',$loginPersonne);
									$requete->execute();

									while ($personne = $requete->fetch(PDO::FETCH_OBJ))
											$estPersonne[] = new Personne($personne);

									$requete->closeCursor();
									return count($estPersonne);
								}

			public function testPersonneLog($loginPersonne){
				$estPersonne = array();

				$sql = 'SELECT * FROM personne WHERE per_login = :login';

				$requete = $this->db->prepare($sql);
				$requete->bindValue(':login',$loginPersonne);
				$requete->execute();

				while ($personne = $requete->fetch(PDO::FETCH_OBJ))
							$estPersonne[] = new Personne($personne);

				$requete->closeCursor();
				return $estPersonne;
			}

			public function getPersonne($numPer){
				$sql = "select * FROM personne  where per_num=$numPer";

				$requete = $this->db->prepare($sql);
				$requete->execute();

				$personne = $requete->fetch(PDO::FETCH_OBJ);

				$personne_trouve = new Personne($personne);

				return $personne_trouve;
			}

			public function supprimerPersonne($numPer){

				$requete1=$this->db->prepare("DELETE FROM vote WHERE per_num IN (SELECT per_num FROM personne WHERE per_num=('$numPer'))");
				$requete1->execute();

				$requete2=$this->db->prepare("DELETE FROM etudiant WHERE per_num IN (SELECT per_num FROM personne WHERE per_num=('$numPer'))");
				$requete2->execute();

				$requete3=$this->db->prepare("DELETE FROM salarie WHERE per_num IN (SELECT per_num FROM personne WHERE per_num=('$numPer'))");
				$requete3->execute();

				$requete4=$this->db->prepare("DELETE FROM personne WHERE per_num=('$numPer')");
				$retour = $requete4->execute();

				return $retour;
			}

			public function modifierPersonne($per){
				$sqls = "select per_pwd FROM personne where per_num=:perNum";

				$requetes = $this->db->prepare($sqls);
				$requetes->bindValue(':perNum', $per->getPerNum(), PDO::PARAM_INT);
				$requetes->execute();

				$personne = $requetes->fetch(PDO::FETCH_OBJ);

				$anc_pwd = $personne->per_pwd;

				if($anc_pwd == $per->getPerPwd()){
					$pwd_crypte = $per->getPerPwd();
				} else {
					$pwd_crypte = cryptePwd($per->getPerPwd());
				}

				$sql = "Update personne
								set per_nom = :nom, per_prenom = :prenom, per_tel = :tel, per_mail = :mail, per_login = :login, per_pwd = '$pwd_crypte'
								WHERE per_num = :num";
				$requete = $this->db->prepare($sql);
				$requete->bindValue(':num', $per->getPerNum(), PDO::PARAM_INT);
				$requete->bindValue(':nom', $per->getPerNom(), PDO::PARAM_STR);
				$requete->bindValue(':prenom', $per->getPerPrenom(), PDO::PARAM_STR);
				$requete->bindValue(':tel', $per->getPerTel(), PDO::PARAM_STR);
				$requete->bindValue(':mail', $per->getPerMail(), PDO::PARAM_STR);
				$requete->bindValue(':login', $per->getPerLogin(), PDO::PARAM_STR);

				$requete->execute();
			}

			public function avoirNomPrenom($per_num){

				$sql = "select CONCAT(per_nom,' ',per_prenom) as nomComplet FROM personne
				where per_num = $per_num";

				$requete = $this->db->prepare($sql);
				$requete->execute();

				$citation = $requete->fetch(PDO::FETCH_OBJ);

				return $citation->nomComplet;
			}

}

?>
