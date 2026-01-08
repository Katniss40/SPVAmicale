<?php
require_once "connexion.php";

header('Content-Type: application/json');

// Récupération des réservations valides (tu peux ajouter un filtre si tu veux uniquement certaines)
$sql = "SELECT id, nom_reservant, date_debut, date_fin FROM reservations ORDER BY date_debut ASC";
$result = $conn->query($sql);

$events = [];

while ($row = $result->fetch_assoc()) {
    $events[] = [
        'id' => $row['id'],
        'title' => $row['nom_reservant'],
        'start' => $row['date_debut'],
        'end' => (new DateTime($row['date_fin']))->modify('+1 day')->format('Y-m-d') // end exclusif FullCalendar
    ];
}

echo json_encode($events);