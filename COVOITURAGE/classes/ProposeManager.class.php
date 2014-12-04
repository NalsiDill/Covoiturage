<?php
class ProposeManager{
	private $db;
	
	public function __construct($db){
		$this->db = $db;
	}
	
	public function add($propose){
		$req = $this->db->prepare(
		'INSERT INTO propose (par_num, per_num, pro_date, pro_time, pro_place, pro_sens) VALUES (:par_num, :per_num, :pro_date, :pro_time, :pro_place, :pro_sens)');
		$req->bindValue(':par_num', $propose->getPar_num());
		$req->bindValue(':per_num', $propose->getPer_num());
		$req->bindValue(':pro_date', $propose->getPro_date());
		$req->bindValue(':pro_time', $propose->getPro_time());
		$req->bindValue(':pro_place', $propose->getPro_place());
		$req->bindValue(':pro_sens', $propose->getPro_sens());
		
		$retour = $req->execute();
		
		return $retour;
	}
	
	public function getAllProposes(){
		$listeProposes = array();
		$sql = 'SELECT par_num, per_num, pro_date, pro_time, pro_place, pro_sens FROM propose';
		$req = $this->db->prepare($sql);
		$req->execute();
		
		while($propose = $req->fetch(PDO::FETCH_OBJ)){
			$listeProposes[] = new Propose($propose);
		}
		$req->closeCursor();
		
		return $listeProposes;
		
	}
    
    public function getVillesBySens(){
        $listVilles = array();
		
		$sql = 'SELECT vil_num, vil_nom FROM ville v 
		JOIN parcours p on p.vil_num1 = v.vil_num
        JOIN propose pro on pro.par_num = p.par_num
        WHERE pro_sens = 0
		GROUP BY vil_nom
        UNION
        SELECT vil_num, vil_nom FROM ville v 
		JOIN parcours p on p.vil_num2 = v.vil_num
        JOIN propose pro on pro.par_num = p.par_num
        WHERE pro_sens = 1
		GROUP BY vil_nom';
		$req = $this->db->prepare($sql);
		$req->execute();
		
		while($ville = $req->fetch(PDO::FETCH_OBJ)){
			$listVilles[] = new Ville($ville);
		}
		$req->closeCursor();
		
		return $listVilles;
    }
    
    public function getTrajetsByRecherche($par_num, $dateAvant, $dateApres, $heure, $sens){
        $listTrajets = array();
		
		$sql = 'SELECT * FROM propose pro
        JOIN parcours par on pro.par_num = par.par_num
        WHERE pro.par_num = :par_num
        AND pro_date >= :dateAvant
        AND pro_date <= :dateApres
        AND pro_time > :heure
        AND pro_sens = :pro_sens';
		$req = $this->db->prepare($sql);
        $req->bindValue(':par_num', $par_num);
        $req->bindValue(':dateAvant', $dateAvant);
        $req->bindValue(':dateApres', $dateApres);
        $req->bindValue(':heure', $heure);
        $req->bindValue(':pro_sens', $sens);
		$req->execute();
		
		while($propose = $req->fetch(PDO::FETCH_OBJ)){
			$listTrajets[] = new Propose($propose);
		}
		$req->closeCursor();
		
		return $listTrajets;
    }
}