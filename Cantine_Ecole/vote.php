<?php
require_once '../bdd.php';

// Handle vote submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote_option'])) {
    $voteOption = $_POST['vote_option'];

    // Update the vote count in the database
    $sql = "UPDATE vote SET vote_count = vote_count + 1 WHERE option_name = :option_name";
    $stmt = $connexion->prepare($sql);
    $stmt->execute(['option_name' => $voteOption]);
    echo "<p>Merci pour votre vote !</p>";
}

// Fetch the current vote counts
$sql = "SELECT option_name, vote_count FROM vote";
$result = $connexion->query($sql);
$votes = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote - Cantine</title>
    <link rel="stylesheet" href="../CSS/vote.css">
</head>

<body>
    <h1>Votez pour votre opinion sur le menu</h1>
    <form method="POST" action="">
        <button class="green" type="submit" name="vote_option" value="J'aime bien">
            <p>J'aime bien</p>
            <img src="../image/Group 81.png" alt="J'aime bien">
        </button>
        <button class="orange" type="submit" name="vote_option" value="J'aime moyen">
            <p>J'aime moyen</p>
            <img src="../image/Group 71.png" alt="J'aime moyen">
        </button>
        <button class="red" type="submit" name="vote_option" value="J'aime pas">
            <p>J'aime pas</p>
            <img src="../image/Group 72.png" alt="J'aime pas">
        </button>
    </form>
</body>

</html>