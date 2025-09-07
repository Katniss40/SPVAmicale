<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['photo'])) {
    $photo = $_POST['photo'];

    //Suppression du fichier
    if (file_exists($photo)) {
        unlink($photo);
        echo "Photo supprimée avec succès.";
    } else {
        echo "Fichier introuvable.";
    }
}

header("Location: /GalerieSPV"); // Redirection vers la page galerie
exit;
?>