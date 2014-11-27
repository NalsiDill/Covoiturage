<?php
class FonctionManager{
	private $db;
	
	public function __construct($db){
		$this->db = $db;
	}
	
	public function add($fonction){
		$req = $this->db->prepare(
		'INSERT INTO fonction (fon_num, fon_libelle) VALUES (:fon_num, :fon_libelle)');
		$req->bindValue(':fon_num', $fonction->getFon_num());
		$req->bindValue(':fon_libelle', $fonction->getFon_libelle());
		
		$retour = $req->execute();
		
		return $retour;
	}
	
	public function getAllFonctions(){
		$listeFonctions = array();
		$sql = 'SELECT fon_num, fon_libelle FROM fonction';
		$req = $this->db->prepare($sql);
		$req->execute();
		
		while($fonction = $req->fetch(PDO::FETCH_OBJ)){
			$listeFonctions[] = new Fonction($fonction);
		}
		$req->closeCursor();
		
		return $listeFonctions;
		
	}
	
	public function getFonctionByID($numeroFonction){
		$req = $this->db->prepare('SELECT * 
		FROM Fonction WHERE fon_num = :num');
		$req->bindValue(':num', $numeroFonction);
		$nom = $req->execute();
		
		while($fonction = $req->fetch(PDO::FETCH_OBJ)){
			$fonctione = new Fonction($fonction);
		}
		$req->closeCursor();
			
		return $fonctione;
	}
}