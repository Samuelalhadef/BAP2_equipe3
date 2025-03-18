<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/profils.css">
    <title>Page d'accueil Admin</title>
</head>
<body>
    <nav>
        <p>Nom du projet</p>
        <p>Date du jour</p>
        <ul>
            <li><a href="HTML_User_Home.php">Accueil</a></li>
            <li><a href="HTML_User_Menu.php">Menus</a></li>
            <li><a href="HTML_User_Vote.php">Vote</a></li>
            <li><a href="HTML_User_Pesee.php">Pesée</a></li>
            <li><a href="HTML_User_Logout.php">Déconnexion</a></li>
        </ul>
    </nav>

    <div>
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
            }
            else {
                echo "<p>Vous n'êtes pas connecté ou la session a expiré.</p>";
            }
        ?>
    </div>

    <div>
        <div class="menu_recap">
            <h3>Menu du jour :</h3>
            <?php
                $sql = "SELECT entree, plat, dessert FROM menu ORDER BY id DESC LIMIT 1";
                $req = $connexion->query($sql);

                if ($req) {
                    $menu = $req->fetch(PDO::FETCH_ASSOC); // Récupération des données

                    if ($menu) {
                        // Stocker les valeurs en session
                        $_SESSION['entree'] = $menu['entree'];
                        $_SESSION['plat'] = $menu['plat'];
                        $_SESSION['dessert'] = $menu['dessert'];
                    }
                }

                if (isset($_SESSION['entree']) && isset($_SESSION['plat']) && isset($_SESSION['dessert'])) {
                    echo "<div>";
                    echo "<p>Entrée : " . htmlspecialchars($_SESSION['entree']) . "</p>";
                    echo "<p>Plat : " . htmlspecialchars($_SESSION['plat']) . "</p>";
                    echo "<p>Dessert : " . htmlspecialchars($_SESSION['dessert']) . "</p>";
                    echo "</div>";
                }
                else {
                    echo "<p>Il n'y a pas de menus dans la liste pour le moment</p>";
                }
            ?>
            <button>Gestion des menus<i class="fa-solid fa-arrow-right"></i></button>
        </div>
        <div>
            <h3>Gestion des profils</h3>
            <button>Détails<i class="fa-solid fa-arrow-right"></i></button>
        </div>
        <div>
            <h3>Synthèse</h3>
            <button>Détails<i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </div>
</body>
</html>



