<?php
session_start();

// Vérification CSRF pour la sécurité
if (!isset($_POST['token']) || !isset($_SESSION['csrf_vote_add']) || $_POST['token'] !== $_SESSION['csrf_vote_add']) {
    die("Erreur de sécurité.");
}

// Vérifier si un type de vote a été soumis
if (isset($_POST['vote_type'])) {
    $vote_type = $_POST['vote_type'];
    
    // Stocker temporairement le vote dans la session pour l'enregistrer après le deuxième vote
    $_SESSION['vote_faim'] = $vote_type;
    
    // Régénérer un nouveau token CSRF pour la prochaine étape
    $_SESSION['csrf_vote_add'] = bin2hex(random_bytes(32));
    
    // Rediriger vers la page du deuxième vote
    header('Location: HTML_Vote_Like.php');
    exit;
} else {
    $_SESSION['vote_message'] = "Erreur: Données de vote incomplètes.";
    header('Location: HTML_Vote_Faim.php');
    exit;
}
?>