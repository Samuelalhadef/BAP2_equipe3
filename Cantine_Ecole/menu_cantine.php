<?php
// session_start();

// if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'ecole') {
//     header('Location: ../HTML_Connexion.php');
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Cantine</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="menu-container">
        <h1>Gestion de la Cantine</h1>
        
        <div class="menu-options">
            <a href="vote_faim.php" class="menu-card">
                <h2>Zone Enfants - Vote du Jour</h2>
                <p>Système de vote pour la faim</p>
            </a>
            <br>
            <br>
            <a href="gestion_cantine.php" class="menu-card">
                <h2>Administration Cantine</h2>
                <p>Paramètres et gestion de la cantine</p>
            </a>
        </div>
        
        <a href="../dashboard_ecole.php" class="back-link">← Retour au tableau de bord principal</a>
    </div>
</body>
</html> 