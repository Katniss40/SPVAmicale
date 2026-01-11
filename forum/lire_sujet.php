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
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: white;">
        <div class="container-fluid">
            <a class="navbar-brand policeNav" href="/">
                <img src="/Images/Logo_SPleon3.png" alt="Logo" width="70" height="50" class="d-inline-block align-text-top">Amicale des Sapeurs-Pompiers de Léon
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
        </div>
    </section>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin" data-show="admin">Tableau de bord Administrateur</a>
            <a class="navbar-brand" href="/Blog" data-show="actif">Tableau de bord</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item" data-show="admin"><a class="nav-link" href="/spv">Liste des membres</a></li>
                    <li class="nav-item"><a class="nav-link" href="/liens">Liens Utiles</a></li>
                    <li class="nav-item"><a class="nav-link" href="/calendrier">Calendrier des Gardes</a></li>
                    <li class="nav-item"><a class="nav-link" href="/VideGrenier">Vide grenier</a></li>
                    <li class="nav-item"><a class="nav-link" href="/GalerieSPV">Gestion des Photos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Blog">Discussions</a></li>
                    <li class="nav-item"><a class="nav-link" href="/pages/auth/reservation.php">Réservation fendeuse</a></li>
                    <li class="nav-item"><a class="nav-link" href="/forum/account.php">Mon Compte</a></li>
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
        // Connexion à la base pour récupérer le titre
        $base = mysqli_connect('mysql-pompiers-leon.alwaysdata.net', '408942', '@Admin-2025@');
        mysqli_select_db($base, 'pompiers-leon_admin');
        $id_sujet = mysqli_real_escape_string($base, $_GET['id_sujet_a_lire']);
        $sql_titre = 'SELECT titre FROM forum_sujets WHERE id="' . $id_sujet . '"';
        $req_titre = mysqli_query($base, $sql_titre);
        $titre_sujet = '';
        if ($req_titre && $data_titre = mysqli_fetch_array($req_titre)) {
            $titre_sujet = htmlentities(trim($data_titre['titre']));
        }
        mysqli_free_result($req_titre);
        mysqli_close($base);

        echo '<div class="admin-card">';
        echo '<h1 class="titre-section">Lecture du sujet : ' . $titre_sujet . '</h1>';
        echo '<br>';
        echo '<div class="forum-reponses-list">';

        // Connexion à la base pour récupérer les réponses
        $base = mysqli_connect('mysql-pompiers-leon.alwaysdata.net', '408942', '@Admin-2025@');
        mysqli_select_db($base, 'pompiers-leon_admin');
        $sql = 'SELECT auteur, message, date_reponse FROM forum_reponses WHERE correspondance_sujet="' . $id_sujet . '" ORDER BY date_reponse ASC';
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
            echo '</div>';
        }
        if ($nb_reponses === 0) {
            echo '<div class="forum-reponse-card"><em>Aucune réponse pour ce sujet pour le moment.</em></div>';
        }
        mysqli_free_result($req);
        mysqli_close($base);

        echo '</div>'; // .forum-reponses-list
        echo '<br />';
        echo '<a class="btn" href="./insert_reponse.php?numero_du_sujet=' . $id_sujet . '">Répondre</a>';
        echo '</div>'; // .admin-card
    }
    ?>
    <br><br>
</main>

<!-- Bouton retour haut -->
<button id="backToTop" aria-label="Retour en haut" title="Retour en haut">↑ Haut</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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