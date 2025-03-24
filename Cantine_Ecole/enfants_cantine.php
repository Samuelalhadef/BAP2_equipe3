<?php
// session_start();

// if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'ecole') {
//     header('Location: ../../HTML_Connexion.php');
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Enfants - Cantine</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <div class="container">
        <h1>Gestion des Enfants - Cantine</h1>
        
        <div class="content">
            <!-- Cette section sera à développer selon vos besoins -->
            <div class="section-presence">
                <h2>Présences du jour</h2>
                <p>Liste des présences à implémenter...</p>
            </div>

            <div class="section-regimes">
                <h2>Régimes Alimentaires</h2>
                <p>Gestion des régimes à implémenter...</p>
            </div>
        </div>
        
        <a href="menu_cantine.php" class="back-link">← Retour au menu cantine</a>
    </div>
</body>
</html> 