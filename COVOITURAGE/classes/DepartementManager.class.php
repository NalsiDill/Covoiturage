<?php
class DepartementManager{
	private $db;
	
	public function __construct($db){
		$this->db = $db;
	}
	
	public function add($departement){
		$req = $this->db->prepare(
		'INSERT INTO departement (dep_num, dep_nom, vil_num) VALUES (:dep_num, :dep_nom, :vil_num)');
		$req->bindValue(':dep_num', $departement->getFon_num());
		$req->bindValue(':dep_nom', $departement->getDiv_num());
		$req->bindValue(':vil_num', $departement->getVil_num());
		
		$retour = $req->execute();
		
		return $retour;
	}
	
	public function getAllDepartements(){
		$listeDepartements = array();
		$sql = 'SELECT dep_num, dep_nom, vil_num FROM departement';
		$req = $this->db->prepare($sql);
		$req->execute();
		
		while($departement = $req->fetch(PDO::FETCH_OBJ)){
			$listeDepartements[] = new Departement($departement);
		}
		$req->closeCursor();
		
		return $listeDepartements;
		
	}
	
	public function getDepartementByID($numeroDepartement){
		$req = $this->db->prepare('SELECT * 
		FROM Departement WHERE dep_num = :num');
		$req->bindValue(':num', $numeroDepartement);
		$nom = $req->execute();
		
		while($departement = $req->fetch(PDO::FETCH_OBJ)){
			$departemente = new Departement($departement);
		}
		$req->closeCursor();
			
		return $departemente;
	}
}