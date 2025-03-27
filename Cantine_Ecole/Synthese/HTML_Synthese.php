<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../CSS/crud_users.css">
    <title>Synthèse des Données</title>
    <style>
        #excel-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 0.9em;
        }
        #excel-table th, #excel-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        #excel-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        #excel-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        #loading {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #666;
        }
        .table-container {
            max-height: 500px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <header>
        <a href="../../Mairie/HTML_Admin_Home.php"><img class="logo" src="../../images/logo.png"></a>
        <p id="date"></p>
        <div>
            <div class="off-screen-menu">
                <ul class="off-screen-menu-item">
                    <li><a href="../../Mairie/HTML_Admin_Home.php">PAGE D'ACCUEIL</a></li>
                    <li><a href="../../Mairie/Menu/HTML_Liste_Menu.php">GESTION DES MENUS</a></li>
                    <li><a href="../../Mairie/Users/HTML_Users.php">GESTION DES PROFILS</a></li>
                    <li><a href="../../Mairie/Synthese/HTML_Synthese.php">SYNTHESE</a></li>
                </ul>
                <ul class="off-screen-menu-plus">
                    <li class="off-screen-menu-item-text"><a href="../../Login/HTML_Login.php">Se déconnecter&nbsp;&nbsp;</a><i class="fa-solid fa-right-from-bracket"></i></li>
                </ul>
            </div>
            <nav>
                <p>MENU&nbsp;&nbsp;</p>
                <div class="ham-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <form action="export_excel.php" method="post">
            <h2>SYNTHESE DES DONNEES</h2>
            
            <button type="submit">Exporter en Excel</button>

            <div id="loading">Chargement des données...</div>
            <div class="table-container">
                <div id="excel-output"></div>
            </div>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('get_excel_data.php')
                .then(response => response.json())
                .then(data => {
                    // Masquer le message de chargement
                    document.getElementById('loading').style.display = 'none';
                    
                    // Créer un tableau HTML
                    const tableElement = document.createElement('table');
                    tableElement.id = 'excel-table';
                    
                    // En-têtes
                    const thead = document.createElement('thead');
                    const headerRow = document.createElement('tr');
                    data[0].forEach(header => {
                        const th = document.createElement('th');
                        th.textContent = header;
                        headerRow.appendChild(th);
                    });
                    thead.appendChild(headerRow);
                    tableElement.appendChild(thead);
                    
                    // Données
                    const tbody = document.createElement('tbody');
                    for (let i = 1; i < data.length; i++) {
                        const tr = document.createElement('tr');
                        data[i].forEach(cell => {
                            const td = document.createElement('td');
                            td.textContent = cell;
                            tr.appendChild(td);
                        });
                        tbody.appendChild(tr);
                    }
                    tableElement.appendChild(tbody);
                    
                    // Afficher le tableau
                    const outputDiv = document.getElementById('excel-output');
                    outputDiv.appendChild(tableElement);
                })
                .catch(error => {
                    // Gestion des erreurs
                    document.getElementById('loading').textContent = 'Erreur de chargement des données';
                    console.error('Erreur:', error);
                });
        });
    </script>

    <script src="../../JS/nav.js"></script>
</body>
</html>