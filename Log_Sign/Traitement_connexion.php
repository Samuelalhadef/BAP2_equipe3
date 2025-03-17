<?php
session_start();

// Vérification du token CSRF
if (!isset($_POST['token']) || !isset($_SESSION['csrf_connexion_add'])) {
    header('Location: HTML_Connexion.php');
    exit('Session expirée, veuillez réessayer');
}

if (!hash_equals($_SESSION['csrf_connexion_add'], $_POST['token'])) {
    header('Location: HTML_Connexion.php');
    exit('CSRF invalide');
}

// Régénérer un nouveau token pour la prochaine utilisation
$_SESSION['csrf_connexion_add'] = bin2hex(random_bytes(32));

// Le reste du code de traitement de la connexion
// ... existing code ... 