<?php

class FonctionManager {
	private $dbo;

		public function __construct($db){
			$this->db = $db;
		}

		public function listeFonction(){
			$listeFonction = array();
			$sql = 'SELECT * FROM fonction';
			$requete = $this->db->prepare($sql);
			$requete -> execute();

			while ($fonction = $requete->fetch(PDO::FETCH_OBJ))
				$listeFonction[] = new Fonction($fonction);

			$requete->closeCursor();
			return $listeFonction;
		}
		public function getAllFonction(){
            $listeFonctions = array();

            $sql = 'select * FROM fonction';

            $requete = $this->db->prepare($sql);
            $requete->execute();

            while ($fon = $requete->fetch(PDO::FETCH_OBJ))
                $listeFonctions[] = new Fonction($fon);

            $requete->closeCursor();
            return $listeFonctions;
		}
}

?>
