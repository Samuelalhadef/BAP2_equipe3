<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../CSS/gestion_profil.css">
    <title>Page d'accueil Admin</title>
</head>
<body>
    <header>
        <p>Nom du projet<p>
        <p>Date du jour<p>
        <div>
            <div class="off-screen-menu">
                <ul class="off-screen-menu-item">
                    <li><a href="../../Mairie/HTML_Admin_Home.php">PAGE D'ACCUEIL</a></li>
                    <li><a href="../../Mairie/Menu/HTML_Liste_Menu.php">GESTION DES MENUS</a></li>
                    <li><a href="../../Mairie/Gestion_profils/HTML_Gestion_profils.php">GESTION DES PROFILS</a></li>
                    <li><a href="../../Mairie/Synthese/HTML_Synthese.php">SYNTHESE</a></li>
                </ul>
                <ul class="off-screen-menu-plus">
                    <li class="off-screen-menu-item-text"><a href="#">Paramètres&nbsp;&nbsp;</a><i class="fa-solid fa-gear"></i></li>
                    <li class="off-screen-menu-item-text"><a href="../../Log_Sign/HTML_Log_Sign.php">Se déconnecter&nbsp;&nbsp;</a><i class="fa-solid fa-right-from-bracket"></i></li>
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
    
    <h2>Gestion des profils</h2>
    <div class="profiles">
        <?php

        $servername = "localhost";
        $username = "root";
        $password = "";

        //On accède à la base de donnée
        require_once '../../bdd.php';

        session_start();

        // Requête SQL pour sélectionner les menus
        $sql = "SELECT * FROM gestion_profils LIMIT 1";
        $req = $connexion->query($sql);

            $nombreProfils = isset($_GET['nombre']) ? (int)$_GET['nombre'] : 6; // Par défaut 6, modifiable via l'URL
            for ($i = 1; $i <= $nombreProfils; $i++): 
        ?>
        <?php endfor; ?>
        <div class="add-profile">
            <button><a href="../../Mairie/Gestion_profils/HTML_GP_create.php">Ajouter&nbsp;<i class='fa-solid fa-plus'></i></a></button>
        </div>
    </div>


    <script src="../../JS/nav.js"></script>
</body>
</html>
