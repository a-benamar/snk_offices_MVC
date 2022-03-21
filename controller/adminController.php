<?php
ini_set('display_errors', 'on');
//TODO Verification Admin
require_once("./model/managers/adminManager.php");
require_once("./model/managers/utilisateurManager.php");
require_once("./model/managers/equipementManager.php");
require_once("./model/managers/reservationManager.php");
require_once("./model/managers/salleManager.php");
require_once("./model/managers/ImageManager.php");
require_once("./model/managers/aboutUsManager.php");
require_once("./model/managers/actualitesManager.php");


if (!isset($_GET['action'])) {
    $action = "accueilAdmin";
} else {
    $action = filter_var($_GET['action'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch ($action) {


    case "accueilAdmin":

        $adminManager       =  new AdminManager($lePDO);
        $AllAdmins          =  $adminManager->getAllAdmins();

        $utilisateurManager =  new UtilisateurManager($lePDO);
        $AllUtilisateurs    =  $utilisateurManager->getAllUtilisateurs();

        $salleManager       =  new SalleManager($lePDO);
        $AllSalles          =  $salleManager->getAllSalles();

        $reservationManager =  new ReservationManager($lePDO);
        $AllReservations    =  $reservationManager->getAllReservations();

        $imageManager       =  new ImageManager($lePDO);
        $AllImages          =  $imageManager->getAllImages();

        $aboutUsManager     =  new AboutUsManager($lePDO);
        $AllAboutUS         =  $aboutUsManager->getAllAboutUs();

        $actualitesManager  =  new ActualitesManager($lePDO);
        $AllActualites      =  $actualitesManager->getAllActualites();


        require('view/admin/accueilAdmin.php');

        break;


        //Debut user
    case "listUser":
        // list utilisateur
        $utilisateurManager =  new UtilisateurManager($lePDO);
        $utilisateurs       =  $utilisateurManager->getAllUtilisateurs();

        require('view/admin/utilisateur/registerUser.php');

        break;

    case "traitement-inscription-utilisateur":
        // debut traitement ajouter d'un user

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {


            $_SESSION['error'] = "Une erreur est survenue : la methode POST est attendu";
            header("location:./?path=admin&action=listUser");
        }


        if (isset($_POST['pseudo'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['tel'], $_POST['mdp'], $_POST['c_mdp'])) {

            if (!empty($_POST['pseudo']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['c_mdp'])) {

                // Nettoyage des caractères HTML et création des variables

                $user_pseudo     = trim(filter_var($_POST['pseudo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_prenom     = trim(filter_var($_POST['prenom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_nom        = trim(filter_var($_POST['nom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_email      = trim(filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_tel        = trim(filter_var($_POST['tel'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_adresse    = trim(filter_var($_POST['adresse'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_cp         = trim(filter_var($_POST['cp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_ville      = trim(filter_var($_POST['ville'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_password   = trim(filter_var($_POST['mdp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_c_password = trim(filter_var($_POST['c_mdp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                //on verifie la validation de l'email
                if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {

                    $_SESSION["error"] = "Erreur - L'email n'est pas valide)";
                    header('Location:./?path=admin&action=listUser');

                    exit;
                }

                // nettoyage de l'email
                $user_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);

                //Formater le nom et le prénom proprement 
                $user_nom     = strtoupper($user_nom);
                $user_prenom  =  ucfirst(strtolower($user_prenom));
                $user_email   = strtolower($user_email);

                // on verifie si les deux mdp saisis sont bon
                if ($user_password !== $user_c_password) {

                    $_SESSION['error'] = "Les mot de passe sont pas identiques";
                    header("location: ./?path=admin&action=listUser");
                    exit;
                }

                // on va hasher le mot de passe
                // $user_password = password_hash($user_password, PASSWORD_DEFAULT);
                $user_password = hash("sha256", $user_password);

                $utilisateurManager  = new UtilisateurManager($lePDO);
                $checkEmail          = $utilisateurManager->getUtilisateurByEmail($user_email);

                if ($checkEmail) {

                    $_SESSION['error'] = "Adresse Email existe déjà.";
                    header("location:./?path=admin&action=listUser");
                    exit;
                } else {
                    $utilisateur = new Utilisateur();
                    $utilisateur->setPseudo($user_pseudo);
                    $utilisateur->setNom($user_nom);
                    $utilisateur->setPrenom($user_prenom);
                    $utilisateur->setEmail($user_email);
                    $utilisateur->setAdresse($user_adresse);
                    $utilisateur->setCp($user_cp);
                    $utilisateur->setVille($user_ville);
                    $utilisateur->setTel($user_tel);
                    $utilisateur->setMdp($user_password);

                    $addUtilisateurOk = $utilisateurManager->addUtilisateur($utilisateur);

                    if ($addUtilisateurOk) {
                        $_SESSION['success'] = "Le compte client est créé avec succès.";
                        header("location:./?path=admin&action=listUser");
                        exit;
                    } else {
                        $_SESSION['error'] = "Une erreur est survenue lors de la création.";
                        header("location:./?path=admin&action=listUser");
                    }
                }
            } else {
                $_SESSION['error'] = "Une erreur est survenue, Merci de remplir les champs vide";
                header("location:./?path=admin&action=listUser");
            }
        } else {
            $_SESSION['error'] = "Une erreur est survenue, Merci de ressayer";
            header("location:./?path=admin&action=listUser");
        }


        break;

    case "edit-user":
        // debut update user 
        if (isset($_GET['edit_id'])) {

            $edit_id            =  filter_var($_GET['edit_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $utilisateurManager = new UtilisateurManager($lePDO);
            $utilisateur        = $utilisateurManager->getUtilisateurById($edit_id);

            require('view/admin/utilisateur/editUser.php');
        }

        // fin update user

        break;


    case "traitement-edit-user":

        //traitement update user

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            $_SESSION['error'] = "Une erreur est survenue : la methode POST est attendu";
            header("location:./?path=admin&action=listUser");
            exit;
        }


        if (isset($_POST['edit_pseudo'], $_POST['edit_nom'], $_POST['edit_prenom'], $_POST['edit_email'], $_POST['edit_tel'], $_POST['edit_mdp'], $_POST['edit_c_mdp'])) {


            if (!empty($_POST['edit_pseudo']) && !empty($_POST['edit_nom']) && !empty($_POST['edit_prenom']) && !empty($_POST['edit_email']) && !empty($_POST['edit_tel']) && !empty($_POST['edit_mdp']) && !empty($_POST['edit_c_mdp'])) {

                $user_id         = trim(filter_var($_POST['edit_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_pseudo     = trim(filter_var($_POST['edit_pseudo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_nom        = trim(filter_var($_POST['edit_nom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_prenom     = trim(filter_var($_POST['edit_prenom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_email      = trim(filter_var($_POST['edit_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_tel        = trim(filter_var($_POST['edit_tel'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_adresse    = trim(filter_var($_POST['edit_adresse'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_ville      = trim(filter_var($_POST['edit_ville'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_cp         = trim(filter_var($_POST['edit_cp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_password   = trim(filter_var($_POST['edit_mdp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_c_password = trim(filter_var($_POST['edit_c_mdp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                //on verifie la validation de l'email
                if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {

                    $_SESSION["error"] = "Erreur - L'email n'est pas valide)";
                    header('Location:./?path=admin&action=listUser');

                    exit;
                }

                // nettoyage de l'email
                $user_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);

                //Formater le nom et le prénom proprement 
                $user_nom     = strtoupper($user_nom);
                $user_prenom  =  ucfirst(strtolower($user_prenom));
                $user_adresse =  ucfirst($user_adresse);
                $user_email   = strtolower($user_email);

                // on verifie si les deux mdp sont identiques
                if ($user_password !== $user_c_password) {

                    $_SESSION['error'] = "Les mots de passe sont pas identiques";
                    header("location: ./?path=admin&action=listUser");
                    exit;
                }

                // on va hasher le mot de passe
                $user_password = hash("sha256", $user_password);

                $utilisateurManager = new UtilisateurManager($lePDO);
                $checkEmail         = $utilisateurManager->getUtilisateurByEmail($user_email);

                if ($checkEmail > 1) {
                    $_SESSION['error'] = "Adresse Email existe déjà.";
                    header("location:./?path=admin&action=listUser");
                    exit;

                } else {
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

                    $updateUtilisateurOk = $utilisateurManager->updateUtilisateur($utilisateur);

                    if ($updateUtilisateurOk) {

                        $_SESSION['success'] = "Le compte d'utilisateur est mis-à-jour avec succès";
                        header("location:./?path=admin&action=listUser");
                        exit;
                    } else {
                        $_SESSION['error'] = "Une erreur est survenue lors de modification";
                        header("location:./?path=admin&action=listUser");
                    }
                }
            } else {
                $_SESSION['error'] = "Une erreur est survenue, Merci de remplir les champs vide";
                header("location:./?path=admin&action=listUser");
            }
        } else {
            $_SESSION['error'] = "Une erreur est survenue, Merci de ressayer";
            header("location:./?path=admin&action=listUser");
        }

        //fin trfaitement update user
        break;


    case "delete-user":
        //debut delete user
        if (isset($_POST['delete_btn'])) {

            if (isset($_POST['delete_id'])) {

                $delete_id           =  filter_var($_POST['delete_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $utilisateurManager  = new UtilisateurManager($lePDO);
                $deleteUtilisateurOk = $utilisateurManager->deleteUtilisateurById($delete_id);

                if ($deleteUtilisateurOk) {

                    $_SESSION['success'] = "La suppression de l'admin effectue avec succès";
                    header("location:./?path=admin&action=listUser");
                    exit;
                } else {
                    $_SESSION['error'] = "Une erreur est survenue lors de suppression";
                    header("location:./?path=admin&action=listUser");
                }
            }

            // fin delete user
        }

        // fin user
        break;


    case "listAdmin":

        $adminManager = new AdminManager($lePDO);
        $admins       = $adminManager->getAllAdmins();

        require('view/admin/administrateur/registerAdmin.php');
        break;

    case "traitement-inscription-admin":

        //debut traitement ajouter un admin

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            $_SESSION['error'] = "Une erreur est survenue : la methode POST est attendu";
            header("location:./?path=admin&action=listAdmin");
            exit;
        }


        if (isset($_POST['pseudo'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['c_mdp'])) {


            if (!empty($_POST['pseudo']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['c_mdp'])) {
                //  var_dump($_POST);exit;

                $admin_pseudo     = trim(filter_var($_POST['pseudo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $admin_nom        = trim(filter_var($_POST['nom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $admin_prenom     = trim(filter_var($_POST['prenom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $admin_email      = trim(filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $admin_password   = trim(filter_var($_POST['mdp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $admin_c_password = trim(filter_var($_POST['c_mdp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                //on verifie la validation de l'email
                if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {

                    $_SESSION["error"] = "Erreur - L'email n'est pas valide";
                    header('Location:./?path=admin&action=listAdmin');
                    exit;
                }

                // nettoyage de l'email
                $admin_email = filter_var($admin_email, FILTER_SANITIZE_EMAIL);

                //Formater le nom et le prénom proprement 
                $admin_nom     = strtoupper($admin_nom);
                $admin_prenom  =  ucfirst(strtolower($admin_prenom));
                $admin_email   = strtolower($admin_email);

                // on verifie si les deux mdp saisis sont bon

                if ($admin_password !== $admin_c_password) {

                    $_SESSION['error'] = "Les mot de passe sont pas identiques.";
                    header("location: ./?path=admin&action=listAdmin");
                    exit;
                }

                // hasher le mot de passe
                //$admin_password = password_hash($admin_password, PASSWORD_DEFAULT);
                $admin_password = hash("sha256", $admin_password);

                $adminManager = new AdminManager($lePDO);
                $checkEmail   = $adminManager->getAdminByEmail($admin_email);

                if ($checkEmail) {

                    $_SESSION['error'] = "Adresse Email existe déjà.";
                    header("location:./?path=admin&action=listAdmin");
                    exit;
                } else {
                    $admin = new Admin();
                    $admin->setPseudo($admin_pseudo);
                    $admin->setNom($admin_nom);
                    $admin->setPrenom($admin_prenom);
                    $admin->setEmail($admin_email);
                    $admin->setMdp($admin_password);

                    $addAdminOk = $adminManager->addAdmin($admin);

                    if ($addAdminOk) {
                        $_SESSION['success'] = "Admin ajouté avec succès.";
                        header("location:./?path=admin&action=listAdmin");
                        exit;
                    } else {
                        $_SESSION['error'] = "Une erreur est survenue lors de la création";
                        header("location:./?path=admin&action=listAdmin");
                    }
                }
            } else {
                $_SESSION['error'] = "Une erreur est survenue, Merci de remplir les champs vides";
                header("location:./?path=admin&action=listAdmin");
            }
        } else {
            $_SESSION['error'] = "Une erreur est survenue, Formulaire non envoyé";
            header("location:./?path=admin&action=listAdmin");
        }

        break;


    case "edit-admin":

        if (isset($_GET['edit_id'])) {

            $edit_id       =  filter_var($_GET['edit_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $adminManager  = new AdminManager($lePDO);
            $admin         = $adminManager->getAdminById($edit_id);

            require('view/admin/administrateur/editAdmin.php');
        }

        break;


    case "traitement-edit-admin":
        //update Admin

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            $_SESSION['error'] = "Une erreur est survenue : la methode POST est attendu";
            header("location:./?path=admin&action=listAdmin");
            exit;
        }


        if (isset($_POST['edit_pseudo'], $_POST['edit_nom'], $_POST['edit_prenom'], $_POST['edit_email'], $_POST['edit_mdp'], $_POST['edit_c_mdp'])) {

            if (!empty($_POST['edit_pseudo']) && !empty($_POST['edit_nom']) && !empty($_POST['edit_prenom']) && !empty($_POST['edit_email']) && !empty($_POST['edit_mdp']) && !empty($_POST['edit_c_mdp'])) {


                $admin_id         = trim(filter_var($_POST['edit_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $admin_pseudo     = trim(filter_var($_POST['edit_pseudo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $admin_nom        = trim(filter_var($_POST['edit_nom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $admin_prenom     = trim(filter_var($_POST['edit_prenom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $admin_email      = trim(filter_var($_POST['edit_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $admin_password   = trim(filter_var($_POST['edit_mdp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $admin_c_password = trim(filter_var($_POST['edit_c_mdp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));


                //on verifie la validation de l'email
                if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {

                    $_SESSION["error"] = "Erreur - L'email n'est pas valide";
                    header('Location:./?path=admin&action=listAdmin');
                    exit;
                }

                // nettoyage de l'email
                $admin_email = filter_var($admin_email, FILTER_SANITIZE_EMAIL);

                //Formater le nom et le prénom proprement 
                $admin_nom    = strtoupper($admin_nom);
                $admin_prenom =  ucfirst(strtolower($admin_prenom));
                $admin_email  = strtolower($admin_email);

                // on verifie si les deux mdp sont identiques

                if ($admin_password !== $admin_c_password) {

                    $_SESSION['error'] = "Les mots de passe sont pas identiques.";
                    header("location: ./?path=admin&action=listAdmin");
                    exit;
                }

                // hasher le mot de passe
                $admin_password = hash("sha256", $admin_password);

                $adminManager   = new AdminManager($lePDO);
                $checkEmail     = $adminManager->getAdminByEmail($admin_email);

                if ($checkEmail > 1) {

                    $_SESSION['error'] = "Adresse Email existe déjà.";
                    header("location:./?path=admin&action=listAdmin");
                    exit;

                } else {
                    $admin = new Admin();
                    $admin->setIdAdmin($admin_id);
                    $admin->setPseudo($admin_pseudo);
                    $admin->setNom($admin_nom);
                    $admin->setPrenom($admin_prenom);
                    $admin->setEmail($admin_email);
                    $admin->setMdp($admin_password);

                    $updateAdminOk = $adminManager->updateAdmin($admin);

                    if ($updateAdminOk) {

                        $_SESSION['success'] = "Le compte admin est mis-à-jour avec succès";
                        header("location:./?path=admin&action=listAdmin");
                        exit;
                    } else {
                        $_SESSION['error'] = "Une erreur est survenue lors des modifications";
                        header("location:./?path=admin&action=listAdmin");
                    }
                }
            } else {
                $_SESSION['error'] = "Une erreur est survenue, Merci de remplir les champs vides";
                header("location:./?path=admin&action=listAdmin");
            }
        } else {
            $_SESSION['error'] = "Une erreur est survenue, Formulaire non envoyé";
            header("location:./?path=admin&action=listAdmin");
        }


        //fin update admin

        break;

        //debut delet admin
    case "delete-admin":

        if (isset($_POST['delete_btn'])) {

            if (isset($_POST['delete_id'])) {

                $delete_id     =  filter_var($_POST['delete_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $adminManager  = new AdminManager($lePDO);
                $deleteAdminOk = $adminManager->deleteAdminByIdAdmin($delete_id);

                if ($deleteAdminOk) {

                    $_SESSION['success'] = "La suppression de l'admin effectue avec succès";
                    header("location:./?path=admin&action=listAdmin");
                    exit;
                } else {
                    $_SESSION['error'] = "Une erreur est survenue lors de suppression";
                    header("location:./?path=admin&action=listAdmin");
                }
            }

            // fin delet admin
        }

        // fin admin
        break;

        // debut reservation

    case "listReservation":
        // view all reservation

        $reservationManager  = new ReservationManager($lePDO);
        $reservations        = $reservationManager->getAllReservations();

        $utilisateurManager  = new UtilisateurManager($lePDO);
        $utilisateurs        = $utilisateurManager->getAllUtilisateurs(); //afficher tous les user dans le form reserv

        $salleManager        = new SalleManager($lePDO);
        $salles              = $salleManager->getAllSalles();  //afficher tous les salles dans le form reserv

        require('view\admin\reservation\registerReservation.php');
        // fin view all reservation

        break;

    case "traitement-ajouter-reservation":
        //debut traitement ajouter une reservation

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            $_SESSION['error'] = "Une erreur est survenue : la methode POST est attendu";
            header("location:./?path=admin&action=listReservation");
            exit;
        }

        if (isset($_POST['idUtilisateur'], $_POST['idSalle'], $_POST['nbr_participant'], $_POST['evenement'], $_POST['dateDebut'], $_POST['heureDebut'], $_POST['dateFin'], $_POST['heureFin'], $_POST['description'])) {


            if (!empty($_POST['idUtilisateur']) && !empty($_POST['idSalle']) && !empty($_POST['nbr_participant']) && !empty($_POST['evenement']) && !empty($_POST['dateDebut']) && !empty($_POST['heureDebut']) && !empty($_POST['dateFin']) && !empty($_POST['heureFin']) && !empty($_POST['description'])) {

                $evenement       = trim(filter_var($_POST['evenement'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $nbr_participant = trim(filter_var($_POST['nbr_participant'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $description     = trim(filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $start_date      = filter_var($_POST['dateDebut'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $start_hour      = filter_var($_POST['heureDebut'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $end_date        = filter_var($_POST['dateFin'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $end_hour        = filter_var($_POST['heureFin'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $id_salle        = trim(filter_var($_POST['idSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $id_utilisateur  = trim(filter_var($_POST['idUtilisateur'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                $start_date      = date_create($start_date . " " . $start_hour);
                $end_date        = date_create($end_date . " " . $end_hour);


                $reservation     = new Reservation();
                $reservation->setIdSalle($id_salle);

                $salleManager    = new SalleManager($lePDO);
                $isDispo         = $salleManager->isDispo($reservation, $start_date, $end_date);

                if (!$isDispo) {

                    $_SESSION['error'] = "La salle n'est pas disponible dans ces dates, merci de choisir une autre salle";
                    header("location:./?path=admin&action=listReservation");
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
                    $addReservationOk   = $reservationManager->addReservation($reservation);

                    if ($addReservationOk) {

                        $_SESSION['success'] = "Résérvation enregistrée avec succès.";
                        header("location:./?path=admin&action=listReservation");
                        exit;
                    } else {
                        $_SESSION['error'] = "Une erreur est survenue lors d'ajouter la réservation.";
                        header("location:./?path=admin&action=listReservation");
                    }
                }
            } else {
                $_SESSION['error'] = "Une erreur est survenue, Merci de remplir les champs vides";
                header("location:./?path=admin&action=listReservation");
            }
        } else {
            $_SESSION['error'] = "Une erreur est survenue, Formulaire non envoyé";
            header("location:./?path=admin&action=listReservation");
        }
        // fin traitemnt ajouter une reservation


        break;

        // update une reservation    
    case "edit-reservation":

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

            require('view\admin\reservation\editReservation.php');
        }
        break;

    case "traitement-edit-reservation":

        //debut traitement update reservation

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            $_SESSION['error'] = "Une erreur est survenue : la methode POST est attendu";
            header("location:./?path=admin&action=listReservation");
            exit;
        }

        if (isset($_POST['edit_id'], $_POST['edit_idClient'], $_POST['edit_idSalle'], $_POST['edit_nbr_participant'], $_POST['edit_evenement'], $_POST['edit_dateDebut'], $_POST['edit_heureDebut'], $_POST['edit_dateFin'], $_POST['edit_heureFin'], $_POST['edit_description'])) {



            if (!empty($_POST['edit_id']) && !empty($_POST['edit_idClient']) && !empty($_POST['edit_idSalle']) && !empty($_POST['edit_nbr_participant']) && !empty($_POST['edit_evenement']) && !empty($_POST['edit_dateDebut']) && !empty($_POST['edit_heureDebut']) && !empty($_POST['edit_dateFin']) && !empty($_POST['edit_heureFin']) && !empty($_POST['edit_description'])) {


                $id_Reservation  = trim(filter_var($_POST['edit_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $evenement       = trim(filter_var($_POST['edit_evenement'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $nbr_participant = trim(filter_var($_POST['edit_nbr_participant'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $description     = trim(filter_var($_POST['edit_description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $start_date      = trim(filter_var($_POST['edit_dateDebut'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $start_hour      = trim(filter_var($_POST['edit_heureDebut'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $end_date        = trim(filter_var($_POST['edit_dateFin'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $end_hour        = trim(filter_var($_POST['edit_heureFin'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $id_salle        = trim(filter_var($_POST['edit_idSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $id_Client       = trim(filter_var($_POST['edit_idClient'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                $start_date      = date_create($start_date . " " . $start_hour);
                $end_date        = date_create($end_date . " " . $end_hour);

                $reservation     = new Reservation();
                $reservation->setIdSalle($id_salle);

                $salleManager    = new SalleManager($lePDO);
                $isDispo         = $salleManager->isDispo($reservation, $start_date, $end_date);

                if (!$isDispo) {

                    $_SESSION['error'] = "La salle n'est pas disponible dans ces dates, merci de choisir une autre salle";
                    header("location:./?path=admin&action=listReservation");
                    exit;
                } else {

                    $reservation->setIdReservation($id_Reservation);
                    $reservation->setEvenement($evenement);
                    $reservation->setNbreParticipant($nbr_participant);
                    $reservation->setDescription($description);
                    $reservation->setDateDebut($start_date);
                    $reservation->setDateFin($end_date);
                    $reservation->setIdSalle($id_salle);
                    $reservation->setIdUtilisateur($id_Client);

                    $reservationManager = new ReservationManager($lePDO);
                    $updateReservationOk = $reservationManager->updateReservation($reservation);

                    if ($updateReservationOk) {

                        $_SESSION['success'] = "La mis-à-jour du résérvation <strong> RES00" . $id_Reservation . date('/Y') . "</strong> est effectuée avec succès";
                        header("location:./?path=admin&action=listReservation");
                        exit;
                    } else {
                        $_SESSION['error'] = "Une erreur est survenue lors de la mis-à-jour";
                        header("location:./?path=admin&action=listReservation");
                    }
                }
            } else {
                $_SESSION['error'] = "Une erreur est survenue, Merci de remplir les champs vides";
                header("location:./?path=admin&action=listReservation");
            }
        } else {
            $_SESSION['error'] = "Une erreur est survenue, Formulaire non envoyé";
            header("location:./?path=admin&action=listReservation");
        }


        //fin update reservation
        break;

    case "view-reservation":
        //view  reservation

        $id                 =  filter_var($_GET['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $reservationManager = new ReservationManager($lePDO);
        $reservations       = $reservationManager->getReservationById($id);

        $utilisateurManager = new UtilisateurManager($lePDO);
        $idUtilisateur      = $reservations->getIdUtilisateur();
        $utilisateur        = $utilisateurManager->getUtilisateurById($idUtilisateur);

        $salleManager       = new SalleManager($lePDO);
        $salles             = $salleManager->getAllsalles();
        $idSalle            = $reservations->getIdSalle();
        $salle              = $salleManager->getSalleById($idSalle);

        require('view/admin/reservation/viewReservation.php');

        // fin view reservation
        break;

    case "delete-reservation":
        //supprimer une reservation

        if (isset($_POST['delete_btn'])) {


            if (isset($_POST['delete_id'])) {

                $delete_id           =  filter_var($_POST['delete_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $reservationManager  = new ReservationManager($lePDO);
                $deleteReservationOk = $reservationManager->deleteReservationById($delete_id);
            }

            if ($deleteReservationOk) {

                $_SESSION['success'] = "Réservation annulée et supprimé avec succès";
                header("location:./?path=admin&action=listReservation");
                exit;
            } else {
                $_SESSION['error'] = "Une erreur est survenue lors de suppression";
                header("location:./?path=admin&action=listReservation");
            }
            require('view/admin/reservation/listReservation.php');

            // fin delet admin
        }

        break;

        // debut salles

    case "listSalle":
        //debut list all salle

        $salleManager = new SalleManager($lePDO);
        $salles       = $salleManager->getAllSalles();

        require('view/admin/salle/registerSalle.php');
        //fin list all salle
        break;

    case "viewSalle":
        //debut view  salle

        $id           =  filter_var($_GET['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $salleManager = new SalleManager($lePDO);
        $salles       = $salleManager->getSalleById($id);;

        require('view/admin/salle/viewSalle.php');
        //fin view salle
        break;

    case "traitement-ajouter-salle":
        //debut traitement ajouter une salle

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {


            $_SESSION['error'] = "Une erreur est survenue : la methode POST est attendu";
            header("location:./?path=admin&action=listSalle");
        }


        if (isset($_POST['nomSalle'], $_POST['typeSalle'], $_POST['capSalle'], $_POST['villeSalle'], $_POST['prixSalle'], $_POST['statusSalle'], $_POST['descriptionSalle'])) {

            if (!empty($_POST['nomSalle']) && !empty($_POST['typeSalle']) && !empty($_POST['capSalle']) && !empty($_POST['villeSalle']) && !empty($_POST['prixSalle']) && !empty($_POST['statusSalle']) && !empty($_POST['descriptionSalle'])) {


                $nom_salle         = trim(filter_var($_POST['nomSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $type_salle        = trim(filter_var($_POST['typeSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $cap_salle         = trim(filter_var($_POST['capSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $ville_salle       = trim(filter_var($_POST['villeSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $prix_salle        = trim(filter_var($_POST['prixSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $status_salle      = trim(filter_var($_POST['statusSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $description_salle = trim(filter_var($_POST['descriptionSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                // formater nom nom,status et type de salle
                $nom_salle         = strtoupper($nom_salle);
                $type_salle        = ucfirst($type_salle);
                $status_salle      = ucfirst($status_salle);
                $ville_salle       = ucfirst($ville_salle);

                $salleManager      = new SalleManager($lePDO);
                $verifSalle        = $salleManager->getSalleByNom($nom_salle);

                if ($verifSalle) {
                    $_SESSION['error'] = "Une salle avec ce nom deja existe";
                    header("location:./?path=admin&action=listSalle");
                    exit;
                } else {
                    $salle = new Salle();
                    $salle->setIdSalle($id_salle);
                    $salle->setNomSalle($nom_salle);
                    $salle->setTypeSalle($type_salle);
                    $salle->setStatusSalle($status_salle);
                    $salle->setCapSalle($cap_salle);
                    $salle->setVilleSalle($ville_salle);
                    $salle->setPrixSalle($prix_salle);
                    $salle->setDescriptionSalle($description_salle);

                    $addSalleOk = $salleManager->addSalle($salle);

                    if ($addSalleOk) {
                        $_SESSION['success'] = "La nouvelle salle est ajoutée avec succès";
                        header("location:./?path=admin&action=listSalle");
                        exit;
                    } else {
                        $_SESSION['error'] = "Une erreur est survenue ... Merci de ressayer";
                        header("location:./?path=admin&action=listSalle");
                    }
                }
            } else {
                $_SESSION['error'] = "Une erreur est survenue, Merci de remplir les champs vides";
                header("location:./?path=admin&action=listSalle");
            }
        } else {
            $_SESSION['error'] = "Une erreur est survenue, Formulaire non envoyé";
            header("location:./?path=admin&action=listSalle");
        }

        //fin traitement  ajouter une salle
        break;

    case "edit-salle":
        //debut edit  salle
        if (isset($_GET['edit_id'])) {

            $edit_id      =  filter_var($_GET['edit_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $salleManager = new SalleManager($lePDO);
            $salle        = $salleManager->getAllSalles();
            $salles       = $salleManager->getSalleById($edit_id);
            //  var_dump($_SESSION);exit;

            require('view/admin/salle/editSalle.php');
            //fin edit salle
        }
        break;

    case "traitement-edit-salle":
        //debut  traitement  edit salle

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            $_SESSION['error'] = "Une erreur est survenue : la methode POST est attendu";
            header("location:./?path=admin&action=listSalle");
        }


        if (isset($_POST['edit_nomSalle'], $_POST['edit_typeSalle'], $_POST['edit_capSalle'], $_POST['edit_villeSalle'], $_POST['edit_prixSalle'], $_POST['edit_statusSalle'], $_POST['edit_descriptionSalle'])) {


            if (!empty($_POST['edit_nomSalle']) && !empty($_POST['edit_typeSalle']) && !empty($_POST['edit_capSalle']) && !empty($_POST['edit_villeSalle']) && !empty($_POST['edit_prixSalle']) && !empty($_POST['edit_statusSalle']) && !empty($_POST['edit_descriptionSalle'])) {


                $id_salle          = trim(filter_var($_POST['edit_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $nom_salle         = trim(filter_var($_POST['edit_nomSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $type_salle        = trim(filter_var($_POST['edit_typeSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $status_salle      = trim(filter_var($_POST['edit_statusSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $cap_salle         = trim(filter_var($_POST['edit_capSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $ville_salle       = trim(filter_var($_POST['edit_villeSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $prix_salle        = trim(filter_var($_POST['edit_prixSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $description_salle = trim(filter_var($_POST['edit_descriptionSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                // formater nom,status et type de salle
                $nom_salle         = strtoupper($nom_salle);
                $type_salle        = ucfirst($type_salle);
                $status_salle      = ucfirst($status_salle);
                $ville_salle       = ucfirst($ville_salle);


                $salle = new Salle();
                $salle->setIdSalle($id_salle);
                $salle->setNomSalle($nom_salle);
                $salle->setTypeSalle($type_salle);
                $salle->setStatusSalle($status_salle);
                $salle->setCapSalle($cap_salle);
                $salle->setVilleSalle($ville_salle);
                $salle->setPrixSalle($prix_salle);
                $salle->setDescriptionSalle($description_salle);

                $salleManager  = new SalleManager($lePDO);
                $updateSalleOk = $salleManager->updateSalle($salle);

                if ($updateSalleOk) {

                    $_SESSION['success'] = "Mis-à-jour du effectuée avec succès";
                    header("location:./?path=admin&action=listSalle");
                    exit;
                } else {
                    $_SESSION['error'] = "Une erreur est survenue lors des modifications";
                    header("location:./?path=admin&action=listSalle");
                }
            } else {
                $_SESSION['error'] = "Une erreur est survenue, Merci de remplir les champs vides";
                header("location:./?path=admin&action=listSalle");
            }
        } else {
            $_SESSION['error'] = "Une erreur est survenue, Formulaire non envoyé";
            header("location:./?path=admin&action=listSalle");
        }

        //fin traitement  edit salle
        break;

    case "delete-salle":
        //debut delet une salle

        if (isset($_POST['delete_btn'])) {

            if (isset($_POST['delete_id'])) {

                $delete_id     =  filter_var($_POST['delete_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $salleManager  = new SalleManager($lePDO);
                $deleteSalleOk =  $salleManager->deleteSalleById($delete_id);
            }

            if ($deleteSalleOk) {

                $_SESSION['success'] = "La salle est supprimé avec succès";
                header("location:./?path=admin&action=listSalle");
                exit;
            } else {
                $_SESSION['error'] = "Une erreur est survenue lors de suppression";
                header("location:./?path=admin&action=listSalle");
            }

            // fin delet admin
        }
        require('view/admin/reservation/listSalle.php');

        //fin delete une salle
        break;

        // fin salles

        // deubut abouts Us
    case "listAboutUs":
        // debut list about us

        $aboutUsManager = new AboutUsManager($lePDO);
        $aboutUs        = $aboutUsManager->getAllAboutUs();

        require('view/admin/aboutus/registerAboutUs.php');
        // fin list about us
        break;

    case "traitement-ajouter-aboutUs":
        // debut traitement ajouter  about us

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {


            $_SESSION['error'] = "Une erreur est survenue : la methode POST est attendu";
            header("location:./?path=admin&action=listAboutUs");
        }

        if (isset($_POST['titre'], $_POST['lien'], $_POST['contenu'])) {

            if (!empty($_POST['titre']) && !empty($_POST['contenu'])) {


                $titre_AboutUs   = trim(filter_var($_POST['titre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $lien_AboutUs    = trim(filter_var($_POST['lien'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $contenu_AboutUs = trim(filter_var($_POST['contenu'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                // formater nom nom,status et type de salle

                $titre_AboutUs   = strtoupper($titre_AboutUs);
                $contenu_AboutUs = ucfirst($contenu_AboutUs);

                $aboutUs = new AboutUs();
                $aboutUs->setTitre($titre_AboutUs);
                $aboutUs->setLien($lien_AboutUs);
                $aboutUs->setContenu($contenu_AboutUs);

                $aboutUsManager  = new AboutUsManager($lePDO);
                $addAboutUsOk    = $aboutUsManager->addAboutUs($aboutUs);

                if ($addAboutUsOk) {
                    $_SESSION['success'] = "La nouvelle About Us est ajoutée avec succès";
                    header("location:./?path=admin&action=listAboutUs");
                    exit;
                } else {
                    $_SESSION['error'] = "Une erreur est survenue ... Merci de ressayer";
                    header("location:./?path=admin&action=listAboutUs");
                }
            } else {
                $_SESSION['error'] = "Une erreur est survenue, Merci de remplir les champs vides";
                header("location:./?path=admin&action=listAboutUs");
            }
        } else {
            $_SESSION['error'] = "Une erreur est survenue, Formulaire non envoyé";
            header("location:./?path=admin&action=listAboutUs");
        }

        // fin traitement ajouter  about us
        break;

    case "edit-AboutUs":
        // debut edit  about us
        if (isset($_GET['edit_id'])) {

            $edit_id        =  filter_var($_GET['edit_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $aboutUsManager = new AboutUsManager($lePDO);
            $about          = $aboutUsManager->getAllAboutUs();
            $aboutUs        = $aboutUsManager->getAboutUsById($edit_id);
        }
        require('view/admin/aboutus/editAboutUs.php');
        // fin  edit  about us
        break;

    case "traitement-edit-AboutUs":
        // debut traitement edit  about us

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            $_SESSION['error'] = "Une erreur est survenue : la methode POST est attendu";
            header("location:./?path=admin&action=listAboutUs");
        }


        if (isset($_POST['edit_id'], $_POST['edit_titre'], $_POST['edit_lien'], $_POST['edit_contenu'])) {
            //  var_dump($_POST);exit;

            if (!empty($_POST['edit_titre']) && !empty($_POST['edit_contenu'])) {


                $id_AboutUs      = trim(filter_var($_POST['edit_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $titre_AboutUs   = trim(filter_var($_POST['edit_titre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $lien_AboutUs    = trim(filter_var($_POST['edit_lien'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $contenu_AboutUs = trim(filter_var($_POST['edit_contenu'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                // formater nom nom,status et type de salle

                $titre_AboutUs   = strtoupper($titre_AboutUs);
                $contenu_AboutUs = ucfirst($contenu_AboutUs);

                $aboutUs = new AboutUs();
                $aboutUs->setIdAboutUs($id_AboutUs);
                $aboutUs->setTitre($titre_AboutUs);
                $aboutUs->setLien($lien_AboutUs);
                $aboutUs->setContenu($contenu_AboutUs);

                $aboutUsManager  = new AboutUsManager($lePDO);
                $updateAboutUsOk = $aboutUsManager->updateAboutUs($aboutUs);


                if ($updateAboutUsOk) {

                    $_SESSION['success'] = "Mis-à-jour du effectuée avec succès";
                    header("location:./?path=admin&action=listAboutUs");
                    exit;
                } else {
                    $_SESSION['error'] = "Une erreur est survenue lors des modifications";
                    header("location:./?path=admin&action=listAboutUs");
                }
            } else {
                $_SESSION['error'] = "Une erreur est survenue, Merci de remplir les champs vides";
                header("location:./?path=admin&action=listAboutUs");
            }
        } else {
            $_SESSION['error'] = "Une erreur est survenue, Formulaire non envoyé";
            header("location:./?path=admin&action=listAboutUs");
        }

        // fin traitement edit  about us
        break;

    case "delete-AboutUs":
        // debut deleteabout us
        if (isset($_POST['delete_btn'])) {

            if (isset($_POST['delete_id'])) {

                $delete_id       =  filter_var($_POST['delete_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $aboutUsManager  = new AboutUsManager($lePDO);
                $deleteAboutUsOk = $aboutUsManager->deleteAboutUsByIdAboutUs($delete_id);
            }

            if ($deleteAboutUsOk) {

                $_SESSION['success'] = "L'About Us est supprimé avec succès";
                header("location:./?path=admin&action=listAboutUs");
                exit;
            } else {
                $_SESSION['error'] = "Une erreur est survenue lors de suppression";
                header("location:./?path=admin&action=listAboutUs");
            }
        }
        require('view/admin/aboutus/editAboutUs.php');
        // fin delete  about us
        break;
        // fin about Us


        // debut image
    case "listImage":
        // debut list image

        $imageManager = new ImageManager($lePDO);
        $images       = $imageManager->getAllImages();//extraire de toutes les images dans listImage

        $salleManager = new SalleManager($lePDO);
        $salles       = $salleManager->getAllSalles(); //extraire de toutes les salles dans le form ajouter image

        require('view/admin/image/registerImage.php');
        // fin list image
        break;

    case "traitement-ajouter-image":
        // debut traitement-ajouter-image

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            $_SESSION['error'] = "Une erreur est survenue : la methode POST est attendu";
            header("location:./?path=admin&action=listSalle");
        }


        if (isset($_POST['idSalle'], $_FILES['image'])) {

            if (!empty($_POST['idSalle']) && !empty($_FILES['image'])) {


                $idSalle  = trim(filter_var($_POST['idSalle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $nomImage = $_FILES['image']['name'];

                // on verifie la taille de l image
                $imageOk  = true;

                if ($_FILES["image"]["size"] > 1000000) {
                    $_SESSION['error'] = "Taille de l'image trop grande (>1Mo)";
                    $imageOk = false;
                }

                $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

                if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {

                    $_SESSION['error'] = "Format de fichier invalide";
                    header(('location: ./?path=admin&action=listImage'));
                    $imageOk = false;
                }


                if ($imageOk == false) {

                    $_SESSION['error'] = "image incorecte";
                    header("location:./?path=admin&action=listImage");
                    exit;
                }              

                $salleManager = new SalleManager($lePDO);
                $uneSalle     = $salleManager->getSalleById($idSalle);
                $nomSalle     = $uneSalle->getNomSalle();

                $imageManager = new ImageManager($lePDO);
                $idImage      = $imageManager->getMaxIdImage();

                $idImage      = $idImage + 1;
                $nomImage     = $nomSalle . "-" . $idImage . ".jpg";

                // On vérifie si le nom de l'image existe deja

                if (file_exists("public/uploads/salles/" . $nomImage)) {

                    // $nomImage = $_FILES['image']['name'];
                    // exit;

                    $_SESSION['error'] = "Erreur : L'image '$nomImage' existe deja ... ";
                    header("location:?path=admin&action=listImage");
                    exit;
                }

                $image = new Image();
                $image->setIdImage($idSalle);
                $image->setIdSalle($idSalle);
                $image->setImage($nomImage);

                $estPrincipale = 0;
                if (isset($_POST['estPrincipale'])) {
                    $estPrincipale = 1;
                }
                $image->setEstPrincipale($estPrincipale);

                $addImageOk = $imageManager->addImage($image);

                if ($addImageOk) {

                    // on deplace le fichier de dossier temporaire a  uploads
                    move_uploaded_file($_FILES['image']['tmp_name'], "public/uploads/salles/" . $nomImage);
                    $_SESSION['success'] = "Image " . $nomImage . " ajouter avec succès";
                    header("location:./?path=admin&action=listImage");
                } else {
                    $_SESSION['error'] = "Erreur : Erreur - image non ajoutée";
                    header('location:./?path=admin&action=listImage');
                }
            } else {
                $_SESSION['error'] = "Une erreur est survenue, Merci de remplir les champs vides";
                header("location:./?path=admin&action=listImage");
            }
        } else {
            $_SESSION['error'] = "Une erreur est survenue, Formulaire non envoyé";
            header("location:./?path=admin&action=listImage");
        }

        require('view/admin/image/upload.php');
        // fin traitement-ajouter-image
        break;

    case "delete-image":


        if (isset($_POST['delete_btn'])) {

            if (isset($_POST['delete_id'])) {

                $delete_id     =  filter_var($_POST['delete_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $imageManager  = new ImageManager($lePDO);
                $deleteImageOk = $imageManager->deleteImageByIdImage($delete_id);
            }

            if ($deleteImageOk) {

                $_SESSION['success'] = "L'image est supprimée avec succès";
                header("location:./?path=admin&action=listImage");
                exit;
            } else {
                $_SESSION['error'] = "Une erreur est survenue lors de suppression";
                header("location:./?path=admin&action=listImage");
            }
        }
        require('view/admin/image/listImage.php');
        break;

    case "listActualites":
        // list actualites

        $actualitesManager = new ActualitesManager($lePDO);
        $actualites        = $actualitesManager->getAllActualites();

        require('view/admin/actualites/registerActualites.php');
        // fin actualites
        break;

    case "traitement-ajouter-actualites":
        // debut traitement actualites

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {


            $_SESSION['error'] = "Une erreur est survenue : la methode POST est attendu";
            header("location:./?path=admin&action=listActualites");
        }


        if (isset($_POST['titre'], $_POST['contenu'])) {

            if (!empty($_POST['titre']) && !empty($_POST['contenu'])) {

                $titre_Actualites   = trim(filter_var($_POST['titre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $contenu_Actualites = trim(filter_var($_POST['contenu'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                // formater nom nom,status et type de salle
                $titre_Actualites   = ucfirst($titre_Actualites);
                $contenu_Actualites = ucfirst($contenu_Actualites);

                $actualites = new Actualites();
                $actualites->setTitre($titre_Actualites);
                $actualites->setContenu($contenu_Actualites);

                $actualitesManager = new ActualitesManager($lePDO);
                $addActualitesOk   = $actualitesManager->addActualites($actualites);


                if ($addActualitesOk) {

                    $_SESSION['success'] = "L'actualité est ajoutée avec succès";
                    header("location:./?path=admin&action=listActualites");
                    exit;
                } else {
                    $_SESSION['error'] = "Une erreur est survenue ... Merci de ressayer";
                    header("location:./?path=admin&action=listActualites");
                }
            } else {
                $_SESSION['error'] = "Une erreur est survenue, Merci de remplir les champs vides";
                header("location:./?path=admin&action=listActualites");
            }
        } else {
            $_SESSION['error'] = "Une erreur est survenue, Formulaire non envoyé";
            header("location:./?path=admin&action=listActualites");
        }

        //fin traitement actualites

        break;

    case "edit-actualites":
        // debut edit  actualites
        if (isset($_GET['edit_id'])) {

            $edit_id           =  filter_var($_GET['edit_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $actualitesManager = new ActualitesManager($lePDO);
            $actualites        = $actualitesManager->getActualitesById($edit_id);
        }
        require('view/admin/actualites/editActualites.php');
        // fin  edit  actualites
        break;

    case "traitement-edit-actualites":
        // debut traitement edit  actualites

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            $_SESSION['error'] = "Une erreur est survenue : la methode POST est attendu";
            header("location:./?path=admin&action=listActualites");
        }


        if (isset($_POST['edit_id'], $_POST['edit_titre'], $_POST['edit_contenu'])) {
            //  var_dump($_POST);exit;

            if (!empty($_POST['edit_titre']) && !empty($_POST['edit_contenu'])) {

                $id_Actualites      = trim(filter_var($_POST['edit_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $titre_Actualites   = trim(filter_var($_POST['edit_titre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $contenu_Actualites = trim(filter_var($_POST['edit_contenu'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                // formater nom nom,status et type de salle

                $titre_Actualites   = ucfirst($titre_Actualites);
                $contenu_Actualites = ucfirst($contenu_Actualites);

                $actualites = new Actualites();
                $actualites->setIdActualites($id_Actualites);
                $actualites->setTitre($titre_Actualites);
                $actualites->setContenu($contenu_Actualites);

                $actualitesManager  = new ActualitesManager($lePDO);
                $updateActualitesOk = $actualitesManager->updateActualites($actualites);

                if ($updateActualitesOk) {

                    $_SESSION['success'] = "Mis-à-jour du effectuée avec succès";
                    header("location:./?path=admin&action=listActualites");
                    exit;
                } else {
                    $_SESSION['error'] = "Une erreur est survenue lors des modifications";
                    header("location:./?path=admin&action=listActualites");
                }
            } else {
                $_SESSION['error'] = "Une erreur est survenue, Merci de remplir les champs vides";
                header("location:./?path=admin&action=listActualites");
            }
        } else {
            $_SESSION['error'] = "Une erreur est survenue, Formulaire non envoyé";
            header("location:./?path=admin&action=listActualites");
        }

        // fin traitement edit  actualites
        break;

    case "delete-actualites":
        // debut delete actualites
        if (isset($_POST['delete_btn'])) {

            if (isset($_POST['delete_id'])) {

                $delete_id          =  filter_var($_POST['delete_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $actualitesManager  = new ActualitesManager($lePDO);
                $deleteActualitesOk = $actualitesManager->deleteActualitesByIdActualites($delete_id);
            }

            if ($deleteActualitesOk) {

                $_SESSION['success'] = "L'actualité supprimé avec succès";
                header("location:./?path=admin&action=listActualites");
                exit;
            } else {
                $_SESSION['error'] = "Une erreur est survenue lors de suppression";
                header("location:./?path=admin&action=listActualites");
            }
        }
        require('view/admin/aboutus/editActualites.php');
        // fin delete  actualites        break;

        break;


    case "loginAdmin":
        require('view/admin/administrateur/loginAdmin.php');
        break;

    case "logoutAdmin":
        require('view/admin/administrateur/logoutAdmin.php');
        break;

    default:
        require('view/404.php');
}
