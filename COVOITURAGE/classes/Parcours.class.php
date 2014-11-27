<?php
class Parcours{
	private $par_num;
	private $par_km;
	private $vil_num1;
	private $vil_num2;
	
	public function __construct($valeurs = array()){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}
	
	public function affecte($donnees){
		foreach($donnees as $attribut => $valeur){
			switch($attribut){
				case 'par_num' : $this->setPar_num($valeur); break;
				case 'par_km' : $this->setPar_km($valeur); break;
				case 'vil_num1' : $this->setVil_num1($valeur); break;
				case 'vil_num2' : $this->setVil_num2($valeur); break;
			}
		}
	}
	
	public function setPar_num($num){
		$this->par_num = $num;
	}
	
	public function setPar_km($km){
		$this->par_km = $km;
	}
	
	public function setVil_num1($num1){
		$this->vil_num1 = $num1;
	}
	
	public function setVil_num2($num2){
		$this->vil_num2 = $num2;
	}
	
	public function getPar_num(){
		return $this->par_num;
	}
	
	public function getPar_km(){
		return $this->par_km;
	}
	
	public function getVil_num1(){
		return $this->vil_num1;
	}
	
	public function getVil_num2(){
		return $this->vil_num2;
	}
}