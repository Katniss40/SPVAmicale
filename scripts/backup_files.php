<?php
// Usage: php scripts/backup_files.php path/to/file1 path/to/file2 ...
// Copies each provided file into backups/YYYYMMDD_HHMMSS/<original-path>

if (php_sapi_name() !== 'cli') {
    echo "Run from CLI: php scripts/backup_files.php file1 file2\n";
    exit(1);
}

date_default_timezone_set('Europe/Paris');
$timestamp = date('Ymd_His');
$repoRoot = realpath(__DIR__ . '/..');
$backupRoot = $repoRoot . DIRECTORY_SEPARATOR . 'backups' . DIRECTORY_SEPARATOR . $timestamp;

if (!is_dir($backupRoot) && !mkdir($backupRoot, 0777, true)) {
    fwrite(STDERR, "Erreur : impossible de créer le dossier de sauvegarde $backupRoot\n");
    exit(1);
}

$files = array_slice($argv, 1);
if (empty($files)) {
    echo "Aucun fichier fourni. Usage: php scripts/backup_files.php file1 file2 ...\n";
    exit(0);
}

foreach ($files as $file) {
    $path = $repoRoot . DIRECTORY_SEPARATOR . ltrim($file, "\\/ ");
    $real = realpath($path);
    if ($real === false || !is_file($real)) {
        echo "Skip (introuvable): $file\n";
        continue;
    }

    $rel = substr($real, strlen($repoRoot) + 1);
    $dest = $backupRoot . DIRECTORY_SEPARATOR . str_replace(array('/','\\'), DIRECTORY_SEPARATOR, $rel);
    $destDir = dirname($dest);
    if (!is_dir($destDir) && !mkdir($destDir, 0777, true)) {
        echo "Erreur: impossible de créer $destDir\n";
        continue;
    }

    if (!copy($real, $dest)) {
        echo "Échec copie: $file\n";
    } else {
        echo "Sauvegardé: $file -> " . substr($dest, strlen($repoRoot) + 1) . "\n";
    }
}

echo "Terminé. Dossier de sauvegarde: backups/$timestamp\n";
