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
  <link rel="stylesheet" href="/assets/css/global.css">
  <style>
    .card-resa { max-width: 900px; margin: 24px auto; }
    .status-badge { font-size: 0.95rem; }
  </style>
</head>
<body>
<header>

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
</header>

<section>
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
                <h1 class="page-title"><i class="bi bi-person-badge me-3"></i>📅 Réservation de la VL</h1>
                <div class="page-title-underline"></div>
            </div>
        </div>
    </article>

</section>


<main class="resa-container" style="padding-top:100px;">
 
  <div id="calendar"></div>

  <form id="formResa">
    <div class="mb-3">
      <label for="nom_reservant" class="form-label">Votre nom :</label>
      <input type="text" id="nom_reservant" name="nom_reservant" class="form-control" placeholder="Votre nom" value="<?php echo htmlspecialchars($author_name); ?>" required>
    </div>
    <div class="mb-3">
      <label for="date_debut" class="form-label">Du :</label>
      <input type="date" id="date_debut" name="date_debut" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="date_fin" class="form-label">Au :</label>
      <input type="date" id="date_fin" name="date_fin" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success w-100">Réserver</button>
    <button type="button" id="btnAnnuler" class="btn btn-danger w-100 mt-2">🗑️ Annuler ma réservation</button>
  </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script type="module" src="/JS/auth/reservation_vl.js"></script>
</body>
</html>
