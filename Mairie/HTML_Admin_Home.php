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
        // On accède à la base de donnée
        require_once '../bdd.php';
        
        // Vérifiez si l'utilisateur est connecté (par exemple via une session)
        session_start();
        
        // On vérifie si l'utilisateur est connecté
        if(isset($_SESSION['email'])) {
            // Affichage de l'email stocké dans la session
            echo "<p>" . htmlspecialchars($_SESSION['email']) . "</p>";
        } else {
            echo "<p>Vous n'êtes pas connecté ou la session a expiré.</p>";
        }
    ?>

    <div>
        <p>Menu du jour :</p>
        <?php
        $servername = "localhost";
        $username = "root";

        //On accède à la base de donnée
        require_once '../bdd.php';
            // Requête SQL pour sélectionner et afficher une colonne
            $sql = "SELECT * FROM menu";
            $req = $connexion->query($sql);

        ?>
    </div>
</body>
</html>



