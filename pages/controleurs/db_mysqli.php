<?php
// Helper mysqli centralisé. Utiliser `config.php` (non versionné) ou variables d'environnement.

$repoRoot = realpath(__DIR__ . '/..' . '/..');
// Charger config local si présent
if (file_exists(__DIR__ . '/config.php')) {
    require_once __DIR__ . '/config.php';
}

$dbHost = getenv('DB_HOST') ?: (defined('DB_HOST') ? DB_HOST : '');
$dbName = getenv('DB_NAME') ?: (defined('DB_NAME') ? DB_NAME : '');
$dbUser = getenv('DB_USER') ?: (defined('DB_USER') ? DB_USER : '');
$dbPass = getenv('DB_PASS') ?: (defined('DB_PASS') ? DB_PASS : '');

// Si aucune config fournie, lever une erreur claire
if (empty($dbHost) || empty($dbUser)) {
    // Ne pas exposer le mot de passe dans l'erreur
    throw new \RuntimeException('Configuration de la base de données introuvable. Créez pages/controleurs/config.php ou définissez les variables d\'environnement DB_*');
}

$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    throw new \RuntimeException('Erreur connexion MySQL: ' . $mysqli->connect_error);
}

$mysqli->set_charset('utf8mb4');

?>
