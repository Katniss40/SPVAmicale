<?php
header('Content-Type: application/json; charset=utf-8');

$dataFile = __DIR__ . '/../data/dates.json';
if (!file_exists($dataFile)) {
    echo json_encode(new stdClass());
    exit;
}

$raw = file_get_contents($dataFile);
$all = json_decode($raw, true) ?: [];

$page = $_GET['page'] ?? null;
if ($page) {
    $out = $all[$page] ?? new stdClass();
    echo json_encode($out);
} else {
    echo json_encode($all);
}

exit;

?>
