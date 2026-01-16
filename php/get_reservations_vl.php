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

$events = [];
// detect schema: prefer date_debut/date_fin, else fallback to reserved_at
$col = $conn->query("SHOW COLUMNS FROM reservations_vl LIKE 'date_debut'");
$has_date_debut = ($col && $col->num_rows > 0);
$col2 = $conn->query("SHOW COLUMNS FROM reservations_vl LIKE 'date_fin'");
$has_date_fin = ($col2 && $col2->num_rows > 0);
$col_old = $conn->query("SHOW COLUMNS FROM reservations_vl LIKE 'reserved_at'");
$has_reserved_at = ($col_old && $col_old->num_rows > 0);

if ($has_date_debut && $has_date_fin) {
    $sql = "SELECT id, author_email, author_name, date_debut, date_fin FROM reservations_vl ORDER BY date_debut ASC";
    $res = $conn->query($sql);
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
} elseif ($has_reserved_at) {
    $sql = "SELECT id, author_email, author_name, reserved_at FROM reservations_vl ORDER BY reserved_at ASC";
    $res = $conn->query($sql);
    if ($res) {
        while ($row = $res->fetch_assoc()) {
            $d = (new DateTime($row['reserved_at']))->format('Y-m-d');
            $events[] = [
                'id' => $row['id'],
                'title' => $row['author_name'] ?: $row['author_email'],
                'start' => $d,
                'end' => (new DateTime($d))->modify('+1 day')->format('Y-m-d')
            ];
        }
    }
}

echo json_encode($events);
