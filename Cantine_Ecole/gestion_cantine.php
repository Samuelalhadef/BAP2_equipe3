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
    <title>Administration - Cantine</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h1>Administration de la Cantine</h1>
        
        <div class="content">
            <!-- Cette section sera à développer selon vos besoins -->
            <div class="section-menus">
                <h2>Menus de la Semaine</h2>
                <p>Gestion des menus à implémenter...</p>
            </div>

            <div class="section-parametres">
                <h2>Paramètres</h2>
                <p>Configuration à implémenter...</p>
            </div>
        </div>
        
        <a href="menu_cantine.php" class="back-link">← Retour au menu cantine</a>
    </div>
</body>
</html> 