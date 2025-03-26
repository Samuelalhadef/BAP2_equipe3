<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/profils.css">
    <title>Page d'accueil Admin</title>
</head>

<body>
    <?php
    // Start the session only if it hasn't been started already
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>

    <header>
        <p>Nom du projet</p>
        <p>Date du jour : <?php echo date('d/m/Y'); ?></p>
        <nav>
            <p>Menu</p>
            <div class="ham-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
        <div class="off-screen-menu">
            <ul class="off-screen-menu-item">
                <li><a href="../Cantine_Ecole/HTML_User_Home.php">PAGE D'ACCUEIL</a></li>
                <li><a href="#">GESTION DES MENUS</a></li>
                <li><a href="#">SYNTHESE</a></li>
                <li><a href="#">VOTE DU JOUR</a></li>
                <li><a href="#">PESEE DU JOUR</a></li>
            </ul>
            <ul class="off-screen-menu-plus">
                <li class="off-screen-menu-item-text">
                    <a href="#">Paramètres&nbsp;&nbsp;<i class="fa-solid fa-gear"></i></a>
                </li>
                <li class="off-screen-menu-item-text">
                    <a href="#">Se déconnecter&nbsp;&nbsp;<i class="fa-solid fa-right-from-bracket"></i></a>
                </li>
            </ul>
        </div>
    </header>

    <div class="name_user_admin">
        <h1>BONJOUR</h1>
        <?php
        if (isset($_SESSION['email'])) {
            echo "<h2>" . htmlspecialchars($_SESSION['email']) . "</h2>";
        } else {
            echo "<p>Vous n'êtes pas connecté ou la session a expiré.</p>";
            header('Location: ../log_sign/login.php');
            exit;
        }
        ?>
    </div>

    <div class="container_profils">
        <!-- Section: Menu du jour -->
        <div class="menu_recap">
            <h3>MENU DU JOUR</h3>
            <?php
            require_once '../bdd.php';

            $sql = "SELECT entree, plat, dessert FROM menu ORDER BY id DESC LIMIT 1";
            $req = $connexion->query($sql);

            if ($req) {
                $menu = $req->fetch(PDO::FETCH_ASSOC);
                if ($menu) {
                    $_SESSION['entree'] = $menu['entree'];
                    $_SESSION['plat'] = $menu['plat'];
                    $_SESSION['dessert'] = $menu['dessert'];
                }
            }

            if (isset($_SESSION['entree']) && isset($_SESSION['plat']) && isset($_SESSION['dessert'])) {
                echo "<div class='menu_container'>";
                echo "<div class='menu_details'><p>Entrée :</p><p>" . htmlspecialchars($_SESSION['entree']) . "</p></div>";
                echo "<div class='menu_details'><p>Plat :</p><p>" . htmlspecialchars($_SESSION['plat']) . "</p></div>";
                echo "<div class='menu_details'><p>Dessert :</p><p>" . htmlspecialchars($_SESSION['dessert']) . "</p></div>";
                echo "</div>";
            } else {
                echo "<p>Il n'y a pas de menus dans la liste pour le moment</p>";
            }
            ?>
            <button><a href="../Mairie/HTML_Liste_Menu.php">Gestion des menus&nbsp;<i
                        class="fa-solid fa-arrow-right"></i></a></button>
        </div>

        <!-- Section: Vote du jour -->
        <div class="gestion_profils">
            <h3>VOTE DU JOUR</h3>
            <button><a href="HTML">Détails&nbsp;<i class="fa-solid fa-arrow-right"></i></a></button>
        </div>

        <!-- Section: Pesée du jour -->
        <div class="synthese">
            <h3>PESEE DU JOUR</h3>
            <button><a href="HTML">Détails&nbsp;<i class="fa-solid fa-arrow-right"></i></a></button>
        </div>
    </div>

    <script src="../JS/nav.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/profils.css">
    <title>Admin - Gestion des Profils</title>
</head>

<body>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['email'])) {
        header('Location: ../log_sign/login.php');
        exit;
    }

    if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
        echo "<p>Accès refusé. Vous n'êtes pas autorisé à accéder à cette page.</p>";
        exit;
    }

    require_once '../bdd.php';

    // Handle profile deletion
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
        $deleteId = $_POST['delete_id'];
        $deleteSql = "DELETE FROM connexion WHERE id = :id";
        $deleteStmt = $connexion->prepare($deleteSql);
        $deleteStmt->execute(['id' => $deleteId]);
        echo "<p>Profil supprimé avec succès.</p>";
    }

    // Handle profile update
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
            echo "<p>Profil mis à jour avec succès.</p>";
        } else {
            echo "<p>Veuillez remplir tous les champs pour mettre à jour le profil.</p>";
        }
    }
    ?>

    <h1>Gestion des Profils</h1>
    <?php
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
            echo "<form method='POST' style='display:inline;'>";
            echo "<input type='hidden' name='delete_id' value='" . htmlspecialchars($row['id'] ?? '') . "'>";
            echo "<button type='submit'>Supprimer</button>";
            echo "</form>";
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
        echo "<p>Aucun profil trouvé.</p>";
    }
    ?>
</body>

</html>