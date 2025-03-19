<?php
try {
    $connexion = new PDO("mysql:host=localhost;dbname=BAP2_equipe3", "root", "");
    echo "Connexion réussie à la base de données.";
} catch (PDOException $e) {
    die("Erreur SQL : " . $e->getMessage());
}
?>
