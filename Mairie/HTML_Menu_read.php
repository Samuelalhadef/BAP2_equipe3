<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./globals.css">
    <title>Liste des menus</title>
</head>

<body>

    <div>
        <h1>Liste des menus</h1>

        <?php

            // Connexion à la BDD
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "bap2_equipe3";

            try {
                $connexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // Définir le mode d'erreur pour PDO
                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }

            $getmenus = $connexion -> prepare (
                'SELECT *
                        FROM menu'
            );

            $getmenus->execute();

            $menus = $getmenus -> fetchAll();

            if (empty($menus)) {
                echo '<p>Aucun menu disponible.</p>';
            } else {
                echo '<table border="1">';
                echo '<tr>';
                echo '<th>Id</th>';
                echo '<th>Nom du menu</th>';
                echo '<th>Actions</th>';
                echo '</tr>';

                foreach ($menus as $menu) {
                    echo '<tr>';
                    echo '<td>' . $menu['id'] . '</td>';
                    echo '<td>' . $menu['nom_menu'] . '</td>';
                    echo '<td>';
                    echo '<a href="HTML_menu_details.php?id=' . $menu['id'] . '">Voir les détails</a> | ';
                    echo '<a href="HTML_menu_delete.php?id=' . $menu['id'] . '">Supprimer</a>';
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</table>';
            }

            $connexion = null;

            ?>

    </div>

</body>

</html>