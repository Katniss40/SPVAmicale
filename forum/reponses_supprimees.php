<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// Vérifier rôle admin
if (!isset($_SESSION['Role']) || $_SESSION['Role'] !== 'admin') {
    header('HTTP/1.1 403 Forbidden');
    echo 'Accès refusé.';
    exit;
}

require __DIR__ . '/../pages/controleurs/db_mysqli.php';
$base = $mysqli;

$sql = 'SELECT log_id, original_id, auteur, message, date_reponse, correspondance_sujet, deleted_by, deleted_at FROM forum_reponses_supprimees ORDER BY deleted_at DESC';
$res = mysqli_query($base, $sql) or die('Erreur SQL : '.mysqli_error($base));

?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Historique suppressions - Forum</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1>Historique des réponses supprimées</h1>
      <a class="btn btn-primary" href="/admin">Retour admin</a>
    </div>
    <p>Actions disponibles : restaurer la réponse ou la supprimer définitivement.</p>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Auteur</th>
          <th>Message</th>
          <th>Sujet</th>
          <th>Supprimé par</th>
          <th>Supprimé le</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
<?php
while ($row = mysqli_fetch_assoc($res)) {
    $log_id = (int)$row['log_id'];
    $orig = htmlentities($row['original_id']);
    $auteur = htmlentities($row['auteur']);
    $message = htmlentities($row['message']);
    $snippet = mb_strlen($message) > 200 ? mb_substr($message,0,200) . '...' : $message;
    $sujet = htmlentities($row['correspondance_sujet']);
    $deleted_by = htmlentities($row['deleted_by']);
    $deleted_at = htmlentities($row['deleted_at']);
    echo '<tr>';
    echo '<td>' . $log_id . '</td>';
    echo '<td>' . $auteur . '</td>';
    echo '<td><div style="max-width:420px; overflow:hidden;">' . nl2br($snippet) . '</div></td>';
    echo '<td>' . $sujet . '</td>';
    echo '<td>' . $deleted_by . '</td>';
    echo '<td>' . $deleted_at . '</td>';
    echo '<td>';
    echo '<a class="btn btn-sm btn-success me-1" href="restaure_reponse.php?log_id=' . $log_id . '" onclick="return confirm(\'Restaurer cette réponse ?\')">Restaurer</a>';
    echo '<a class="btn btn-sm btn-danger" href="restaure_reponse.php?log_id=' . $log_id . '&action=delete" onclick="return confirm(\'Supprimer définitivement ce log ?\')">Supprimer définitivement</a>';
    echo '</td>';
    echo '</tr>';
}
mysqli_free_result($res);
mysqli_close($base);
?>
      </tbody>
    </table>
    <a class="btn btn-secondary" href="/admin">Retour admin</a>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
