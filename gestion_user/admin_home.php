<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../admin.css">
    <title>Admin - Accueil</title>
</head>

<body>
    <h1>Accueil Admin - Gestion des utilisateurs</h1>
    <?php
        session_start();

        // Vérifiez si l'utilisateur est connecté
        if (!isset($_SESSION['email'])) {
            header('Location: ../log_sign/login.php'); // Updated path to login.php
            exit;
        }

        // Vérifiez si l'utilisateur est un admin
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
            echo "<p>Accès refusé. Vous n'êtes pas autorisé à accéder à cette page.</p>";
            exit;
        }

        // On accède à la base de donnée
        require_once '../bdd.php'; // Ensure the correct relative path to bdd.php

        // Requête SQL pour récupérer les données des utilisateurs
        $sql = "SELECT connexion.id, connexion.email, menu.entree, menu.plat, menu.dessert 
                FROM connexion 
                LEFT JOIN menu ON menu.id = menu.id"; // Removed reference to connexion.menu_id
        $result = $connexion->query($sql);

        if ($result->rowCount() > 0) {
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Email</th><th>Entrée</th><th>Plat</th><th>Dessert</th></tr>";
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['entree']) . "</td>";
                echo "<td>" . htmlspecialchars($row['plat']) . "</td>";
                echo "<td>" . htmlspecialchars($row['dessert']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Aucune donnée utilisateur trouvée.</p>";
        }
    ?>
</body>

</html>