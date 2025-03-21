<?php
session_start();
require_once '../../bdd.php';

// Vérification de la présence d'un ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('<p>Identifiant manquant</p>');
}

$id_gestionprofils = intval($_GET['id']);

// Vérification que le profil existe
$verify = $connexion->prepare("SELECT id, identifiant FROM gestionprofils WHERE id = :id");
$verify->execute(['id' => $id_gestionprofils]);
$profil = $verify->fetch(PDO::FETCH_ASSOC);

if (!$profil) {
    die('<p>Profil non trouvé</p>');
}

// Récupération de l'identifiant pour supprimer aussi dans la table connexion
$identifiant = $profil['identifiant'];

try {
    // Démarrer une transaction pour garantir l'intégrité des données
    $connexion->beginTransaction();
    
    // Supprimer les dépendances dans la table gestionprofils
    $delete_dependances = $connexion->prepare("DELETE FROM gestionprofils WHERE identifiant = :identifiant");
    $delete_dependances->execute(['identifiant' => $identifiant]);
    
    // Supprimer d'abord les références dans la table connexion
    $delete_connexion = $connexion->prepare("DELETE FROM connexion WHERE identifiant = :identifiant");
    $delete_connexion->execute(['identifiant' => $identifiant]);
    
    // Valider la transaction
    $connexion->commit();
    
    // Rediriger vers la liste des profils avec un message de succès
    header('Location: ../../Mairie/Gestion_profils/HTML_Gestion_profils.php?deleted=1');
    exit();
    
} catch (PDOException $e) {
    // En cas d'erreur, annuler la transaction
    $connexion->rollBack();
    die('<p>Erreur lors de la suppression: ' . $e->getMessage() . '</p>');
}
?>