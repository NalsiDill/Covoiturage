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
	
	public function getAllVilles1(){
		$listVilles1 = array();
		
		$sql = 'SELECT vil_num, vil_nom FROM ville 
		JOIN parcours on parcours.vil_num1 = ville.vil_num
		GROUP BY vil_nom';
		$req = $this->db->prepare($sql);
		$req->execute();
		
		while($ville = $req->fetch(PDO::FETCH_OBJ)){
			$listVilles1[] = new Ville($ville);
		}
		$req->closeCursor();
		
		return $listVilles1;
	}
	
	public function getAllVilles2($no_vil1){
		$listVilles2 = array();
		
		$sql = 'SELECT vil_num, vil_nom FROM ville 
		JOIN parcours on parcours.vil_num2 = ville.vil_num
		WHERE vil_num1 = :num
		GROUP BY vil_nom';
		$req->bindValue(':num', $no_vil1);
		$req = $this->db->prepare($sql);
		$req->execute();
		
		while($ville = $req->fetch(PDO::FETCH_OBJ)){
			$listVilles2[] = new Ville($ville);
		}
		$req->closeCursor();
		
		return $listVilles2;
	}
}