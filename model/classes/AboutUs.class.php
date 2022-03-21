<?php
class AboutUs{
	
	
	private $idAboutUs;
	private $titre;
	private $contenu;
    private $lien;
	private $dateCreation;




	/**
	 * Get the value of idAboutUs
	 */ 
	public function getIdAboutUs()
	{
		return $this->idAboutUs;
	}

	/**
	 * Set the value of idAboutUs
	 *
	 * @return  self
	 */ 
	public function setIdAboutUs($idAboutUs)
	{
		$this->idAboutUs = $idAboutUs;

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
     * Get the value of lien
     */ 
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set the value of lien
     *
     * @return  self
     */ 
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

	/**
	 * Get the value of dateCreation
	 */ 
	public function getDateCreation()
	{
		return $this->dateCreation;
	}

	/**
	 * Set the value of dateCreation
	 *
	 * @return  self
	 */ 
	public function setDateCreation($dateCreation)
	{
		$this->dateCreation = $dateCreation;

		return $this;
	}
}