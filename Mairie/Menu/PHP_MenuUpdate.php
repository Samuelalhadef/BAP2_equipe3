<?php
session_start();

// Vérification du token CSRF
if (!isset($_POST['token']) || $_POST['token'] != $_SESSION['csrf_menu_add']){
    die('<p>CSRF invalide</p>');
}

// Supprime le token en session pour qu'il soit regénéré
unset($_SESSION['csrf_menu_add']);

// Récupérer les données du formulaire
if (!isset($_POST['id_menu']) || empty($_POST['id_menu']) || 
    !isset($_POST['field_name']) || empty($_POST['field_name']) ||
    !isset($_POST['field_value'])) {
    die('<p>Données manquantes pour la modification</p>');
}

$id_menu = intval($_POST['id_menu']);
$field_name = $_POST['field_name'];
$field_value = htmlspecialchars($_POST['field_value']);

// Liste des champs autorisés pour la modification
$allowed_fields = ['entree', 'plat', 'garniture', 'produit_laitier', 'dessert', 'divers', 'date_menu', 'nom_menu'];

// Vérifier si le champ est valide
if (!in_array($field_name, $allowed_fields)) {
    die('<p>Champ non valide pour la modification</p>');
}

require_once '../../bdd.php';

// Préparer la requête SQL pour mettre à jour uniquement le champ spécifié
$sql = "UPDATE menu SET $field_name = :value WHERE id = :id";
$update = $connexion->prepare($sql);
$result = $update->execute([
    'value' => $field_value,
    'id' => $id_menu
]);

if ($update->rowCount() > 0) {
    // Redirection vers la page de détail du menu
    header('Location: ../../Mairie/Menu/HTML_menu_read.php?id=' . $id_menu);
    exit();
} else {
    header('Location: ../../Mairie/Menu/HTML_menu_read.php?id=' . $id_menu);
    exit();
}
?>