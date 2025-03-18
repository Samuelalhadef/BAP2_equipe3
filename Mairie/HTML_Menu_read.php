<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./globals.css">
    <title>READ menu</title>
</head>

<body>

    <div>
        <p><a href="HTML_Liste_menus.php">Revenir sur la liste des menus</a></p>
        
        <?php

            if (!isset($_GET['menu']) || empty($_GET['menu'])){
                die('<p>menu introuvable</p>');
            }

            // Connexion à la BDD
            require_once 'bdd.php';

            $getmenu = $connexion -> prepare (
                query: 'SELECT *
                        FROM menu
                        WHERE nom_aliment = :nom_aliment
                        LIMIT 1'
            );

            $getmenu-> execute (params: ['generique' => htmlspecialchars(string: $_GET['menu'])]);

            if ($getmenu->rowCount() == 1) {
                $menu = $getmenu -> fetch();
                echo '<h1>', $menu['id'],'</h1>';
                echo '<h1>', $menu['nom'],'</h1>';
            }

            ?>

        <button><a href='HTML_menu_update.php'>Modifier</a></button>
        <button><a href='HTML_menu_delete.php'>Supprimer</a></button>
    </div>

</body>
</html>



