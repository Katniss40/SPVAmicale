<?php
require_once "connexion.php"; // ta connexion à la BDD

// Lire les données JSON envoyées
$data = json_decode(file_get_contents("php://input"), true);

$response = ['success' => false, 'message' => 'Erreur inconnue.'];

if ($data) {
    $nom = trim($data['nom_reservant'] ?? '');
    $debut = $data['date_debut'] ?? '';
    $fin = $data['date_fin'] ?? '';

    if (!$nom || !$debut || !$fin) {
        $response['message'] = 'Veuillez remplir tous les champs.';
    } else {
        // Calcul du nombre de jours inclusifs
        $startDate = new DateTime($debut);
        $endDate = new DateTime($fin);
        if ($endDate < $startDate) {
            $response['message'] = 'La date de fin doit être après la date de début.';
        } else {
            $diff = $startDate->diff($endDate)->days + 1;
            $prix_total = $diff * 15; // 15 €/jour

            // Insertion
            // Si on a l'id utilisateur, l'insérer, sinon faire un insert sans user_id
            $user_id = null; // si tu veux récupérer l'id connecté, à adapter (ex: $_SESSION['UserId'])
            if ($user_id === null) {
                $stmt = $conn->prepare("INSERT INTO reservations (nom_reservant, date_debut, date_fin, prix_total) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("sssd", $nom, $debut, $fin, $prix_total);
            } else {
                $stmt = $conn->prepare("INSERT INTO reservations (user_id, nom_reservant, date_debut, date_fin, prix_total) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("isssd", $user_id, $nom, $debut, $fin, $prix_total);
            }

            if ($stmt && $stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "Réservation ajoutée avec succès !";

            // --- ENVOI DE MAIL À L'ADMIN ---
                $admin_email = "aspleon40@gmail.com";
                $subject = "Nouvelle réservation fendeuse";
                $message_mail = "Bonjour,\n\nUne nouvelle réservation a été effectuée :\n\n" .
                                "Nom : $nom\n" .
                                "Du : $debut\n" .
                                "Au : $fin\n" .
                                "Montant : $prix_total €\n\nMerci.";
                $headers = "From: noreply@pompiers-leon.fr\r\n" .
                           "Reply-To: noreply@pompiers-leon.fr\r\n" .
                           "X-Mailer: PHP/" . phpversion();

                mail($admin_email, $subject, $message_mail, $headers);

            } else {
                $response['message'] = "Erreur lors de l'ajout : " . $stmt->error;
            }
        }
    }
}

header('Content-Type: application/json');
echo json_encode($response);