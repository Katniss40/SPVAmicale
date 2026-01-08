<?php
// Connexion à la base
//include("connexion.php");

// Récupération des données
//$commentaire = htmlspecialchars($_POST['commentaire']);
//$nomFichier = $_FILES['photo']['name'];
//$cheminTemporaire = $_FILES['photo']['tmp_name'];
//$dossierDestination = '../../uploads/' . basename($nomFichier);

// Déplacement du fichier
//if (move_uploaded_file($cheminTemporaire, $dossierDestination)) {
//    $stmt = $conn->prepare("INSERT INTO photos (name, commentaire) VALUES (?, ?)");
 //   $stmt->bind_param("ss", $dossierDestination, $commentaire);
//    $stmt->execute();
    //echo "Photo et commentaire ajoutés avec succès.";
//} else {
    //echo "Erreur lors de l’envoi de la photo.";
//}

//header("Location: /GalerieSPV"); // Redirection vers la page principale

//exit;

include("connexion.php");

// Activer les erreurs PHP pour déboguer
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Récupération des données
$commentaire = htmlspecialchars($_POST['commentaire']);
$nomFichier = basename($_FILES['photo']['name']);
$cheminTemporaire = $_FILES['photo']['tmp_name'];

// 🔧 IMPORTANT : le dossier uploads est à la racine du projet
// On part du répertoire courant (celui où se trouve ce fichier)
$dossierDestination = realpath(__DIR__ . '/../../uploads') . DIRECTORY_SEPARATOR . $nomFichier;
$cheminPublic = '/uploads/' . $nomFichier;

// Création du dossier s’il n’existe pas
$dossierUploads = dirname($dossierDestination);
if (!is_dir($dossierUploads)) {
    mkdir($dossierUploads, 0777, true);
}

if ($_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
    echo "<p style='color:red;'>Erreur upload : code " . $_FILES['photo']['error'] . "</p>";
    exit;
}


// Déplacement du fichier uploadé
if (move_uploaded_file($cheminTemporaire, $dossierDestination)) {
    // Insertion dans la base de données
    $stmt = $conn->prepare("INSERT INTO photos (name, commentaire, url) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nomFichier, $commentaire, $cheminPublic);
    $stmt->execute();

    header("Location: /GalerieSPV");
    exit;
} else {
    echo "<p style='color:red;'>❌ Erreur lors du déplacement du fichier.</p>";
    echo "<p>Chemin temporaire : $cheminTemporaire</p>";
    echo "<p>Destination : $dossierDestination</p>";
    echo "<p>Dossier existe ? " . (is_dir($dossierUploads) ? 'OUI' : 'NON') . "</p>";
    echo "<p>Dossier accessible en écriture ? " . (is_writable($dossierUploads) ? 'OUI' : 'NON') . "</p>";
    exit;
}


?>