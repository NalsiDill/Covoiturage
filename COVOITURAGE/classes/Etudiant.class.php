<?php
class Etudiant extends Personne{
	private $dep_num;
	private $div_num;
	
	public function __construct($valeurs = array()){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}
	
	public function affecte($donnees){
		foreach($donnees as $attribut => $valeur){
			switch($attribut){
				case 'per_num' : $this->setPer_num($valeur); break;
				case 'dep_num' : $this->setDep_num($valeur); break;
				case 'div_num' : $this->setDiv_num($valeur); break;
			}
		}
	}
	
	// Setters
	public function setDep_num($valeur){
		$this->dep_num = $valeur;
	}
	public function setDiv_num($valeur){
		$this->div_num = $valeur;
	}
	
	// Getters
	public function getDep_num(){
		return $this->dep_num;
	}
	public function getDiv_num(){
		return $this->div_num;
	}
}