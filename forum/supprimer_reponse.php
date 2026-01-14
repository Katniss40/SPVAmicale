
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier le rôle administrateur
if (!isset($_SESSION['Role']) || $_SESSION['Role'] !== 'admin') {
    header('HTTP/1.1 403 Forbidden');
    echo 'Accès refusé. Vous devez être administrateur pour supprimer une réponse.';
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: /Blog');
    exit;
}

$id = (int)$_GET['id'];
$id_sujet = isset($_GET['id_sujet_a_lire']) ? (int)$_GET['id_sujet_a_lire'] : null;

// Inclure le helper DB
require __DIR__ . '/../pages/controleurs/db_mysqli.php';
$base = $mysqli;

// Commencer une transaction pour garantir l'intégrité
mysqli_begin_transaction($base);
try {
    // Récupérer la réponse avant suppression
    $id_esc = mysqli_real_escape_string($base, $id);
    $sqlSel = 'SELECT * FROM forum_reponses WHERE id="' . $id_esc . '" LIMIT 1';
    $res = mysqli_query($base, $sqlSel) or throw new Exception('Erreur SQL sélection : '.mysqli_error($base));
    $row = mysqli_fetch_assoc($res);
    mysqli_free_result($res);

    if (!$row) {
        // Rien à supprimer
        mysqli_commit($base);
        mysqli_close($base);
        if ($id_sujet) header('Location: lire_sujet.php?id_sujet_a_lire=' . urlencode($id_sujet));
        else header('Location: /Blog');
        exit;
    }

    // Créer la table de log si elle n'existe pas
    $create = "CREATE TABLE IF NOT EXISTS forum_reponses_supprimees (
        log_id INT AUTO_INCREMENT PRIMARY KEY,
        original_id INT,
        auteur VARCHAR(255),
        message TEXT,
        date_reponse DATETIME,
        correspondance_sujet INT,
        deleted_by VARCHAR(255),
        deleted_at DATETIME
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    mysqli_query($base, $create) or throw new Exception('Erreur création table log : '.mysqli_error($base));

    // Insérer une copie dans la table de log
    $auteur = mysqli_real_escape_string($base, $row['auteur']);
    $message = mysqli_real_escape_string($base, $row['message']);
    $date_reponse = mysqli_real_escape_string($base, $row['date_reponse']);
    $corresp = mysqli_real_escape_string($base, $row['correspondance_sujet'] ?? '');
    $deleted_by = isset($_SESSION['PrenomInput']) ? mysqli_real_escape_string($base, $_SESSION['PrenomInput']) : (isset($_SESSION['EmailInput']) ? mysqli_real_escape_string($base, $_SESSION['EmailInput']) : 'admin');
    $deleted_at = date('Y-m-d H:i:s');

    $ins = "INSERT INTO forum_reponses_supprimees
        (original_id, auteur, message, date_reponse, correspondance_sujet, deleted_by, deleted_at)
        VALUES ('". $id_esc ."', '".$auteur."', '".$message."', '".$date_reponse."', '".$corresp."', '".$deleted_by."', '".$deleted_at."')";
    mysqli_query($base, $ins) or throw new Exception('Erreur insertion log : '.mysqli_error($base));

    // Supprimer la réponse d'origine
    $del = 'DELETE FROM forum_reponses WHERE id="' . $id_esc . '" LIMIT 1';
    mysqli_query($base, $del) or throw new Exception('Erreur suppression : '.mysqli_error($base));

    // Valider la transaction
    mysqli_commit($base);
    mysqli_close($base);

    // Rediriger vers la lecture du sujet
    if ($id_sujet) header('Location: lire_sujet.php?id_sujet_a_lire=' . urlencode($id_sujet));
    else header('Location: /Blog');
    exit;
} catch (Exception $e) {
    mysqli_rollback($base);
    mysqli_close($base);
    // Log minimal côté serveur (ne pas exposer erreur SQL aux utilisateurs)
    error_log('Erreur suppression réponse: ' . $e->getMessage());
    header('Location: /Blog');
    exit;
}

?>
