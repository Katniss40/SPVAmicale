<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

// Vérifier que l'utilisateur est admin
if (!isset($_SESSION['Role']) || $_SESSION['Role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Accès refusé']);
    exit;
}

$body = json_decode(file_get_contents('php://input'), true);
$page = $body['page'] ?? null;
$key = $body['key'] ?? null;
$value = $body['value'] ?? null;

if (!$page || !$key || $value === null) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Paramètres manquants']);
    exit;
}

$dataFile = __DIR__ . '/../data/dates.json';
if (!file_exists($dataFile)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Fichier de données introuvable']);
    exit;
}

$raw = file_get_contents($dataFile);
$all = json_decode($raw, true);
if (!is_array($all)) $all = [];

// sécurité : n'autoriser que la mise à jour d'une clé existante
if (!isset($all[$page]) || !array_key_exists($key, $all[$page])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Clé invalide']);
    exit;
}

$all[$page][$key] = $value;

// write with lock
$tmp = json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
if (file_put_contents($dataFile, $tmp, LOCK_EX) === false) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Impossible d\'écrire le fichier']);
    exit;
}

echo json_encode(['success' => true]);
exit;
?>
