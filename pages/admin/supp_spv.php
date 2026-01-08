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
$NomInput = $_POST['NomInput'];                        
$PrenomInput = $_POST['PrenomInput'];

// Supprime les données dans la base de données
//$sql = " DELETE FROM Users WHERE ID = '$ID'";

// réinitialise l'auto-increment
//$sql = "ALTER TABLE Users AUTO_INCREMENT = 1;";

// Supprimer une entrée

$sql_delete = "DELETE FROM Users WHERE ID = '$ID'";
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