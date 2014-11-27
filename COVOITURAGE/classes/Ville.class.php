<?php
class Ville{
	private $vil_num ;
	private $vil_nom ;
	
	public function __construct($valeurs = array()){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}
	
	public function affecte($donnees){
		foreach($donnees as $attribut => $valeur){
			switch($attribut){
				case 'vil_nom' : $this->setVil_nom($valeur); break;
				case 'vil_num' : $this->setVil_num($valeur); break;
			}
		}
	}
	
	public function setVil_nom($nom){
		$this->vil_nom = $nom;
	}
	
	public function setVil_num($num){
		$this->vil_num = $num;
	}
	
	public function getVil_nom(){
		return $this->vil_nom;
	}
	
	public function getVil_num(){
		return $this->vil_num;
	}
}