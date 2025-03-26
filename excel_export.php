<?php
try {
    $connexion = new PDO("mysql:host=127.0.0.1; dbname=beta", "root", "");
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour récupérer les données
    $requete = $connexion->prepare("SELECT nom, prenom, email, telephone, date_inscription FROM utilisateurs");
    $requete->execute();
    $resultats = $requete->fetchAll(PDO::FETCH_ASSOC);

    // Charger PhpSpreadsheet
    require 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    // Créer un nouveau spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Définir les en-têtes
    $sheet->setCellValue('A1', 'Nom');
    $sheet->setCellValue('B1', 'Prénom');
    $sheet->setCellValue('C1', 'Email');
    $sheet->setCellValue('D1', 'Téléphone');
    $sheet->setCellValue('E1', 'Date d\'inscription');

    // Remplir les données
    $rowNumber = 2;
    foreach ($resultats as $row) {
        $sheet->setCellValue('A' . $rowNumber, $row['nom']);
        $sheet->setCellValue('B' . $rowNumber, $row['prenom']);
        $sheet->setCellValue('C' . $rowNumber, $row['email']);
        $sheet->setCellValue('D' . $rowNumber, $row['telephone']);
        $sheet->setCellValue('E' . $rowNumber, $row['date_inscription']);
        $rowNumber++;
    }

    // Préparer le téléchargement
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="export_utilisateurs.xlsx"');
    header('Cache-Control: max-age=0');

    // Générer et télécharger le fichier
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit();
}
catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
?>