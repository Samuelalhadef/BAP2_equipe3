<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Liste de toutes les menus</title>
</head>
<body>

    <div class="liste_menus">
        <h2>Liste de toutes les menus</h2>
        <p>Cliquez sur son nom pour accéder à sa description et son prix</p>
        <br>
        <?php

        $servername = "localhost";
        $username = "root";
        $password = "root";

        //On accède à la base de donnée
        require_once 'bdd.php';

        // Requête SQL pour sélectionner et afficher une colonne
        $sql = "SELECT nom_aliment FROM menu";
        $req = $connexion->query($sql);

        while($rep = $req->fetch()){
            echo "<p><a href='./Cantine_Ecole/User_Menu_read.php?menu=" . urlencode($rep['nom_aliment']) . "'>" . htmlspecialchars($rep['nom']) . ")</a></p><br>";}

        ?>
    </div>


</body>
</html>



