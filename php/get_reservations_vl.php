<?php
require_once "connexion.php";

header('Content-Type: application/json');

// Assure la présence de la table adaptée
$create = "CREATE TABLE IF NOT EXISTS reservations_vl (
    id INT AUTO_INCREMENT PRIMARY KEY,
    author_email VARCHAR(255) NOT NULL,
    author_name VARCHAR(255) DEFAULT '',
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);";
$conn->query($create);

$sql = "SELECT id, author_email, author_name, date_debut, date_fin FROM reservations_vl ORDER BY date_debut ASC";
$res = $conn->query($sql);
$events = [];
if ($res) {
    while ($row = $res->fetch_assoc()) {
        $events[] = [
            'id' => $row['id'],
            'title' => $row['author_name'] ?: $row['author_email'],
            'start' => $row['date_debut'],
            'end' => (new DateTime($row['date_fin']))->modify('+1 day')->format('Y-m-d')
        ];
    }
}

echo json_encode($events);
