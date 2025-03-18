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
        // On accède à la base de donnée
        require_once '../bdd.php';
        
        // Vérifiez si l'utilisateur est connecté (par exemple via une session)
        session_start();
        
        // On vérifie si l'utilisateur est connecté
        if(isset($_SESSION['email'])) {
            // Affichage de l'email stocké dans la session
            echo "<h2>" . htmlspecialchars($_SESSION['email']) . "</h2>";
        } else {
            echo "<p>Vous n'êtes pas connecté ou la session a expiré.</p>";
        }
    ?>

    <div>
        <div class="menu_jour">
            <h2>Menu du jour :</h2>
            <?php
    $servername = "localhost";
    $username = "root";

    //On accède à la base de donnée
    require_once '../bdd.php';
    
    // Requête SQL pour sélectionner et afficher une colonne
    $sql = "SELECT entree, plat, dessert FROM menu";
    $req = $connexion->query($sql);
    
    // Vérification de la présence de résultats
    if ($req->rowCount() > 0) {
        // On récupère les noms des colonnes depuis le premier résultat
        $firstRow = $req->fetch(PDO::FETCH_ASSOC);
        foreach(array_keys($firstRow) as $colName) {
            echo "<h3>Entrée :</h3>";
            echo "<p>" . htmlspecialchars($colName) . "</p>";
        }
        echo "</tr>";
        
        // On affiche la première ligne déjà récupérée
        foreach($firstRow as $value) {
            echo "<p>" . htmlspecialchars($value) . "</p>";
        }
        
        // Puis on parcourt le reste des résultats
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            foreach($row as $value) {
                echo "<p>" . htmlspecialchars($value) . "</p>";
            }
        }
    } else {
        echo "Aucun résultat trouvé dans la table menu.";
    }
?>
        </div>
        <div class="vote_jour">
            <h2>Vote du jour :</h2>
        </div>
        <div class="pesee_jour">
            <h2>Pesée du jour :</h2>
        </div>
    </div>
    

</body>
</html>



