<?php
session_start();
require_once '../../bdd.php';

if (isset($_GET['id'])) {
    $menu_id = $_GET['id'];

    // Préparer et exécuter la requête de suppression
    $query = $connexion->prepare("DELETE FROM menu WHERE id = :id");
    $result = $query->execute(['id' => $menu_id]);

    if ($result) {
        // Rediriger vers la page de gestion après la suppression
        header('Location: gestion_cantine.php');
        exit;
    } else {
        echo "Une erreur est survenue lors de la suppression du menu.";
    }
} else {
    echo "ID de menu non spécifié.";
}
?>