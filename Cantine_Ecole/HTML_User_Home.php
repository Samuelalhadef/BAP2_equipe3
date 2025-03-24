<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../CSS/home.css">
    <title>Page d'accueil</title>
</head>
<body>
    <header>
        <a href="../../Cantine_Ecole/HTML_User_Home.php"><img class="logo" src="../images/logo.png"></a>
        <p id="date"></p>
        <div>
            <div class="off-screen-menu">
                <ul class="off-screen-menu-item">
                    <li><a href="../../Cantine_Ecole/HTML_User_Home.php">PAGE D'ACCUEIL</a></li>
                    <li><a href="../../Cantine_Ecole/Menu/HTML_ListeEcole_Menu.php">GESTION DES MENUS</a></li>
                    <li><a href="../../Cantine_Ecole/Vote/HTML_Vote.php">VOTE DU JOUR</a></li>
                    <li><a href="../../Cantine_Ecole/Pesee/HTML_Pesee.php">PESEE DU JOUR</a></li>
                    <li><a href="../../Cantine_Ecole/Synthese/HTML_Synthese.php">SYNTHESE</a></li>
                </ul>
                <ul class="off-screen-menu-plus">
                    <li class="off-screen-menu-item-text"><a href="#">Paramètres&nbsp;&nbsp;</a><i class="fa-solid fa-gear"></i></li>
                    <li class="off-screen-menu-item-text"><a href="../../Login/HTML_Login.php">Se déconnecter&nbsp;&nbsp;</a><i class="fa-solid fa-right-from-bracket"></i></li>
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
    
    

    <div class="accueil">
        <h1>BONJOUR,</h1>
        <?php
            $servername = "localhost";
            $username = "root";

            // On accède à la base de donnée
            require_once '../bdd.php';
            
            // Vérifiez si l'utilisateur est connecté (par exemple via une session)
            session_start();
            
            // On vérifie si l'utilisateur est connecté
            if(isset($_SESSION['identifiant'])) {
                // Affichage de l'identifiant stocké dans la session
                echo "<h2>" . htmlspecialchars($_SESSION['identifiant']) . "</h2>";
            }
            else {
                echo "<p>Vous n'êtes pas connecté ou la session a expiré.</p>";
            }
        ?>
    </div>

    <div class="content_accueil">
        <div class="content_menu">
            <h3>MENU DU JOUR</h3>
            <?php
                // Récupération de la date du jour au format YYYY-MM-DD
            $dateAujourdhui = date('Y-m-d');

            // Requête SQL pour récupérer le menu correspondant à la date du jour
            $sql = "SELECT entree, plat, garniture, produit_laitier, dessert, divers FROM menu WHERE date_menu = :dateAujourdhui";
            $req = $connexion->prepare($sql);
            $req->execute(['dateAujourdhui' => $dateAujourdhui]);

            // Affichage du menu
            if ($req && $menu = $req->fetch(PDO::FETCH_ASSOC)) {
                // Stocker les valeurs en session
                $_SESSION['entree'] = $menu['entree'];
                $_SESSION['plat'] = $menu['plat'];
                $_SESSION['garniture'] = $menu['garniture'];
                $_SESSION['produit_laitier'] = $menu['produit_laitier'];
                $_SESSION['dessert'] = $menu['dessert'];
                $_SESSION['divers'] = $menu['divers'];
                
                echo "<div class='menu_container'>";
                    echo "<div class='menu_item'>";
                        echo "<p>Entrée:&nbsp;</p>";
                        echo "<p>" . htmlspecialchars($_SESSION['entree']) . "</p>";
                    echo "</div>";
                    echo "<div class='menu_item'>";
                        echo "<p>Plat:&nbsp;</p>";
                        echo "<p>" . htmlspecialchars($_SESSION['plat']) . "</p>";
                    echo "</div>";
                    echo "<div class='menu_item'>";
                        echo "<p>Garniture:&nbsp;</p>";
                        echo "<p>" . htmlspecialchars($_SESSION['garniture']) . "</p>";
                    echo "</div>";
                    echo "<div class='menu_item'>";
                        echo "<p>Produit laitier:&nbsp;</p>";
                        echo "<p>" . htmlspecialchars($_SESSION['produit_laitier']) . "</p>";
                    echo "</div>";
                    echo "<div class='menu_item'>";
                        echo "<p>Dessert:&nbsp;</p>";
                        echo "<p>" . htmlspecialchars($_SESSION['dessert']) . "</p>";
                    echo "</div>";
                    echo "<div class='menu_item'>";
                        echo "<p>Divers:&nbsp;</p>";
                        echo "<p>" . htmlspecialchars($_SESSION['divers']) . "</p>";
                    echo "</div>";
                echo "</div>";
            } else {
                echo "<p>Pas de menu prévu pour aujourd'hui</p>";
            }
            ?>
            <button><a href="../../Cantine_Ecole/Menu/HTML_ListeEcole_Menu.php">Gestion des menus&nbsp;<i class="fa-solid fa-arrow-right"></i></a></button>
        </div>

        <div class="gestion_vote">
            <h3>VOTE DU JOUR</h3>
            <?php
                $servername = "localhost";
                $username = "root";

                // On accède à la base de donnée
                require_once '../bdd.php';

                // Récupération de la date du jour au format YYYY-MM-DD
                $dateAujourdhui = date('Y-m-d');

                // Requête SQL pour récupérer le menu correspondant à la date du jour
                $sql = "SELECT valeur_element FROM menu WHERE date_menu = :dateAujourdhui";
                $req = $connexion->prepare($sql);
                $req->execute(['dateAujourdhui' => $dateAujourdhui]);

                // Affichage du menu
                if ($req && $menu = $req->fetch(PDO::FETCH_ASSOC)) {
                    // Stocker les valeurs en session
                    $_SESSION['valeur_element'] = $menu['valeur_element'];
                    
                    echo "<div class='menu_container'>";                    
                        echo "<div>";
                            echo "<p><strong>" . htmlspecialchars($_SESSION['valeur_element']) . "</strong></p>";
                        echo "</div>";
                    echo "</div>";
                } else {
                    echo "<p>Pas d'élément à voter pour aujourd'hui</p>";
                }
            ?>
            <button><a href="../../Cantine_Ecole/Vote/HTML_Interface_vote.php">Détails&nbsp;<i class="fa-solid fa-arrow-right"></i></a></button>
        </div>
        <div class="pesee">
            <h3>PESEE DU JOUR</h3>
            <button><a href="HTML">Détails&nbsp;<i class="fa-solid fa-arrow-right"></i></a></button>
        </div>
    </div>
    <script src="../../JS/nav.js"></script>
</body>
</html>




