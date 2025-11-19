<?php
require_once "connexion.php";

$data = json_decode(file_get_contents("php://input"), true);
$response = ['success' => false, 'message' => 'Erreur inconnue.'];

if ($data) {
    $id = $data['id'] ?? null;
    $debut = $data['date_debut'] ?? null;
    $fin = $data['date_fin'] ?? null;

    if (!$id || !$debut || !$fin) {
        $response['message'] = "Veuillez fournir l'id et les nouvelles dates.";
    } else {
        $startDate = new DateTime($debut);
        $endDate = new DateTime($fin);
        if ($endDate < $startDate) {
            $response['message'] = "La date de fin doit être après la date de début.";
        } else {
            $diff = $startDate->diff($endDate)->days + 1;
            $prix_total = $diff * 15;

            $stmt = $conn->prepare("UPDATE reservations SET date_debut = ?, date_fin = ?, prix_total = ? WHERE id = ?");
            $stmt->bind_param("ssdi", $debut, $fin, $prix_total, $id);

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "Réservation mise à jour avec succès !";
            } else {
                $response['message'] = "Erreur : " . $stmt->error;
            }
        }
    }
}

header('Content-Type: application/json');
echo json_encode($response);