<?php
class Actualites{
	
	
	private $idActualites;
	private $titre;
	private $contenu;
	private $image;
	private $datePub;





	/**
	 * Get the value of idActualites
	 */ 
	public function getIdActualites()
	{
		return $this->idActualites;
	}

	/**
	 * Set the value of idActualites
	 *
	 * @return  self
	 */ 
	public function setIdActualites($idActualites)
	{
		$this->idActualites = $idActualites;

		return $this;
	}

	/**
	 * Get the value of titre
	 */ 
	public function getTitre()
	{
		return $this->titre;
	}

	/**
	 * Set the value of titre
	 *
	 * @return  self
	 */ 
	public function setTitre($titre)
	{
		$this->titre = $titre;

		return $this;
	}

	/**
	 * Get the value of contenu
	 */ 
	public function getContenu()
	{
		return $this->contenu;
	}

	/**
	 * Set the value of contenu
	 *
	 * @return  self
	 */ 
	public function setContenu($contenu)
	{
		$this->contenu = $contenu;

		return $this;
	}

	/**
	 * Get the value of datePub
	 */ 
	public function getDatePub()
	{
		return $this->datePub;
	}

	/**
	 * Set the value of datePub
	 *
	 * @return  self
	 */ 
	public function setDatePub($datePub)
	{
		$this->datePub = $datePub;

		return $this;
	}

	/**
	 * Get the value of image
	 */ 
	public function getImage()
	{
		return $this->image;
	}

	/**
	 * Set the value of image
	 *
	 * @return  self
	 */ 
	public function setImage($image)
	{
		$this->image = $image;

		return $this;
	}
}