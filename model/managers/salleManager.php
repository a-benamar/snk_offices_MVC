<?php
require_once("./model/classes/Salle.class.php");
require_once("./model/classes/Reservation.class.php");


class SalleManager {

    private $lePDO;
    
    public function __construct($unPDO)
    {
        $this->lePDO=$unPDO; // assigner le pdo
    }


    public function getSalleById($id)
    {
        try 
        {
            
            $connex = $this->lePDO;
            $sql =$connex->prepare("SELECT * FROM salle WHERE idSalle=:id_salle ");
            $sql->bindParam(":id_salle",$id);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS,"Salle");
            $leResultat = ($sql->fetch());
            return $leResultat;

        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }

    public function getSalleByNom($nomSalle)
    {
        try 
        {
            
            $connex = $this->lePDO;
            $sql =$connex->prepare("SELECT * FROM salle WHERE nomSalle=:nom_salle ");
            $sql->bindParam(":nom_salle",$nomSalle);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS,"Salle");
            $leResultat = ($sql->fetch());
            return $leResultat;

        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }



    /**
     * Extraire tous les salles de la table Salle de la base de données
     * @Return Un array d'objets de la classe Salle 
     */

	public function getAllSalles()
    {

        try 
        {
          
            $connex = $this->lePDO;
            $sql =$connex->prepare("SELECT * FROM salle ORDER BY idSalle");
            $sql->execute();
            $leResultat = ($sql->fetchAll(PDO::FETCH_CLASS,"Salle"));
            return $leResultat;

        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }
	
	
	
	
	//ajouter une salle
	
	    public function addSalle(Salle $salle)
    {
        try 
        {

            $connex = $this->lePDO;
            $sql =$connex->prepare("INSERT INTO salle (nomSalle,typeSalle,capSalle,villeSalle,statusSalle,prixSalle, descriptionSalle) values(:nom_Salle,:type_Salle,:cap_Salle,:ville_Salle,:status_Salle,:prix_Salle, :description_Salle ) ");
			
			$sql->bindValue(":nom_Salle",$salle->getNomSalle());
            $sql->bindValue(":type_Salle",$salle->getTypeSalle());
            $sql->bindValue(":cap_Salle",$salle->getCapSalle());
			$sql->bindValue(":ville_Salle",$salle->getVilleSalle());
			$sql->bindValue(":status_Salle",$salle->getStatusSalle());
			$sql->bindValue(":prix_Salle",$salle->getPrixSalle());
            $sql->bindValue(":description_Salle",$salle->getDescriptionSalle());
            $leResultat = $sql->execute();
            return $leResultat;
          

        } catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }
	
	//modifier les information d'une salle
	
	    public function updateSalle(Salle $salle)
    {
        try 
        {

            $connex = $this->lePDO;
            $sql =$connex->prepare("UPDATE salle set nomSalle=:nom_Salle, typeSalle=:type_Salle, capSalle=:cap_Salle, villeSalle=:ville_Salle, statusSalle=:status_Salle, prixSalle=:prix_Salle, descriptionSalle=:description_Salle where idSalle=:id_Salle ");
          
            $sql->bindValue(":nom_Salle",$salle->getNomSalle());
            $sql->bindValue(":type_Salle",$salle->getTypeSalle());
            $sql->bindValue(":cap_Salle",$salle->getCapSalle());
			$sql->bindValue(":ville_Salle",$salle->getVilleSalle());
			$sql->bindValue(":status_Salle",$salle->getStatusSalle());
			$sql->bindValue(":prix_Salle",$salle->getPrixSalle());
            $sql->bindValue(":description_Salle",$salle->getDescriptionSalle());
            $sql->bindValue(":id_Salle",$salle->getIdSalle());
            $leResultat = $sql->execute();
            return $leResultat;
          

        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }
	
	//supprimer une salle
	

    public function deleteSalleById($id)
    {
        try {
            $connex = $this->lePDO;
            $connex->beginTransaction();

            $sql = $connex->prepare("DELETE FROM image where idSalle=:id_Salle");
            $sql->bindParam(":id_Salle", $id);
            $sql->execute();

            $sql2 = $connex->prepare("DELETE FROM salle where idSalle=:id_Salle");
            $sql2->bindParam(':id_Salle', $id);
            $sql2->execute();
            $connex->commit();

            return true;

            
        } catch (PDOException $error) {
            $connex->rollBack();
            echo "Echec" . $error->getMessage();
            return false;
        }
    }

	
        //extraire les salle ayant l'equipement equip

        // public function getSallesEquip(Equipement $equip)
        // {
        //   try 
        //     {
        //     $connex = $this->lePDO;
        //     $sql =$connex->prepare("select*from salle where idEquipement in (select idEquipement from sequipementSalle  where idEquipement=:id_equip)") ;
        //     $idEquip=$equip->getIdEquipement() ;
        //     $sql->bindValue(':id_equip',$idEquip) ;
        //     $sql->execute();
        //     $resultat = ($sql->fetchAll(PDO::FETCH_CLASS,"Salle"));
        //     return $resultat;
        //     } 
        //     catch (PDOException $error) 
        //      {
        //     echo $error->getMessage();
        //     }
        //  }


    //vérifier que la salle est disponible
    public function isDispo($reservation, $date_Debut, $date_Fin)
    {
    $connex = $this->lePDO;        
       $sql = $connex->prepare("SELECT * FROM reservation where (idSalle =:id_Salle) and ((dateDebut BETWEEN :date_Debut AND :date_Fin) OR (dateFin BETWEEN :date_Debut and :date_Fin)) OR (dateDebut<:date_Debut and dateFin>:date_Fin)") ;
    
        $sql->bindValue(':id_Salle',$reservation->getIdSalle());
        $sql->bindValue(':date_Debut', $date_Debut->format('Y-m-d H:i:s'));
        $sql->bindValue(':date_Fin', $date_Fin->format('Y-m-d H:i:s'));
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_CLASS,'Reservation') ;
        $leResultat = $sql->fetchAll();

        $nb_lignes= count($leResultat) ; 

        if ($nb_lignes==0) {return true;}

        else {return false;}
    }
}
?>

