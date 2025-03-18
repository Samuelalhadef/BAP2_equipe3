<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./globals.css">
    <title>Liste de tous les menus</title>
</head>

<body>

    <div class="liste_menus">
        <h2>MENUS</h2>
        <button><a href="./HTML_Menu_create.php">Ajouter</a></button>

        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";

            //On accède à la base de donnée
            require_once '../bdd.php';

            // Requête SQL pour sélectionner et afficher une colonne
            $sql = "SELECT * FROM menu";
            $req = $connexion->query($sql);

            while($rep = $req->fetch()){
                echo "<p>" . htmlspecialchars($rep['nom_menu']) ."</p>";
                echo "<p>" . htmlspecialchars($rep['entree']) ."</p>";
                echo "<p>" . htmlspecialchars($rep['plat']) . "</p>";
                echo "<p>" . htmlspecialchars($rep['dessert']) ."</p>";
            }
            echo "<button><a href='../Mairie/HTML_Menu_read.php'>Voir le menu</a></button>";

        ?>

    </div>


</body>

</html>