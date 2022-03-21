<?php
require_once("./model/classes/Admin.class.php");

class AdminManager {

    private $lePDO;
    
    public function __construct($unPDO)
    {
        $this->lePDO=$unPDO; 
    }

    public function getAdminById($id)
    {
        try {
            
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM admin WHERE idAdmin = :id_Admin ");
            $sql->bindParam(":id_Admin",$id);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS,"Admin");
            $leResultat = ($sql->fetch());
            return $leResultat;

        }
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }

    public function getAdminByEmail($email)
    {
        try 
        {    
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM admin WHERE email=:email_Admin ");
            $sql->bindParam(":email_Admin",$email);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS,"Admin");
            $leResultat = ($sql->fetch());
            return $leResultat;

        }
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }

	
	//chercher l'admin par email et mdp
	  
    public function getAdminByEmailAndPassword($email, $password)
    {
        try 
        {    
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM admin WHERE email=:email_Admin And mdp=:password_Admin ");
            $sql->bindParam(":email_Admin",$email);
            $sql->bindParam(":password_Admin",$password);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS,"Admin");
            $leResultat = ($sql->fetch());
            return $leResultat;

        }
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }


	public function getAllAdmins()
    {
        try
        {
            $connex = $this->lePDO;
            $sql =$connex->prepare("SELECT * FROM admin ORDER BY idAdmin");
            $sql->execute();
            $leResultat = ($sql->fetchAll(PDO::FETCH_CLASS,"Admin"));
            return $leResultat;

        }
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }
	
	
	
	
	//ajouter un admin
	
	    public function addAdmin(Admin $admin)
    {
        try
        {
           
            $connex = $this->lePDO;
            $sql =$connex->prepare("INSERT INTO admin (pseudo,nom,prenom,email,mdp) values(:pseudoAdmin,:nomAdmin,:prenomAdmin,:emailAdmin,:mdpAdmin)");
            $sql->bindValue(":pseudoAdmin",$admin->getPseudo());
            $sql->bindValue(":nomAdmin",$admin->getNom());
            $sql->bindValue(":prenomAdmin",$admin->getPrenom());
            $sql->bindValue(":emailAdmin",$admin->getEmail());
			$sql->bindValue(":mdpAdmin",$admin->getMdp());
            $leResultat = $sql->execute();  
            return $leResultat;
          

        }
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }
	
	//modifier les informations d'un admin
	
	    public function updateAdmin(Admin $admin)
    {
        try
        {
            $connex = $this->lePDO;
            $sql =$connex->prepare("UPDATE admin set pseudo=:pseudoAdmin,nom=:nomAdmin, prenom=:prenomAdmin, email=:emailAdmin, mdp=:mdpAdmin  where idAdmin=:id_Admin ");
          
            $sql->bindValue(":id_Admin",$admin->getIdAdmin());
            $sql->bindValue(":pseudoAdmin",$admin->getPseudo());
            $sql->bindValue(":nomAdmin",$admin->getNom());
            $sql->bindValue(":prenomAdmin",$admin->getPrenom());
            $sql->bindValue(":emailAdmin",$admin->getEmail());
			$sql->bindValue(":mdpAdmin",$admin->getMdp());
            $leResultat = $sql->execute();  
            return $leResultat;
        }
        catch (PDOException $error) 
        {
            echo $error->getMessage();
        }
    }
	
	//supprimer un Admin
	
		public function deleteAdminByIdAdmin($id)
    {
        try 
            {
            $connex = $this->lePDO;
            $sql = $connex->prepare("DELETE FROM admin where idAdmin=:id_Admin") ;
            $sql->bindParam(':id_Admin',$id) ;
            $leResultat = $sql->execute();  
            return $leResultat;

            }
            catch (PDOException $error) 
            {
                echo $error->getMessage();
            }
	
    }

}
