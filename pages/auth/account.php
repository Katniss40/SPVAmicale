<?php
if (session_status() === PHP_SESSION_NONE) {
        session_start();
}
?>

<!-- Styles globaux pour les titres harmonisés -->
<link rel="stylesheet" href="/scss/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css">

<header>
<nav class="navbar navbar-expand-lg fixed-top" style="background-color: rgb(255,255,255); border-bottom: 2px solid #2E7D32; width:100vw; margin-left:0; margin-right:0;">
    <div class="container-fluid">
        <a class="navbar-brand policeNav" href="/">
            <img src="/Images/Logo_SPleon3.png" alt="Logo" width="70" height="50" class="d-inline-block align-text-top"><span style="color: rgb(196, 29, 29); font-weight:bold; font-size:1.5rem; margin-left:8px;">Amicale des Sapeurs-Pompiers de Léon</span>
        </a>
        <?php if (!empty($_SESSION['PrenomInput'])): ?>
            <span class="navbar-welcome" style="margin-left:24px; font-size:1.1rem; color:#2E7D32; font-weight:bold;">Bienvenue, <?php echo htmlspecialchars($_SESSION['PrenomInput']); ?></span>
        <?php endif; ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="#navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link policeNav" href="/">Accueil</a></li>
                <li class="nav-item"><a class="nav-link policeNav" href="/galerie">Galerie</a></li>
                <li class="nav-item"><a class="nav-link policeNav" href="/manifestations">Bal/Vide-grenier</a></li>
                <li class="nav-item"><a class="nav-link policeNav" href="/recrutement">Recrutement</a></li>
                <li class="nav-item"><a class="nav-link policeNav" href="/infos">Manifestations</a></li>
                <li class="nav-item dropdown" data-show="connected">
                    <li><a class="nav-link policeDrop" href="/Blog" data-show="actif">SPV</a></li>
                    <li><a class="nav-link policeDrop" href="/admin" data-show="admin">Administrateur</a></li>
                </li>
                <li class="nav-item" data-show="disconnected"><a class="nav-link policeNav" href="/signin">Connexion</a></li>
                <li class="nav-item" data-show="connected"><button class="nav-link policeNav" id="btnSignout">Déconnexion</button></li>
            </ul>
        </div>
    </div>
</nav>
</header>

<section>
        <nav class="navbar navbar-expand-lg bg-pompier admin-subnav navbar-dark" data-bs-theme="dark">
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
                        <li class="nav-item">
                            <a class="nav-link" href="/fendeuse">Réservation fendeuse</a>
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

<!-- Hero (moved after header to avoid overlap) -->
<div class="hero-scene text-center text-white">
    <div class="hero-scene-content">
        <h1 class="hero-scene-text">Mon compte</h1>
        <div><a href="/" class="btn btn-primary">Retour Accueil</a></div>
    </div>
</div>

<section class="admin-page">
    <article class="bg-white text-black">
        <div class="container p-4">
            <div class="page-title-container text-center">
                <h1 class="page-title"><i class="bi bi-person-badge me-3"></i>Mon Compte</h1>
                <div class="page-title-underline"></div>
            </div>
        </div>
    </article>
</section>
<br>

<!-- Espace admin : cartes harmonisées -->
<section class="container py-4">

    <!-- Coordonnées -->
    <div class="card shadow-lg border-0 rounded-4 mb-4">
        <div class="card-header bg-white border-0 pt-4">
            <h2 class="page-title text-center mb-0"><i class="bi bi-person-vcard me-3"></i>Vos Coordonnées</h2>
            <div class="page-title-underline"></div>
        </div>
        <div class="card-body">
            <form method="post" class="row g-3 align-items-end mb-3">
                <div class="col-md-6 col-lg-4">
                    <label for="CAgent" class="form-label fw-semibold">Code Agent</label>
                    <input type="text" name="CAgent" id="CAgent" class="form-control" placeholder="Ex : 12345" required>
                </div>
                <div class="col-md-4 col-lg-3">
                    <button type="submit" class="btn btn-success w-100"><i class="bi bi-search me-2"></i>Afficher</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Code Agent</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
include("connexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $CAgent = trim($_POST["CAgent"]);

    $stmt = $conn->prepare("SELECT CAgent, NomInput, PrenomInput FROM Users WHERE CAgent = ?");
    $stmt->bind_param("s", $CAgent);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['CAgent']) . "</td>";
            echo "<td>" . htmlspecialchars($row['NomInput']) . "</td>";
            echo "<td>" . htmlspecialchars($row['PrenomInput']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3' class='text-center text-muted'>Aucun résultat trouvé pour ce code agent.</td></tr>";
    }

    $stmt->close();
}
?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modification adresse / téléphone -->
    <div class="card shadow-lg border-0 rounded-4 mb-4">
        <div class="card-header bg-white border-0 pt-4">
            <h2 class="page-title text-center mb-0"><i class="bi bi-geo-alt me-3"></i>Modifier adresse / téléphone</h2>
            <div class="page-title-underline"></div>
        </div>
        <div class="card-body">
            <form action="/pages/auth/modif_account.php" method="POST" class="row g-3">
                <div class="col-md-4">
                    <label for="CAgent" class="form-label fw-semibold">Code Agent</label>
                    <input type="text" class="form-control" id="CAgent" name="CAgent" placeholder="Ex : 12345" required>
                </div>
                <div class="col-md-4">
                    <label for="Adresse" class="form-label fw-semibold">Adresse</label>
                    <input type="text" class="form-control" id="Adresse" name="Adresse" placeholder="Adresse">
                </div>
                <div class="col-md-4">
                    <label for="Telephone" class="form-label fw-semibold">Téléphone</label>
                    <input type="text" class="form-control" id="Telephone" name="Telephone" placeholder="01.02.03.04.05">
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check2-circle me-2"></i>Valider</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Mots de passe (Outlook / Firewall / Apis) -->
    <div class="card shadow-lg border-0 rounded-4 mb-4">
        <div class="card-header bg-white border-0 pt-4">
            <h2 class="page-title text-center mb-0"><i class="bi bi-shield-lock me-3"></i>Ajouter / modifier vos mots de passe</h2>
            <div class="page-title-underline"></div>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-3 border rounded-3">
                        <h5 class="fw-semibold mb-3"><i class="bi bi-envelope-at me-2"></i>Outlook</h5>
                        <form action="/pages/auth/gestion_AOutlook.php" method="POST" class="vstack gap-3">
                            <div>
                                <label for="CAgentOutlook" class="form-label">Code Agent</label>
                                <input type="text" class="form-control" id="CAgentOutlook" name="CAgent" required>
                            </div>
                            <div>
                                <label for="Outlook" class="form-label">Mot de passe Outlook</label>
                                <input type="text" class="form-control" id="Outlook" name="Outlook">
                            </div>
                            <button type="submit" class="btn btn-secondary">Enregistrer</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded-3">
                        <h5 class="fw-semibold mb-3"><i class="bi bi-shield-check me-2"></i>Firewall</h5>
                        <form action="/pages/auth/gestion_AFirewall.php" method="POST" class="vstack gap-3">
                            <div>
                                <label for="CAgentFirewall" class="form-label">Code Agent</label>
                                <input type="text" class="form-control" id="CAgentFirewall" name="CAgent">
                            </div>
                            <div>
                                <label for="Firewall" class="form-label">Mot de passe Firewall</label>
                                <input type="text" class="form-control" id="Firewall" name="Firewall">
                            </div>
                            <button type="submit" class="btn btn-secondary">Enregistrer</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded-3">
                        <h5 class="fw-semibold mb-3"><i class="bi bi-diagram-3 me-2"></i>Apis</h5>
                        <form action="/pages/auth/gestion_AApis.php" method="POST" class="vstack gap-3">
                            <div>
                                <label for="CAgentApis" class="form-label">Code Agent</label>
                                <input type="text" class="form-control" id="CAgentApis" name="CAgent">
                            </div>
                            <div>
                                <label for="Apis" class="form-label">Mot de passe Apis</label>
                                <input type="text" class="form-control" id="Apis" name="Apis">
                            </div>
                            <button type="submit" class="btn btn-secondary">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informations personnelles -->
    <div class="card shadow-lg border-0 rounded-4 mb-4">
        <div class="card-header bg-white border-0 pt-4">
            <h2 class="page-title text-center mb-0"><i class="bi bi-house-heart me-3"></i>Informations Personnelles</h2>
            <div class="page-title-underline"></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Adresse</th>
                            <th>Téléphone</th>
                            <th>Adresse mail</th>
                        </tr>
                    </thead>
                    <tbody>
        <?php
        include("connexion.php");

                $sql = "SELECT * FROM Users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {

        // Affichage des données dans le tableau
        
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Adresse']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Telephone']) . "</td>";
            echo "<td>" . htmlspecialchars($row['EmailInput']) . "</td>";
            echo "</tr>";
        }
    }
        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Mots de passe -->
    <div class="card shadow-lg border-0 rounded-4 mb-4">
        <div class="card-header bg-white border-0 pt-4">
            <h2 class="page-title text-center mb-0"><i class="bi bi-key me-3"></i>Vos mots de passe</h2>
            <div class="page-title-underline"></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Site web</th>
                            <th>APIS</th>
                            <th>FIREWALL</th>
                            <th>OUTLOOK</th>
                        </tr>
                    </thead>
                    <tbody>
        <?php

        // Utiliser le helper mysqli centralisé
        require_once __DIR__ . '/../controleurs/db_mysqli.php';
            $sql = "SELECT * FROM securite_acces";
            $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {

        // Affichage des données dans le tableau
        
            echo "<tr>";
            echo "<td>••••••</td>";
            echo "<td>" . htmlspecialchars($row['Apis']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Firewall']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Outlook']) . "</td>";
            echo "</tr>";
                    }
                }
                $conn->close();
        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>



    