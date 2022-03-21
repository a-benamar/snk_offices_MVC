<?php
ini_set('display_errors', 'on');
//TODO Verification Admin
require_once("./model/managers/adminManager.php");
require_once("./model/managers/utilisateurManager.php");
require_once("./model/managers/equipementManager.php");
require_once("./model/managers/reservationManager.php");
require_once("./model/managers/salleManager.php");
require_once("./model/managers/serviceManager.php");

if (!isset($_GET['action'])) {
    $action = "client";
} else {
    $action = filter_var($_GET['action'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}


switch ($action) {

    case "profil-client":

        $idUtilisateur      = $_SESSION['id'];
        $utilisateurManager = new UtilisateurManager($lePDO);
        $utilisateur        = $utilisateurManager->getUtilisateurById($idUtilisateur);

        require('view/utilisateur/profil.php');

        break;

    case "edit-profil-client":
        // debut update user 
        if (isset($_GET['edit_id'])) {

            $edit_id            =  filter_var($_GET['edit_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $utilisateurManager = new UtilisateurManager($lePDO);
            $utilisateur        = $utilisateurManager->getUtilisateurById($edit_id);

            require_once('view/utilisateur/edit-profil-client.php');
        }

        // fin update user

        break;

    case "traitement-edit-profil-client":

        //traitement update user
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            $_SESSION['error'] = "Une erreur est survenue : la methode POST est attendu";
            header("location:./?path=client&action=traitement-edit-profil-client");
            exit;
        }

        if (isset($_POST['edit_id'], $_POST['edit_pseudo'], $_POST['edit_nom'], $_POST['edit_prenom'], $_POST['edit_email'], $_POST['edit_tel'], $_POST['edit_mdp'])) {

            if (!empty($_POST['edit_pseudo']) && !empty($_POST['edit_nom']) && !empty($_POST['edit_prenom']) && !empty($_POST['edit_email']) && !empty($_POST['edit_tel']) && !empty($_POST['edit_mdp']) && !empty($_POST['edit_c_mdp'])) {

                $user_id         = trim(filter_var($_POST['edit_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_pseudo     = trim(filter_var($_POST['edit_pseudo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_nom        = trim(filter_var($_POST['edit_nom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_prenom     = trim(filter_var($_POST['edit_prenom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_email      = trim(filter_var($_POST['edit_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_tel        = trim(filter_var($_POST['edit_tel'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_password   = trim(filter_var($_POST['edit_mdp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_c_password = trim(filter_var($_POST['edit_c_mdp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_adresse    = trim(filter_var($_POST['edit_adresse'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_ville      = trim(filter_var($_POST['edit_ville'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_cp         = trim(filter_var($_POST['edit_cp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                //Formater le nom et le prénom proprement 
                $user_nom        =  strtoupper($user_nom);
                $user_prenom     =  ucfirst(strtolower($user_prenom));
                $user_adresse    =  ucfirst($user_adresse);
                $user_ville      =  ucfirst($user_ville);

                // on verifie si les deux mdp saisis sont bon
                if ($user_password !== $user_c_password) {

                    $_SESSION['error'] = "Les mots de passe sont pas identiques";
                    header('Location:./?path=client&action=profil-client');
                    exit;
                }

                // on va hasher le mot de passe
                $user_password = hash("sha256", $user_password);

                $utilisateur = new Utilisateur();
                $utilisateur->setIdUtilisateur($user_id);
                $utilisateur->setPseudo($user_pseudo);
                $utilisateur->setNom($user_nom);
                $utilisateur->setPrenom($user_prenom);
                $utilisateur->setEmail($user_email);
                $utilisateur->setTel($user_tel);
                $utilisateur->setMdp($user_password);
                $utilisateur->setAdresse($user_adresse);
                $utilisateur->setVille($user_ville);
                $utilisateur->setCp($user_cp);

                $utilisateurManager = new UtilisateurManager($lePDO);
                $updateOk           = $utilisateurManager->updateUtilisateur($utilisateur);

                if ($updateOk) {
                    $_SESSION['success'] = "Mise à jour effectuée avec succès ...";
                    header('Location:./?path=client&action=profil-client');
                    exit;
                } else {
                    $_SESSION['error'] = "Une erreur est survenue lors des modifications";
                    header('Location:./?path=client&action=profil-client');
                }
            } else {
                $_SESSION['error'] = "Une erreur est survenue, Merci de remplir tous les champs";
                header('Location:./?path=client&action=profil-client');
            }
        } else {

            $_SESSION['error'] = "Une erreur est survenue, Merci de ressayer";
            header('Location:./?path=client&action=profil-client');
        }

        //fin traitement update client

        break;

    case "delete-compte-client":

        if (isset($_POST['delete_btn'])) {

            if (isset($_POST['delete_id'])) {

                $delete_id           =  filter_var($_POST['delete_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $utilisateurManager  = new UtilisateurManager($lePDO);
                $deleteOk            = $utilisateurManager->deleteUtilisateurById($delete_id);
            }

            if ($deleteOk) {

                $_SESSION['success'] = "Compte supprimé avec succès";
                header("location:./?path=main&action=connexion");
                exit;
            } else {
                $_SESSION['error'] = "Une erreur est survenue lors de suppression";
                header("location:./?path=client&action=profil-client");
            }

            // fin delet compte client
        }
        
        require('view/utilisateur/connexion.php');

        break;


    case "form-reservation":

        $salleManager  = new SalleManager($lePDO);
        $salles        = $salleManager->getAllSalles();

        require('view/reservation/formReservation.php');
        break;

    case "viewReservation":

        $idUtilisateur      = $_SESSION['id'];

        $reservationManager = new ReservationManager($lePDO);
        $reservations       = $reservationManager->getReservationByIdUtilisateur($idUtilisateur);

        $salleManager       = new SalleManager($lePDO);

        require('view/reservation/viewReservation.php');
        break;


    case "traitement-reservation-client":
        //debut traitement ajouter une reservation
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            $_SESSION['error'] = "Une erreur est survenue : la methode POST est attendu";
            header("location:./?path=client&action=viewReservation");
            exit;
        }

        if (isset($_POST['idSalle'], $_POST['nbr_participant'], $_POST['evenement'], $_POST['dateDebut'], $_POST['heureDebut'], $_POST['dateFin'], $_POST['heureFin'], $_POST['description'])) {

            if (!empty($_POST['idSalle']) && !empty($_POST['nbr_participant']) && !empty($_POST['evenement']) && !empty($_POST['dateDebut']) && !empty($_POST['heureDebut']) && !empty($_POST['dateFin']) && !empty($_POST['heureFin']) && !empty($_POST['description'])) {

                $evenement       = trim(filter_var($_POST['evenement'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $nbr_participant = trim(filter_var($_POST['nbr_participant'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $description     = trim(filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $start_date      = trim(filter_var($_POST['dateDebut'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $start_hour      = trim(filter_var($_POST['heureDebut'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $end_date        = trim(filter_var($_POST['dateFin'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $end_hour        = trim(filter_var($_POST['heureFin'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $id_salle        = trim(filter_var($_POST['idSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $id_utilisateur  = $_SESSION['id'];

                $start_date      = date_create($start_date . " " . $start_hour);
                $end_date        = date_create($end_date . " " . $end_hour);

                $reservation     = new Reservation();
                $reservation->setIdSalle($id_salle);

                $salleManager    = new SalleManager($lePDO);
                $isDispo         = $salleManager->isDispo($reservation, $start_date, $end_date);

                if (!$isDispo) {

                    $_SESSION['error'] = "La salle n'est pas disponible dans ces dates, merci de choisir une autre salle";
                    header("location:./?path=client&action=form-reservation");
                    exit;
                } else {
                    $reservation->setEvenement($evenement);
                    $reservation->setNbreParticipant($nbr_participant);
                    $reservation->setDescription($description);
                    $reservation->setDateDebut($start_date);
                    $reservation->setDateFin($end_date);
                    $reservation->setIdSalle($id_salle);
                    $reservation->setIdUtilisateur($id_utilisateur);

                    $reservationManager = new ReservationManager($lePDO);
                    $reservationOk      = $reservationManager->addReservation($reservation);

                    if ($reservationOk) {
                        
                        $_SESSION['success'] = "La réservation est bien prise en compte";
                        header("location:./?path=client&action=viewReservation");
                        exit;
                    } else {
                        $_SESSION['error'] = "Une erreur est survenue lors d'ajouter la réservation.";
                        header("location:./?path=client&action=viewReservation");
                    }
                }
            } else {
                $_SESSION['error'] = "Une erreur est survenue, Merci de remplir tous les champs";
                header("location:./?path=client&action=form-reservation");
            }
        } else {
            $_SESSION['error'] = "Une erreur est survenue, Formulaire non envoyé";
            header("location:./?path=client&action=form-reservation");
        }
        // fin traitemnt ajouter une reservation

        require('view/reservation/formReservation.php');

        break;

        // update une reservation  client  
    case "edit-reservation-client":

        if (isset($_GET['edit_id'])) {

            $edit_id            =  filter_var($_GET['edit_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $reservationManager = new ReservationManager($lePDO);
            $reservations       = $reservationManager->getReservationById($edit_id);

            $utilisateurManager = new UtilisateurManager($lePDO);
            $idUtilisateur      = $reservations->getIdUtilisateur();
            $utilisateur        = $utilisateurManager->getUtilisateurById($idUtilisateur);

            $salleManager       = new SalleManager($lePDO);
            $salles             = $salleManager->getAllsalles();
            $idSalle            = $reservations->getIdSalle();
            $salle              = $salleManager->getSalleById($idSalle);


            require('view/reservation/edit-reservation-client.php');
        }


        break;

    case "traitement-edit-reservation-client":

        //debut traitement update reservation

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            $_SESSION['error'] = "Une erreur est survenue : la methode POST est attendu";
            header("location:./?path=client&action=viewReservation");
            exit;
        }

        if (isset($_POST['edit_id'], $_POST['edit_idClient'], $_POST['edit_idSalle'], $_POST['edit_nbr_participant'], $_POST['edit_evenement'], $_POST['edit_dateDebut'], $_POST['edit_heureDebut'], $_POST['edit_dateFin'], $_POST['edit_heureFin'], $_POST['edit_description'])) {


            if (!empty($_POST['edit_id']) && !empty($_POST['edit_idClient']) && !empty($_POST['edit_idSalle']) && !empty($_POST['edit_nbr_participant']) && !empty($_POST['edit_evenement']) && !empty($_POST['edit_dateDebut']) && !empty($_POST['edit_heureDebut']) && !empty($_POST['edit_dateFin']) && !empty($_POST['edit_heureFin']) && !empty($_POST['edit_description'])) {


                $nbr_participant = trim(filter_var($_POST['edit_nbr_participant'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $id_Reservation  = trim(filter_var($_POST['edit_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $description     = trim(filter_var($_POST['edit_description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $evenement       = trim(filter_var($_POST['edit_evenement'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $start_date      = trim(filter_var($_POST['edit_dateDebut'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $start_hour      = trim(filter_var($_POST['edit_heureDebut'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $end_date        = trim(filter_var($_POST['edit_dateFin'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $end_hour        = trim(filter_var($_POST['edit_heureFin'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $id_Salle        = trim(filter_var($_POST['edit_idSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $id_Client       = trim(filter_var($_POST['edit_idClient'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                $start_date      = date_create($start_date . " " . $start_hour);
                $end_date        = date_create($end_date . " " . $end_hour);

                $reservation     = new Reservation();
                $reservation->setIdSalle($id_alle);

                $salleManager    = new SalleManager($lePDO);
                $isDispo         = $salleManager->isDispo($reservation, $start_date, $end_date);

                if (!$isDispo) {
                    $_SESSION['error'] = "La salle n'est pas disponible dans ces dates, merci de choisir une autre salle";
                    header("location:./?path=client&action=form-reservation");
                    exit;
                }

                $reservation->setIdReservation($id_Reservation);
                $reservation->setEvenement($evenement);
                $reservation->setNbreParticipant($nbr_participant);
                $reservation->setDescription($description);
                $reservation->setDateDebut($start_date);
                $reservation->setDateFin($end_date);
                $reservation->setIdSalle($id_Salle);
                $reservation->setIdUtilisateur($id_Client);


                $reservationManager = new ReservationManager($lePDO);
                $updateOk           = $reservationManager->updateReservation($reservation);

                if ($updateOk) {

                    $_SESSION['success'] = "La mis-à-jour du résérvation <strong> RES00" . $id_Reservation . date('/Y') . "</strong> est effectuée avec succès";
                    header("location:./?path=client&action=viewReservation");
                    exit;
                } else {
                    $_SESSION['error'] = "Une erreur est survenue lors de la mis-à-jour";
                    header("location:./?path=client&action=viewReservation");
                }
            } else {
                $_SESSION['error'] = "Une erreur est survenue, Merci de remplir tous les champs";
                header("location:./?path=client&action=viewReservation");
            }
        } else {
            $_SESSION['error'] = "Une erreur est survenue, Formulaire non envoyé";
            header("location:./?path=client&action=viewReservation");
        }


        //fin update reservation
        break;


    case "delete-reservation-client":
        //supprimer une reservation

        if (isset($_POST['delete_btn'])) {

            if (isset($_POST['delete_id'])) {

                $delete_id          =  filter_var($_POST['delete_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $reservationManager =  new ReservationManager($lePDO);
                $deleteOk           =  $reservationManager->deleteReservationById($delete_id);
            }

            if ($deleteOk) {

                $_SESSION['success'] = "Réservation annulée et supprimé avec succès";
                header("location:./?path=client&action=viewReservation");
                exit;
            } else {
                $_SESSION['error'] = "Une erreur est survenue lors de suppression";
                header("location:./?path=client&action=viewReservation");
            }

            // fin delet reservation
        }
        require('view/reservation/viewReservation.php');

        break;

    default:
        require('view/404.php');
}
