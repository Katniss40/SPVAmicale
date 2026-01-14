<?php
// Utiliser le helper centralisé
require_once __DIR__ . '/../controleurs/db_mysqli.php';
$conn = $mysqli;

if (!$conn) {
    die('Erreur de connexion à la base de données.');
}

?>