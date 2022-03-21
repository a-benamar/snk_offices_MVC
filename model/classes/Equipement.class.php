<?php

class Equipement{
	
    private $idEquipement;
    private $intituleEquipement;
 
    
	
/*	public function __construct($idEquipement,$intituleEquipement)
	{
    
	$this->idEquipement=$idEquipement;
    $this->intituleEquipement=$intituleEquipement;

  
	}*/

	public function __construct($intituleEquipement)
	{
    
	$this->intituleEquipement=$intituleEquipement;
    
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
	
	/**
	 * Get the value of intituleEquipement
	 */ 
	  function getIntituleEquipement() {
        return $this->intituleEquipement;
    }
	
	/**
	 * Set the value of intituleEquipement
	 */ 
    function setIntituleEquipement($intituleEquipement) {
        $this->intituleEquipement = $intituleEquipement;
    }
		

}


?>