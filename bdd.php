<?php

try {
    $connexion = new PDO("mysql:host=localhost; dbname=table_plante", "root", "");
}
catch (Exception $e){
    die("Erreur SQL :" . $e->getMessage());
}

?>