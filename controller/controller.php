<?php
ini_set('display_errors', 'on');

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require_once("./model/managers/adminManager.php");
require_once("./model/managers/utilisateurManager.php");
require_once("./model/managers/reservationManager.php");
require_once("./model/managers/salleManager.php");
require_once("./model/managers/ImageManager.php");
require_once("./model/managers/AboutUsManager.php");
require_once("./model/managers/ActualitesManager.php");


if (!isset($_GET['action'])) {
    $action = "accueil";
} else {
    $action = filter_var($_GET['action'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch ($action) {
    case "accueil":
// la fonction qui deduire le texte de contenu à 20 mots dans les cartes.
        function tronquer($contenu){
				
            $texte_tronque = "";			
            $chaine_explode = explode(" ", $contenu);
            
        
            for($i = 0; $i < 45; $i++){
            $texte_tronque .= $chaine_explode[$i] . " ";
            }
        
            return $texte_tronque . "[...]";
        };

        $actualitesManager =  new ActualitesManager($lePDO);
        $actualites        =  $actualitesManager->getAllActualites();

        require('view/accueil.php');
        break;

        case "single-actualites":

            $idActualites      = filter_var($_GET['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $actualitesManager = new ActualitesManager($lePDO);
            $actualites        = $actualitesManager->getActualitesById($idActualites);

            require('view/actualite/single.php');
            break;

    case "decSalles":

        $imageManager     = new ImageManager($lePDO);
        $estPrincipale    = true;
        $images           = $imageManager->getImageByEstPrincipale($estPrincipale);
        $salleManagerById = new SalleManager($lePDO);

        require('view/salle/decSalles.php');
        break;

    case "description-salle":

        $imageManager = new ImageManager($lePDO);
        $idSalle      = filter_var($_GET['salle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $salleManager = new SalleManager($lePDO);

        require('view/salle/descriptionSalle.php');
        break;

    case "domiciliation":
        require('view/domiciliation/domiciliation.php');
        break;

    case "aboutUs":

        $aboutUsManager = new AboutUsManager($lePDO);
        $idAboutUs      = 1;
        $aboutUs        = $aboutUsManager->getAboutUsById($idAboutUs);

        require('view/aboutUs.php');
        break;

    case "contact":
        require('view/contact.php');
        break;

    case "traitement-contact":

        require 'public/PHPMailer-master/src/Exception.php';
        require 'public/PHPMailer-master/src/PHPMailer.php';
        require 'public/PHPMailer-master/src/SMTP.php';

        function secure_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            $_SESSION['error'] = "Erreur dans la requête d'envoi - POST attendu";
            header('Location:./?path=main&action=contact');
            exit;
        }

        if (!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['sujet']) && !empty($_POST['message'])) {

            $nom = secure_input($_POST['nom']);
            $email = secure_input($_POST['email']);
            $sujet = secure_input($_POST['sujet']);
            $message = secure_input($_POST['message']);

            $email = secure_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }


            $mail = new PHPmailer();
            $mail->IsSMTP();
            // $mail->SMTPDebug = 2;
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->SMTPAuth = true;
            $mail->Username = "contact.snkoffices@gmail.com"; //votre gmail
            $mail->Password = "Hops12ikhouvanje12"; // mdp gmail
            $mail->SMTPSecure = 'ssl';
            $mail->setFrom($email, 'Formulaire de contact SNK Offices'); // votre gmail
            $mail->AddAddress('contact.snkoffices@gmail.com');

            $mail->IsHTML(true);
            $mail->Subject = 'Message de ' . $nom . '- E-mail: ' . $email . '- sujet: ' . $sujet;
            $mail->Body = $message;
            $mail->CharSet = "UTF-8";

            if (!$mail->Send()) { //Teste le return code de la fonction
                //  var_dump(!$mail->Send());exit;
                //echo $mail->ErrorInfo; //Affiche le message d'erreur 
                $_SESSION['error'] = "Message non envoyé, Merci de ressayer";
                header('location:./?path=main&action=contact');
                exit;
            } else {
                $_SESSION['success'] = 'Message envoyé avec succès';
                header('location:./?path=main&action=contact');
            }
            $mail->SmtpClose();
            unset($mail);
        } else {
            $_SESSION["error"] = "Merci de remplir les champs obligatoire";
            header('location:./?path=main&action=contact');
            exit;
        }

        break;

    case "connexion":
        if (isset($_SESSION['email'])) {
            session_unset();
            session_destroy();
            header('location: ./?path=main&action=connexion');
        } else {
            require('view/connexion.php');
        }

        break;

    case "traitement-connexion":

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            $_SESSION['error'] = "Erreur dans la requête d'envoi - POST attendu";
            header('Location:./?path=main&action=connexion');
            exit;
        }

        if (isset($_POST['email'], $_POST['mdp'])) {

            if (!empty($_POST['email']) && !empty($_POST['mdp'])) {

                if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
                    $_SESSION['error'] = "L'email n'est pas valide";
                    header('Location:./?path=main&action=connexion');
                    exit;
                }

                $email         = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
                $email         = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password      = filter_var($_POST["mdp"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password      = hash("sha256", $password);

                $admin         = new AdminManager($lePDO);
                $utilisateur   = new UtilisateurManager($lePDO);

                $isAdmin       = $admin->getAdminByEmailAndPassword($email, $password);
                $isUtilisateur = $utilisateur->getUtilisateurByEmailAndPassword($email, $password);

                if ($isAdmin) {
                    session_unset();
                    $_SESSION["id"]     = $isAdmin->getIdAdmin();
                    $_SESSION["pseudo"] = $isAdmin->getPseudo();
                    $_SESSION["email"]  = $isAdmin->getEmail();
                    $_SESSION["role"]   = 'admin';

                    header('Location:./?path=main&action=accueil');
                    exit;
                } else {

                    if ($isUtilisateur) {
                        session_unset();
                        $_SESSION["id"]     = $isUtilisateur->getIdUtilisateur();
                        $_SESSION["pseudo"] = $isUtilisateur->getPseudo();
                        $_SESSION["email"]  = $isUtilisateur->getEmail();
                        $_SESSION["role"]   = 'user';

                        header('Location:./?path=main&action=accueil');
                    } else {

                        $_SESSION["error"] = "Erreur - Email et / ou mot de passe incorrect";
                        header('Location:./?path=main&action=connexion');
                        exit;
                    }
                }
            } else {
                $_SESSION["error"] = "Erreur - Merci de remplir tous les champs";
                header('Location:./?path=main&action=connexion');
                exit;
            }
        } else {
            $_SESSION["error"] = "formulaire non ennvoyé";
            header('Location:./?path=main&action=connexion');
            exit;
        }

        break;


    case "inscription":
        require('view/utilisateur/inscription.php');

        break;
    case "traitement-inscription":

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {


            $_SESSION['error'] = "Une erreur est survenue : la methode POST est attendu";
            header("location:./?path=admin&action=listSalle");
        }


        if (isset($_POST['pseudo'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['tel'], $_POST['mdp'], $_POST['c_mdp'])) {

            if (!empty($_POST['pseudo']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['c_mdp'])) {

                // Nettoyage des caractères HTML et création des variables
                $user_pseudo      = trim(filter_var($_POST['pseudo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_nom         = trim(filter_var($_POST['nom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_prenom      = trim(filter_var($_POST['prenom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_adresse     = trim(filter_var($_POST['adresse'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_codePostale = trim(filter_var($_POST['cp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_ville       = trim(filter_var($_POST['ville'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_tel         = trim(filter_var($_POST['tel'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_email       = trim(filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_password    = trim(filter_var($_POST['mdp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
                $user_c_password  = trim(filter_var($_POST['c_mdp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                //on verifie la validation de l'email
                if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {

                    $_SESSION["error"] = "Erreur - L'email n'est pas valide)";
                    header('Location:./?path=main&action=traitement-inscription');
                    exit;
                }

                // nettoyage de l'email
                $user_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);

                //Formater le nom et le prénom proprement 
                $user_nom    = strtoupper($user_nom);
                $user_prenom = strtolower($user_prenom);
                $user_prenom = ucfirst($user_prenom);
                $user_email  = strtolower($user_email);
                $user_ville  = ucfirst($user_ville);

                // on verifie si les deux mdp saisis sont bon

                if ($user_password !== $user_c_password) {

                    $_SESSION['error'] = "Erreur - les mot de passe ne sont pas identiques";
                    header("location: ./?path=main&action=inscription");
                    exit;
                }

                // on va hasher le mot de passe

                $user_password = hash("sha256", $user_password);

                $utilisateurManager = new utilisateurManager($lePDO);
                $checkEmail         = $utilisateurManager->getUtilisateurByEmail($user_email);

                if ($checkEmail) {

                    $_SESSION["error"] = "Un compte deja éxiste avec cette adresse Mail";
                    header("location: ./?path=main&action=inscription");
                    exit;
                } else {

                    $utilisateur = new Utilisateur();
                    $utilisateur->setPseudo($user_pseudo);
                    $utilisateur->setNom($user_nom);
                    $utilisateur->setPrenom($user_prenom);
                    $utilisateur->setEmail($user_email);
                    $utilisateur->setAdresse($user_adresse);
                    $utilisateur->setVille($user_ville);
                    $utilisateur->setTel($user_tel);
                    $utilisateur->setCp($user_codePostale);
                    $utilisateur->setMdp($user_password);

                    $inscriptionUtilisateurOk = $utilisateurManager->addUtilisateur($utilisateur);

                    if ($inscriptionUtilisateurOk) {
                        session_unset();
                        // Le formulaire est validé, on renvoie un message de réussite
                        $_SESSION["success"] = 'Votre compte à été crée avec succès, merci de se connecter  <a href="./?path=main&action=connexion" class="link-success fw-bold"> ici ...</a>';
                        header("location: ./?path=main&action=inscription");
                        exit;
                    } else {
                        $_SESSION['error'] = "Une erreur est survenue lors de la création de compte.";
                        header("location:./?path=main&action=inscription");
                    }
                }
            } else {
                $_SESSION['error'] = "Une erreur est survenue, Merci de ressayer";
                header("location:./?path=main&action=inscription");
            }
        } else {
            $_SESSION['error'] = "Une erreur est survenue, Merci de remplir les champs vide";
            header("location:./?path=main&action=inscription");
        }


        break;

    case "deconnexion":
        require('view/deconnexion.php');
        break;

    case "403":

        require('view/403.php');


    default:
        require('view/404.php');
}


