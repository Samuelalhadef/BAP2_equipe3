<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../admin.css">
    <title>Admin - Accueil</title>
</head>

<body>
    <h1>Accueil Admin - Gestion des utilisateurs</h1>
    <?php
    session_start();

    // Vérifiez si l'utilisateur est connecté
    if (!isset($_SESSION['email'])) {
        header('Location: ../log_sign/login.php');
        exit;
    }

    // Vérifiez si l'utilisateur est un admin
    if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
        echo "<p>Accès refusé. Vous n'êtes pas autorisé à accéder à cette page.</p>";
        exit;
    }

    require_once '../bdd.php';

    // Handle deletion
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
        $deleteId = $_POST['delete_id'];
        $deleteSql = "DELETE FROM connexion WHERE id = :id";
        $deleteStmt = $connexion->prepare($deleteSql);
        $deleteStmt->execute(['id' => $deleteId]);
        echo "<p>Utilisateur avec ID $deleteId supprimé avec succès.</p>";
    }

    // Handle update
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_id'])) {
        $updateId = $_POST['update_id'];
        $newEmail = $_POST['email'] ?? '';
        $newPassword = $_POST['password'] ?? '';

        if (!empty($newEmail) && !empty($newPassword)) {
            $updateSql = "UPDATE connexion SET email = :email, mdp = :password WHERE id = :id";
            $updateStmt = $connexion->prepare($updateSql);
            $updateStmt->execute([
                'email' => $newEmail,
                'password' => $newPassword,
                'id' => $updateId
            ]);
            echo "<p>Utilisateur avec ID $updateId mis à jour avec succès.</p>";
        } else {
            echo "<p>Veuillez remplir tous les champs pour mettre à jour l'utilisateur.</p>";
        }
    }

    // Fetch user data
    $sql = "SELECT id, email FROM connexion";
    $result = $connexion->query($sql);

    if ($result->rowCount() > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Email</th><th>Actions</th></tr>";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id'] ?? '') . "</td>";
            echo "<td>" . htmlspecialchars($row['email'] ?? '') . "</td>";
            echo "<td>";
            // Delete form
            echo "<form method='POST' style='display:inline;'>";
            echo "<input type='hidden' name='delete_id' value='" . htmlspecialchars($row['id'] ?? '') . "'>";
            echo "<button type='submit'>Supprimer</button>";
            echo "</form>";
            // Update form
            echo "<form method='POST' style='display:inline; margin-left:10px;'>";
            echo "<input type='hidden' name='update_id' value='" . htmlspecialchars($row['id'] ?? '') . "'>";
            echo "<input type='email' name='email' placeholder='Nouvel email' required>";
            echo "<input type='password' name='password' placeholder='Nouveau mot de passe' required>";
            echo "<button type='submit'>Modifier</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Aucun utilisateur trouvé.</p>";
    }
    ?>
</body>

</html>