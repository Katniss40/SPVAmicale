<!DOCTYPE html>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
// Support des deux variantes de clé de session utilisées ailleurs (`Role` ou `role`)
$user_role = $_SESSION['Role'] ?? $_SESSION['role'] ?? '';
$dashboard_href = ($user_role === 'admin') ? '/admin' : '/Blog';
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des gardes et formations</title>
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/admin-custom.css">
    <link rel="stylesheet" href="/assets/css/calendrier-custom.css">
</head>
<body>
<div class="hero-scene admin-hero text-center text-white">
    <div class="hero-scene-content">
        <h1 class="hero-scene-text">Calendrier des gardes et formations</h1>
        <div><a href="/admin" class="btn btn-outline-light">Retour Accueil</a></div>
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
                        <a class="nav-link" href="/calendrier">Calendrier des gardes</a>
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
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="reservationsDropdown">
                            <li><a class="dropdown-item" href="/reservation-fendeuse">Fendeuse</a></li>
                            <li><a class="dropdown-item" href="/reservations-vl">VL</a></li>
                            <li><a class="dropdown-item" href="/reservations-historique">Historique</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/forum/account.php">Mon Compte</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="container admin-card">
    <div class="visible-page-title" style="margin-top:1rem; margin-bottom:1rem;">
        <h2 class="titre-section">Calendrier des gardes et formations</h2>
    </div>
    <div class="full-page">
        <p class="cal-info" style="margin-bottom:1.2em;">Le calendrier est mis à jour régulièrement. Vous pouvez consulter les gardes prévues pour les prochaines semaines.</p>
    </div>
    <div class="team-row">
        <div class="team-col">
            <div class="team-block">
                <h5>Équipe verte</h5>
                <p class="verte" id="equipe_verte">
                    <span class="team-members">
                        <span class="member">JM Renaut</span>,
                        <span class="member">T Chabassière</span>,
                        <span class="member">V Laforie</span>,
                        <span class="member">R Espana</span>,
                        <span class="member">M Renaut</span>,
                        <span class="member">Y Renaut</span>,
                        <span class="member">F Laforie</span>
                    </span>
                </p>
            </div>
        </div>
        <div class="team-col">
            <div class="team-block">
                <h5>Équipe bleue</h5>
                <p class="bleu" id="equipe_bleu">
                    <span class="team-members">
                        <span class="member">P Dubos</span>,
                        <span class="member">W Lartigue</span>,
                        <span class="member">M Bourguignon</span>,
                        <span class="member">B Biord</span>,
                        <span class="member">A Lebrere</span>,
                        <span class="member">F Fradon</span>,
                        <span class="member">H Lalous</span>,
                        <span class="member">M Prevot</span>
                    </span>
                </p>
            </div>
        </div>
        <div class="team-col">
            <div class="team-block">
                <h5>Équipe jaune</h5>
                <p class="jaune" id="equipe_jaune">
                    <span class="team-members">
                        <span class="member">JP Savy</span>,
                        <span class="member">A Doulet</span>,
                        <span class="member">J Bourdeloux</span>,
                        <span class="member">S Bourdeloux</span>,
                        <span class="member">J Mouyssac</span>,
                        <span class="member">JJ Chanut</span>,
                        <span class="member">L Decoopman</span>,
                        <span class="member">S Cordier</span>
                    </span>
                </p>
            </div>
        </div>
    </div>
    <div class="ratio ratio-4x3 full-page">
<!--<iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=7&ctz=Europe%2FParis&src=cG9tcGllcnMubGVvbkBnbWFpbC5jb20&color=%23e4c441" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>
<iframe src="https://calendar.google.com/calendar/embed?src=pompiers.leon%40gmail.com&ctz=Europe%2FParis" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
-->
<iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=Europe%2FParis&src=YXNwbGVvbjQwQGdtYWlsLmNvbQ&src=ZmJmZmM2NjgwNGMyOWUxODc4Mjk2ZDJlZjI4YjZhMTczZDQ3MjRiYzhkNmQwOTc4ZTQyNDQxMzVkMmRiOTg1YUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=OGVkZjVkZTg4MTE5ZjY4NjVhMzYwNzFkNTE5NmNhZGY0MzU5MTUyZWNiNGRjNzYzOWFkNmFkNWRlNGM1NWRhY0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=MWJiNzk5YTQwMTAzMmY3ZTg5NzY3Y2U3ZmJjZTQ1ODIwNjljY2E1Mjc1NGI3ZjMwMDY2ZmM1NGZiMTM1Y2VmN0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&color=%23e67c73&color=%234285f4&color=%23f6bf26&color=%230b8043" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>

</div>

</section>
</body>
</html>

       
        
  <!--<iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=2&ctz=Europe%2FParis&showPrint=0&mode=WEEK&showTz=0&showTabs=0&showTitle=0&showCalendars=0&src=NDlhZDIwNzA4MTY2MjdhZTYzNzNmZjE3OWIwZmU2N2MxZDcxN2ExNGVmZTJiNGVlMDdjNjY1NzRlOTk4ZDZjY0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=ZnIuZnJlbmNoI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&color=%23f6ff00&color=%230b8043" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>
<iframe src="https://calendar.google.com/calendar/embed?src=pompiers.leon%40gmail.com&ctz=Europe%2FParis" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>
<iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=2&ctz=Europe%2FParis&showCalendars=0&showTz=0&src=cG9tcGllcnMubGVvbkBnbWFpbC5jb20&color=%23e4c441" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>-->