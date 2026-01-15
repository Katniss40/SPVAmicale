<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Support des deux variantes de clé de session (`Role` ou `role`)
$user_role = $_SESSION['Role'] ?? $_SESSION['role'] ?? '';
$dashboard_href = ($user_role === 'admin') ? '/admin' : '/Blog';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Membres</title>
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/admin-custom.css">
    <link rel="stylesheet" href="/assets/css/spv-custom.css">
</head>
<body>

<div class="hero-scene admin-hero text-center text-white">
    <div class="hero-scene-content">
        <h1 class="hero-scene-text">Gestion des Membres</h1>
        <div><a href="/admin" class="btn btn-primary">Retour Accueil</a></div>
    </div>
</div>


<section>
    <nav class="navbar navbar-expand-lg bg-pompier admin-subnav" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin" data-show="admin">Tableau de bord Administrateur</a>
            <a class="navbar-brand" href="/Blog" data-show="actif">Tableau de bord</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item" data-show="admin">
                            <a class="nav-link" href="/spv">Liste des membres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/liens">Liens Utiles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/calendrier">Calendrier des Gardes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/VideGrenier">Vide grenier</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/GalerieSPV">Gestion des Photos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Blog">Discussions</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="reservationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Réservations</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="reservationsDropdown">
                                <li><a class="dropdown-item" href="/fendeuse">Fendeuse</a></li>
                                <li><a class="dropdown-item" href="/reservation-vl">VL</a></li>
                                <li><a class="dropdown-item" href="/admin/reservations-vl">Historique</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/forum/account.php">Mon Compte</a>
                        </li>
                    </ul>
                </div>
        </div>
    </nav>

</section>

<section class="admin-page">
    <article class="bg-white text-black">
        <div class="container p-4">
            <div class="page-title-container text-center">
                <h1 class="page-title"><i class="bi bi-people me-3"></i>Liste des Pompiers</h1>
                <div class="page-title-underline"></div>
            </div>
        </div>
    </article>
</section>

<br>
<section class="container admin-card">
    <div class="card-list-employe mt-3 table-membres">
        <h2 class="titre-section">Liste des Membres enregistrés</h2>
        <div class="card-body table-responsive table-spv">
            <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Rôle</th>
                                <th>Code Agent</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Adresse</th>
                                <!-- Mot de Passe masqué/retiré pour confidentialité -->
                                <th>Em@il</th>
                                <th>Téléphone</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Utiliser le helper mysqli centralisé
                        require_once __DIR__ . '/../controleurs/db_mysqli.php';
                        $sql = "SELECT * FROM Users";
                        $result = $mysqli->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td data-label='ID'>" . htmlspecialchars($row['ID']) . "</td>";
                                echo "<td data-label='Rôle'>" . htmlspecialchars($row['Role']) . "</td>";
                                echo "<td data-label='Code Agent'>" . htmlspecialchars($row['CAgent']) . "</td>";
                                echo "<td data-label='Nom'>" . htmlspecialchars($row['NomInput']) . "</td>";
                                echo "<td data-label='Prénom'>" . htmlspecialchars($row['PrenomInput']) . "</td>";
                                echo "<td data-label='Adresse'>" . htmlspecialchars($row['Adresse']) . "</td>";
                                // Mot de passe retiré de l'affichage pour confidentialité
                                echo "<td data-label='Email'>" . htmlspecialchars($row['EmailInput']) . "</td>";
                                echo "<td data-label='Téléphone'>" . htmlspecialchars($row['Telephone']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>Aucun employé trouvé.</td></tr>";
                        }
                        if (isset($mysqli) && $mysqli instanceof mysqli) {
                            $mysqli->close();
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
</body>
<br>
<br>

</html>