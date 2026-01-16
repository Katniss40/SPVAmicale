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
$author_name = $_SESSION['PrenomInput'] ?? '';

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
<?php include __DIR__ . '/../..//pages/controleurs/nav_stub.php' ?? ''; ?>
<?php include __DIR__ . '/../controleurs/nav_stub.php'; ?>
  <div class="card card-resa shadow-sm">
    <div class="card-body">
      <h3 class="card-title">Réservation du véhicule VL</h3>
      <p class="text-muted">Page réservée aux membres connectés. Vous pouvez réserver le véhicule si personne ne l'a déjà pris. Vous seul(e) pouvez annuler votre réservation.</p>

      <div class="row">
        <div class="col-md-8">
          <?php if ($reservation): ?>
            <div class="mb-3">
              <p><strong>Statut :</strong> <span class="badge bg-danger status-badge">Réservé</span></p>
              <p><strong>Réservé par :</strong> <?php echo htmlspecialchars($reservation['author_name'] ?: $reservation['author_email']); ?></p>
              <p><strong>Depuis :</strong> <?php echo htmlspecialchars($reservation['reserved_at']); ?></p>
            </div>
          <?php else: ?>
            <div class="mb-3">
              <p><strong>Statut :</strong> <span class="badge bg-success status-badge">Disponible</span></p>
              <p>Le véhicule est actuellement disponible.</p>
            </div>
          <?php endif; ?>
        </div>

        <div class="col-md-4 text-md-end">
          <?php if (!$reservation): ?>
            <form method="post">
              <input type="hidden" name="action" value="reserve">
              <button type="submit" class="btn btn-primary">Réserver le VL</button>
            </form>
          <?php elseif ($reservation['author_email'] === $author_email): ?>
            <form method="post">
              <input type="hidden" name="action" value="cancel">
              <button type="submit" class="btn btn-warning">Annuler ma réservation</button>
            </form>
          <?php else: ?>
            <button class="btn btn-secondary" disabled>Réservé par un autre membre</button>
          <?php endif; ?>
        </div>
      </div>

      <hr>
      <a href="/forum/account.php" class="btn btn-link">Retour à mon compte</a>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
