<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./globals.css">
    <title>Détails du menu</title>
</head>

<body>

    <div>
        <h1>Détails du menu</h1>

        <?php

            if (!isset($_GET['id']) || empty($_GET['id'])){
                die('<p>Erreur : le paramètre "id" est manquant ou vide dans l\'URL. Veuillez vérifier l\'URL et réessayer.</p>');
            }

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

            $getmenu = $connexion -> prepare (
                'SELECT *
                        FROM menu
                        WHERE id = :id
                        LIMIT 1'
            );

            $getmenu->bindParam(':id', $_GET['id']);
            $getmenu->execute();

            if ($getmenu->rowCount() == 1) {
                $menu = $getmenu -> fetch();
                echo '<h1>Id du menu : ' . $menu['id'] . '</h1>';
                echo '<h1>Nom du menu : ' . $menu['nom_menu'] . '</h1>';
                echo '<h1>Entree: ' . $menu['entree'] . '</h1>';
                echo '<h1>plat : ' . $menu['plat'] . '</h1>';
                echo '<h1>dessert : ' . $menu['dessert'] . '</h1>';
            } else {
                die('<p>Erreur : le menu avec l\'id "' . $_GET['id'] . '" n\'a pas été trouvé dans la base de données.</p>');
            }

            $connexion = null;

            ?>

    </div>

</body>

</html>