<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/crud.css">
    <title>READ menu</title>
</head>

<body>
    <header>
        <p>Nom du projet<p>
        <p>Date du jour<p>
        <div>
            <div class="off-screen-menu">
                <ul class="off-screen-menu-item">
                <li><a href="../Mairie/HTML_Admin_Home.php">PAGE D'ACCUEIL</a></li>
                <li><a href="../Mairie/HTML_Liste_Menu.php">GESTION DES MENUS</a></li>
                    <li><a href="#">GESTION DES PROFILS</a></li>
                    <li><a href="#">SYNTHESE</a></li>
                </ul>
                <ul class="off-screen-menu-plus">
                    <li class="off-screen-menu-item-text"><a href="#">Paramètres&nbsp;&nbsp;</a><i class="fa-solid fa-gear"></i></li>
                    <li class="off-screen-menu-item-text"><a href="#">Se déconnecter&nbsp;&nbsp;</a><i class="fa-solid fa-right-from-bracket"></i></li>
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

    <div>
        <p><a href="HTML_Liste_menus.php">Revenir sur la liste des menus</a></p>
        
        <?php

            if (!isset($_GET['menu']) || empty($_GET['menu'])){
                die('<p>menu introuvable</p>');
            }

            // Connexion à la BDD
            require_once 'bdd.php';

            $getmenu = $connexion -> prepare (
                query: 'SELECT entree, plat, dessert
                        FROM menu
                        WHERE nom_menu = :nom_menu
                        LIMIT 1'
            );

            $getmenu-> execute (params: ['generique' => htmlspecialchars(string: $_GET['menu'])]);

            if ($getmenu->rowCount() == 1) {
                $menu = $getmenu -> fetch();
                echo '<h1>', $menu['nom_menu'],'</h1>';
            }

            ?>

        <button><a href='HTML_menu_update.php'>Modifier</a></button>
        <button><a href='HTML_menu_delete.php'>Supprimer</a></button>
    </div>
    
    <script src="../JS/nav.js"></script>
</body>
</html>



