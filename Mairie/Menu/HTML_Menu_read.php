<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../CSS/crud_menu.css">
    <title>Lire le menu</title>
</head>

<body>
    <header>
        <p>EcoMiam</p>
        <p id="date"></p>
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

    <button class="back"><a href="../../Mairie/Menu/HTML_Liste_menu.php"><i class="fa-solid fa-arrow-left"></i>Revenir sur la liste des menus</a></button>

    <div class="elements_all">
        <?php
        // Vérifier si le paramètre "id" est bien présent
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            die('<p>Menu introuvable (paramètre manquant)</p>');
        }

        require_once '../../bdd.php';

        // Récupérer et sécuriser l'ID du menu
        $id_menu = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id_menu) {
            die('<p>ID du menu invalide</p>');
        }

        // Préparer la requête SQL
        $getmenu = $connexion->prepare(
            'SELECT * FROM menu WHERE id = :id LIMIT 1'
        );

        // Exécuter la requête avec l'ID assaini
        $getmenu->execute(['id' => $id_menu]);

        if ($getmenu->rowCount() === 1) {
            $menu = $getmenu->fetch(PDO::FETCH_ASSOC);
            echo '<div class="elements">';
                echo '<div class="element">';
                    echo '<h3>Entrée:</h3>';
                    echo '<p>' . htmlspecialchars($menu['entree']) . '</p>';
                    echo '<button><a href="../../Mairie/Menu/HTML_menu_update.php?id=' . $id_menu . '&field=entree">Modifier<i class="fa-solid fa-pencil"></i></a></button>';
                echo '</div>';
                echo '<div class="element">';
                    echo '<h3>Plat:</h3>';
                    echo '<p>' . htmlspecialchars($menu['plat']) . '</p>';
                    echo '<button><a href="../../Mairie/Menu/HTML_menu_update.php?id=' . $id_menu . '&field=plat">Modifier<i class="fa-solid fa-pencil"></i></a></button>';
                echo '</div>';
                echo '<div class="element">';
                    echo '<h3>Garniture:</h3>';
                    echo '<p>' . htmlspecialchars($menu['garniture']) . '</p>';
                    echo '<button><a href="../../Mairie/Menu/HTML_menu_update.php?id=' . $id_menu . '&field=garniture">Modifier<i class="fa-solid fa-pencil"></i></a></button>';
                echo '</div>';
            echo '</div>';
            
            echo '<div class="elements">';
                echo '<div class="element">';
                    echo '<h3>Produit laitier:</h3>';
                    echo '<p>' . htmlspecialchars($menu['produit_laitier']) . '</p>';
                    echo '<button><a href="../../Mairie/Menu/HTML_menu_update.php?id=' . $id_menu . '&field=produit_laitier">Modifier<i class="fa-solid fa-pencil"></i></a></button>';
                echo '</div>';
                echo '<div class="element">';
                    echo '<h3>Dessert:</h3>';
                    echo '<p>' . htmlspecialchars($menu['dessert']) . '</p>';
                    echo '<button><a href="../../Mairie/Menu/HTML_menu_update.php?id=' . $id_menu . '&field=dessert">Modifier<i class="fa-solid fa-pencil"></i></a></button>';
                echo '</div>';
                echo '<div class="element">';
                    echo '<h3>Divers:</h3>';
                    echo '<p>' . htmlspecialchars($menu['divers']) . '</p>';
                    echo '<button><a href="../../Mairie/Menu/HTML_menu_update.php?id=' . $id_menu . '&field=divers">Modifier<i class="fa-solid fa-pencil"></i></a></button>';
                echo '</div>';
            echo '</div>';
        }
        else {
            echo '<p>Menu introuvable en base de données</p>';
        }
        ?>
    </div>
    
    <script src="../../JS/nav.js"></script>
    <script src="../../JS/enregistrement.js"></script>
</body>
</html>


