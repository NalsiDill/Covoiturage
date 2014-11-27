<?php
class SalarieManager{
	private $db;
	
	public function __construct($db){
		$this->db = $db;
	}
	
	public function add($salarie){
		$req = $this->db->prepare(
		'INSERT INTO salarie (per_num, sal_telprof, fon_num) VALUES (:per_num, :sal_telprof, :fon_num)');
        $req->bindValue(':per_num', $salarie->getPer_num());
		$req->bindValue(':sal_telprof', $salarie->getSal_telprof());
		$req->bindValue(':fon_num', $salarie->getFon_num());
		
		$retour = $req->execute();
		
		return $retour;
	}
	
	public function getAllSalaries(){
		$listeVilles = array();
		$sql = 'SELECT * FROM salarie';
		$req = $this->db->prepare($sql);
		$req->execute();
		
		while($salarie = $req->fetch(PDO::FETCH_OBJ)){
			$listeSalaries[] = new Salarie($salarie);
		}
		$req->closeCursor();
		
		return $listeSalaries;
		
	}
	
	public function getSalarieByID($numeroSalarie){
		$req = $this->db->prepare('SELECT * 
		FROM Salarie WHERE per_num = :num');
		$req->bindValue(':num', $numeroSalarie);
		$nom = $req->execute();
		
		while($salarie = $req->fetch(PDO::FETCH_OBJ)){
			$salariee = new Salarie($salarie);
		}
		$req->closeCursor();
			
		return $salariee;
	}
}