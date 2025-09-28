<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo'])) {
    $uploadDir = '../../uploads/'; // Dossier ou stocker les photos
    $uploadFile = $uploadDir . basename($_FILES['photo']['name']);
     $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Définir les formats autorisés et la taille maximale
        $allowedFormats = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/bmp'];
        $maxFileSize = 2 * 200 * 150; // 2MB

    // Vérifie si le fichier est une image
        $fileType = mime_content_type($_FILES['photo']['tmp_name']);
    if (strpos($fileType, 'image') === false) {
        die('Le fichier téléchargé n\'est pas une image.');
   }

   // Générer un nom unique pour chaque image
        $newName = uniqid('image_', true) . '.' . $extension;
    
    // Déplace le fichier dans le dossier "uploads"
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
        echo 'Photo ajoutée avec succès !';
    } else {
        echo 'Erreur lors de l\'ajout de la photo.';
    }
}

header("Location: /GalerieSPV"); // Redirection vers la page principale
exit;

?>