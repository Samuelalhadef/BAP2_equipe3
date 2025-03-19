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
    <link rel="stylesheet" href="../CSS/profils.css">
</head>
<body>
    <h1>Votez pour votre opinion sur le menu</h1>
    <form method="POST" action="">
        <button type="submit" name="vote_option" value="J'aime bien">J'aime bien</button>
        <button type="submit" name="vote_option" value="J'aime moyen">J'aime moyen</button>
        <button type="submit" name="vote_option" value="J'aime pas">J'aime pas</button>
    </form>

    <h2>Résultats des votes</h2>
    <table border="1">
        <tr>
            <th>Option</th>
            <th>Nombre de votes</th>
        </tr>
        <?php foreach ($votes as $vote): ?>
        <tr>
            <td><?php echo htmlspecialchars($vote['option_name']); ?></td>
            <td><?php echo htmlspecialchars($vote['vote_count']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
