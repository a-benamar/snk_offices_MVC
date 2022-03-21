<?php
require_once("./model/classes/AboutUs.class.php");


class AboutUsManager {

    private $lePDO;
    
    public function __construct($unPDO)
    {
        $this->lePDO=$unPDO; // assigner le pdo
    }

    public function getAboutUsById($id)
    {
        try 
        {
            
            $connex = $this->lePDO;
            $sql =$connex->prepare("SELECT * FROM aboutus WHERE idAboutUs=:id_AboutUs ");
            $sql->bindParam(":id_AboutUs",$id);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS,"AboutUs");
            $leResultat = ($sql->fetch());
            return $leResultat;

        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }


        /**
     * Extraire tous les images de la table Image de la base de données
     * @Return Un array d'objets de la classe about us 
     */

	public function getAllAboutUs()
    {

        try 
        {
          
            $connex = $this->lePDO;
            $sql =$connex->prepare("SELECT * FROM aboutUs ORDER BY idAboutUs");
            $sql->execute();
            $leResultat = ($sql->fetchAll(PDO::FETCH_CLASS,"AboutUs"));
            return $leResultat;

        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }

    //ajouter une about us
	
    public function addAboutUs(AboutUs $aboutUs)
    {
        try 
        {

            $connex = $this->lePDO;
            $sql =$connex->prepare("INSERT INTO aboutus (titre, contenu, lien) values(:titre, :contenu, :lien ) ");
			
			$sql->bindValue(":titre",$aboutUs->getTitre());
            $sql->bindValue(":contenu",$aboutUs->getContenu());
            $sql->bindValue(":lien",$aboutUs->getLien());
            $sql->execute();            
            $leResultat = $sql->execute();  
            return $leResultat;          

        } catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }
	
	//modifier les information about us
	
	    public function updateAboutUs(AboutUs $aboutUs)
    {
        try 
        {

            $connex = $this->lePDO;
            $sql =$connex->prepare("UPDATE aboutus set titre=:titre, lien=:lien, contenu=:contenu where idAboutUs=:id_AboutUs ");
          
            $sql->bindValue(":titre",$aboutUs->getTitre());
            $sql->bindValue(":lien",$aboutUs->getLien());
            $sql->bindValue(":contenu",$aboutUs->getContenu());
            $sql->bindValue(":id_AboutUs",$aboutUs->getIdAboutUs());
            $leResultat = $sql->execute();  
            return $leResultat;


        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }
	
	//supprimer une about us
	
		public function deleteAboutUsByIdAboutUs($id)
    {
        
        $connex = $this->lePDO;
        $sql =$connex->prepare(" DELETE FROM aboutus where idAboutUs=:id_AboutUs") ;
		$sql->bindParam(':id_AboutUs',$id) ;
        $leResultat = $sql->execute();  
        return $leResultat;
	
    }
	

}

?>