<?php
require_once "connexion.php";

$data = json_decode(file_get_contents("php://input"), true);
$response = ['success' => false, 'message' => 'Erreur inconnue.'];

if ($data) {
    // soit on reçoit l'id de la réservation
    if (isset($data['id'])) {
        $stmt = $conn->prepare("DELETE FROM reservations WHERE id = ?");
        $stmt->bind_param("i", $data['id']);
    }
    // ou date de début (utile si suppression via formulaire)
    elseif (isset($data['date'])) {
        $date = $data['date'];
        $stmt = $conn->prepare("DELETE FROM reservations WHERE date_debut = ?");
        $stmt->bind_param("s", $date);
    } else {
        $stmt = null;
        $response['message'] = "Aucune information pour supprimer.";
    }

    if ($stmt && $stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Réservation supprimée avec succès.";

    // --- ENVOI DE MAIL À L'ADMIN ---
    $admin_email = "aspleon40@gmail.com";
    $subject = "Annulation de réservation fendeuse";
    $message_mail = "Bonjour,\n\nUne réservation a été annulée :\n\n" .
                    "Nom : $nom\n" .
                    "Du : $debut\n" .
                    "Au : $fin\n\nMerci.";
    $headers = "From: noreply@pompiers-leon.fr\r\n" .
               "Reply-To: noreply@pompiers-leon.fr\r\n" .
               "X-Mailer: PHP/" . phpversion();

    mail($admin_email, $subject, $message_mail, $headers);

    } elseif ($stmt) {
        $response['message'] = "Erreur : " . $stmt->error;
    }
}

header('Content-Type: application/json');
echo json_encode($response);
