<?php
class PersonneManager{
	private $db;
	
	public function __construct($db){
		$this->db = $db;
	}
	// ajout de personne dans la base
	public function add($personne){
		$req = $this->db->prepare(
		'INSERT INTO Personne (per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd) 
		VALUES (:per_nom, :per_prenom, :per_tel, :per_mail, :per_login, :per_pwd)');
		$req->bindValue(':per_nom', $personne->getPer_nom());
		$req->bindValue(':per_prenom', $personne->getPer_prenom());
		$req->bindValue(':per_tel', $personne->getPer_tel());
		$req->bindValue(':per_mail', $personne->getPer_mail());
		$req->bindValue(':per_login', $personne->getPer_login());
		$req->bindValue(':per_pwd', $personne->getPer_pwd());
		
		$retour = $req->execute();
		
		return $retour;
	}
	// modification de personne existante
	public function update($personne){
		$req = $this->db->prepare(
		'UPDATE Personne 
		SET per_nom = :per_nom, per_prenom = :per_prenom, per_tel = :per_tel, per_mail = :per_mail
		WHERE per_num = :per_num');
		$req->bindValue(':per_nom', $personne->getPer_nom());
		$req->bindValue(':per_prenom', $personne->getPer_prenom());
		$req->bindValue(':per_tel', $personne->getPer_tel());
		$req->bindValue(':per_mail', $personne->getPer_mail());
		$req->bindValue(':per_num', $personne->getPer_num());
		
		$retour = $req->execute();
		
		return $retour;
	}
	
	public function getAllPersonnes(){
		$listePersonnes = array();
		$sql = 'SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd 
		FROM Personne';
		$req = $this->db->prepare($sql);
		$req->execute();
		
		while($personne = $req->fetch(PDO::FETCH_OBJ)){
			$listePersonnes[] = new Personne($personne);
		}
		$req->closeCursor();
		
		return $listePersonnes;
		
	}
	
	public function getPersonneByID($numeroPersonne){
		$req = $this->db->prepare('SELECT * 
		FROM Personne WHERE per_num = :num');
		$req->bindValue(':num', $numeroPersonne);
		$nom = $req->execute();
		
		while($personne = $req->fetch(PDO::FETCH_OBJ)){
			$personnee = new Personne($personne);
		}
		$req->closeCursor();
			
		return $personnee;
	}
	
	public function getIDByPersonne($nom, $prenom, $login){
        $req = $this->db->prepare('SELECT per_num FROM Personne
        WHERE per_nom = :nom
        AND per_prenom = :prenom
        AND per_login = :login');
        $req->bindValue(':nom', $nom);
        $req->bindValue(':prenom', $prenom);
        $req->bindValue(':login', $login);
        $num = $req->execute();
        
        while($personne = $req->fetch(PDO::FETCH_OBJ)){
            $personnee = new Personne($personne);
        }
        $req->closeCursor();
        
        return $personnee;
    }
}