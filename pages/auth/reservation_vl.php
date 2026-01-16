<?php
session_start();

// Accès réservé aux membres connectés
if (!isset($_SESSION['EmailInput'])) {
    header('Location: /signin');
    exit;
}

require_once __DIR__ . '/../controleurs/db_mysqli.php';
$conn = $mysqli;

$author_email = $_SESSION['EmailInput'];
$author_name = $_SESSION['PrenomInput'] ?? $_SESSION['prenomInput'] ?? $_SESSION['NomInput'] ?? $_SESSION['nomInput'] ?? '';

// Créer la table si elle n'existe pas (simple gestion d'une seule réservation pour le VL)
$createSql = "CREATE TABLE IF NOT EXISTS reservations_vl (
    id INT AUTO_INCREMENT PRIMARY KEY,
    author_email VARCHAR(255) NOT NULL,
    author_name VARCHAR(255) DEFAULT '',
    reserved_at DATETIME NOT NULL
);";
$conn->query($createSql);

// Traitement des actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'reserve') {
        // Si personne n'a réservé -> insérer
        $res = $conn->query("SELECT id FROM reservations_vl LIMIT 1");
        if (!$res || $res->num_rows === 0) {
            $stmt = $conn->prepare("INSERT INTO reservations_vl (author_email, author_name, reserved_at) VALUES (?, ?, NOW())");
            $stmt->bind_param('ss', $author_email, $author_name);
            $stmt->execute();
            $stmt->close();
        }
    } elseif ($action === 'cancel') {
        // Annulation autorisée uniquement par l'auteur
        $stmt = $conn->prepare("DELETE FROM reservations_vl WHERE author_email = ? LIMIT 1");
        $stmt->bind_param('s', $author_email);
        $stmt->execute();
        $stmt->close();
    }

    header('Location: /pages/auth/reservation_vl.php');
    header('Location: /reservation-vl');
}

// Récupérer l'état courant
$stmt = $conn->prepare("SELECT author_email, author_name, reserved_at FROM reservations_vl LIMIT 1");
$stmt->execute();
$result = $stmt->get_result();
$reservation = $result->fetch_assoc();
$stmt->close();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Réservation VL - Caserne de Léon</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/global.css">
  <style>
    .card-resa { max-width: 900px; margin: 24px auto; }
    .status-badge { font-size: 0.95rem; }
    /* FullCalendar visibility tweaks: force readable colors for headers, days and buttons */
    .fc .fc-toolbar-title { color: #2E7D32 !important; font-weight:700; }
    .fc .fc-col-header-cell-cushion { color: #2E7D32 !important; font-weight:600; }
    .fc .fc-daygrid-day-number { color: #2E7D32 !important; font-weight:600; }
    .fc .fc-button-primary { background: #2E7D32 !important; border-color:#2E7D32 !important; color:#fff !important; }
    .fc .fc-button { color: #fff !important; }
    .fc .fc-daygrid-event { background-color: #b30000 !important; color: #fff !important; border: none !important; border-radius:6px !important; }
    .fc .fc-daygrid-day { background: #fff !important; }
  </style>
</head>
<body>
<header>
  <script>
    // Shim to prevent errors when third-party scripts expect `s3gt` global
    window.s3gt = window.s3gt || {};
  </script>

<nav class="navbar navbar-expand-lg fixed-top" style="background-color: rgb(255,255,255); border-bottom: 2px solid #2E7D32;">
  <div class="container-fluid">
    <a class="navbar-brand policeNav" href="/">
      <img src="/Images/Logo_SPleon3.png" alt="Logo" width="70" height="50" class="d-inline-block align-text-top">Amicale des Sapeurs-Pompiers de Léon</a>
      <?php if (!empty($author_name)): ?>
        <span class="navbar-welcome" style="margin-left:90px; font-size:1.1rem; color:#2E7D32; font-weight:bold;">Bienvenue, <?php echo htmlspecialchars($author_name); ?></span>
      <?php endif; ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="#navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?php
      session_start();

      // --- Connexion via helper centralisé ---
      require_once __DIR__ . '/../controleurs/db_mysqli.php';
      if (!$mysqli) die("Échec de la connexion : base de données inaccessible.");
      $conn = $mysqli;

      $user_id = $_SESSION['user_id'] ?? 1;
      $user_nom = $_SESSION['NomInput'] ?? 'Utilisateur';
      $user_email = $_SESSION['EmailInput'] ?? '';
      $message = "";
      ?>

      <!DOCTYPE html>
      <html lang="fr">
      <head>
      <meta charset="UTF-8">
      <title>Réservation VL</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
      <link rel="stylesheet" href="/assets/css/global.css">
      <link rel="stylesheet" href="/assets/css/reservation.css">
      <link rel="stylesheet" href="/scss/main.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css">
      <link href="https://fonts.googleapis.com/css2?family=Emilys+Candy&family=Happy+Monkey&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300;400;500;600;700&display=swap" rel="stylesheet">
      </head>

      <body>
      <header>
      <nav class="navbar navbar-expand-lg fixed-top" style="background-color: rgb(255,255,255); border-bottom: 2px solid #2E7D32;">
        <div class="container-fluid">
          <a class="navbar-brand policeNav" href="/">
            <img src="/Images/Logo_SPleon3.png" alt="Logo" width="70" height="50" class="d-inline-block align-text-top">Amicale des Sapeurs-Pompiers de Léon</a>
            <?php if(isset($_SESSION['PrenomInput'])): ?>
              <span class="navbar-welcome" style="margin-left:90px; font-size:1.1rem; color:#2E7D32; font-weight:bold;">Bienvenue, <?php echo htmlspecialchars($_SESSION['PrenomInput']); ?></span>
            <?php endif; ?>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="#navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link policeNav" href="/">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link policeNav" href="/galerie">Galerie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link policeNav" href="/manifestations">Bal/Vide-grenier</a>
              </li>
              <li class="nav-item">
                <a class="nav-link policeNav" href="/recrutement">Recrutement</a>
              </li>
              <li class="nav-item">
                <a class="nav-link policeNav" href="/infos">Manifestations</a>
              </li>
        
              <li class="nav-item dropdown" data-show="connected">
                <li><a class="nav-link policeDrop" href="/Blog" data-show="actif">SPV</a></li>
                <li><a class="nav-link policeDrop" href="/admin" data-show="admin">Administrateur</a></li>
              </li>
        
              <li class="nav-item" data-show="disconnected">
                <a class="nav-link policeNav" href="/signin">Connexion</a>
              </li>
              <li class="nav-item" data-show="connected">
                <button class="nav-link policeNav" id="btnSignout">Déconnexion</button>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <section class="hero-scene text-center text-white">
          <div class="hero-scene-content"><br><br><br><br>
              <h1 style="color: white;" class="hero-scene-text">Réservation VL</h1>
          </div>        
      </section>

      <nav class="navbar navbar-expand-lg bg-pompier navbar-dark" data-bs-theme="dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="/admin" data-show="admin">Tableau de bord Administrateur</a>
          <a class="navbar-brand" href="/Blog" data-show="actif">Tableau de bord</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
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
                <a class="nav-link" href="/pages/auth/reservation.php">Réservation fendeuse</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/forum/account.php">Mon Compte</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      </header>

      <section class="admin-page">
          <article class="bg-white text-black">
              <div class="container p-4">
                  <div class="page-title-container text-center">
                      <h1 class="page-title"><i class="bi bi-tools me-3"></i>Réservation VL</h1>
                      <div class="page-title-underline"></div>
                  </div>
              </div>
          </article>
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
            <p style="color: #d32f2f;">⚠️ Veuillez saisir manuellement vos dates au format JJ/MM/AAAA.</p>
          </div>
          <div class="mb-3">
            <label for="date_fin" class="form-label">Au :</label>
            <input type="date" id="date_fin" name="date_fin" class="form-control" required>
            <p style="color: #d32f2f;">⚠️ Veuillez saisir manuellement vos dates au format JJ/MM/AAAA.</p>
          </div>
          <p id="montant-total" style="font-weight:bold; color:#2E7D32;">Montant total : 0 €</p>
          <button type="submit" class="btn btn-success w-100">Réserver (15 €/jour)</button>
          <button type="button" id="btnAnnuler" class="btn btn-danger w-100 mt-2">🗑️ Annuler ma réservation</button>
        </form>
      </main>

      <!-- Footer et back to top -->
      <button id="backToTop" aria-label="Retour en haut" title="Retour en haut">↑ Haut</button>
      <footer class="footer">
        <div class="footer-container">
          <div class="footer-col">
            <h3>Nous contacter</h3>
            <p>Adresse M@il : 
              <a class="mail" href="mailto:aspleon40@gmail.com">aspleon40@gmail.com</a>
            </p>
            <div class="social-buttons">
              <button class="facebook" onclick="window.location.href='https://www.facebook.com/csleon.sapeurspompiers';">
                <i class="bi bi-facebook"></i> Facebook
              </button>
              <button class="instagram" onclick="window.location.href='https://www.instagram.com/sapeurs_pompiers_de_leon';">
                <i class="bi bi-instagram"></i> Instagram
              </button>
            </div>
          </div>

          <div class="footer-col">
            <p>
              Centre de secours et d'incendie <br>
              Route de Laguens <br>
              40550 Léon <br>
              Tel Chef de centre : 06.89.76.78.67 <br>
              Tel Président Amicale : 06.14.81.77.03
            </p>
          </div>

          <div class="footer-col">
            <p>Mentions légales</p>
            <a href="/fichiers/mentions_legales_spv.docx" class="btn-mentions">Télécharger ICI</a>
            <p class="copyright">© 2025 Amicale des Sapeurs-Pompiers de Léon<br>Tous droits réservés</p>
          </div>
        </div>

        <div class="signature">
          <p>Site conçu par Bourdeloux Corinne - Web-Crea 2.0 - contactez-moi 
            <a class="mail" href="mailto:w3b.cre4@gmail.com">ICI</a>
          </p>
        </div>
      </footer>  

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
      <script type="module" src="/JS/auth/reservation_vl.js"></script>
      <script type="module" src="/JS/auth/roleManager.js"></script>
      <script type="module" src="/JS/auth/signout.js"></script>
      <script src="/JS/auth/auto_logout_on_close.js"></script>

      <script>
      document.addEventListener('DOMContentLoaded', function() {
        const prixParJour = 15;
        const montantEl = document.getElementById('montant-total');
        const inputDebut = document.getElementById('date_debut');
        const inputFin = document.getElementById('date_fin');

        function parseToDate(value) {
          if (!value) return null;
          if (value.includes('/')) {
            const [d,m,y] = value.split('/');
            return new Date(y, m-1, d);
          }
          return new Date(value);
        }

        function calcNbJours(startDate, endDate) {
          if (!startDate) return 0;
          if (!endDate) endDate = startDate;
          const diff = (endDate - startDate) / (1000*60*60*24);
          return diff >= 0 ? diff+1 : 0;
        }

        function updateMontant() {
          const start = parseToDate(inputDebut.value);
          const end = parseToDate(inputFin.value);
          const nb = calcNbJours(start,end);
          montantEl.textContent = `Montant total : ${nb*prixParJour} €`;
        }

        inputDebut.addEventListener('change', updateMontant);
        inputFin.addEventListener('change', updateMontant);
      });
      </script>

      </body>
      </html>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
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
          <a class="nav-link" href="/pages/auth/reservation.php">Réservation fendeuse</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/forum/account.php">Mon Compte</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</header>

<section class="admin-page">
    <article class="bg-white text-black">
        <div class="container p-4">
            <div class="page-title-container text-center">
                <h1 class="page-title"><i class="bi bi-tools me-3"></i>Réservation VL</h1>
                <div class="page-title-underline"></div>
            </div>
        </div>
    </article>
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
      <p style="color: #d32f2f;">⚠️ Veuillez saisir manuellement vos dates au format JJ/MM/AAAA.</p>
    </div>
    <div class="mb-3">
      <label for="date_fin" class="form-label">Au :</label>
      <input type="date" id="date_fin" name="date_fin" class="form-control" required>
      <p style="color: #d32f2f;">⚠️ Veuillez saisir manuellement vos dates au format JJ/MM/AAAA.</p>
    </div>
    <p id="montant-total" style="font-weight:bold; color:#2E7D32;">Montant total : 0 €</p>
    <button type="submit" class="btn btn-success w-100">Réserver (15 €/jour)</button>
    <button type="button" id="btnAnnuler" class="btn btn-danger w-100 mt-2">🗑️ Annuler ma réservation</button>
  </form>
</main>

<!-- Footer et back to top -->
<button id="backToTop" aria-label="Retour en haut" title="Retour en haut">↑ Haut</button>
<footer class="footer">
  <div class="footer-container">
    <div class="footer-col">
      <h3>Nous contacter</h3>
      <p>Adresse M@il : 
        <a class="mail" href="mailto:aspleon40@gmail.com">aspleon40@gmail.com</a>
      </p>
      <div class="social-buttons">
        <button class="facebook" onclick="window.location.href='https://www.facebook.com/csleon.sapeurspompiers';">
          <i class="bi bi-facebook"></i> Facebook
        </button>
        <button class="instagram" onclick="window.location.href='https://www.instagram.com/sapeurs_pompiers_de_leon';">
          <i class="bi bi-instagram"></i> Instagram
        </button>
      </div>
    </div>

    <div class="footer-col">
      <p>
        Centre de secours et d'incendie <br>
        Route de Laguens <br>
        40550 Léon <br>
        Tel Chef de centre : 06.89.76.78.67 <br>
        Tel Président Amicale : 06.14.81.77.03
      </p>
    </div>

    <div class="footer-col">
      <p>Mentions légales</p>
      <a href="/fichiers/mentions_legales_spv.docx" class="btn-mentions">Télécharger ICI</a>
      <p class="copyright">© 2025 Amicale des Sapeurs-Pompiers de Léon<br>Tous droits réservés</p>
    </div>
  </div>

  <div class="signature">
    <p>Site conçu par Bourdeloux Corinne - Web-Crea 2.0 - contactez-moi 
      <a class="mail" href="mailto:w3b.cre4@gmail.com">ICI</a>
    </p>
  </div>
</footer>  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script type="module" src="/JS/auth/reservation.js"></script>
<script type="module" src="/JS/auth/roleManager.js"></script>
<script type="module" src="/JS/auth/signout.js"></script>
<script src="/JS/auth/auto_logout_on_close.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const prixParJour = 15;
  const montantEl = document.getElementById('montant-total');
  const inputDebut = document.getElementById('date_debut');
  const inputFin = document.getElementById('date_fin');

  function parseToDate(value) {
    if (!value) return null;
    if (value.includes('/')) {
      const [d,m,y] = value.split('/');
      return new Date(y, m-1, d);
    }
    return new Date(value);
  }

  function calcNbJours(startDate, endDate) {
    if (!startDate) return 0;
    if (!endDate) endDate = startDate;
    const diff = (endDate - startDate) / (1000*60*60*24);
    return diff >= 0 ? diff+1 : 0;
  }

  function updateMontant() {
    const start = parseToDate(inputDebut.value);
    const end = parseToDate(inputFin.value);
    const nb = calcNbJours(start,end);
    montantEl.textContent = `Montant total : ${nb*prixParJour} €`;
  }

  inputDebut.addEventListener('change', updateMontant);
  inputFin.addEventListener('change', updateMontant);
});
</script>

</body>
</html>
