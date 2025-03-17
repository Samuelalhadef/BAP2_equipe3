<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./globals.css">
    <title>Liste de toutes les menus</title>
</head>
<body>

    <div class="liste_menus">
        <h2>Liste de toutes les menus</h2>
        <p>Cliquez sur son nom pour accéder au vote</p>
        <br>
        <?php

        $servername = "localhost";
        $username = "root";
        $password = "root";

        //On accède à la base de donnée
        require_once 'bdd.php';

        // Requête SQL pour sélectionner et afficher une colonne
        $sql = "SELECT id, nom_aliment, image_aliment FROM menu";
        $req = $connexion->query($sql);

        while($rep = $req->fetch()){
            echo "<p><a href='./Mairie/HTML_Menu_read.php?menu=" . urlencode($rep['nom_aliment']) . "'>". htmlspecialchars($rep['nom_aliment']) . "</a></p><br>";
        }

        ?>
        <button><a href="./Admin_Menu_create.php">Ajouter</a></button>
    </div>


</body>
</html>



