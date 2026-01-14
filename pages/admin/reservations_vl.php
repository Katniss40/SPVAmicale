<?php
session_start();
if (!isset($_SESSION['EmailInput']) || ($_SESSION['Role'] ?? '') !== 'admin') {
    header('Location: /signin');
    exit;
}

require_once __DIR__ . '/../controleurs/db_mysqli.php';
$conn = $mysqli;

// Créer la table si besoin
$createSql = "CREATE TABLE IF NOT EXISTS reservations_vl (
    id INT AUTO_INCREMENT PRIMARY KEY,
    author_email VARCHAR(255) NOT NULL,
    author_name VARCHAR(255) DEFAULT '',
    reserved_at DATETIME NOT NULL
);";
$conn->query($createSql);

// Récupérer l'historique
$res = $conn->query("SELECT id, author_email, author_name, reserved_at FROM reservations_vl ORDER BY reserved_at DESC");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Historique réservations VL</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/global.css">
</head>
<body>
<main class="container py-4">
  <div class="card">
    <div class="card-body">
      <h3>Historique des réservations VL</h3>
      <p class="text-muted">Liste complète (triée par date décroissante).</p>

      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Auteur</th>
              <th>Nom</th>
              <th>Date / Heure</th>
            </tr>
          </thead>
          <tbody>
          <?php if ($res && $res->num_rows > 0): while ($row = $res->fetch_assoc()): ?>
            <tr>
              <td><?php echo htmlspecialchars($row['id']); ?></td>
              <td><?php echo htmlspecialchars($row['author_email']); ?></td>
              <td><?php echo htmlspecialchars($row['author_name']); ?></td>
              <td><?php echo htmlspecialchars($row['reserved_at']); ?></td>
            </tr>
          <?php endwhile; else: ?>
            <tr><td colspan="4" class="text-center text-muted">Aucune réservation trouvée.</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>

      <a href="/admin" class="btn btn-secondary">Retour admin</a>
    </div>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
