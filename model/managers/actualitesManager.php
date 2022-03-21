<?php
require_once("./model/classes/Actualites.class.php");


class ActualitesManager {

    private $lePDO;
    
    public function __construct($unPDO)
    {
        $this->lePDO=$unPDO; // assigner le pdo
    }

    public function getActualitesById($id)
    {
        try 
        {
            
            $connex = $this->lePDO;
            $sql =$connex->prepare("SELECT * FROM actualites WHERE idActualites=:id_Actualites LIMIT 1");
            $sql->bindParam(":id_Actualites",$id);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS,"Actualites");
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
     * @Return Un array d'objets de la classe actualites
     */

	public function getAllActualites()
    {

        try 
        {
          
            $connex = $this->lePDO;
            $sql =$connex->prepare("SELECT * FROM actualites ORDER BY datePub");
            $sql->execute();
            $leResultat = ($sql->fetchAll(PDO::FETCH_CLASS,"Actualites"));
            return $leResultat;

        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }

    //ajouter une actualites
	
    public function addActualites(Actualites $actualites)
    {
        try 
        {

            $connex = $this->lePDO;
            $sql =$connex->prepare("INSERT INTO actualites (titre, contenu ) values(:titre, :contenu) ");
			
			$sql->bindValue(":titre",$actualites->getTitre());
            $sql->bindValue(":contenu",$actualites->getContenu());           
            $leResultat = $sql->execute();  
            return $leResultat;          

        } catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }
	
	
	
	    public function updateActualites(Actualites $actualites)
    {
        try 
        {

            $connex = $this->lePDO;
            $sql =$connex->prepare("UPDATE actualites set titre=:titre, contenu=:contenu where idActualites=:id_Actualites ");    
            $sql->bindValue(":titre",$actualites->getTitre());
            $sql->bindValue(":contenu",$actualites->getContenu());
            $sql->bindValue(":id_Actualites",$actualites->getIdActualites());
            $leResultat = $sql->execute();  
            return $leResultat;


        } 
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }
	
	//supprimer une actualites
	
		public function deleteActualitesByIdActualites($id)
    {
        
        $connex = $this->lePDO;
        $sql =$connex->prepare(" DELETE FROM actualites where idActualites=:id_Actualites") ;
		$sql->bindParam(':id_Actualites',$id) ;
        $leResultat = $sql->execute();  
        return $leResultat;
	
    }

    // la fonction qui deduire le texte de contenu à 20 mots dans les cartes.

function tronquer($contenu){
				
	$texte_tronque = "";			
	$chaine_explode = explode(" ", $contenu);
	

	for($i = 0; $i < 20; $i++){
	$texte_tronque .= $chaine_explode[$i] . " ";
	}

	return $texte_tronque . "(...)";

}
	

}

?>