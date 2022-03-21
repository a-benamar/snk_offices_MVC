<?php

/**
 * Function qui permet d'établir la co a la BDD 
 * retourne la connexion
 */


function etablirCo()
{
     // dev connexion
    // $urlSGBD  = "localhost"; 
    // $nomBDD   = "snk_offices";
    // $loginBDD = "root";
    // $mdpBDD   = "";
    // $dsn      = "mysql:host=$urlSGBD; dbname=$nomBDD"; // data source name

    // remote database connexion
    $host  = "remotemysql.com"; 
    $nomBDD   = "NQwqORDCXH";
    $loginBDD = "NQwqORDCXH";
    $mdpBDD   = "nWq5tmfAI8";
    $dsn      = "mysql:host=$host; dbname=$nomBDD"; // data source name

    try {
        $connex = new PDO("$dsn", "$loginBDD", "$mdpBDD", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        $connex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $error) {
        echo "Problème de connexion!<br>";
        echo $error->getMessage();
    }

    return $connex;
}
