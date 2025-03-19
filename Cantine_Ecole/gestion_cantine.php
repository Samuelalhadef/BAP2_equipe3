<?php
session_start();

// if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'ecole') {
//     header('Location: ../HTML_Connexion.php');
//     exit();
// }

require_once '../bdd.php';

$query = $connexion->query("SELECT * FROM menu ORDER BY date_menu DESC");
$menus = $query->fetchAll(PDO::FETCH_ASSOC);


while ($menu = $query->fetch()) {
    echo "<div class='menu-item'>";
    echo "<h3>" . htmlspecialchars($menu['nom_menu']) . "</h3>";
    echo "<p>Date: " . htmlspecialchars($menu['date_menu']) . "</p>";
    echo "<a href='modifier_menu.php?id=" . $menu['id'] . "' class='btn btn-secondary'>Modifier</a>";
    echo "<a href='supprimer_menu.php?id=" . $menu['id'] . "' class='btn btn-danger' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce menu ?')\">Supprimer</a>";
    echo "</div>";
}
// Récupérer les données journalières pour aujourd'hui
$date_today = date('Y-m-d');
$query = $connexion->prepare("SELECT * FROM donnees_journee WHERE date_jour = :date_jour");
$query->execute(['date_jour' => $date_today]);
$donnees_journee = $query->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $poids_dechets = $_POST['poids_dechets'];
    $poids_pain = $_POST['poids_pain'];
    $nb_repas_prevus = $_POST['nb_repas_prevus'];
    $nb_repas_adultes = $_POST['nb_repas_adultes'];
    $nb_repas_non_consommes = $_POST['nb_repas_non_consommes'];

    if ($donnees_journee) {
        // Mettre à jour les données existantes
        $query = $connexion->prepare("UPDATE donnees_journee SET poids_dechets = :poids_dechets, poids_pain = :poids_pain, nb_repas_prevus = :nb_repas_prevus, nb_repas_adultes = :nb_repas_adultes, nb_repas_non_consommes = :nb_repas_non_consommes WHERE date_jour = :date_jour");
        $query->execute([
            'poids_dechets' => $poids_dechets,
            'poids_pain' => $poids_pain,
            'nb_repas_prevus' => $nb_repas_prevus,
            'nb_repas_adultes' => $nb_repas_adultes,
            'nb_repas_non_consommes' => $nb_repas_non_consommes,
            'date_jour' => $date_today
        ]);
    } else {
        // Insérer de nouvelles données
        $query = $connexion->prepare("INSERT INTO donnees_journee (date_jour, poids_dechets, poids_pain, nb_repas_prevus, nb_repas_adultes, nb_repas_non_consommes) VALUES (:date_jour, :poids_dechets, :poids_pain, :nb_repas_prevus, :nb_repas_adultes, :nb_repas_non_consommes)");
        $query->execute([
            'date_jour' => $date_today,
            'poids_dechets' => $poids_dechets,
            'poids_pain' => $poids_pain,
            'nb_repas_prevus' => $nb_repas_prevus,
            'nb_repas_adultes' => $nb_repas_adultes,
            'nb_repas_non_consommes' => $nb_repas_non_consommes
        ]);
    }

    header('Location: gestion_cantine.php');
    exit;
}
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
        .form-container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-primary {
            background-color: #4CAF50;
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
                                <h4>Menu du <?php echo date('d/m/Y', strtotime($menu['date_menu'])); ?></h4>
                                
                                <?php 
                            // Récupérer les aliments pour ce menu
                            $query = $connexion->prepare("SELECT * FROM aliments WHERE id_menu = :id_menu");
                            $query->execute(['id_menu' => $menu['id']]);
                            $aliments = $query->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            
                            <div>
                                <?php if (empty($aliments)): ?>
                                    <p><em>Aucun aliment défini pour ce menu</em></p>
                                    <?php else: ?>
                                        <strong>Entrée:</strong> 
                                        <?php 
                                    $entrees = array_filter($aliments, function($a) { return $a['type'] === 'entree'; });
                                    echo !empty($entrees) ? reset($entrees)['nom'] : 'Non défini';
                                    ?>
                                    <br>
                                    
                                    <strong>Plat principal:</strong> 
                                    <?php 
                                    $plats = array_filter($aliments, function($a) { return $a['type'] === 'plat'; });
                                    echo !empty($plats) ? reset($plats)['nom'] : 'Non défini';
                                    ?>
                                    <br>
                                    
                                    <strong>Dessert:</strong> 
                                    <?php 
                                    $desserts = array_filter($aliments, function($a) { return $a['type'] === 'dessert'; });
                                    echo !empty($desserts) ? reset($desserts)['nom'] : 'Non défini';
                                    ?>
                                <?php endif; ?>
                            </div>
                            
                            <div class="menu-actions">
                                <a href="modifier_menu.php?id=<?php echo $menu['id']; ?>" class="btn btn-secondary">Modifier</a>
                                <a href="supprimer_menu.php?id=<?php echo $menu['id']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce menu ?')">Supprimer</a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                        <div class="form-container">
                            <h2>Données Journalières</h2>
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label for="poids_dechets">Poids des déchets (kg)</label>
                                    <input type="number" id="poids_dechets" name="poids_dechets" value="<?php echo $donnees_journee['poids_dechets'] ?? ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="poids_pain">Poids du pain (kg)</label>
                                    <input type="number" id="poids_pain" name="poids_pain" value="<?php echo $donnees_journee['poids_pain'] ?? ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="nb_repas_prevus">Nombre de repas prévus</label>
                                    <input type="number" id="nb_repas_prevus" name="nb_repas_prevus" value="<?php echo $donnees_journee['nb_repas_prevus'] ?? ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="nb_repas_adultes">Nombre de repas adultes</label>
                                    <input type="number" id="nb_repas_adultes" name="nb_repas_adultes" value="<?php echo $donnees_journee['nb_repas_adultes'] ?? ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="nb_repas_non_consommes">Nombre de repas non consommés</label>
                                    <input type="number" id="nb_repas_non_consommes" name="nb_repas_non_consommes" value="<?php echo $donnees_journee['nb_repas_non_consommes'] ?? ''; ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html> 