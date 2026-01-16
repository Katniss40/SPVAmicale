<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amicale des Sapeurs-Pompiers - Sujet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/lire_sujet.css">
    
    
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: rgb(255,255,255); border-bottom: 2px solid #2E7D32;">
        <div class="container-fluid">
            <a class="navbar-brand policeNav" href="/">
                <img src="/Images/Logo_SPleon3.png" alt="Logo" width="70" height="50" class="d-inline-block align-text-top"><span style="color: rgb(196, 29, 29); font-weight:bold; font-size:20px; margin-left:8px;">Amicale des Sapeurs-Pompiers de Léon</span>
            </a>
            <?php if(isset($_SESSION['PrenomInput'])): ?>
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
                    <li class="nav-item"><a class="nav-link policeDrop" href="/Blog" data-show="actif">SPV</a></li>
                    <li class="nav-item"><a class="nav-link policeDrop" href="/admin" data-show="admin">Administrateur</a></li>
                    <li class="nav-item" data-show="disconnected"><a class="nav-link policeNav" href="/signin">Connexion</a></li>
                    <li class="nav-item" data-show="connected"><button class="nav-link policeNav" id="btnSignout">Déconnexion</button></li>
                </ul>
            </div>
        </div>
</nav>
    <section class="hero-scene text-center text-white">
        <div class="hero-scene-content">
            <br><br><br><br>
            <h1 style="color: white;" class="hero-scene-text">Lecture du sujet</h1>
            <div><a href="/" class="btn btn-primary">Retour Accueil</a></div>
        </div>
    </section>
    <!--<nav class="navbar navbar-expand-lg bg-pompier admin-subnav" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin" data-show="admin">Tableau de bord Administrateur</a>
            <a class="navbar-brand" href="/Blog" data-show="actif">Tableau de bord</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item" data-show="admin"><a class="nav-link" href="/spv">Liste des membres</a></li>
                    <li class="nav-item"><a class="nav-link" href="/liens">Liens Utiles</a></li>
                    <li class="nav-item"><a class="nav-link" href="/calendrier">Calendrier des gardes et formations</a></li>
                    <li class="nav-item"><a class="nav-link" href="/VideGrenier">Vide grenier</a></li>
                    <li class="nav-item"><a class="nav-link" href="/GalerieSPV">Gestion des Photos</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/Blog">Discussions</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="reservationsDropdownForum" role="button" data-bs-toggle="dropdown" aria-expanded="false">Réservations</a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="reservationsDropdownForum">
                            <li><a class="dropdown-item" href="/reservation-fendeuse">Fendeuse</a></li>
                            <li><a class="dropdown-item" href="/reservation-vl">VL</a></li>
                            <li><a class="dropdown-item" href="/admin/reservations-vl">Historique</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="/forum/account.php">Mon Compte</a></li>
                </ul>
            </div>
        </div>
    </nav>-->
    <nav class="navbar navbar-expand-lg " data-bs-theme="dark">
        <div class="container-fluid" style="background-color: #2E7D32; font-family: montserrat; border-bottom: 2px solid #2E7D32; paddding: 8px 0px">
            <a class="navbar-brand" href="/admin" data-show="admin">Tableau de bord Administrateur</a>
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
                        <!--<li class="nav-item">
                            <a class="nav-link" href="/fendeuse">Réservation fendeuse</a>
                        </li>-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="reservationsDropdownAdmin" role="button" data-bs-toggle="dropdown" aria-expanded="false">Réservations</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="reservationsDropdownAdmin">
                                <li><a class="dropdown-item" href="/fendeuse">Fendeuse</a></li>
                                <li><a class="dropdown-item" href="/reservation-vl">VL</a></li>
                                <li><a class="dropdown-item" href="/admin/reservations-vl">Historique</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/forum/account.php">Mon Compte</a>
                        </li>
                        <!-- 'Réponses supprimées' moved to admin page actions (button near forum subjects) -->
                    </ul>
                </div>
        </div>
</nav>
</header>

<main>
    <a class="btn" href="/Blog">Retour à l'accueil</a>
    <br><br>
    <?php
    if (!isset($_GET['id_sujet_a_lire'])) {
        echo '<div class="admin-card"><h2 class="titre-section">Sujet non défini.</h2></div>';
    } else {
        // Connexion à la base pour récupérer le titre (helper centralisé)
        require_once __DIR__ . '/../pages/controleurs/db_mysqli.php';
        $base = $mysqli;
        $id_sujet = mysqli_real_escape_string($base, $_GET['id_sujet_a_lire']);
        $sql_titre = 'SELECT titre FROM forum_sujets WHERE id="' . $id_sujet . '"';
        $req_titre = mysqli_query($base, $sql_titre);
        $titre_sujet = '';
        if ($req_titre && $data_titre = mysqli_fetch_array($req_titre)) {
            $titre_sujet = htmlentities(trim($data_titre['titre']));
        }
        mysqli_free_result($req_titre);

        echo '<div class="admin-card">';
        echo '<h1 class="titre-section">Lecture du sujet : ' . $titre_sujet . '</h1>';
        echo '<br>';
        echo '<div class="forum-reponses-list">';

        // Connexion à la base pour récupérer les réponses (réutilise $mysqli)
        // $base est déjà défini ci-dessus à partir de db_mysqli.php
        // (si le helper n'a pas été inclus plus haut, inclure maintenant)
        if (!isset($base)) {
            require_once __DIR__ . '/../pages/controleurs/db_mysqli.php';
            $base = $mysqli;
        }
        $sql = 'SELECT id, auteur, message, date_reponse FROM forum_reponses WHERE correspondance_sujet="' . $id_sujet . '" ORDER BY date_reponse ASC';
        $req = mysqli_query($base, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($base));
        $nb_reponses = 0;
        while ($data = mysqli_fetch_array($req)) {
            $nb_reponses++;
            sscanf($data['date_reponse'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);
            echo '<div class="forum-reponse-card">';
            echo '<div class="forum-reponse-header">';
            echo '<span class="forum-reponse-auteur">' . htmlentities(trim($data['auteur'])) . '</span>';
            echo '<span class="forum-reponse-date">' . $jour . '-' . $mois . '-' . $annee . ' ' . $heure . ':' . $minute . '</span>';
            echo '</div>';
            echo '<div class="forum-reponse-message">' . nl2br(htmlentities(trim($data['message']))) . '</div>';
            // Si l'utilisateur connecté est administrateur, afficher le lien de suppression
            if (isset($_SESSION['Role']) && $_SESSION['Role'] === 'admin') {
                $respId = (int)$data['id'];
                echo '<div class="forum-reponse-actions"><a class="btn btn-sm btn-danger" href="supprimer_reponse.php?id=' . $respId . '&id_sujet_a_lire=' . urlencode($id_sujet) . '" onclick="return confirm(\'Supprimer cette réponse ?\')">Supprimer</a></div>';
            }
            echo '</div>';
        }
        if ($nb_reponses === 0) {
            echo '<div class="forum-reponse-card"><em>Aucune réponse pour ce sujet pour le moment.</em></div>';
        }
        mysqli_free_result($req);
        mysqli_close($base);

        echo '</div>'; // .forum-reponses-list
        echo '<br />';
        echo '<a class="btn" href="/forum/insert_reponse.php?numero_du_sujet=' . $id_sujet . '">Répondre</a>';
        // Lien vers l'historique des suppressions pour les administrateurs
        if (isset($_SESSION['Role']) && $_SESSION['Role'] === 'admin') {
            echo ' <a class="btn btn-secondary ms-2" href="/forum/reponses_supprimees.php">Historique suppressions</a>';
        }
        echo '</div>'; // .admin-card
    }
    ?>
    <br><br>
</main>

<!-- Bouton retour haut -->
<button id="backToTop" aria-label="Retour en haut" title="Retour en haut">↑ Haut</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script type="module" src="/JS/auth/roleManager.js"></script>
      <script type="module" src="/JS/auth/signin-script.js"></script>
      <script type="module" src="/JS/auth/signout.js"></script>
            <script src="/JS/auth/auto_logout_on_close.js"></script>
      <script type="module" src="/Router/router.js"></script>

<script>
// Bouton retour haut
const backToTopBtn = document.getElementById('backToTop');
window.addEventListener('scroll', () => {
    if (window.scrollY > 200) {
        backToTopBtn.classList.add('visible');
    } else {
        backToTopBtn.classList.remove('visible');
    }
});
backToTopBtn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>
</body>
</html>