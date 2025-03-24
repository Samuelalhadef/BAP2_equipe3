<?php
session_start();

// Traitement du vote
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['vote'])) {
    $vote = $_POST['vote'];
    $nom = $_POST['nom'];
    $classe = $_POST['classe'];
    
    // TODO: Ajouter la logique pour sauvegarder le vote dans la base de données
    // Pour l'instant, on simule un succès
    $message = "Merci $nom ! Ton vote a été enregistré.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote - Faim du Jour</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <div class="vote-container">
        <h1>Comment as-tu faim aujourd'hui ?</h1>
        
        <?php if (isset($message)): ?>
            <div class="message-success">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="vote-form">

            <div class="vote-options">
                <button type="submit" name="vote" value="petite" class="vote-button petite-faim">
                    <span class="emoji">🙂</span>
                    <span class="text">Petite faim</span>
                </button>

                <button type="submit" name="vote" value="grande" class="vote-button grande-faim">
                    <span class="emoji">😋</span>
                    <span class="text">Grande faim</span>
                </button>
            </div>
        </form>

        <div class="resultats">
            <h2>Résultats du jour</h2>
            <?php
            // TODO: Récupérer et afficher les vrais résultats depuis la base de données
            ?>
            <div class="resultats-graph">
                <div class="barre petite" style="width: 40%;">
                    <span>Petite faim: 40%</span>
                </div>
                <div class="barre grande" style="width: 60%;">
                    <span>Grande faim: 60%</span>
                </div>
            </div>
        </div>

        <a href="menu_cantine.php" class="back-link">← Retour au menu</a>
    </div>
</body>
</html> 