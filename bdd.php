<?php
try {
    // Option 1: Try connecting to localhost with default port
    $connexion = new PDO("mysql:host=localhost;dbname=BAP2_equipe3", "root", "");
    
    // Option 2: If localhost doesn't work, try 127.0.0.1 (explicit IP)
    // $connexion = new PDO("mysql:host=127.0.0.1;dbname=BAP2_equipe3", "root", "");
    
    // Option 3: Try specifying the port explicitly
    // $connexion = new PDO("mysql:host=localhost;port=3306;dbname=BAP2_equipe3", "root", "");
    
    // Option 4: If you're using MAMP on Mac, try this
    // $connexion = new PDO("mysql:host=localhost;port=8889;dbname=BAP2_equipe3", "root", "root");
    
    // Set PDO error mode to exception
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die("Erreur SQL : " . $e->getMessage());
}
?>