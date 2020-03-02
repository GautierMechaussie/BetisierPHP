<?php

class DepartementManager {
	private $dbo;

		public function __construct($db){
			$this->db = $db;
		}

		public function listeDepartement(){
			$listeDepartement = array();
			$sql = 'SELECT * FROM departement';
			$requete = $this->db->prepare($sql);
			$requete -> execute();

			while ($departement = $requete->fetch(PDO::FETCH_OBJ))
				$listeDepartement[] = new Departement($departement);

			$requete->closeCursor();
			return $listeDepartement;
		}
		public function getAllDepartement(){
            $listeDepartements = array();

            $sql = 'select * FROM departement';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($departement = $requete->fetch(PDO::FETCH_OBJ))
                $listeDepartements[] = new Departement($departement);

            $requete->closeCursor();
            return $listeDepartements;
		}
		public function getDepartement($numDep){

      $sql="select * FROM departement where dep_num=$numDep";

      $requete = $this->db->prepare($sql);
      $requete->execute();

      $departement = $requete->fetch(PDO::FETCH_OBJ);

      $listeDepartements = new Departement($departement);


      $requete->closeCursor();
      return $listeDepartements;
  }
  public function getAllDepartementFromOneVille($numVille){
					$listeDepartements = array();

					$sql = "select * FROM departement where vil_num = $numVille";

					$requete = $this->db->prepare($sql);
					$requete->execute();

					while ($departement = $requete->fetch(PDO::FETCH_OBJ))
							$listeDepartements[] = new Departement($departement);

					$requete->closeCursor();
					if(empty($listeDepartements)){
						$listeDepartements = NULL;
					}
					return $listeDepartements;
	}

}

?>
