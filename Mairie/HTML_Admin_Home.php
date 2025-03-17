<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./home.css">
    <title>Page d'accueil Admin</title>
</head>
<body>
    <h1>BONJOUR,</h1>
    <?php
        $servername = "localhost";
        $username = "root";

        //On accède à la base de donnée
        require_once '../bdd.php';

        // Requête SQL pour sélectionner et afficher une colonne
        $sql = "SELECT entree, plat, dessert FROM menu";
        $req = $connexion->query($sql);

        while($rep = $req->fetch()){
            echo "<p><a href='../Mairie/HTML_Menu_read.php?menu=" . urlencode($rep['nom_aliment']) . "'>" . htmlspecialchars($rep['nom']) . ")</a></p><br>";}
        ?>
</body>
</html>



