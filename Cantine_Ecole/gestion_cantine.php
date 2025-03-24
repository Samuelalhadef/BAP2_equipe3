<?php
session_start();

// if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'ecole') {
//     header('Location: ../HTML_Connexion.php');
//     exit();
// }

require_once '../bdd.php';

$query = $connexion->query("SELECT * FROM menu ORDER BY date_menu DESC");
$menus = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Cantine</title>
    <link rel="stylesheet" href="../style.css">
    <style>
    .menu-item {
        background: white;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .menu-actions {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .btn {
        padding: 8px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
    }

    .btn-primary {
        background-color: #4CAF50;
        color: white;
    }

    .btn-secondary {
        background-color: #2196F3;
        color: white;
    }

    .btn-danger {
        background-color: #F44336;
        color: white;
    }
    </style>
</head>

<body>
    <div class="container">
        <a href="menu_cantine.php" class="back-link">← Retour au menu</a>
        <h1>Administration de la Cantine</h1>

        <div class="content">
            <div class="section-menus">
                <h2>Gérer les menus</h2>
                <p>Gérez les menus de la semaine et leur composition.</p>

                <a href="ajouter_menu.php" class="btn btn-primary">Ajouter un nouveau menu</a>

                <h3>Menus existants</h3>
                <?php if (empty($menus)): ?>
                <p>Aucun menu n'a été créé pour le moment.</p>
                <?php else: ?>
                <?php foreach ($menus as $menu): ?>
                <div class="menu-item">
                    <h4>Menu du <?php echo !empty($menu['date_menu']) ? date('d/m/Y', strtotime($menu['date_menu'])) : 'non défini'; ?></h4>

                    <div>
                        <strong>Entrée:</strong> <?php echo htmlspecialchars($menu['entree'] ?? 'Non défini'); ?><br>
                        <strong>Plat principal:</strong> <?php echo htmlspecialchars($menu['plat'] ?? 'Non défini'); ?><br>
                        <strong>Dessert:</strong> <?php echo htmlspecialchars($menu['dessert'] ?? 'Non défini'); ?>
                    </div>

                    <div class="menu-actions">
                        <a href="modifier_menu.php?id=<?php echo $menu['id']; ?>" class="btn btn-secondary">Modifier</a>
                        <a href="supprimer_menu.php?id=<?php echo $menu['id']; ?>" class="btn btn-danger"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce menu ?')">Supprimer</a>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="section-parametres">
                <h2>Paramètres</h2>
                <p>Configuration des horaires et autres paramètres de la cantine.</p>
                <!-- Cette section peut être développée plus tard -->
            </div>
        </div>
    </div>
</body>

</html>