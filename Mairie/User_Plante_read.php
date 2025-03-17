<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>READ PLANTE</title>
</head>

<body>

    <div class>
        <p><a href="User_Liste_plantes.php">Revenir sur la liste des plantes</a></p>
        <?php

        if (!isset($_GET['plante']) || empty($_GET['plante'])){
            die('<p>Plante introuvable</p>');
        }

        // Connexion à la BDD
        require_once 'bdd.php';

        $getPlante = $connexion -> prepare (
            query: 'SELECT nom, generique, content, prix
                    FROM plante
                    WHERE generique = :generique
                    LIMIT 1'
        );

        $getPlante-> execute (params: ['generique' => htmlspecialchars(string: $_GET['plante'])]);

        if ($getPlante->rowCount() == 1) {
            $plante = $getPlante -> fetch();
            echo '<h1>', $plante['nom'],'</h1>';
            echo '<h2>', $plante['generique'],'</h2>';
            echo '<p>', $plante['content'],'</p>';
            echo '<h3>', $plante['prix'],"€",'</h3>';
        }
        ?>

    </div>

</body>
</html>



