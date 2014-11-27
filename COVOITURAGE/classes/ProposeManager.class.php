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
	

}