<?php
require_once '../bdd.php';

// Handle reset votes
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_votes'])) {
    $resetSql = "UPDATE vote SET vote_count = 0";
    $connexion->exec($resetSql);
    echo "<p>Les votes ont été réinitialisés avec succès.</p>";
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
    <title>Résultats des Votes</title>
    <link rel="stylesheet" href="../CSS/vote.css">
</head>

<body>
    <h1>Résultats des Votes</h1>
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

    <form method="POST" action="" style="margin-top: 20px;">
        <button type="submit" name="reset_votes" style="background-color: #FF5733; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            Réinitialiser les votes
        </button>
    </form>
</body>

</html>