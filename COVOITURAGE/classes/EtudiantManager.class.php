<?php
class EtudiantManager{
	private $db;
	
	public function __construct($db){
		$this->db = $db;
	}
	
	public function add($etudiant){
		$req = $this->db->prepare(
		'INSERT INTO etudiant (per_num, dep_num, div_num) VALUES (:per_num, :dep_num, :div_num)');
        $req->bindValue(':per_num', $etudiant->getPer_num());
		$req->bindValue(':dep_num', $etudiant->getDep_num());
		$req->bindValue(':div_num', $etudiant->getDiv_num());
		
		$retour = $req->execute();
		
		return $retour;
	}
	
	public function getAllEtudiants(){
		$listeEtudiants = array();
		$sql = 'SELECT * FROM etudiant';
		$req = $this->db->prepare($sql);
		$req->execute();
		
		while($etudiant = $req->fetch(PDO::FETCH_OBJ)){
			$listeEtudiants[] = new Etudiant($etudiant);
		}
		$req->closeCursor();
		
		return $listeEtudiants;
		
	}
	
	public function getEtudiantByID($numeroEtudiant){
		$req = $this->db->prepare('SELECT * 
		FROM Etudiant WHERE per_num = :num');
		$req->bindValue(':num', $numeroEtudiant);
		$nom = $req->execute();
		
		while($etudiant = $req->fetch(PDO::FETCH_OBJ)){
			$etudiante = new Etudiant($etudiant);
		}
		$req->closeCursor();
			
		return $etudiante;
	}
	
}