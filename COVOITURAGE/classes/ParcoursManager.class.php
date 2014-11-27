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
}