<?php
// test de connexion

//session_start();

// Charger config local si présent (fichier non versionné)
if (file_exists(__DIR__ . '/config.php')) {
  require_once __DIR__ . '/config.php';
}

$host = getenv('DB_HOST') ?: (defined('DB_HOST') ? DB_HOST : '');
$db = getenv('DB_NAME') ?: (defined('DB_NAME') ? DB_NAME : '');
$user = getenv('DB_USER') ?: (defined('DB_USER') ? DB_USER : '');
$pass = getenv('DB_PASS') ?: (defined('DB_PASS') ? DB_PASS : '');
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$option= [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false
];

try {
  $pdo = new PDO($dsn, $user, $pass, $option);
  // Ne pas afficher d'informations sensibles en production
}
catch (\PDOException $e) {
  throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

?>