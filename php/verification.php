<?php

session_start();

// Connexion a la base de données
$host = 'mysql-pompiers-leon.alwaysdata.net'; // Adresse du serveur
$dbname = 'pompiers-leon_admin'; // Nom de la base de données
$user = '408942'; // Nom d'utilisateur MySQL
$password = '@Admin-2025@'; // Mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if (empty($_POST['EmailInput']) || empty($_POST['PasswordInput'])) {
    echo "Veuillez remplir tous les champs.";
    exit;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $EmailInput = $_POST['EmailInput'];
    $PasswordInput = $_POST['PasswordInput'];

// Requête pour récupérer l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM Users WHERE EmailInput = :EmailInput");
    $stmt->bindParam(':EmailInput', $EmailInput);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);



    if ($user && password_verify($PasswordInput, $user['PasswordInput'])) {
        $_SESSION['user_id'] = $EmailInput;
        echo "Connexion réussie ! Bienvenue, " . htmlspecialchars($user['PrenomInput']) . ".";
        header("Location: /");
        exit;
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}




?>