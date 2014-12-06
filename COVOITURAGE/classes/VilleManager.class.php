<?php
class VilleManager{
	private $db;
	
	public function __construct($db){
		$this->db = $db;
	}
	
	public function add($ville){
		$req = $this->db->prepare(
		'INSERT INTO ville (vil_nom) VALUES (:vil_nom)');
		$req->bindValue(':vil_nom', $ville->getVil_nom());
		
		$retour = $req->execute();
		
		return $retour;
	}
	
	public function getAllVilles(){
		$listeVilles = array();
		$sql = 'SELECT vil_num, vil_nom FROM ville';
		$req = $this->db->prepare($sql);
		$req->execute();
		
		while($ville = $req->fetch(PDO::FETCH_OBJ)){
			$listeVilles[] = new Ville($ville);
		}
		$req->closeCursor();
		
		return $listeVilles;
		
	}
	
	public function getVilleByID($numeroVille){
		$req = $this->db->prepare('SELECT * FROM ville WHERE vil_num = :num');
		$req->bindValue(':num', $numeroVille);
		$nom = $req->execute();
		
		while($ville = $req->fetch(PDO::FETCH_OBJ)){
			$villee = new Ville($ville);
		}
		$req->closeCursor();
			
		return $villee;
	}
	
    public function getVilleByNom($nomVille){
        $req = $this->db->prepare('SELECT * FROM ville WHERE vil_nom = :nom');
		$req->bindValue(':nom', $nomVille);
		$nom = $req->execute();
		
        $villee = new Ville(null);
        
		while($ville = $req->fetch(PDO::FETCH_OBJ)){
			$villee = new Ville($ville);
		}
		$req->closeCursor();
        
        if($villee == null){
            return null;
        }
		return $villee;
    }
	
}