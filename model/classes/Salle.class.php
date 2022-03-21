<?php

class Salle{
	
    private $idSalle;
    private $nomSalle;
	private $typeSalle;
	private $capSalle;
	private $villeSalle;
	private $statusSalle;
	private $prixSalle;
	private $descriptionSalle;

	/**
	 * Get the value of idSalle
	 */ 
    function getIdSalle() {
        return $this->idSalle;
    }

    /**
	 * Set the value of idSalle
	 */ 
	function setIdSalle($idSalle) {
        $this->idSalle = $idSalle;
    }
	
	
	/**
	 * Get the value of nomSalle
	 */ 
	function getNomSalle() {
        return $this->nomSalle;
    }
	
	/**
	 * Set the value of nomSalle
	 */ 
    function setNomSalle($nomSalle) {
        $this->nomSalle = $nomSalle;
    }
	

	/**
	 * Get the value of typeSalle
	 */ 
    function getTypeSalle() {
        return $this->typeSalle;
    }

    /**
	 * Set the value of typeSalle
	 */ 
	 function setTypeSalle($typeSalle) {
        $this->typeSalle = $typeSalle;
    }
	
	
	/**
	 * Get the value of capSalle
	 */ 
	 function getCapSalle() {
        return $this->capSalle;
    }

    /**
	 * Set the value of capSalle
	 */ 
	 function setCapSalle($capSalle) {
        $this->capSalle = $capSalle;
    }
	
	/**
	 * Get the value of villeSalle
	 */ 
	 function getVilleSalle() {
        return $this->villeSalle;
    }

	/**
	 * Set the value of villeSalle
	 */ 
	 function setVilleSalle($villeSalle) {
        $this->villeSalle = $villeSalle;
    }
	
	/**
	 * Get the value of statusSalle
	 */ 
	function getStatusSalle() {
        return $this->statusSalle;
    }

   /**
	 * Set the value of statusSalle
	 */ 
	function setStatusSalle($statusSalle) {
        $this->statusSalle = $statusSalle;
    }
	
	/**
	 * Get the value of prixSalle
	 */ 
	function getPrixSalle() {
        return $this->prixSalle;
    }

   /**
	 * Set the value of prixSalle
	 */ 
	function setPrixSalle($prixSalle) {
        $this->prixSalle = $prixSalle;
    }
		


	/**
	 * Get the value of descriptionSalle
	 */ 
	public function getDescriptionSalle()
	{
		return $this->descriptionSalle;
	}

	/**
	 * Set the value of descriptionSalle
	 *
	 * @return  self
	 */ 
	public function setDescriptionSalle($descriptionSalle)
	{
		$this->descriptionSalle = $descriptionSalle;

		return $this;
	}
}

?>
