<?php
session_start();
require_once "connexion.php";

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
$resp = ['success' => false, 'message' => 'Erreur inconnue.'];

if (!$data) {
    $resp['message'] = 'Données manquantes.';
    echo json_encode($resp);
    exit;
}

$start = $data['date_debut'] ?? '';
$end = $data['date_fin'] ?? $start;
$author_email = $_SESSION['EmailInput'] ?? '';
$author_name = $_SESSION['PrenomInput'] ?? ($_SESSION['NomInput'] ?? $author_email);

if (!$author_email || !$start || !$end) {
    $resp['message'] = 'Paramètres invalides ou non connecté.';
    echo json_encode($resp);
    exit;
}

// Normalize dates
try {
    $d1 = new DateTime($start);
    $d2 = new DateTime($end);
} catch (Exception $e) {
    $resp['message'] = 'Format de date invalide.';
    echo json_encode($resp);
    exit;
}
if ($d2 < $d1) { $tmp = $d1; $d1 = $d2; $d2 = $tmp; }
$s = $d1->format('Y-m-d');
$e = $d2->format('Y-m-d');

// Create table if missing
$create = "CREATE TABLE IF NOT EXISTS reservations_vl (
    id INT AUTO_INCREMENT PRIMARY KEY,
    author_email VARCHAR(255) NOT NULL,
    author_name VARCHAR(255) DEFAULT '',
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);";
$conn->query($create);

// Check conflicts: overlapping ranges
$stmt = $conn->prepare("SELECT COUNT(*) as cnt FROM reservations_vl WHERE NOT (date_fin < ? OR date_debut > ?)");
$stmt->bind_param('ss', $s, $e);
$stmt->execute();
$res = $stmt->get_result()->fetch_assoc();
if ($res && intval($res['cnt']) > 0) {
    $resp['message'] = 'Conflit : plage déjà réservée.';
    echo json_encode($resp);
    exit;
}
$stmt->close();

$ins = $conn->prepare("INSERT INTO reservations_vl (author_email, author_name, date_debut, date_fin) VALUES (?, ?, ?, ?)");
$ins->bind_param('ssss', $author_email, $author_name, $s, $e);
if ($ins->execute()) {
    $resp['success'] = true;
    $resp['message'] = 'Réservation VL enregistrée.';
} else {
    $resp['message'] = 'Erreur en enregistrant : ' . $ins->error;
}
echo json_encode($resp);
