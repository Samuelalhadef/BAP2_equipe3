<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/liste_menus.css">
    <title>Liste des menus</title>
</head>
<body>
    <header>
        <p>Nom du projet<p>
        <p>Date du jour<p>
        <div>
            <div class="off-screen-menu">
                <ul class="off-screen-menu-item">
                    <li><a href="../Mairie/HTML_Admin_Home.php">PAGE D'ACCUEIL</a></li>
                    <li><a href="../Mairie/HTML_Liste_Menu.php">GESTION DES MENUS</a></li>
                    <li><a href="#">GESTION DES PROFILS</a></li>
                    <li><a href="#">SYNTHESE</a></li>
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

    <div class="liste_menus">
        <div class="titre_date">
            <h2>Gestion des menus</h2>
            <h3>Semaine du 17/03/2025 au 23/03/2025</h3>
        </div>

        <div class="date_swipe">
            <div class="calendar-container">
                <button class="calendar" id="open-calendar"><i class="fa-solid fa-calendar-days"></i>&nbsp;Calendrier</button>
                <input type="date" id="date-picker" style="display: none;">
                <p id="selected-date"></p>
            </div>
            
            <div>
                <button>Semaine précédente</button>
                <button>Semaine suivante</button>
            </div>
        </div>
        
        
        <div>
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";

                //On accède à la base de donnée
                require_once '../bdd.php';

                // Requête SQL pour sélectionner et afficher une colonne
                $sql = "SELECT * FROM menu";
                $req = $connexion->query($sql);
                
                echo "<div class='menu_all'>";
                    while($rep = $req->fetch()){
                        echo "<div class='menu_bloc'>";
                            echo "<div class='menu_details'>";
                                echo "<p>Date</p>";
                                echo "<p>" . htmlspecialchars($rep['nom_menu']) ."</p>";
                                echo "<p>" . htmlspecialchars($rep['entree']) ."</p>";
                                echo "<p>" . htmlspecialchars($rep['plat']) . "</p>";
                                echo "<p>" . htmlspecialchars($rep['dessert']) ."</p>";
                            echo "</div>";
                            echo "<button><a href='../Mairie/HTML_Menu_update.php'>Modifier le menu&nbsp;&nbsp;</a><i class='fa-solid fa-pencil'></i></button>";
                        echo "</div>";
                    }
                echo "</div>";
            ?>
        </div>
    </div>

    <script src="../JS/nav.js"></script>
</body>
</html>



