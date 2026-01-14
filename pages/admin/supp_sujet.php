<?php

// =====================================
// 🔹 Ca fonctionne, ne plus toucher
// =====================================


// Utiliser le helper mysqli centralisé
require_once __DIR__ . '/../controleurs/db_mysqli.php';
$conn = $mysqli;

if (!$conn) {
    die('Erreur de connexion à la base de données.');
}

// Récuperer les données du formulaire

$ID = $_POST['id'];
//$NomInput = $_POST['NomInput'];                        
//$PrenomInput = $_POST['PrenomInput'];

// Supprime les données dans la base de données
//$sql = " DELETE FROM Users WHERE ID = '$ID'";

// réinitialise l'auto-increment
//$sql = "ALTER TABLE Users AUTO_INCREMENT = 1;";

// Supprimer une entrée

$sql_delete = "DELETE FROM forum_sujets WHERE id = '$ID'";
$conn->query($sql_delete);

// Réinitialiser l'auto-increment
$sql_reset = "ALTER TABLE Users AUTO_INCREMENT = 1";
$conn->query($sql_reset);


if($conn->query($sql_delete) === TRUE) {
    //echo "Entrée enregistrée avec succés"
    header('Location: /admin');
    exit();
    ;
} else {
     echo "Erreur : " .$sql."<br>" .$conn->error;
}

// fermer la connexion
$conn->close();

?>