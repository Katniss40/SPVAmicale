<?php
//session_start();
//require('connexion.php');

//header('Content-Type: application/json; charset=utf-8');

//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //$email = trim($_POST['EmailInput'] ?? '');
  //$password = trim($_POST['PasswordInput'] ?? '');

  //if (empty($email) || empty($password)) {
    //echo json_encode(['success' => false, 'message' => 'Champs manquants.']);
    //exit;
  //}

        // Sécurisation basique
  //$emailEscaped = mysqli_real_escape_string($conn, $email);
  //$passwordEscaped = mysqli_real_escape_string($conn, $password);

         // 🔍 Vérifie si un utilisateur existe avec ce mail
  //$query = "SELECT * FROM `Users` WHERE `EmailInput` = '$emailEscaped' LIMIT 1";
  //$result = mysqli_query($conn, $query);

  //if ($result && mysqli_num_rows($result) === 1) {
///    $user = mysqli_fetch_assoc($result);

    // ⚠️ À sécuriser plus tard (password_hash / verify)
//    if ($user['PasswordInput'] === $passwordEscaped) {

//      $_SESSION['EmailInput'] = $user['EmailInput'];
//      $_SESSION['Role'] = $user['Role'];

      // ✅ Redirection selon le rôle
//      if ($user['Role'] === 'admin') {
//    $redirect = '/admin';
//} elseif ($user['Role'] === 'actif') {
//    $redirect = '/calendrier'; // ou la page principale des membres
//} else {
//    $redirect = '/';
//}

//      echo json_encode([
 //       'success' => true,
 //       'redirect' => $redirect,
 //       'role' => $user['Role'],
//        'debug' => 'Utilisateur trouvé et connecté'
 //     ]);
 //     exit;

//    } else {
 //     echo json_encode(['success' => false, 'message' => 'Mot de passe incorrect.']);
 //     exit;
 //   }
//  } else {
 //   echo json_encode(['success' => false, 'message' => 'Utilisateur introuvable.']);
//    exit;
 // }
//}
?>


<?php

// ===============================
// 🔹 Version mise a Jour
// ===============================


session_start();
require('connexion.php');

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['EmailInput'] ?? '');
  $password = trim($_POST['PasswordInput'] ?? '');

  if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Champs manquants.']);
    exit;
  }

  // Sécurisation basique
  $emailEscaped = mysqli_real_escape_string($conn, $email);
  $passwordEscaped = mysqli_real_escape_string($conn, $password);

  // 🔍 Vérifie si un utilisateur existe avec ce mail
  $query = "SELECT * FROM `Users` WHERE `EmailInput` = '$emailEscaped' LIMIT 1";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);

    // ⚠️ À sécuriser plus tard (password_hash / verify)
    if ($user['PasswordInput'] === $passwordEscaped) {

      $_SESSION['EmailInput'] = $user['EmailInput'];
      $_SESSION['Role'] = $user['Role'];

      // ✅ Redirection selon le rôle
      if ($user['Role'] === 'admin') {
        $redirect = '/admin';
      } elseif ($user['Role'] === 'actif') {
        $redirect = '/calendrier';
      } else {
        $redirect = '/';
      }

      echo json_encode([
        'success' => true,
        'redirect' => $redirect,
        'role' => $user['Role'],
        'debug' => 'Utilisateur trouvé et connecté'
      ]);
      exit;
    } else {
      echo json_encode(['success' => false, 'message' => 'Mot de passe incorrect.']);
      exit;
    }
  } else {
    echo json_encode(['success' => false, 'message' => 'Utilisateur introuvable.']);
    exit;
  }
}

// 🔍 Si la requête est GET → on renvoie juste l’état de session
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $connected = isset($_SESSION['EmailInput']);
  $role = $_SESSION['Role'] ?? null;
  echo json_encode([
    'connected' => $connected,
    'role' => $role
  ]);
  exit;
}
?>