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
echo "Connexion réussi!";

// Récuperer les données du formulaire


$ID = $_POST['ID'];
$NomInput = null; // non utilisé
$PrenomInput = null; // non utilisé

// Vérifier si l'utilisateur à supprimer est admin ou le compte test
$sql_check = "SELECT Role, NomInput FROM Users WHERE ID = '$ID'";
$result_check = $conn->query($sql_check);
$isAdmin = false;
$isTest = false;
if ($result_check && $row = $result_check->fetch_assoc()) {
    $isAdmin = ($row['Role'] === 'admin');
    $isTest = (strtolower(trim($row['NomInput'])) === 'test');
}

// Compter le nombre d'admins restants
$sql_count = "SELECT COUNT(*) as nb FROM Users WHERE Role = 'admin'";
$result_count = $conn->query($sql_count);
$nbAdmins = 0;
if ($result_count && $row = $result_count->fetch_assoc()) {
    $nbAdmins = (int)$row['nb'];
}

if ($isTest) {
    // Affichage d'une page d'erreur stylée pour le compte test
    echo "<!DOCTYPE html>\n<html lang='fr'>\n<head>\n<meta charset='UTF-8'>\n<meta name='viewport' content='width=device-width, initial-scale=1.0'>\n<title>Suppression impossible</title>\n<link rel='stylesheet' href='/assets/css/admin-custom.css'>\n<style>\n.body-error-admin { min-height: 100vh; display: flex; flex-direction: column; justify-content: center; align-items: center; background: #f5e6cc; }\n.card-error-admin { background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.12); padding: 2.5em 2em; max-width: 400px; text-align: center; }\n.card-error-admin h1 { color: #b30000; font-size: 2rem; margin-bottom: 1em; }\n.card-error-admin p { color: #333; font-size: 1.1rem; margin-bottom: 2em; }\n.card-error-admin .btn { background: #2E7D32; color: #fff; border: none; border-radius: 6px; padding: 0.7em 2em; font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: background 0.2s; }\n.card-error-admin .btn:hover { background: #1B5E20; }\n</style>\n</head>\n<body class='body-error-admin'>\n  <div class='card-error-admin'>\n    <h1>Suppression impossible</h1>\n    <p>La suppression de l’utilisateur <b>TEST</b> est impossible.<br>Ce compte est réservé à la maintenance et à la récupération d’accès administrateur.<br>Merci de conserver ce compte pour la sécurité du site.</p>\n    <button class='btn' onclick=\"window.location.href='/admin'\">Retour au tableau de bord</button>\n  </div>\n  <script>setTimeout(function(){ window.location.href='/admin'; }, 6000);</script>\n</body>\n</html>";
    $conn->close();
    exit();
}
if ($isAdmin && $nbAdmins <= 1) {
    // Affichage d'une page d'erreur stylée
    echo "<!DOCTYPE html>\n<html lang='fr'>\n<head>\n<meta charset='UTF-8'>\n<meta name='viewport' content='width=device-width, initial-scale=1.0'>\n<title>Suppression impossible</title>\n<link rel='stylesheet' href='/assets/css/admin-custom.css'>\n<style>\n.body-error-admin { min-height: 100vh; display: flex; flex-direction: column; justify-content: center; align-items: center; background: #f5e6cc; }\n.card-error-admin { background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.12); padding: 2.5em 2em; max-width: 400px; text-align: center; }\n.card-error-admin h1 { color: #b30000; font-size: 2rem; margin-bottom: 1em; }\n.card-error-admin p { color: #333; font-size: 1.1rem; margin-bottom: 2em; }\n.card-error-admin .btn { background: #2E7D32; color: #fff; border: none; border-radius: 6px; padding: 0.7em 2em; font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: background 0.2s; }\n.card-error-admin .btn:hover { background: #1B5E20; }\n</style>\n</head>\n<body class='body-error-admin'>\n  <div class='card-error-admin'>\n    <h1>Suppression impossible</h1>\n    <p>Il doit rester au moins <b>un administrateur</b> sur le site.<br>Ajoutez un autre admin avant de supprimer celui-ci.</p>\n    <button class='btn' onclick=\"window.location.href='/admin'\">Retour au tableau de bord</button>\n  </div>\n  <script>setTimeout(function(){ window.location.href='/admin'; }, 6000);</script>\n</body>\n</html>";
    $conn->close();
    exit();
}

// Supprimer l'entrée
$sql_delete = "DELETE FROM Users WHERE ID = '$ID'";
if($conn->query($sql_delete) === TRUE) {
    // Réinitialiser l'auto-increment
    $sql_reset = "ALTER TABLE Users AUTO_INCREMENT = 1";
    $conn->query($sql_reset);
    header('Location: /admin');
    exit();
} else {
    echo "Erreur : " .$sql_delete."<br>" .$conn->error;
}

$conn->close();

?>