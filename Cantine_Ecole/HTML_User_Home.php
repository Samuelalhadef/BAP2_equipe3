<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header('Location: ../log_sign/login.php'); // Redirigez vers la page de connexion si non connecté
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../home.css">
    <title>Page d'accueil Admin</title>
</head>
<body>
    <h1>BONJOUR,</h1>
    <h2><?php echo htmlspecialchars($_SESSION['email']); ?></h2>

    <div class="menu_recap">
        <p>Menu du jour :</p>
        <?php
        // Requête SQL pour sélectionner et afficher une colonne
        $sql = "SELECT * FROM menu";
        $req = $connexion->query($sql);

        if (isset($_SESSION['entree']) && isset($_SESSION['plat']) && isset($_SESSION['dessert'])) {
            echo "<p>Entrée : " . htmlspecialchars($_SESSION['entree']) . "</p>";
            echo "<p>Plat : " . htmlspecialchars($_SESSION['plat']) . "</p>";
            echo "<p>Dessert : " . htmlspecialchars($_SESSION['dessert']) . "</p>";
        } else {
            echo "<p>Il n'y a pas de menus dans la liste pour le moment</p>";
        }
        ?>
        <button>Gestion des menus<i class="fa-solid fa-arrow-right"></i></button>
        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1): ?>
        <button onclick="window.location.href='../gestion_user/admin_home.php'">Voir les données des utilisateurs</button>
        <?php endif; ?>
    </div>
</body>
</html>