<?php
    session_start();

    if (!isset($_SESSION['csrf_menu_add']) || empty($_SESSION['csrf_menu_add'])){
        $_SESSION['csrf_menu_add'] = bin2hex(random_bytes(32));
    }

    // Récupérer les paramètres de l'URL
    $id_menu = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $field = isset($_GET['field']) ? $_GET['field'] : '';

    // Liste des champs autorisés pour la modification
    $allowed_fields = ['entree', 'plat', 'garniture', 'produit_laitier', 'dessert', 'divers', 'date_menu', 'nom_menu'];

    // Vérifier si le champ est valide
    if (!in_array($field, $allowed_fields)) {
        die('<p>Champ non valide pour la modification</p>');
    }

    // Charger les données actuelles du menu
    $current_value = '';
    if ($id_menu > 0) {
        require_once '../../bdd.php';
        $query = $connexion->prepare("SELECT * FROM menu WHERE id = :id");
        $query->execute(['id' => $id_menu]);
        $current_menu = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($current_menu) {
            $current_value = $current_menu[$field];
        } else {
            header('Location: ../Mairie/HTML_Liste_Menu.php');
            exit();
        }
    }

    // Traduire le nom du champ pour l'affichage
    $field_labels = [
        'entree' => 'Entrée',
        'plat' => 'Plat',
        'garniture' => 'Garniture',
        'produit_laitier' => 'Produit laitier',
        'dessert' => 'Dessert',
        'divers' => 'Divers',
        'date_menu' => 'Date du menu',
        'nom_menu' => 'Nom du menu'
    ];

    $field_label = $field_labels[$field];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../CSS/crud_menu.css">
    <title>Modifier <?= $field_label ?></title>
</head>
<body>
    <header>
        <p>Nom du projet<p>
        <p>Date du jour<p>
        <div>
            <div class="off-screen-menu">
                <ul class="off-screen-menu-item">
                    <li><a href="../../Mairie/HTML_Admin_Home.php">PAGE D'ACCUEIL</a></li>
                    <li><a href="../Mairie/Menu/HTML_Liste_Menu.php">GESTION DES MENUS</a></li>
                    <li><a href="../Mairie/Gestion_profils/HTML_Gestion_profils.php">GESTION DES PROFILS</a></li>
                    <li><a href="../Mairie/Synthese/HTML_Synthese.php">SYNTHESE</a></li>
                </ul>
                <ul class="off-screen-menu-plus">
                    <li class="off-screen-menu-item-text"><a href="#">Paramètres&nbsp;&nbsp;</a><i class="fa-solid fa-gear"></i></li>
                    <li class="off-screen-menu-item-text"><a href="../Log_Sign/HTML_Log_Sign.php">Se déconnecter&nbsp;&nbsp;</a><i class="fa-solid fa-right-from-bracket"></i></li>
                </ul>
            </div>
            <nav>
                <p>MENU&nbsp;&nbsp;</p>
                <div class="ham-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
    </header>
    
    <section class="crud_menu">
        <form action="PHP_MenuUpdate.php" method="POST">
            <h2>MODIFIER <?= strtoupper($field_label) ?></h2>
            <div class="textbox">
                <div class="infos">
                    <div class="info_to">
                        <label for="field_value"><?= $field_label ?></label>
                        <?php if ($field === 'date_menu'): ?>
                            <input type="date" name="field_value" id="field_value" value="<?= htmlspecialchars($current_value) ?>" required>
                        <?php else: ?>
                            <input type="text" name="field_value" id="field_value" value="<?= htmlspecialchars($current_value) ?>" required>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id_menu" value="<?= $id_menu ?>">
            <input type="hidden" name="field_name" value="<?= $field ?>">
            <input type="hidden" name="token" value="<?= $_SESSION['csrf_menu_add']; ?>">
            <input type="submit" name="modifier" value="Modifier">
            <a href="../../Mairie/Menu/HTML_menu_read.php?id=<?= $id_menu ?>" class="cancel-btn">Annuler</a>
        </form>
    </section>
    <script src="../../JS/nav.js"></script>
</body>
</html>