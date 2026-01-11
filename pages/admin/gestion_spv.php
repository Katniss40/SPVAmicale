<?php

// =====================================
// 🔹 Ca fonctionne, ne plus toucher
// =====================================


// Connexion a la base de données
$servername = 'mysql-pompiers-leon.alwaysdata.net';
$username = '408942';
$password =  '@Admin-2025@';
$dbname = 'pompiers-leon_admin';

// créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if($conn->connect_error) {
    die("erreur de connexion: " .$conn->connect_error);
}

// Récuperer les données du formulaire

$Role = $_POST['Role'];
$CAgent = $_POST['CAgent'];
$NomInput = $_POST['NomInput'];                        
$PrenomInput = $_POST['PrenomInput'];
$Adresse = $_POST['Adresse'];
$Telephone = $_POST['Telephone'];
$EmailInput = $_POST['EmailInput'];                       
$PasswordInput = $_POST['PasswordInput'];


// Vérification si l'email existe déjà
$checkEmail = $conn->prepare("SELECT id FROM Users WHERE EmailInput = ? LIMIT 1");
$checkEmail->bind_param("s", $EmailInput);
$checkEmail->execute();
$checkEmail->store_result();

if ($checkEmail->num_rows > 0) {
    // Email déjà utilisé : message d'erreur stylé
    echo '<!DOCTYPE html><html lang="fr"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Erreur - Email déjà utilisé</title>';
    echo '<style>body{font-family:sans-serif;background:#f8f8f8;margin:0;padding:0;} .error-container{max-width:400px;margin:60px auto;background:#fff;border-radius:8px;box-shadow:0 2px 8px #0001;padding:32px;text-align:center;} .error-title{color:#c00;font-size:1.5em;margin-bottom:12px;} .error-msg{color:#333;margin-bottom:18px;} .btn-retour{display:inline-block;margin-top:10px;padding:8px 18px;background:#c00;color:#fff;text-decoration:none;border-radius:4px;font-weight:bold;transition:background 0.2s;} .btn-retour:hover{background:#900;}</style>';
    echo '</head><body><div class="error-container">';
    echo '<div class="error-title">Adresse email déjà utilisée</div>';
    echo '<div class="error-msg">Un compte existe déjà avec cette adresse email.<br>Veuillez en choisir une autre ou <a href="/pages/admin/admin.php" class="btn-retour">retour</a>.</div>';
    echo '</div></body></html>';
    $checkEmail->close();
    $conn->close();
    exit();
}
$checkEmail->close();

// insère les données dans la base de données
$sql = "INSERT INTO Users(Role, NomInput, PrenomInput, Adresse, CAgent, Telephone, EmailInput, PasswordInput) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $Role, $NomInput, $PrenomInput, $Adresse, $CAgent, $Telephone, $EmailInput, $PasswordInput);

if($stmt->execute()) {
    header('Location: /admin');
    exit();
} else {
    echo '<!DOCTYPE html><html lang="fr"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Erreur - Insertion</title>';
    echo '<style>body{font-family:sans-serif;background:#f8f8f8;margin:0;padding:0;} .error-container{max-width:400px;margin:60px auto;background:#fff;border-radius:8px;box-shadow:0 2px 8px #0001;padding:32px;text-align:center;} .error-title{color:#c00;font-size:1.5em;margin-bottom:12px;} .error-msg{color:#333;margin-bottom:18px;} .btn-retour{display:inline-block;margin-top:10px;padding:8px 18px;background:#c00;color:#fff;text-decoration:none;border-radius:4px;font-weight:bold;transition:background 0.2s;} .btn-retour:hover{background:#900;}</style>';
    echo '</head><body><div class="error-container">';
    echo '<div class="error-title">Erreur lors de l\'ajout</div>';
    echo '<div class="error-msg">Une erreur est survenue lors de l\'ajout de l\'agent.<br>Merci de réessayer.<br><a href="/pages/admin/admin.php" class="btn-retour">Retour</a></div>';
    echo '</div></body></html>';
}
$stmt->close();

// fermer la connexion
$conn->close();
?>

