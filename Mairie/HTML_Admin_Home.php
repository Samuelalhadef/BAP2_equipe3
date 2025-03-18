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
    <header>
        <p>Nom du projet<p>
        <p>Date du jour<p>
        <div>
            <div class="off-screen-menu">
                <ul class="off-screen-menu-item">
                    <li><a href="#">PAGE D'ACCUEIL</a></li>
                    <li><a href="#">GESTION DES MENUS</a></li>
                    <li><a href="#">SYNTHESE</a></li>
                    <li><a href="#">VOTE DU JOUR</a></li>
                    <li><a href="#">PESEE DU JOUR</a></li>
                </ul>
                <ul class="off-screen-menu-plus">
                    <li class="off-screen-menu-item-text"><a href="#">Paramètres&nbsp;&nbsp;</a><i class="fa-solid fa-gear"></i></li>
                    <li class="off-screen-menu-item-text"><a href="#">Se déconnecter&nbsp;&nbsp;</a><i class="fa-solid fa-right-from-bracket"></i></li>
                </ul>
            </div>
            <nav>
                <p>MENU&nbsp;&nbsp;</p>
                <div class="ham-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
    </header>
    
    

    <div class="name_user_admin">
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

    <div class="container_profils">
        <div class="menu_recap">
            <h3>MENU DU JOUR</h3>
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
                    echo "<div class='menu_container'>";
                        echo "<div class='menu_details'>";
                            echo "<p>Entrée :</p>";
                            echo "<p>" . htmlspecialchars($_SESSION['entree']) . "</p>";
                        echo "</div>";
                        echo "<div class='menu_details'>";
                            echo "<p>Plat :</p>";
                            echo "<p>" . htmlspecialchars($_SESSION['plat']) . "</p>";
                        echo "</div>";
                        echo "<div class='menu_details'>";
                            echo "<p>Dessert :</p>";
                            echo "<p>" . htmlspecialchars($_SESSION['dessert']) . "</p>";
                        echo "</div>";
                    echo "</div>";
                }
                else {
                    echo "<p>Il n'y a pas de menus dans la liste pour le moment</p>";
                }
            ?>
            <button><a href="HTML">Gestion des menus&nbsp;</a><i class="fa-solid fa-arrow-right"></i></button>
        </div>
        <div class="gestion_profils">
            <h3>GESTION DES PROFILS</h3>
            <button><a href="HTML">Détails&nbsp;</a><i class="fa-solid fa-arrow-right"></i></button>
        </div>
        <div class="synthese">
            <h3>SYNTHESE</h3>
            <button><a href="HTML">Détails&nbsp;</a><i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </div>
    <script src="../JS/nav.js"></script>
</body>
</html>



