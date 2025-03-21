<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../CSS/gestion_profil.css">
    <title>Page de gestion de profils</title>
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
    
    <section class="gestion_profils">
        <h2>Gestion des profils</h2>
        <button class="add-btn"><a href="../../Mairie/Gestion_profils/HTML_GP_create.php">Ajouter un profil&nbsp;<i class='fa-solid fa-plus'></i></a></button>
        <div class="profiles">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";

            // On accède à la base de données
            require_once '../../bdd.php';

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Requête SQL pour sélectionner et afficher les profils
            $sql = "SELECT * FROM gestionprofils";
            $req = $connexion->query($sql);
            
            // Vérifie s'il y a des résultats
            if ($req->rowCount() > 0) {
                echo "<div class='profiles-grid'>";
                
                while ($rep = $req->fetch()) {
                    echo "<div class='profile-item'>";

                        echo "<p><strong>Nom de l'école:</strong> " . htmlspecialchars($rep['nom'] ?? '') . "</p>";
                        echo "<p><strong>Adresse:</strong> " . htmlspecialchars($rep['adresse'] ?? '') . "</p>";
                        echo "<p><strong>Code postal:</strong> " . htmlspecialchars($rep['code_postal'] ?? '') . "</p>";
                        echo "<p><strong>Ville:</strong> " . htmlspecialchars($rep['ville'] ?? '') . "</p>";
                        echo "<p><strong>Identifiant:</strong> " . htmlspecialchars($rep['identifiant'] ?? '') . "</p>";
                        echo "<p><strong>Mot de passe:</strong> " . htmlspecialchars($rep['mdp'] ?? '') . "</p>";
                        echo "<p><strong>Commentaire:</strong> " . htmlspecialchars($rep['commentaire'] ?? $rep['Commentaire'] ?? '') . "</p>";   

                        echo "<div class='profile-actions'>";
                            echo "<button class='edit'><a href='../../Mairie/Gestion_profils/HTML_GP_update.php?id=" . $rep['id'] . "' class='edit-btn'>Modifier&nbsp;<i class='fa-solid fa-pencil'></i></a></button>";
                            echo "<button class='delete'><a href='../../Mairie/Gestion_profils/HTML_GP_delete.php?id=" . $rep['id'] . "' class='delete-btn' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce profil?\")'>Supprimer&nbsp;<i class='fa-solid fa-trash'></i></a></button>";
                        echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "<p class='no-profiles-message'>Aucun profil n'a encore été ajouté.</p>";
            }
            ?>
        </div>
    </section>
    <script src="../../JS/nav.js"></script>
</body>
</html>