<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Liste de toutes les plantes</title>
</head>
<body>

    <div class="liste_plantes">
        <h2>Liste de toutes les plantes</h2>
        <p>Cliquez sur son nom pour accéder à sa description et son prix</p>
        <br>
        <?php

        $servername = "localhost";
        $username = "root";
        $password = "root";

        //On accède à la base de donnée
        require_once 'bdd.php';

        // Requête SQL pour sélectionner et afficher une colonne
        $sql = "SELECT id, nom, generique FROM plante";
        $req = $connexion->query($sql);

        while($rep = $req->fetch()){
            echo "<p><a href='Admin_Menu_read.php?plante=" . urlencode($rep['generique']) . "'>" . htmlspecialchars($rep['id']) . ' '. htmlspecialchars($rep['nom']) . " (" . htmlspecialchars($rep['generique']) . ")</a></p><br>";
        }

        ?>
        <button><a href="Admin_Plante_create.php">Ajouter</a></button>
    </div>


</body>
</html>



