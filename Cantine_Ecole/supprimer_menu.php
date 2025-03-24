<?php
session_start();

require_once '../bdd.php';

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: gestion_cantine.php');
    exit;
}

$id_menu = (int)$_GET['id'];

try {
    // Begin a transaction for data consistency
    $connexion->beginTransaction();
    
    // First, delete the menu record
    $query = $connexion->prepare("DELETE FROM menu WHERE id = :id");
    $result = $query->execute(['id' => $id_menu]);
    
    if ($result) {
        // If deletion was successful, commit transaction
        $connexion->commit();
        
        // Set a success message (optional)
        $_SESSION['success_message'] = "Le menu a été supprimé avec succès.";
    } else {
        // If deletion failed, rollback transaction
        $connexion->rollBack();
        $_SESSION['error_message'] = "Erreur lors de la suppression du menu.";
    }
} catch (PDOException $e) {
    // If an error occurred, rollback transaction
    $connexion->rollBack();
    $_SESSION['error_message'] = "Erreur de base de données: " . $e->getMessage();
}

// Redirect back to menu management page
header('Location: gestion_cantine.php');
exit;
?>
