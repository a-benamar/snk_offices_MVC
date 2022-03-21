<?php
require_once("./model/classes/Image.class.php");


class ImageManager {

    private $lePDO;
    
    public function __construct($unPDO)
    {
        $this->lePDO=$unPDO; // assigner le pdo
    }

    public function getImageById($id)
    {
        try 
        {
            
            $connex = $this->lePDO;
            $sql =$connex->prepare("SELECT * FROM image WHERE idImage=:id_Image ");
            $sql->bindParam(":id_Image",$id);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS,"Image");
            $leResultat = ($sql->fetch());
            return $leResultat;

        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }


    public function getImageByIdSalle($idSalle)
    {
        try 
        {
            
            $connex = $this->lePDO;
            $sql =$connex->prepare("SELECT * FROM image WHERE idSalle=:id_Salle");
            $sql->bindParam(":id_Salle",$idSalle);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS,"Image");
            $leResultat = ($sql->fetchAll());
            return $leResultat;

        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }

    


    public function getImageByEstPrincipale($estPrincipale)
    {
        try 
        {
            
            $connex = $this->lePDO;
            $sql =$connex->prepare("SELECT * FROM image WHERE  estPrincipale = :est_Principale ");
            $sql->bindParam(":est_Principale",$estPrincipale);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS,"Image");
            $leResultat = ($sql->fetchAll());
            return $leResultat;

        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }


    
    public function getMaxIdImage()
    {
        try 
        {
            
            $connex = $this->lePDO;
            $sql =$connex->prepare("SELECT max(idImage) as max_id FROM image");
            $sql->execute();
            $resultat = ($sql->fetch(PDO::FETCH_ASSOC));
            $leResultat = $resultat['max_id'];
            return $leResultat;

        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }


        /**
     * Extraire tous les images de la table Image de la base de données
     * @Return Un array d'objets de la classe Salle 
     */

	public function getAllImages()
    {

        try 
        {
          
            $connex = $this->lePDO;
            $sql =$connex->prepare("SELECT * FROM image ORDER BY idImage");
            $sql->execute();
            $leResultat = ($sql->fetchAll(PDO::FETCH_CLASS,"Image"));
            return $leResultat;

        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }

    //ajouter une salle
	
    public function addImage(Image $image)
    {
        try 
        {

            $connex = $this->lePDO;
            $sql =$connex->prepare("INSERT INTO image (idSalle, image, estPrincipale) values (:id_Salle, :image, :estPrincipale ) ");
            $sql->bindValue(":id_Salle",$image->getIdSalle());
            $sql->bindValue(":image",$image->getImage());
            $sql->bindValue(":estPrincipale",$image->getEstPrincipale());
            $leResultat = $sql->execute();  
            return $leResultat;
          

        } catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }
	
	//modifier les information d'une salle
	
	    public function updateImage(Image $image)
    {
        try 
        {

            $connex = $this->lePDO;
            $sql =$connex->prepare("UPDATE image set idSalle=:id_Salle, image=:image,estPrincipale=:estPrincipale where idImage=:id_Image ");
          
            $sql->bindValue(":id_Image",$image->getIdImage()); 
            $sql->bindValue(":id_Salle",$image->getIdSalle()); 
            $sql->bindValue(":image",$image->getImage());
            $sql->bindValue(":estPrincipale",$image->getEstPrincipale());
            $leResultat = $sql->execute();  
            return $leResultat;
          
        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }
	
	//supprimer une salle
	
		public function deleteImageByIdImage($id)
    {
        
        $connex = $this->lePDO;
        $sql =$connex->prepare(" DELETE FROM image  where idImage=:id_Image") ;
		$sql->bindParam(':id_Image',$id) ;
        $leResultat = $sql->execute();  
        return $leResultat;
	
    }
	

}

?>