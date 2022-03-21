<?php
require_once("./model/classes/Equipement.class.php");

class EquipementManager {

  
    public static function getEquipementById($id)
    {
        try {
           
            $connex = etablirCo();
            $sql =$connex->prepare("SELECT * FROM equipement WHERE idEquipement=:id_Equipement ");
            $sql->bindParam(":id_Equipement",$id);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS,"Equipement");
            $leResultat = ($sql->fetch());
            return $leResultat;

        } catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }

    /**
     * Extraire tous les equipements de la table Equipement de la base de données
     * @Return Un array d'objets de la classe Equipement 
     */

	public static function getAllEquipements()
    {

        try {
          
            $connex = etablirCo();
            $sql =$connex->prepare("SELECT * FROM equipement ORDER BY idEquipement");
            $sql->execute();
            $leResultat = ($sql->fetchAll(PDO::FETCH_CLASS,"Equipement"));
            return $leResultat;

        } catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }
	
	
	
	
	//ajouter un Equipement
	
	    public static function addEquipement(Equipement $equipement)
    {
        try 
        {
           
            $connex = etablirCo();
            $sql =$connex->prepare("INSERT INTO equipement (intituleEquipement) values(:intitule_Equipement) ");
			
			$sql->bindValue(":intitule_Equipement",$equipement->getIntituleEquipement());
            $leResultat = $sql->execute();  
            return $leResultat;
          

        } catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }
	
	//modifier les informations d'un equipement
	
	    public static function updateEquipement(Equipement $equipement)
    {
        try {
            
            $connex = etablirCo();
            $sql =$connex->prepare("UPDATE equipement set intituleEquipement=:intitule_Equipement  where idEquipement=:id_Equipement ");
          
            $sql->bindValue(":intitule_Equipement",$equipement->getIntituleEquipement());
            $sql->bindValue(":id_Equipement",$equipement->getIdEquipement());
            $leResultat = $sql->execute();  
            return $leResultat;
          

        } catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }
	
	//supprimer uun equipement
	
		public static function deleteEquipement(Equipement $equipement)
    {
        
        $connex = etablirCo();
        $sql =$connex->prepare("DELETE FROM equipement  where idEquipement=:id_Equipement") ;
        $id=$equipement->getIdEquipement() ;
		$sql->bindParam(':id_Equipement',$id) ;
        $leResultat = $sql->execute();  
        return $leResultat;
	
    }
	
    //extraire les equipements d'une salle

    public static function getEquipSalle(Salle $salle){

     try
     {
        $connex = etablirCo();
        $sql =$connex->prepare("SELECT * FROM equipement where idEquipement in(SELECT idEquipement FROM equipementSalle  where idSalle=:id_Salle)") ;
        
        $idSalle=$salle->getIdSalle() ;
		$sql->bindValue(':id_Salle',$idSalle) ;
        $sql->execute();
        $leResultat = ($sql->fetchAll(PDO::FETCH_CLASS,"Equipement"));
        return $leResultat;

    } catch (PDOException $error) 
    {
        echo $error->getMessage();
    }
    }
 //extraire les services d'une salle

    public static function getServiceSalle(Salle $salle){

        try
        {
           $connex = etablirCo();
           $sql =$connex->prepare("SELECT * FROM service where idService in(SELECT idService FROM serviceSalle  where idSalle=:id_Salle)") ;
           $idSalle=$salle->getIdSalle() ;
           $sql->bindValue(':id_Salle',$idSalle) ;
           $sql->execute();
           $leResultat = ($sql->fetchAll(PDO::FETCH_CLASS,"Service"));
           return $leResultat;
           
       } catch (PDOException $error) 
       {
           echo $error->getMessage();
       }
       }

}
?>