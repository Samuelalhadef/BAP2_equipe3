<?php
require_once '../bdd.php';

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
</body>

</html>