<?php

class Service{
	
    private $idService;
    private $libelleService;
 
    
	
	/*public function __construct($idService,$libelleService)
	{
    
	$this->idService=$idService;
    $this->libelleService=$libelleService;

  
	}*/

	/*public function __construct($libelleService)
	{
    
	$this->libelleService=$libelleService;
    
	}*/

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
	
	/**
	 * Get the value of libelleService
	 */ 
	  function getLibelleService() {
        return $this->libelleService;
    }
	
	/**
	 * Set the value of libelleService
	 */ 
    function setLibelleService($libelleService) {
        $this->libelleService = $libelleService;
    }

   
		

}


?>