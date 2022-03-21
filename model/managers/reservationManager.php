<?php
require_once("./model/classes/Reservation.class.php");


class ReservationManager
{

    private $lePDO;

    public function __construct($unPDO)
    {
        $this->lePDO = $unPDO; // assigner le pdo
    }

    public function getReservationById($id)
    {
        try {

            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM reservation WHERE idReservation=:id_reservation ");

            $sql->bindParam(":id_reservation", $id);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS, "Reservation");
            $leResultat = ($sql->fetch());
            return $leResultat;
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    public function getReservationByIdUtilisateur($idUtilisateur)
    {
        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM reservation WHERE idUtilisateur=:id_utilisateur ORDER BY dateReservation ");
            $sql->bindParam(":id_utilisateur", $idUtilisateur);
            $sql->execute();
            $leResultat = ($sql->fetchAll(PDO::FETCH_CLASS, "Reservation"));
            return $leResultat;
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }


    /**
     * Extraire tous les reservations de la table Reservation de la base de données
     * @Return Un array d'objets de la classe Reservation 
     */

    public function getAllReservations()
    {

        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM reservation ORDER BY idReservation");
            $sql->execute();
            $leResultat = ($sql->fetchAll(PDO::FETCH_CLASS, "Reservation"));

            return $leResultat;
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    //Extraires les reservation d'une date
    public function getReservationsByDate($date)
    {

        try {


            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM reservation where dateReservation=:date_Reservation");
            $sql->bindParam(":date_Reservation", $date);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS, "Reservation");
            $leResultat = ($sql->fetch());
            return $leResultat;
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }


    //ajouter une reservation
    public function addReservation(Reservation $reservation)
    {
        try {

            $connex = $this->lePDO;
            $sql = $connex->prepare("INSERT INTO reservation (dateDebut, dateFin, nbreParticipant, evenement, description, idUtilisateur, idSalle) values(:date_Debut,:date_Fin,:nbre_Participant, :evenement, :description, :id_Utilisateur, :id_Salle) ");

            $sql->bindValue(":date_Debut", $reservation->getDateDebut()->format('Y-m-d H:i:s'));
            $sql->bindValue(":date_Fin", $reservation->getDateFin()->format('Y-m-d H:i:s'));
            $sql->bindValue(":nbre_Participant", $reservation->getNbreParticipant());
            $sql->bindValue(":evenement", $reservation->getEvenement());
            $sql->bindValue(":description", $reservation->getDescription());
            $sql->bindValue(":id_Utilisateur", $reservation->getIdUtilisateur());
            $sql->bindValue(":id_Salle", $reservation->getIdSalle());
            $leResultat = $sql->execute();
            return $leResultat;
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    //modifier les informations d'un reservation

    public function updateReservation(Reservation $reservation)
    {
        try {

            $connex = $this->lePDO;
            $sql = $connex->prepare("UPDATE reservation set dateDebut=:date_Debut, dateFin=:date_Fin, nbreParticipant=:nbre_Participant, evenement=:evenement, idUtilisateur=:id_Utilisateur, idSalle=:id_Salle, description=:description where idReservation=:id_Reservation ");

            $sql->bindValue(":id_Reservation", $reservation->getIdReservation());
            $sql->bindValue(":date_Debut", $reservation->getDateDebut()->format('Y-m-d H:i:s'));
            $sql->bindValue(":date_Fin", $reservation->getDateFin()->format('Y-m-d H:i:s'));
            $sql->bindValue(":nbre_Participant", $reservation->getNbreParticipant());
            $sql->bindValue(":description", $reservation->getDescription());
            $sql->bindValue(":evenement", $reservation->getEvenement());
            $sql->bindValue(":id_Utilisateur", $reservation->getIdUtilisateur());
            $sql->bindValue(":id_Salle", $reservation->getIdSalle());
            $leResultat = $sql->execute();
            return $leResultat;
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    //supprimer une reservation

    public function deleteReservationById($id)
    {

        $connex = $this->lePDO;
        $sql = $connex->prepare("DELETE FROM reservation  where idReservation=:id_Reservation");
        $sql->bindParam(':id_Reservation', $id);
        $leResultat = $sql->execute();
        return $leResultat;
    }
}
