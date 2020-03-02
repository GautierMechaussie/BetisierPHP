<?php

class DivisionManager {
	private $dbo;

		public function __construct($db){
			$this->db = $db;
		}

		public function listeDivision(){
			$listeDivision = array();
			$sql = 'SELECT * FROM division';
			$requete = $this->db->prepare($sql);
			$requete -> execute();

			while ($division = $requete->fetch(PDO::FETCH_OBJ))
				$listeDivision[] = new Division($division);

			$requete->closeCursor();
			return $listeDivision;
		}
		public function getAllDivision(){
            $listeDivisions = array();

            $sql = 'select * FROM division';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($division = $requete->fetch(PDO::FETCH_OBJ))
                $listeDivisions[] = new Division($division);

            $requete->closeCursor();
            return $listeDivisions;
		}

}

?>
