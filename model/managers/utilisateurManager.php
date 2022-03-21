<?php
require("./model/classes/Utilisateur.class.php");


class UtilisateurManager
{

    private $lePDO;

    public function __construct($unPDO)
    {
        $this->lePDO = $unPDO; // assigner le pdo: on va mettre donner la valeur de parametre unPDO a l'attribut lePDO
    }


    public function getUtilisateurById($id)
    {
        try {

            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM utilisateur WHERE idUtilisateur=:id_Utilisateur ");
            $sql->bindParam(":id_Utilisateur", $id);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS, "Utilisateur");
            $resultat = ($sql->fetch());
            return $resultat;
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }



    public function getUtilisateurByEmail($email)
    {
        try {

            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM utilisateur WHERE email=:email_Utilisateur ");
            $sql->bindParam(":email_Utilisateur", $email);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS, "Utilisateur");
            $leResultat = ($sql->fetch());
            return $leResultat;

        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }


    //chercher utilisateur par email et mdp

    public function getUtilisateurByEmailAndPassword($email, $password)
    {
        try {

            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM utilisateur WHERE email=:email_Utilisateur AND mdp=:mdp_Utilisateur ");
            $sql->bindParam(":email_Utilisateur", $email);
            $sql->bindParam(":mdp_Utilisateur", $password);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS, "Utilisateur");
            $leResultat = ($sql->fetch());
            return $leResultat;

        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    /**
     * Extraire tous les utilisateurs de la table Utilisateur de la base de données
     * @Return Un array d'objets de la classe Utilisateur 
     */

    public function getAllUtilisateurs()
    {

        try {

            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM utilisateur ORDER BY idUtilisateur");
            $sql->execute();
            $leResultat = ($sql->fetchAll(PDO::FETCH_CLASS, "Utilisateur"));
            return $leResultat;

        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }




    //ajouter un utilisateur

    public function addUtilisateur(Utilisateur $utilisateur)
    {
        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("INSERT INTO utilisateur (pseudo,nom,prenom,email,mdp,adresse,cp,ville,tel) values(:pseudoUtilisateur,:nomUtilisateur,:prenomUtilisateur,:emailUtilisateur,:mdpUtilisateur,:adresseUtilisateur,:cp,:villeUtilisateur,:telUtilisateur)");

            $sql->bindValue(":pseudoUtilisateur", $utilisateur->getPseudo());
            $sql->bindValue(":nomUtilisateur", $utilisateur->getNom());
            $sql->bindValue(":prenomUtilisateur", $utilisateur->getPrenom());
            $sql->bindValue(":emailUtilisateur", $utilisateur->getEmail());
            $sql->bindValue(":mdpUtilisateur", $utilisateur->getMdp());
            $sql->bindValue(":adresseUtilisateur", $utilisateur->getAdresse());
            $sql->bindValue(":cp", $utilisateur->getCp());
            $sql->bindValue(":villeUtilisateur", $utilisateur->getVille());
            $sql->bindValue(":telUtilisateur", $utilisateur->getTel());
            $leResultat = $sql->execute();  
            return $leResultat;

        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    //modifier les informations d'un utilisateur
    /**
     * 
     */
    public function updateUtilisateur(Utilisateur $utilisateur)
    {
        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("UPDATE utilisateur set pseudo= :pseudoUtilisateur, nom=:nomUtilisateur, prenom=:prenomUtilisateur, email=:emailUtilisateur, mdp=:mdpUtilisateur,adresse=:adresseUtilisateur,cp=:codePostale, ville=:villeUtilisateur,tel=:telUtilisateur where idUtilisateur=:id_Utilisateur ");

            $sql->bindValue(":id_Utilisateur", $utilisateur->getIdUtilisateur());
            $sql->bindValue(":pseudoUtilisateur", $utilisateur->getPseudo());
            $sql->bindValue(":nomUtilisateur", $utilisateur->getNom());
            $sql->bindValue(":prenomUtilisateur", $utilisateur->getPrenom());
            $sql->bindValue(":emailUtilisateur", $utilisateur->getEmail());
            $sql->bindValue(":mdpUtilisateur", $utilisateur->getMdp());
            $sql->bindValue(":adresseUtilisateur", $utilisateur->getAdresse());
            $sql->bindValue(":codePostale", $utilisateur->getCp());
            $sql->bindValue(":villeUtilisateur", $utilisateur->getVille());
            $sql->bindValue(":telUtilisateur", $utilisateur->getTel());
            $leResultat = $sql->execute();  
            return $leResultat;

        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    //supprimer un utilisateur

    public function deleteUtilisateurById($id)
    {
        try {
            $connex = $this->lePDO;
            $connex->beginTransaction();

            $sql = $connex->prepare("DELETE FROM reservation where idUtilisateur=:id_Utilisateur");
            $sql->bindParam(":id_Utilisateur", $id);
            $sql->execute();

            $sql2 = $connex->prepare("DELETE FROM utilisateur  where idUtilisateur=:id_Utilisateur");
            $sql2->bindParam(':id_Utilisateur', $id);
            $sql2->execute();
            $connex->commit();
            return true;

        } catch (PDOException $error) {
            $connex->rollBack();
            echo "Echec: " . $error->getMessage();
            return false;
        }
    }
}
