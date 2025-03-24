<?php
require_once '../bdd.php';
session_start();

// Handle vote submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['vote'])) {
    $vote = $_POST['vote'];

    // Update the vote count in the database
    $sql = "UPDATE vote_faim SET vote_count = vote_count + 1 WHERE option_name = :option_name";
    $stmt = $connexion->prepare($sql);
    $stmt->execute(['option_name' => $vote]);

    // Redirect to vote.php
    header("Location: vote.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote - Faim du Jour</title>
    <link rel="stylesheet" href="../CSS/vote.css">
</head>

<body>
    <div class="vote-container">
        <h1>Comment as-tu faim aujourd'hui ?</h1>

        <form method="POST" action="" class="vote-form">
            <div class="vote-options">
                <div class="vote-card">
                    <button type="submit" name="vote" value="Petite Faim" class="vote-button green">
                        <p>Petite Faim</p>
                        <img src="../image/Mask group (1).png" alt="Petite Faim">
                    </button>
                </div>
                <div class="vote-card">
                    <button type="submit" name="vote" value="Grande Faim" class="vote-button orange">
                        <p>Grande Faim</p>
                        <img src="../image/Mask group.png" alt="Grande Faim">
                    </button>
                </div>
            </div>
        </form>

        <a href="menu_cantine.php" class="back-link">← Retour au menu</a>
    </div>
</body>

</html>