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

$Role = $_POST['Role'];
$CAgent = $_POST['CAgent'];
$NomInput = $_POST['NomInput'];                        
$PrenomInput = $_POST['PrenomInput'];
$Adresse = $_POST['Adresse'];
$Telephone = $_POST['Telephone'];
$EmailInput = $_POST['EmailInput'];                       
$PasswordInput = $_POST['PasswordInput'];

// insere les données dans la base de données
$sql = " INSERT INTO Users(Role, NomInput, PrenomInput, Adresse, CAgent, Telephone, EmailInput, PasswordInput) VALUES ('$Role', '$NomInput', '$PrenomInput', '$Adresse', '$CAgent', '$Telephone', '$EmailInput', '$PasswordInput')";


if($conn->query($sql) === TRUE) {
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

