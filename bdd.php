<?php

try {
    $connexion = new PDO("mysql:host=localhost; dbname=BAP2_equipe3", "root", "");
}
catch (Exception $e){
    die("Erreur SQL :" . $e->getMessage());
}

?>