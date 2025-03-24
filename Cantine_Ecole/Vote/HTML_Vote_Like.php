<?php
session_start();

// Vérifier si le premier vote a été effectué
if (!isset($_SESSION['vote_faim'])) {
    header('Location: HTML_Vote_Faim.php');
    exit;
}

// Récupérer l'élément du jour
$valeur_element = isset($_SESSION['valeur_element']) ? $_SESSION['valeur_element'] : 'Plat du jour';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote - Appréciation</title>
    <link rel="stylesheet" href="../../CSS/vote.css">
</head>
<body>
    <section class="vote_appreciation">
        <h1>As-tu aimé ce plat ? C'est toi le chef !</h1>
        <h2>Aujourd'hui c'est: <?= htmlspecialchars($valeur_element); ?> !</h2>
        
        <div class="appreciation">
            <form method="post" action="HTML_Vote_Confirmation.php">
                <input type="hidden" name="vote_appreciation" value="aime">
                <input type="hidden" name="token" value="<?= $_SESSION['csrf_vote_add']; ?>">
                <button class="appreciation_item" type="submit">
                    <h3>J'aime !</h3>
                    <img src="../../images/Aime.svg" alt="J'aime">
                </button>
            </form>
            
            <form method="post" action="HTML_Vote_Confirmation.php">
                <input type="hidden" name="vote_appreciation" value="aime_moyen">
                <input type="hidden" name="token" value="<?= $_SESSION['csrf_vote_add']; ?>">
                <button class="appreciation_item" type="submit">
                    <h3>Moyen</h3>
                    <img src="../../images/Moyen.svg" alt="Moyen">
                </button>
            </form>
            
            <form method="post" action="HTML_Vote_Confirmation.php">
                <input type="hidden" name="vote_appreciation" value="aime_pas">
                <input type="hidden" name="token" value="<?= $_SESSION['csrf_vote_add']; ?>">
                <button class="appreciation_item" type="submit">
                    <h3>Je n'aime pas</h3>
                    <img src="../../images/AimePas.svg" alt="Je n'aime pas">
                </button>
            </form>
        </div>
    </section>
</body>
</html>