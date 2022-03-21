<?php

ini_set('display_errors', 'on');

// if(!isset($_SESSION["user"]) || (!isset($_SESSION["admin"]))){

//     include("view/connexion.php");
  
// }


//supprime une variable
unset($_SESSION["user"]);   // supprimer que la partied'utilisateur
unset($_SESSION["admin"]);   // supprimer que la partied'utilisateur
$_SESSION = array();  // vide le tableau de session
session_destroy(); // supprime tous

include("view/connexion.php");

?>