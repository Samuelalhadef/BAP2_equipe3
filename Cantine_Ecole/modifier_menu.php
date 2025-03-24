<?php
session_start();

require_once '../bdd.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: gestion_cantine.php');
    exit;
}

$id_menu = (int)$_GET['id'];

$query = $connexion->prepare("SELECT * FROM menu WHERE id = :id");
$query->execute(['id' => $id_menu]);
$menu = $query->fetch(PDO::FETCH_ASSOC);

if (!$menu) {
    header('Location: gestion_cantine.php');
    exit;
}

// Get menu details directly from the menu table
$entree = $menu['entree'] ?? '';
$plat = $menu['plat'] ?? '';
$dessert = $menu['dessert'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date_menu = $_POST['date_menu'];
    $entree = $_POST['entree'];
    $plat = $_POST['plat'];
    $dessert = $_POST['dessert'];
    
    if (empty($date_menu)) {
        $error = "La date du menu est obligatoire";
    } else {
        // Update the menu directly with all fields
        $query = $connexion->prepare("UPDATE menu SET date_menu = :date_menu, entree = :entree, plat = :plat, dessert = :dessert WHERE id = :id");
        $result = $query->execute([
            'date_menu' => $date_menu,
            'entree' => $entree,
            'plat' => $plat,
            'dessert' => $dessert,
            'id' => $id_menu
        ]);
        
        if ($result) {
            header('Location: gestion_cantine.php');
            exit;
        } else {
            $error = "Une erreur est survenue lors de la modification du menu";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un menu - Cantine</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .form-container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group textarea {
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
        .btn-secondary {
            background-color: #ccc;
            color: #333;
        }
        .error {
            color: #F44336;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="gestion_cantine.php" class="back-link">← Retour à la gestion</a>
        <h1>Modifier le menu du <?php echo date('d/m/Y', strtotime($menu['date_menu'])); ?></h1>
        
        <div class="form-container">
            <?php if (isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="date_menu">Date du menu</label>
                    <input type="date" id="date_menu" name="date_menu" value="<?php echo $menu['date_menu']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="entree">Entrée</label>
                    <input type="text" id="entree" name="entree" value="<?php echo htmlspecialchars($entree); ?>" placeholder="Ex: Salade de tomates">
                </div>
                
                <div class="form-group">
                    <label for="plat">Plat principal</label>
                    <input type="text" id="plat" name="plat" value="<?php echo htmlspecialchars($plat); ?>" placeholder="Ex: Poulet rôti et pommes de terre">
                </div>
                
                <div class="form-group">
                    <label for="dessert">Dessert</label>
                    <input type="text" id="dessert" name="dessert" value="<?php echo htmlspecialchars($dessert); ?>" placeholder="Ex: Yaourt ou fruit">
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    <a href="gestion_cantine.php" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>