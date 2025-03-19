<?php

try {
    $connexion = new PDO("mysql:host=localhost; dbname=BAP2_equipe3", "root", "");
} catch (Exception $e) {
    die("Erreur SQL :" . $e->getMessage());
}

// Assurez-vous que les tables `users` et `menu` existent dans votre base de données
// CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, email VARCHAR(255), menu_id INT, is_admin BOOLEAN);
// CREATE TABLE menu (id INT AUTO_INCREMENT PRIMARY KEY, entree VARCHAR(255), plat VARCHAR(255), dessert VARCHAR(255));

?>