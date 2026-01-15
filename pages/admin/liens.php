<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Support des deux variantes de clé de session (`Role` ou `role`)
$user_role = $_SESSION['Role'] ?? $_SESSION['role'] ?? '';
$dashboard_href = ($user_role === 'admin') ? '/admin' : '/Blog';
?>

<div class="hero-scene text-center text-white">
    <div class="hero-scene-content">
            <h1 class="hero-scene-text">Liens Utiles</h1>
            <div><a href="/" class="btn btn-primary">Retour Accueil</a></div>
    </div>
</div>


<section>
    <nav class="navbar navbar-expand-lg bg-pompier admin-subnav" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin" data-show="admin">Tableau de bord Administrateur</a>
            <a class="navbar-brand" href="/Blog" data-show="actif">Tableau de bord</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="#navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
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
                <h1 class="page-title"><i class="bi bi-link-45deg me-3"></i>Ressources et Liens</h1>
                <div class="page-title-underline"></div>
            </div>
        </div>
    </article>
</section>

<br>
<br>

<section class="container liens-utiles">
    
    <div>
        <div class="row bg-arc-mint-green-light-staff py-3">
            <div class="card-list-employe mt-3">
                <div class="card-header">
                    <h2 class="text-center text-primary admin">Liens Utiles</h2>
                </div>

                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="liens">Voici quelques liens utiles pour les pompiers :</p>
                        </div>
                    </div>
                        <div>
                        <p>Site officiel : <a  href="https://www.sdis40.fr/">sdis</a>.</p>
                        <p>Site de l'ASPL : <a href="https://www.pompiers-leon40.fr/">pompiers-leon40.fr</a>.</p>
                        <p>Site de la FNSPF : <a href="https://www.pompiers.fr/">pompiers.fr</a>.</p>
                        <p>Firewall : <a href="https://firewall.sdis40.fr/global-protect/login.esp">firewall.sdis.fr</a>.</p>
                        <p>Apis : <a href="https://www.plateforme-apis.fr/login/index.php">plateforme-apis.fr</a>.</p>
                        <p>Outlook : <a href="https://outlook.live.com/mail/">outlook.live.com</a>.</p>
                    </div>
                </div>
            </div> 
        </div> 
    </div> 
    <br>    
</section>
