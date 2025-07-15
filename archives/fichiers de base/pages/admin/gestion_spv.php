<?php
/*include_once '../../controleurs/db_connexion.php';
// session_start();
// if($_SESSION['username'] !== ""){
// $user = $_SESSION['username'];
    //afficher un message
//  echo "Bonjour $user, vous êtes connecté";
//  }

    $sql= "INSERT INTO `users`(`NomInput`, `PasswordInput`, `PrenomInput`, `Role`, `Adresse`, `Telephone`, `email`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')"
    $result = $conn->query($sql);

    // Redirection avec des paramètres GET
    header("Location: admin.php");
    exit;*/



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
$NomInput = $_POST['NomInput'];                        
$PrenomInput = $_POST['PrenomInput'];
$Adresse = $_POST['Adresse'];
$Telephone = $_POST['Telephone'];
$email = $_POST['email'];                       
$PasswordInput = $_POST['PasswordInput'];

// insere les données dans la base de données
$sql = " INSERT INTO users(Role, NomInput, PrenomInput, Adresse, Telephone, email, PasswordInput) VALUES ('$Role', '$NomInput', '$PrenomInput', '$Adresse', '$Telephone', '$email', '$PasswordInput')";


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

