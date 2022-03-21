<?php
class Reservation{
	
	private $idReservation;
	private $dateReservation;
	private $nbreParticipant;
	private $dateDebut;
	private $dateFin;
	private $evenement;
	private $description;
	private $idSalle;
	private $idUtilisateur;

	/**
	 * Get the value of dateReservation
	 */ 
	public function getDateReservation()
	{
	return $this->dateReservation;
	}

	/**
	 * Set the value of dateReservation

	 */ 
	public function setDateReservation($dateReservation)
	{
	$this->dateReservation = $dateReservation;

	}

	/**
	 * Get the value of dateDebut
	 */ 
	public function getDateDebut()
	{
	return $this->dateDebut;
	}

	/**
	 * Set the value of dateDebut

	 */ 
	public function setDateDebut($dateDebut)
	{
	$this->dateDebut = $dateDebut;

	}

	/**
	 * Get the value of dateFin
	 */ 
	public function getDateFin()
	{
	return $this->dateFin;
	}

	/**
	 * Set the value of dateFin

	 */ 
	public function setDateFin($dateFin)
	{
	$this->dateFin = $dateFin;

	}

	/**
	 * Get the value of nbreParticipant
	 */ 
	public function getNbreParticipant()
	{
	return $this->nbreParticipant;
	}

	/**
	 * Set the value of nbreParticipant

	 */ 
	public function setNbreParticipant($nbreParticipant)
	{
	$this->nbreParticipant = $nbreParticipant;

	}


	/**
	 * Get the value of idSalle
	 */ 
	public function getIdSalle()
	{
		return $this->idSalle;
	}

	/**
	 * Set the value of idSalle
	 *
	 * @return  self
	 */ 
	public function setIdSalle($idSalle)
	{
		$this->idSalle = $idSalle;

		return $this;
	}



	/**
	 * Get the value of idUtilisateur
	 */ 
	public function getIdUtilisateur()
	{
		return $this->idUtilisateur;
	}

	/**
	 * Set the value of idUtilisateur
	 *
	 * @return  self
	 */ 
	public function setIdUtilisateur($idUtilisateur)
	{
		$this->idUtilisateur = $idUtilisateur;

		return $this;
	}

	/**
	 * Get the value of evenement
	 */ 
	public function getEvenement()
	{
		return $this->evenement;
	}

	/**
	 * Set the value of evenement
	 *
	 * @return  self
	 */ 
	public function setEvenement($evenement)
	{
		$this->evenement = $evenement;

		return $this;
	}

	/**
	 * Get the value of description
	 */ 
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Set the value of description
	 *
	 * @return  self
	 */ 
	public function setDescription($description)
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * Get the value of idReservation
	 */ 
	public function getIdReservation()
	{
		return $this->idReservation;
	}

	/**
	 * Set the value of idReservation
	 *
	 * @return  self
	 */ 
	public function setIdReservation($idReservation)
	{
		$this->idReservation = $idReservation;

		return $this;
	}
}
?>

