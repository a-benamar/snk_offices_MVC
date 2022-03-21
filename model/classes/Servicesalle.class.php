<?php

class Equipementsalle{
	
    private $idSalle;
    private $idService;
 
    
	
	/*public function __construct($idSalle,$idService)
	{
    
	$this->idSalle=$idSalle;
    $this->idService=$idService;

  
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
	 * Get the value of idService
	 */ 
	  function getIdService() {
        return $this->idService;
    }
	
	/**
	 * Set the value of idService
	 */ 
    function setIdService($idService) {
        $this->idService = $idService;
    }
		

}


?>