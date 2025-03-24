<?php
session_start();

// Récupérer le message s'il existe
$message = isset($_SESSION['vote_message']) ? $_SESSION['vote_message'] : "Merci pour votre participation !";

// Effacer le message de la session après l'avoir récupéré
unset($_SESSION['vote_message']);

// Récupérer les statistiques de vote depuis la base de données
try {
    $connexion = new PDO("mysql:host=127.0.0.1; dbname=test_bap", "root", "");
    $stmt = $connexion->query("SELECT * FROM vote WHERE id = 1");
    $stats = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $stats = [
        'grande_faim' => 0,
        'petite_faim' => 0,
        'aime' => 0,
        'aime_moyen' => 0,
        'aime_pas' => 0,
        'valeur_element' => 'Plat du jour'
    ];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote enregistré - Merci !</title>
    <link rel="stylesheet" href="../../CSS/vote.css">
</head>
<body>
    <section class="vote_confirmation">
        <h1>Merci pour votre vote !</h1>
        <p class="confirmation_message"><?= htmlspecialchars($message); ?></p>
        
        <div class="resultats">
            <h2>Statistiques pour "<?= htmlspecialchars($stats['valeur_element'] ?? 'Plat du jour'); ?>" :</h2>
            
            <div class="stat_section">
                <h3>Niveau de faim</h3>
                <div class="compteurs">
                    <div class="compteur">
                        <h4>Grande faim</h4>
                        <p><?= intval($stats['grande_faim']) ?> votes</p>
                    </div>
                    <div class="compteur">
                        <h4>Petite faim</h4>
                        <p><?= intval($stats['petite_faim']) ?> votes</p>
                    </div>
                </div>
            </div>
            
            <div class="stat_section">
                <h3>Appréciation</h3>
                <div class="compteurs">
                    <div class="compteur">
                        <h4>J'aime</h4>
                        <p><?= intval($stats['aime']) ?> votes</p>
                    </div>
                    <div class="compteur">
                        <h4>Moyen</h4>
                        <p><?= intval($stats['aime_moyen']) ?> votes</p>
                    </div>
                    <div class="compteur">
                        <h4>Je n'aime pas</h4>
                        <p><?= intval($stats['aime_pas']) ?> votes</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="retour">
            <a href="../../index.php" class="bouton_retour">Retour à l'accueil</a>
        </div>
    </section>
</body>
</html>