<?php
class ParcoursManager{
	private $db;
	
	public function __construct($db){
		$this->db = $db;
	}
	
	public function add($parcours){
		$req = $this->db->prepare(
		'INSERT INTO parcours (par_km, vil_num1, vil_num2) VALUES (:par_km, :vil_num1, :vil_num2)');
		$req->bindValue(':par_km', $parcours->getPar_km());
		$req->bindValue(':vil_num1', $parcours->getVil_num1());
		$req->bindValue(':vil_num2', $parcours->getVil_num2());
		
		$retour = $req->execute();
		
		return $retour;
	}
	
	public function getAllParcours(){
		$listeParcours = array();
		$sql = 'SELECT par_num, par_km, vil_num1, vil_num2 FROM parcours';
		$req = $this->db->prepare($sql);
		$req->execute();
		
		while($parcours = $req->fetch(PDO::FETCH_OBJ)){
			$listeParcours[] = new Parcours($parcours);
		}
		$req->closeCursor();
		
		return $listeParcours;
		
	}
	
	public function getAllVillesDepart(){
		$listVilles = array();
		
		$sql = 'SELECT vil_num, vil_nom FROM ville v 
		JOIN parcours p on p.vil_num1 = v.vil_num
		GROUP BY vil_nom
        UNION
        SELECT vil_num, vil_nom FROM ville v 
		JOIN parcours p on p.vil_num2 = v.vil_num
		GROUP BY vil_nom';
		$req = $this->db->prepare($sql);
		$req->execute();
		
		while($ville = $req->fetch(PDO::FETCH_OBJ)){
			$listVilles[] = new Ville($ville);
		}
		$req->closeCursor();
		
		return $listVilles;
	}
	
	public function getAllVillesArrivée($no_vil1){
		$listVilles = array();
		
		$sql = 'SELECT vil_num, vil_nom FROM ville 
		JOIN parcours on parcours.vil_num2 = ville.vil_num
		WHERE vil_num1 = :num
		GROUP BY vil_nom
        UNION
        SELECT vil_num, vil_nom FROM ville 
		JOIN parcours on parcours.vil_num1 = ville.vil_num
		WHERE vil_num2 = :num
		GROUP BY vil_nom';
        $req = $this->db->prepare($sql);
		$req->bindValue(':num', $no_vil1);
		$req->execute();
		
		while($ville = $req->fetch(PDO::FETCH_OBJ)){
			$listVilles[] = new Ville($ville);
		}
		$req->closeCursor();
		
		return $listVilles;
	}
    
    public function getParcoursByVilles($vil_num1, $vil_num2){
        $req = $this->db->prepare('SELECT * FROM parcours
            WHERE vil_num1 = :vil_num1
            AND vil_num2 = :vil_num2
            UNION
            SELECT * FROM parcours
            WHERE vil_num1 = :vil_num2
            AND vil_num2 = :vil_num1');
        $req->bindValue(':vil_num1', $vil_num1);
        $req->bindValue(':vil_num2', $vil_num2);
		$nom = $req->execute();
		
		while($parcours = $req->fetch(PDO::FETCH_OBJ)){
			$parcourss = new Parcours($parcours);
		}
		$req->closeCursor();
		return $parcourss;
    }
    
    public function getParcoursByVillesWithOrdre($vil_num1, $vil_num2){
        $req = $this->db->prepare('SELECT * FROM parcours
            WHERE vil_num1 = :vil_num1
            AND vil_num2 = :vil_num2');
        $req->bindValue(':vil_num1', $vil_num1);
        $req->bindValue(':vil_num2', $vil_num2);
		$nom = $req->execute();
		
		while($parcours = $req->fetch(PDO::FETCH_OBJ)){
			$parcourss = new Parcours($parcours);
		}
		$req->closeCursor();
        if($parcours == null){
            return null;
        }
		return $parcourss;
    }
    
	public function getParcoursById($par_num){
		$parcourss = array();
		$req = $this->db->prepare('SELECT * FROM parcours WHERE par_num = :par_num');
		$req->bindValue(':par_num', $par_num);
		$nom = $req->execute();
		
		while($parcours = $req->fetch(PDO::FETCH_OBJ)){
			$parcourss = new Parcours($parcours);
		}
		$req->closeCursor();
		return $parcourss;
		
	}
}