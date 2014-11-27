<?php
class Departement{
	private $dep_num;
	private $dep_nom;
	private $vil_num;
	
	public function __construct($valeurs = array()){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}
	
	public function affecte($donnees){
		foreach($donnees as $attribut => $valeur){
			switch($attribut){
				case 'dep_num' : $this->setDep_num($valeur); break;
				case 'dep_nom' : $this->setDep_nom($valeur); break;
				case 'vil_num' : $this->setVil_num($valeur); break;
			}
		}
	}
	
	// Setters
	public function setDep_num($valeur){
		$this->dep_num = $valeur;
	}
	public function setDep_nom($valeur){
		$this->dep_nom = $valeur;
	}
	public function setVil_num($valeur){
		$this->vil_num = $valeur;
	}
	
	// Getters
	public function getDep_num(){
		return $this->dep_num;
	}
	public function getDep_nom(){
		return $this->dep_nom;
	}
	public function getVil_num(){
		return $this->vil_num;
	}
	
}