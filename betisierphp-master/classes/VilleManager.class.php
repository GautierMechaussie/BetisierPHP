<?php

class VilleManager {
	private $dbo;

		public function __construct($db){
			$this->db = $db;
		}

				public function ajouterVille($ville){
            $requete = $this->db->prepare(
						'INSERT INTO ville (vil_num, vil_nom) VALUES (:numero, :nom);');

            $requete->bindValue(':numero',$ville->getVilleNum());
						$requete->bindValue(':nom',$ville->getVilleNom());

            $retour=$requete->execute();
						return $retour;
        }

				public function listeVille(){
								$listeVilles = array();

								$sql = 'SELECT * FROM ville ORDER BY 1';

								$requete = $this->db->prepare($sql);
								$requete->execute();

								while ($ville = $requete->fetch(PDO::FETCH_OBJ))
										$listeVilles[] = new Ville($ville);

								$requete->closeCursor();
								return $listeVilles;
							}

				public function nombreVille(){
								$nombreVilles = array();

								$sql = 'SELECT * FROM ville';

								$requete = $this->db->prepare($sql);
								$requete->execute();

								while ($ville = $requete->fetch(PDO::FETCH_OBJ))
										$nombreVilles[] = new Ville($ville);

								$requete->closeCursor();
								return count($nombreVilles);
							}

			public function supprimerVille($numVille){

			    $requete1=$this->db->prepare("DELETE FROM departement  WHERE vil_num IN (SELECT vil_num FROM ville WHERE vil_num=('$numVille'))");
			    $requete1->execute();

			    $requete2=$this->db->prepare("DELETE FROM ville WHERE vil_num=('$numVille')");
			    $retour = $requete2->execute();
					return $retour;
			}

				public function modifierVille($num,$nom)
		    {
		        $sql="UPDATE VILLE SET vil_nom='$nom' WHERE vil_num='$num'";
		        $requete=$this->db->prepare($sql);
		        $retour=$requete->execute();
						return $retour;
		    }

				public function getVille($num){
						$requete = $this->db->prepare(
						"SELECT * FROM ville WHERE vil_num = '$num'");

						$requete->execute();

						$ville = $requete->fetch(PDO::FETCH_OBJ);
						return $ville;
				}


								public function getVilleParNom($nom){
												$nombreVilles = array();

												$requete = $this->db->prepare(
												"SELECT * FROM ville WHERE vil_nom = '$nom'");

												$requete->execute();

												while ($ville = $requete->fetch(PDO::FETCH_OBJ))
														$nombreVilles[] = new Ville($ville);

												$requete->closeCursor();
												return count($nombreVilles);
											}

											public function presenceDep($num){
															$nombreVilles = array();

															$requete = $this->db->prepare(
															"SELECT * FROM departement WHERE vil_num = '$num'");

															$requete->execute();

															while ($ville = $requete->fetch(PDO::FETCH_OBJ))
																	$nombreVilles[] = new Ville($ville);

															$requete->closeCursor();
															return count($nombreVilles);
														}


}

?>
