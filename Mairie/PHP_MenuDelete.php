<?php
session_start();

if (!isset($_POST['token']) || $_POST['token'] != $_SESSION['csrf_menu_add']){
    die('<p>CSRF invalide</p>');
}

// Supprime le token en session pour qu'il soit regénéré
unset($_SESSION['csrf_menu_add']);

// Vérifier si l'ID et le nom du menu sont présents
$id = null;
$nom_menu = null;

if (isset($_POST["id"]) && !empty($_POST["id"])){
    $id = htmlspecialchars($_POST["id"]);
} else {
    echo "<p>L'ID du menu est obligatoire</p>";
    exit;
}

if (isset($_POST["nom_menu"]) && !empty($_POST["nom_menu"])){
    $nom_menu = htmlspecialchars($_POST["nom_menu"]);
} else {
    echo "<p>Le nom du menu est obligatoire</p>";
    exit;
}

// Si nous avons à la fois l'ID et le nom
if ($id && $nom_menu) {
    require_once '../bdd.php';

    $sauvegarde = $connexion->prepare("DELETE FROM menu WHERE id = :id AND nom_menu = :nom_menu");
    $sauvegarde->execute([
        "id" => $id,
        "nom_menu" => $nom_menu
    ]);

    if ($sauvegarde->rowCount() > 0) {
        echo "<p>Suppression du menu réussie</p>";
        echo "<a href='../Mairie/HTML_Liste_menu.php'>Revenir sur la page de tous les menus</a>";
    } else {
        echo "<p>Aucun menu correspondant trouvé ou une erreur est survenue</p>";
    }
}
?>