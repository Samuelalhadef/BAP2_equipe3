<?php
require_once '../bdd.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    // Validate CSRF token
    if (!isset($_SESSION['csrf_menu_add']) || !isset($_POST['token']) || $_POST['token'] !== $_SESSION['csrf_menu_add']) {
        die("Invalid CSRF token.");
    }

    // Retrieve form data
    $nom_menu = $_POST['nom_menu'] ?? '';
    $entree = $_POST['entree'] ?? '';
    $plat = $_POST['plat'] ?? '';
    $garniture = $_POST['garniture'] ?? '';
    $produit_laitier = $_POST['produit_laitier'] ?? '';
    $dessert = $_POST['dessert'] ?? '';
    $divers = $_POST['divers'] ?? '';

    // Validate required fields
    if (!empty($nom_menu) && !empty($entree) && !empty($plat) && !empty($garniture) && !empty($produit_laitier) && !empty($dessert) && !empty($divers)) {
        // Insert into the database
        $sql = "INSERT INTO menu (nom_menu, entree, plat, garniture, produit_laitier, dessert, divers) 
                VALUES (:nom_menu, :entree, :plat, :garniture, :produit_laitier, :dessert, :divers)";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([
            'nom_menu' => $nom_menu,
            'entree' => $entree,
            'plat' => $plat,
            'garniture' => $garniture,
            'produit_laitier' => $produit_laitier,
            'dessert' => $dessert,
            'divers' => $divers
        ]);
        echo "<p>Menu ajouté avec succès !</p>";
    } else {
        echo "<p>Veuillez remplir tous les champs.</p>";
    }
}
?>