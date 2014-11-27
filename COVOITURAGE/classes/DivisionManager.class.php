<?php
class DivisionManager{
	private $db;
	
	public function __construct($db){
		$this->db = $db;
	}
	
	public function add($division){
		$req = $this->db->prepare(
		'INSERT INTO division (div_num, div_nom) VALUES (:div_num, :div_nom)');
		$req->bindValue(':div_num', $division->getDiv_num());
		$req->bindValue(':div_nom', $division->getDiv_nom());
		
		$retour = $req->execute();
		
		return $retour;
	}
	
	public function getAllDivisions(){
		$listeDivisions = array();
		$sql = 'SELECT div_num, div_nom FROM division';
		$req = $this->db->prepare($sql);
		$req->execute();
		
		while($division = $req->fetch(PDO::FETCH_OBJ)){
			$listeDivisions[] = new Division($division);
		}
		$req->closeCursor();
		
		return $listeDivisions;
	}
	
	
}