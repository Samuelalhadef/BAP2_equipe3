<?php
session_start();

// Générer le token CSRF si non existant
if (empty($_SESSION['csrf_vote_add'])) {
    $_SESSION['csrf_vote_add'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote - Faim du Jour</title>
    <link rel="stylesheet" href="../../CSS/vote.css">
</head>
<body>
    <section class="vote_faim">
        <h1>C'est l'heure du vote !</h1>
        <h2>Aujourd'hui, j'avais une:</h2>
        <div class="faim">
            <form method="post" action="PHP_Vote_Faim.php">
                <input type="hidden" name="vote_type" value="grande_faim">
                <input type="hidden" name="token" value="<?= $_SESSION['csrf_vote_add']; ?>">
                <button class="faim_item" type="submit">
                    <a href="../../Cantine_Ecole/Vote/HTML_Vote_Like.php">
                        <img src="../../images/GrandeFaim_Texte.gif">
                    </a>
                </button>
            </form>
            
            <form method="post" action="PHP_Vote_Faim.php">
                <input type="hidden" name="vote_type" value="petite_faim">
                <input type="hidden" name="token" value="<?= $_SESSION['csrf_vote_add']; ?>">
                <button class="faim_item" type="submit">
                    <a href="../../Cantine_Ecole/Vote/HTML_Vote_Like.php">
                        <img src="../../images/PetiteFaim_Texte.gif">
                    </a>
                </button>
            </form>
        </div>
    </section>
</body>
</html>