<?php
class Personne{
	private $per_num;
	private $per_nom;
	private $per_prenom;
	private $per_tel;
	private $per_mail;
	private $per_login;
	private $per_pwd;
	
	public function __construct($valeurs = array()){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}
	
	public function affecte($donnees){
		foreach($donnees as $attribut => $valeur){
			switch($attribut){
				case 'per_num' : $this->setPer_num($valeur); break;
				case 'per_nom' : $this->setPer_nom($valeur); break;
				case 'per_prenom' : $this->setPer_prenom($valeur); break;
				case 'per_tel' : $this->setPer_tel($valeur); break;
				case 'per_mail' : $this->setPer_mail($valeur); break;
				case 'per_login' : $this->setPer_login($valeur); break;
				case 'per_pwd' : $this->setPer_pwd($valeur); break;
			}
		}
	}
	
	// Setters
	public function setPer_num($num){
		$this->per_num = $num;
	}
	public function setPer_nom($nom){
		$this->per_nom = $nom;
	}
	public function setPer_prenom($prenom){
		$this->per_prenom = $prenom;
	}
	public function setPer_tel($tel){
		$this->per_tel = $tel;
	}
	public function setPer_mail($mail){
		$this->per_mail = $mail;
	}
	public function setPer_login($login){
		$this->per_login = $login;
	}
	public function setPer_pwd($pwd){
		$this->per_pwd = $pwd;
	}
	
	// Getters
	public function getPer_num(){
		return $this->per_num;
	}
	public function getPer_nom(){
		return $this->per_nom;
	}
	public function getPer_prenom(){
		return $this->per_prenom;
	}
	public function getPer_tel(){
		return $this->per_tel;
	}
	public function getPer_mail(){
		return $this->per_mail;
	}
	public function getPer_login(){
		return $this->per_login;
	}
	public function getPer_pwd(){
		return $this->per_pwd;
	}
}