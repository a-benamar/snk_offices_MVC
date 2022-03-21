<?php
require_once("./model/classes/Service.class.php");


class ServiceManager {

    public static function getServiceById($id)
    {
        try {
            
            $connex = etablirCo();
            $sql =$connex->prepare("SELECT * FROM service WHERE idService=:id_Service ");
            $sql->bindParam(":id_Service",$id);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS,"Service");
            $leResultat = ($sql->fetch());
            return $leResultat;

        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }

    /**
     * Extraire tous les services de la table service de la base de données
     * @Return Un array d'objets de la classe Service 
     */

	public static function getAllServices()
    {

        try 
        {
          
            $connex = etablirCo();
            $sql =$connex->prepare("SELECT * FROM service ORDER BY idService");
            $sql->execute();
            $leResultat = ($sql->fetchAll(PDO::FETCH_CLASS,"Service"));
            return $leResultat;

        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }
	
	
	
	
	//ajouter une service
	
	    public static function addService(Service $service)
    {
        try 
        {
            
            $connex = etablirCo();
            $sql =$connex->prepare("INSERT INTO service (libelleService) values(:libelle_Service) ");
			
			$sql->bindValue(":libelle_Service",$service->getLibelleService());
            $leResultat = $sql->execute();  
            return $leResultat;
          

        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }
	
	//modifier les informations d'une service
	
	    public static function updateService(Service $service)
    {
        try 
        {
            $connex = etablirCo();
            $sql =$connex->prepare("UPDATE service set libelleService=:libelle_Service  where idService=:id_Service ");
          
            $sql->bindValue(":libelle_Service",$service->getLibelleService());
            $sql->bindValue(":id_Service",$service->getIdService());
            $leResultat = $sql->execute();  
            return $leResultat;
          

        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }
	
	//supprimer uune service
	
		public static function deleteService(Service $service)
    {   
        
        $connex = etablirCo();
        $sql =$connex->prepare("delete from service  where idService=:id_Service") ;
        $id=$service->getIdService() ;
		$sql->bindParam(':id_Service',$id) ;
        $leResultat = $sql->execute();  
        return $leResultat;
	
    }
	
	
}
?>