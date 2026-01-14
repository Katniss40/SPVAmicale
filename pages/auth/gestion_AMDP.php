<?php

// Utiliser le helper mysqli centralisé
require_once __DIR__ . '/../controleurs/db_mysqli.php';
$conn = $mysqli;

// Récuperer les données du formulaire
$Code_Agent = $_POST['CAgent'] ?? '';
$rawPassword = $_POST['PasswordInput'] ?? '';

// Si le champ mot de passe est vide, conserver l'existant
if (empty($rawPassword)) {
    $stmtGet = $conn->prepare("SELECT PasswordInput FROM Users WHERE CAgent = ?");
    $stmtGet->bind_param("s", $Code_Agent);
    $stmtGet->execute();
    $res = $stmtGet->get_result();
    $row = $res->fetch_assoc();
    $PasswordInput = $row['PasswordInput'] ?? '';
    $stmtGet->close();
} else {
    $PasswordInput = $rawPassword; // stocker en clair (rétablissement temporaire)
}

// Mettre à jour le mot de passe (haché)
$stmt = $conn->prepare("UPDATE Users SET PasswordInput = ? WHERE CAgent = ?");
$stmt->bind_param("ss", $PasswordInput, $Code_Agent);

if ($stmt->execute()) {
    header('Location: /forum/account.php?CAgent=' . urlencode($Code_Agent) . '&success=1');
    exit();
} else {
    echo "Erreur : " . htmlspecialchars($stmt->error);
}

// fermer la connexion
$conn->close();

?>

