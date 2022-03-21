<?php
session_start();
require("model/bdd.php");
$lePDO = etablirCo(); // un objet PDO presente la function de la connexion

if (!isset($_GET['path'])) {
    $path = "main";
} else {
    
    $path = filter_var($_GET['path'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}
switch ($path) {

    case "admin":

        if (empty($_SESSION['role']) || $_SESSION['role'] != "admin") {
            header("location:./?path=main&action=403");

        } elseif ($_SESSION['role'] == "admin") {

            require('controller/adminController.php');

        } else {
            
            header("location:./?path=main&action=403");
        }
        break;


    case "client":

        if (empty($_SESSION['role']) || $_SESSION['role'] != "user") {

            header("location:./?path=main&action=connexion");

        }elseif ($_SESSION['role'] == "user"){

                require('controller/clientController.php');

            }else{
                header("location:./?path=main&action=connexion");
            }

        
        break;


    case "main":

        require('controller/Controller.php');
        break;

    default:
        require("view/404.php");
}
