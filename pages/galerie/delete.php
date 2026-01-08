<?php
include("connexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['photo_id'])) {
    $photo_id = intval($_POST['photo_id']);

    // Récupère le chemin du fichier image
    $stmt = $conn->prepare("SELECT name FROM photos WHERE id = ?");
    $stmt->bind_param("i", $photo_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $photo = $result->fetch_assoc();

    if ($photo) {
        $cheminFichier = $photo['name'];

        // Supprime le fichier image si présent
        if (file_exists($cheminFichier)) {
            unlink($cheminFichier);
        }

        // Supprime l'entrée dans la base
        $stmt = $conn->prepare("DELETE FROM photos WHERE id = ?");
        $stmt->bind_param("i", $photo_id);
        $stmt->execute();

        // Redirection vers la galerie
        header("Location: /GalerieSPV"); // Redirection vers la page principale
        exit;
    } else {
        echo "Photo introuvable dans la base.";
    }
} else {
    echo "Requête invalide.";
}
?>