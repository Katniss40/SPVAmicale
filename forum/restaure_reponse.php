<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// Vérifier rôle admin
if (!isset($_SESSION['Role']) || $_SESSION['Role'] !== 'admin') {
    header('HTTP/1.1 403 Forbidden');
    echo 'Accès refusé.';
    exit;
}

if (!isset($_GET['log_id']) || !is_numeric($_GET['log_id'])) {
    header('Location: reponses_supprimees.php');
    exit;
}

$log_id = (int)$_GET['log_id'];
$action = isset($_GET['action']) ? $_GET['action'] : 'restore';

require __DIR__ . '/../pages/controleurs/db_mysqli.php';
$base = $mysqli;

mysqli_begin_transaction($base);
try {
    $log_esc = mysqli_real_escape_string($base, $log_id);
    $sel = 'SELECT * FROM forum_reponses_supprimees WHERE log_id="' . $log_esc . '" LIMIT 1';
    $r = mysqli_query($base, $sel) or throw new Exception('Erreur SQL: '.mysqli_error($base));
    $row = mysqli_fetch_assoc($r);
    mysqli_free_result($r);

    if (!$row) {
        mysqli_commit($base);
        mysqli_close($base);
        header('Location: reponses_supprimees.php');
        exit;
    }

    if ($action === 'delete') {
        $del = 'DELETE FROM forum_reponses_supprimees WHERE log_id="' . $log_esc . '" LIMIT 1';
        mysqli_query($base, $del) or throw new Exception('Erreur suppression log: '.mysqli_error($base));
        mysqli_commit($base);
        mysqli_close($base);
        header('Location: reponses_supprimees.php');
        exit;
    }

    // Restaurer : insérer dans forum_reponses
    $auteur = mysqli_real_escape_string($base, $row['auteur']);
    $message = mysqli_real_escape_string($base, $row['message']);
    $date_reponse = mysqli_real_escape_string($base, $row['date_reponse']);
    $corresp = mysqli_real_escape_string($base, $row['correspondance_sujet']);

    $ins = 'INSERT INTO forum_reponses VALUES ("", "' . $auteur . '", "' . $message . '", "' . $date_reponse . '", "' . $corresp . '")';
    mysqli_query($base, $ins) or throw new Exception('Erreur insertion restauration: '.mysqli_error($base));

    // Mettre à jour la date_derniere_reponse du sujet
    $now = date('Y-m-d H:i:s');
    $upd = 'UPDATE forum_sujets SET date_derniere_reponse="' . $now . '" WHERE id="' . $corresp . '"';
    mysqli_query($base, $upd) or throw new Exception('Erreur update sujet: '.mysqli_error($base));

    // Supprimer l'entrée du log
    $delLog = 'DELETE FROM forum_reponses_supprimees WHERE log_id="' . $log_esc . '" LIMIT 1';
    mysqli_query($base, $delLog) or throw new Exception('Erreur suppression log après restore: '.mysqli_error($base));

    mysqli_commit($base);
    mysqli_close($base);

    header('Location: reponses_supprimees.php');
    exit;
} catch (Exception $e) {
    mysqli_rollback($base);
    mysqli_close($base);
    error_log('Erreur restauration réponse: ' . $e->getMessage());
    header('Location: reponses_supprimees.php');
    exit;
}

?>
