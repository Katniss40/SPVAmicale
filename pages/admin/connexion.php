<?php
// Utiliser le helper centralisé — inclure à chaque fois pour recréer la connexion si nécessaire
require __DIR__ . '/../controleurs/db_mysqli.php';
$conn = $mysqli;

if (!$conn) {
    die('Erreur de connexion à la base de données.');
}

?>