<?php

class Utilisateur{
	
	private $idUtilisateur;
	private $pseudo;
	private $nom;
	private $prenom;
	private $email;
	private $mdp;
	private $adresse;
	private $cp;
	private $ville;
	private $tel;
	private $date_inscription;


	/**
	 * Get the value of idUtilisateur
	 */ 
	public function getIdUtilisateur()
	{
	return $this->idUtilisateur;
	}

	/**
	 * Set the value of idUtilisateur

	 */ 
	public function setIdUtilisateur($idUtilisateur)
	{
	$this->idUtilisateur = $idUtilisateur;

	}

	/**
	 * Get the value of nom
	 */ 
	public function getNom()
	{
	return $this->nom;
	}

	/**
	 * Set the value of nom

	 */ 
	public function setNom($nom)
	{
	$this->nom = $nom;

	}

	/**
	 * Get the value of prenom
	 */ 
	public function getPrenom()
	{
	return $this->prenom;
	}

	/**
	 * Set the value of prenom

	 */ 
	public function setPrenom($prenom)
	{
	$this->prenom = $prenom;

	}

	/**
	 * Get the value of email
	 */ 
	public function getEmail()
	{
	return $this->email;
	}

	/**
	 * Set the value of email

	 */ 
	public function setEmail($email)
	{
	$this->email = $email;

	}

	/**
	 * Get the value of mdp
	 */ 
	public function getMdp()
	{
	return $this->mdp;
	}

	/**
	 * Set the value of mdp

	 */ 
	public function setMdp($mdp)
	{
	$this->mdp = $mdp;

	}


	/**
	 * Get the value of adresse
	 */ 
	public function getAdresse()
	{
	return $this->adresse;
	}

	/**
	 * Set the value of adresse

	 */ 
	public function setAdresse($adresse)
	{
	$this->adresse = $adresse;

	}

	
	/**
	 * Get the value of ville
	 */ 
	public function getVille()
	{
	return $this->ville;
	}

	/**
	 * Set the value of ville

	 */ 
	public function setVille($ville)
	{
	$this->ville = $ville;

	}

	/**
	 * Get the value of mdp
	 */ 
	public function getTel()
	{
	return $this->tel;
	}

	/**
	 * Set the value of teltel

	 */ 
	public function setTel($tel)
	{
	$this->tel = $tel;

	}


	/**
	 * Get the value of pseudo
	 */ 
	public function getPseudo()
	{
		return $this->pseudo;
	}

	/**
	 * Set the value of pseudo
	 *
	 * @return  self
	 */ 
	public function setPseudo($pseudo)
	{
		$this->pseudo = $pseudo;

		return $this;
	}

	

	/**
	 * Get the value of cp
	 */ 
	public function getCp()
	{
		return $this->cp;
	}

	/**
	 * Set the value of cp
	 *
	 * @return  self
	 */ 
	public function setCp($cp)
	{
		$this->cp = $cp;

		return $this;
	}


	/**
	 * Get the value of date_inscription
	 */ 
	public function getDate_inscription()
	{
		return $this->date_inscription;
	}

	/**
	 * Set the value of date_inscription
	 *
	 * @return  self
	 */ 
	public function setDate_inscription($date_inscription)
	{
		$this->date_inscription = $date_inscription;

		return $this;
	}
}
?>

