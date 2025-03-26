<?php
// Inclure la connexion à la base de données
require_once("../../bdd.php");

// Configuration pour l'export Excel (CSV)
header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="synthese_donnees_cantines.csv"');
header('Pragma: no-cache');
header('Expires: 0');

// Ouvrir le flux de sortie
$output = fopen('php://output', 'w');

// Écrire l'en-tête UTF-8 pour éviter les problèmes d'encodage
fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

// ===================== //
//   EXPORT DES MENUS    //
// ===================== //
fputcsv($output, ['--- DONNÉES DES MENUS ---']);
fputcsv($output, ['ID', 'Date du menu', 'Nom du menu', 'Entrée', 'Plat', 'Garniture', 'Produit Laitier', 'Dessert', 'Divers']);

try {
    $query = $connexion->query('SELECT id, date_menu, nom_menu, entree, plat, garniture, produit_laitier, dessert, divers FROM menu ORDER BY date_menu DESC');
    $menus = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($menus as $menu) {
        fputcsv($output, $menu);
    }
} catch (PDOException $e) {
    fputcsv($output, ['Erreur lors de la récupération des menus: ' . $e->getMessage()]);
}

// Ligne vide comme séparateur
fputcsv($output, []);

// ===================== //
// EXPORT DONNÉES JOURNALIÈRES //
// ===================== //
fputcsv($output, ['--- DONNÉES JOURNALIÈRES ---']);
fputcsv($output, ['ID', 'Date', 'Poids des déchets (kg)', 'Poids du pain (kg)', 'Repas prévus', 'Repas consommés', 'Repas adultes']);

try {
    // Corrected column names to match the `pesee` table
    $query = $connexion->query('SELECT id, date_menu AS Date, pesee_restes AS "Poids des déchets (kg)", pesee_pain AS "Poids du pain (kg)", nb_repasprevus AS "Repas prévus", nb_repasconsommes AS "Repas consommés", nb_repasconsommesadultes AS "Repas adultes" FROM pesee ORDER BY date_menu DESC');
    $donnees = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($donnees as $donnee) {
        fputcsv($output, $donnee);
    }
} catch (PDOException $e) {
    fputcsv($output, ['Erreur lors de la récupération des données journalières: ' . $e->getMessage()]);
}

// Ligne vide comme séparateur
fputcsv($output, []);

// ===================== //
//   EXPORT DES VOTES    //
// ===================== //
fputcsv($output, ['--- DONNÉES DES VOTES ---']);
fputcsv($output, ['ID', 'Grande Faim', 'Petite Faim', 'Aime', 'Aime Moyen', 'Aime Pas', 'Valeur Élément', 'Date Menu', 'Identifiant']);

try {
    $query = $connexion->query('SELECT id, grande_faim, petite_faim, aime, aime_moyen, aime_pas, valeur_element, date_menu, identifiant FROM vote ORDER BY date_menu DESC');
    $votes = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($votes as $vote) {
        fputcsv($output, $vote);
    }
} catch (PDOException $e) {
    fputcsv($output, ['Erreur lors de la récupération des votes: ' . $e->getMessage()]);
}

// Ligne vide comme séparateur
fputcsv($output, []);

// ===================== //
// EXPORT UTILISATEURS //
// ===================== //
fputcsv($output, ['--- DONNÉES DES UTILISATEURS ---']);
fputcsv($output, ['ID', 'Nom', 'Adresse', 'Identifiant', 'Rôle']);

try {
    $query = $connexion->query('SELECT id, nom, adresse, identifiant, role_profil FROM users ORDER BY id ASC');
    $users = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($users as $user) {
        fputcsv($output, $user);
    }
} catch (PDOException $e) {
    fputcsv($output, ['Erreur lors de la récupération des utilisateurs: ' . $e->getMessage()]);
}

// Fermer le flux de sortie
fclose($output);
exit;