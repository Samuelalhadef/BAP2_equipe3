<?php
session_start();
require_once '../../bdd.php';

// Vérification de l'identifiant du profil
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('<p>Identifiant manquant</p>');
}

$id_gestionprofils = intval($_GET['id']);

// Génération du token CSRF si absent
if (!isset($_SESSION['csrf_gestionprofils_update']) || empty($_SESSION['csrf_gestionprofils_update'])) {
    $_SESSION['csrf_gestionprofils_update'] = bin2hex(random_bytes(32));
}

// Récupération des données du profil
$sql = "SELECT * FROM gestionprofils WHERE id = :id";
$query = $connexion->prepare($sql);
$query->execute(['id' => $id_gestionprofils]);
$profil = $query->fetch(PDO::FETCH_ASSOC);

if (!$profil) {
    die('<p>Profil non trouvé</p>');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/crud_GP.css">
    <title>Modification du Profil</title>
</head>
<body>
    <header>
        <p>EcoMiam<p>
        <p>Date du jour<p>
        <div>
            <div class="off-screen-menu">
                <ul class="off-screen-menu-item">
                    <li><a href="../../Mairie/HTML_Admin_Home.php">PAGE D'ACCUEIL</a></li>
                    <li><a href="../Mairie/Menu/HTML_Liste_Menu.php">GESTION DES MENUS</a></li>
                    <li><a href="../Mairie/Gestion_profils/HTML_Gestion_profils.php">GESTION DES PROFILS</a></li>
                    <li><a href="../Mairie/Synthese/HTML_Synthese.php">SYNTHESE</a></li>
                </ul>
                <ul class="off-screen-menu-plus">
                    <li class="off-screen-menu-item-text"><a href="#">Paramètres&nbsp;&nbsp;</a><i class="fa-solid fa-gear"></i></li>
                    <li class="off-screen-menu-item-text"><a href="../Log_Sign/HTML_Log_Sign.php">Se déconnecter&nbsp;&nbsp;</a><i class="fa-solid fa-right-from-bracket"></i></li>
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
    
    <section class="crud_GP">
        <form action="PHP_GPUpdate.php" method="POST">
            <h2>Modifier le Profil</h2>
            <div class="textbox">
                <div class="infos">
                    <div class="info_to">
                        <label for="nom">Nom de l'école</label>
                        <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($profil['nom']); ?>" required>
                    </div>
                    <div class="info_to">
                        <label for="adresse">Adresse</label>
                        <input type="text" name="adresse" id="adresse" value="<?= htmlspecialchars($profil['adresse']); ?>" required>
                    </div>
                    <div class="infos2">
                        <div class="info_to">
                            <label for="nom">Code Postal</label>
                            <input type="number" name="code_postal" id="code_postal" value="<?= htmlspecialchars($profil['code_postal']); ?>" required>
                        </div>
                        <div class="info_to">
                            <label for="adresse">Ville</label>
                            <input type="text" name="ville" id="ville" value="<?= htmlspecialchars($profil['ville']); ?>" required>
                        </div>
                    </div> 
                </div>
                <div class="infos">
                    <div class="info_to">
                        <label for="plat">Identifiant</label>
                        <input type="text" name="identifiant" id="identifiant" value="<?= htmlspecialchars($profil['identifiant']); ?>" required>
                    </div>
                    <div class="info_to">
                        <label for="garniture">Mot de passe</label>
                        <input type="text" name="mdp" id="mdp" value="<?= htmlspecialchars($profil['mdp']); ?>" required>
                    </div>
                    <div class="info_to">
                        <label for="nom_menu">Commentaire</label>
                        <textarea type="text" name="commentaire" id="commentaire" value="<?= htmlspecialchars($profil['commentaire']); ?>" cols="5" rows="10" required></textarea>
                    </div>
                </div>
            </div>

            <input type="hidden" name="id_gestionprofils" value="<?= $profil['id']; ?>">
            <input type="hidden" name="token" value="<?= $_SESSION['csrf_gestionprofils_update']; ?>">
            <input type="submit" name="modifier" value="Sauvegarder">
        </form>
    </section>
</body>
</html>