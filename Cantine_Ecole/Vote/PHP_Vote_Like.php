<?php
session_start();

// Vérification CSRF pour la sécurité
if (!isset($_POST['token']) || !isset($_SESSION['csrf_vote_add']) || $_POST['token'] !== $_SESSION['csrf_vote_add']) {
    die("Erreur de sécurité.");
}

// Vérifier si toutes les données de vote sont présentes
if (isset($_SESSION['vote_faim']) && isset($_SESSION['valeur_element']) && isset($_POST['vote_appreciation'])) {
    $vote_faim = $_SESSION['vote_faim'];
    $valeur_element = $_SESSION['valeur_element'];
    $vote_appreciation = $_POST['vote_appreciation'];
    
    try {
        // Connexion à la base de données
        $connexion = new PDO("mysql:host=127.0.0.1; dbname=test_bap", "root", "");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Mettre à jour les compteurs dans la table vote
        // D'après votre structure, on incrémente simplement les compteurs appropriés dans la première ligne (id=1)
        $sql = "UPDATE vote SET ";
        
        // Ajouter +1 au compteur de faim approprié
        if ($vote_faim === 'grande_faim') {
            $sql .= "grande_faim = grande_faim + 1";
        } else if ($vote_faim === 'petite_faim') {
            $sql .= "petite_faim = petite_faim + 1";
        }
        
        // Ajouter +1 au compteur d'appréciation approprié
        if ($vote_appreciation === 'aime') {
            $sql .= ", aime = aime + 1";
        } else if ($vote_appreciation === 'aime_moyen') {
            $sql .= ", aime_moyen = aime_moyen + 1";
        } else if ($vote_appreciation === 'aime_pas') {
            $sql .= ", aime_pas = aime_pas + 1";
        }
        
        // Mettre à jour la valeur de l'élément si nécessaire
        $sql .= ", valeur_element = :valeur_element";
        $sql .= " WHERE id = 1";
        
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':valeur_element', $valeur_element);
        $stmt->execute();
        
        $message = "Votre vote a été enregistré avec succès !";
    } catch (PDOException $e) {
        $message = "Erreur lors de l'enregistrement du vote : " . $e->getMessage();
    }
    
    // Nettoyer les données de session qui ne sont plus nécessaires
    unset($_SESSION['vote_faim']);
    unset($_SESSION['valeur_element']);
    
    // Régénérer un nouveau token CSRF pour la prochaine utilisation
    $_SESSION['csrf_vote_add'] = bin2hex(random_bytes(32));
    
    // Stocker le message pour l'afficher sur la page de confirmation
    $_SESSION['vote_message'] = $message;
    
    // Rediriger vers la page de confirmation
    header('Location: HTML_Vote_Confirmation.php');
    exit;
} else {
    $_SESSION['vote_message'] = "Erreur: Données de vote incomplètes.";
    header('Location: HTML_Vote_Faim.php');
    exit;
}
?>