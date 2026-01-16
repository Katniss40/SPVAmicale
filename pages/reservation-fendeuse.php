<?php
// Page réservation fendeuse intégrée au routage, structure harmonisée
session_start();
$message = "";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réservation Fendeuse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/reservation-fendeuse.css">
    <link rel="stylesheet" href="/scss/main.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

<!-- Header global (inclus via layout routé) -->


<div class="hero-scene admin-hero text-center text-white">
    <div class="hero-scene-content">
        <h1 class="hero-scene-text">Réservation de la fendeuse</h1>
    </div>
</div>
<section>

    <nav class="navbar navbar-expand-lg bg-pompier admin-subnav navbar-dark" data-bs-theme="dark">
        <div class="container-fluid">
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
                    <li class="nav-item"><a class="nav-link" href="/calendrier">Calendrier des Gardes</a></li>
                    <li class="nav-item"><a class="nav-link" href="/VideGrenier">Vide grenier</a></li>
                    <li class="nav-item"><a class="nav-link" href="/GalerieSPV">Gestion des Photos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Blog">Discussions</a></li>
                    <li class="nav-item"><a class="nav-link" href="/fendeuse">Réservation fendeuse</a></li>
                    <li class="nav-item"><a class="nav-link" href="/forum/account.php">Mon Compte</a></li>
                </ul>
            </div>
        </div>
    </nav>-->
</section>

<main class="resa-container">
    <h2 class="mb-4">📅 Choisissez vos dates</h2>
    <?= $message ?>
    <div id="calendar"></div>
    <form id="formResa">
        <div class="mb-3">
            <label for="nom_reservant" class="form-label">Votre nom :</label>
            <input type="text" id="nom_reservant" name="nom_reservant" class="form-control" placeholder="Votre nom" value="" required>
        </div>
        <div class="mb-3">
            <label for="date_debut" class="form-label">Du :</label>
            <input type="date" id="date_debut" name="date_debut" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="date_fin" class="form-label">Au :</label>
            <input type="date" id="date_fin" name="date_fin" class="form-control" required>
        </div>
        <p id="montant-total" style="font-weight:bold; color:#2E7D32;">Montant total : 0 €</p>
        <button type="submit" class="btn btn-success w-100">Réserver (15 €/jour)</button>
        <button type="button" id="btnAnnuler" class="btn btn-danger w-100 mt-2">🗑️ Annuler ma réservation</button>
    </form>
</main>


<!-- Un seul footer global sera affiché par le layout routé, ne pas dupliquer ici. -->
<button id="backToTop" aria-label="Retour en haut" title="Retour en haut">↑ Haut</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script type="module">
import initReservationPage from '/JS/auth/reservation.js';
initReservationPage();
</script>
<script type="module" src="/JS/auth/roleManager.js"></script>
<script type="module" src="/JS/auth/signout.js"></script>
<script src="/JS/auth/auto_logout_on_close.js"></script>
<script>
// ... JS du formulaire et du calendrier (identique à l'existant) ...
</script>
</body>
</html>
