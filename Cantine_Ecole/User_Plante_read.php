<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>READ MENU</title>
</head>

<body>

    <div class>
        <p><a href="User_Liste_menus.php">Revenir sur la liste des menus</a></p>
        <?php

        if (!isset($_GET['menu']) || empty($_GET['menu'])){
            die('<p>Menu introuvable</p>');
        }

        // Connexion à la BDD
        require_once 'bdd.php';

        $getmenu = $connexion -> prepare (
            query: 'SELECT nom, generique, content, prix
                    FROM menu
                    WHERE generique = :generique
                    LIMIT 1'
        );

        $getmenu-> execute (params: ['menu' => htmlspecialchars(string: $_GET['menu'])]);

        if ($getMenu->rowCount() == 1) {
            $menu = $getMenu -> fetch();
            echo '<h1>', $menu['nom'],'</h1>';
            echo '<h2>', $menu['generique'],'</h2>';
        }
        ?>

    </div>

</body>
</html>



