<?php

// =====================================
// 🔹 Ca fonctionne, ne plus toucher
// =====================================


// Utiliser le helper mysqli centralisé
require_once __DIR__ . '/../controleurs/db_mysqli.php';
$conn = $mysqli;

// Récuperer les données du formulaire
$ID = (int)($_POST['ID'] ?? 0);
$CAgent = $_POST['CAgent'] ?? '';
$Role = $_POST['Role'] ?? '';
$NomInput = $_POST['NomInput'] ?? '';
$PrenomInput = $_POST['PrenomInput'] ?? '';
$Adresse = $_POST['Adresse'] ?? '';
$Telephone = $_POST['Telephone'] ?? '';
$EmailInput = $_POST['EmailInput'] ?? '';
$rawPassword = $_POST['PasswordInput'] ?? '';
$PasswordInput = $rawPassword; // stocker en clair (rétablissement temporaire)

// Utiliser une requête préparée pour éviter les injections
$stmt = $conn->prepare("UPDATE Users SET Role = ?, CAgent = ?, NomInput = ?, PrenomInput = ?, Adresse = ?, Telephone = ?, EmailInput = ?, PasswordInput = ? WHERE ID = ?");
$stmt->bind_param("ssssssssi", $Role, $CAgent, $NomInput, $PrenomInput, $Adresse, $Telephone, $EmailInput, $PasswordInput, $ID);

if ($stmt->execute()) {
    header('Location: /admin');
    exit();
} else {
    echo "Erreur : " . htmlspecialchars($stmt->error);
}

// fermer la connexion
$conn->close();

?>
