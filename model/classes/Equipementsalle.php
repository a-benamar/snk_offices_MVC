<?php

class Equipementsalle{
	
    private $idSalle;
    private $idEquipement;
 
    
	
	/*public function __construct($idEquipement)
	{
    
    $this->idEquipement=$idEquipement;

  
	}*/


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
	 * Get the value of idEquipement
	 */ 
	  function getIdEquipement() {
        return $this->idEquipement;
    }
	
	/**
	 * Set the value of idEquipement
	 */ 
    function setIdEquipement($idEquipement) {
        $this->idEquipement = $idEquipement;
    }
		

}


?>