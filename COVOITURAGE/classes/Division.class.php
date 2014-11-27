<?php
class Division{
	private $div_num;
	private $div_nom;
	
	public function __construct($valeurs = array()){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}
	
	public function affecte($donnees){
		foreach($donnees as $attribut => $valeur){
			switch($attribut){
				case 'div_num' : $this->setDiv_num($valeur); break;
				case 'div_nom' : $this->setDiv_nom($valeur); break;
			}
		}
	}
	
	// Setters
	public function setDiv_num($valeur){
		$this->div_num = $valeur;
	}
	public function setDiv_nom($valeur){
		$this->div_nom = $valeur;
	}
	
	// Getters
	public function getDiv_num(){
		return $this->div_num;
	}
	public function getDiv_nom(){
		return $this->div_nom;
	}
	
}