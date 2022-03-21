<?php

if(isset($_POST['logout_btn']))
{
    session_destroy();
    unset($_SESSION['pseudo']);
    header('location: ./?path=main&action=accueil');
}


