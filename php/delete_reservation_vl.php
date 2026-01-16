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

$author_email = $_SESSION['EmailInput'] ?? '';
$is_admin = (isset($_SESSION['Role']) && $_SESSION['Role'] === 'admin');

$date = $data['date_debut'] ?? null;
$id = $data['id'] ?? null;

// detect schema
$col = $conn->query("SHOW COLUMNS FROM reservations_vl LIKE 'date_debut'");
$has_date_debut = ($col && $col->num_rows > 0);
$col2 = $conn->query("SHOW COLUMNS FROM reservations_vl LIKE 'date_fin'");
$has_date_fin = ($col2 && $col2->num_rows > 0);

if ($id) {
    // Delete by id if admin or owner
    if (!$is_admin) {
        // check owner
        $stmt = $conn->prepare("SELECT author_email FROM reservations_vl WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $r = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if (!$r || $r['author_email'] !== $author_email) {
            $resp['message'] = 'Non autorisé.';
            echo json_encode($resp);
            exit;
        }
    }
    $del = $conn->prepare("DELETE FROM reservations_vl WHERE id = ? LIMIT 1");
    $del->bind_param('i', $id);
    $del->execute();
    $resp['success'] = true; $resp['message'] = 'Réservation supprimée.';
    echo json_encode($resp);
    exit;
}

if ($date) {
    // delete reservations that include this date and belong to user (or admin)
    $d = $date;
    if ($has_date_debut && $has_date_fin) {
        if ($is_admin) {
            $del = $conn->prepare("DELETE FROM reservations_vl WHERE date_debut <= ? AND date_fin >= ?");
            $del->bind_param('ss', $d, $d);
        } else {
            $del = $conn->prepare("DELETE FROM reservations_vl WHERE date_debut <= ? AND date_fin >= ? AND author_email = ?");
            $del->bind_param('sss', $d, $d, $author_email);
        }
    } else {
        // fallback to single-date schema using reserved_at
        if ($is_admin) {
            $del = $conn->prepare("DELETE FROM reservations_vl WHERE DATE(reserved_at) = ?");
            $del->bind_param('s', $d);
        } else {
            $del = $conn->prepare("DELETE FROM reservations_vl WHERE DATE(reserved_at) = ? AND author_email = ?");
            $del->bind_param('ss', $d, $author_email);
        }
    }
    if ($del->execute()) {
        $resp['success'] = true; $resp['message'] = 'Réservation annulée.';
    } else {
        $resp['message'] = 'Erreur suppression.';
    }
    echo json_encode($resp);
    exit;
}

$resp['message'] = 'Paramètres incorrects.';
echo json_encode($resp);
