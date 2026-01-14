<?php
// Helper de compatibilité : utilise le helper centralisé si disponible
require_once __DIR__ . '/../pages/controleurs/db_mysqli.php';
$conn = $mysqli;

if (!$conn) {
    die('Erreur de connexion à la base de données.');
}

?>