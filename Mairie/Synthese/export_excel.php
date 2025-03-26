<?php
require_once("../../bdd.php");
require_once '../../vendor/autoload.php';  // Assure-toi d'avoir installé PhpSpreadsheet via Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Créer un objet Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// ===================== //
//   EXPORT DES MENUS    //
// ===================== //
$sheet->setCellValue('A1', '--- DONNÉES DES MENUS ---');
$sheet->setCellValue('A2', 'ID');
$sheet->setCellValue('B2', 'Date du menu');
$sheet->setCellValue('C2', 'Nom du menu');
$sheet->setCellValue('D2', 'Entrée');
$sheet->setCellValue('E2', 'Plat');
$sheet->setCellValue('F2', 'Garniture');
$sheet->setCellValue('G2', 'Produit Laitier');
$sheet->setCellValue('H2', 'Dessert');
$sheet->setCellValue('I2', 'Divers');

// Récupérer les données des menus
$row = 3;
try {
    $query = $connexion->query('SELECT id, date_menu, nom_menu, entree, plat, garniture, produit_laitier, dessert, divers FROM menu ORDER BY date_menu DESC');
    $menus = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($menus as $menu) {
        $sheet->setCellValue('A' . $row, $menu['id']);
        $sheet->setCellValue('B' . $row, $menu['date_menu']);
        $sheet->setCellValue('C' . $row, $menu['nom_menu']);
        $sheet->setCellValue('D' . $row, $menu['entree']);
        $sheet->setCellValue('E' . $row, $menu['plat']);
        $sheet->setCellValue('F' . $row, $menu['garniture']);
        $sheet->setCellValue('G' . $row, $menu['produit_laitier']);
        $sheet->setCellValue('H' . $row, $menu['dessert']);
        $sheet->setCellValue('I' . $row, $menu['divers']);
        $row++;
    }
} catch (PDOException $e) {
    $sheet->setCellValue('A' . $row, 'Erreur lors de la récupération des menus: ' . $e->getMessage());
}

// Ligne vide comme séparateur
$row++;
$sheet->setCellValue('A' . $row, '');

// ===================== //
// EXPORT DONNÉES JOURNALIÈRES //
// ===================== //
$row++;
$sheet->setCellValue('A' . $row, '--- DONNÉES JOURNALIÈRES ---');
$row++;
$sheet->setCellValue('A' . $row, 'ID');
$sheet->setCellValue('B' . $row, 'Poids des déchets (kg)');
$sheet->setCellValue('C' . $row, 'Poids du pain (kg)');
$sheet->setCellValue('D' . $row, 'Repas prévus');
$sheet->setCellValue('E' . $row, 'Repas consommés');
$sheet->setCellValue('F' . $row, 'Repas adultes');
$sheet->setCellValue('G' . $row, 'Date Menu');
$sheet->setCellValue('H' . $row, 'Identifiant');

$row++;
try {
    $query = $connexion->query('SELECT id, pesee_restes AS "Poids des déchets (kg)", pesee_pain AS "Poids du pain (kg)", nb_repasprevus AS "Repas prévus", nb_repasconsommes AS "Repas consommés", nb_repasconsommesadultes AS "Repas adultes", date_menu, identifiant FROM pesee ORDER BY date_menu DESC');
    $donnees = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($donnees as $donnee) {
        $sheet->setCellValue('A' . $row, $donnee['id']);
        $sheet->setCellValue('B' . $row, $donnee['Poids des déchets (kg)']);
        $sheet->setCellValue('C' . $row, $donnee['Poids du pain (kg)']);
        $sheet->setCellValue('D' . $row, $donnee['Repas prévus']);
        $sheet->setCellValue('E' . $row, $donnee['Repas consommés']);
        $sheet->setCellValue('F' . $row, $donnee['Repas adultes']);
        $sheet->setCellValue('G' . $row, $donnee['date_menu']);
        $sheet->setCellValue('H' . $row, $donnee['identifiant']);
        $row++;
    }
} catch (PDOException $e) {
    $sheet->setCellValue('A' . $row, 'Erreur lors de la récupération des données journalières: ' . $e->getMessage());
}

// Ligne vide comme séparateur
$row++;
$sheet->setCellValue('A' . $row, '');

// ===================== //
//   EXPORT DES VOTES    //
// ===================== //
$row++;
$sheet->setCellValue('A' . $row, '--- DONNÉES DES VOTES ---');
$row++;
$sheet->setCellValue('A' . $row, 'ID');
$sheet->setCellValue('B' . $row, 'Grande Faim');
$sheet->setCellValue('C' . $row, 'Petite Faim');
$sheet->setCellValue('D' . $row, 'Aime');
$sheet->setCellValue('E' . $row, 'Aime Moyen');
$sheet->setCellValue('F' . $row, 'Aime Pas');
$sheet->setCellValue('G' . $row, 'Valeur Élément');
$sheet->setCellValue('H' . $row, 'Date Menu');
$sheet->setCellValue('I' . $row, 'Identifiant');

$row++;
try {
    $query = $connexion->query('SELECT id, grande_faim, petite_faim, aime, aime_moyen, aime_pas, valeur_element, date_menu, identifiant FROM vote ORDER BY date_menu DESC');
    $votes = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($votes as $vote) {
        $sheet->setCellValue('A' . $row, $vote['id']);
        $sheet->setCellValue('B' . $row, $vote['grande_faim']);
        $sheet->setCellValue('C' . $row, $vote['petite_faim']);
        $sheet->setCellValue('D' . $row, $vote['aime']);
        $sheet->setCellValue('E' . $row, $vote['aime_moyen']);
        $sheet->setCellValue('F' . $row, $vote['aime_pas']);
        $sheet->setCellValue('G' . $row, $vote['valeur_element']);
        $sheet->setCellValue('H' . $row, $vote['date_menu']);
        $sheet->setCellValue('I' . $row, $vote['identifiant']);
        $row++;
    }
} catch (PDOException $e) {
    $sheet->setCellValue('A' . $row, 'Erreur lors de la récupération des votes: ' . $e->getMessage());
}

// ===================== //
// EXPORT DES UTILISATEURS //
// ===================== //
$row++;
$sheet->setCellValue('A' . $row, '--- DONNÉES DES UTILISATEURS ---');
$row++;
$sheet->setCellValue('A' . $row, 'ID');
$sheet->setCellValue('B' . $row, 'Nom');
$sheet->setCellValue('C' . $row, 'Adresse');
$sheet->setCellValue('D' . $row, 'Identifiant');
$sheet->setCellValue('E' . $row, 'Rôle');

$row++;
try {
    $query = $connexion->query('SELECT id, nom, adresse, identifiant, role_profil FROM users ORDER BY id ASC');
    $users = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($users as $user) {
        $sheet->setCellValue('A' . $row, $user['id']);
        $sheet->setCellValue('B' . $row, $user['nom']);
        $sheet->setCellValue('C' . $row, $user['adresse']);
        $sheet->setCellValue('D' . $row, $user['identifiant']);
        $sheet->setCellValue('E' . $row, $user['role_profil']);
        $row++;
    }
} catch (PDOException $e) {
    $sheet->setCellValue('A' . $row, 'Erreur lors de la récupération des utilisateurs: ' . $e->getMessage());
}

// Créer un writer pour enregistrer le fichier Excel
$writer = new Xlsx($spreadsheet);

// Forcer le téléchargement du fichier Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="synthese_donnees_cantines.xlsx"');
$writer->save('php://output');
exit;