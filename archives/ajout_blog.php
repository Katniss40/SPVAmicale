<?php
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

$title = $_POST['title'];
$content = $_POST['content'];                        


// insere les données dans la base de données
$sql = " INSERT INTO blog(title, content) VALUES ('$title', '$content')";


if($conn->query($sql) === TRUE) {
    //echo "Entrée enregistrée avec succés"
    header('Location: /blog');
    exit();
    ;
} else {
     echo "Erreur : " .$sql."<br>" .$conn->error;
}

// fermer la connexion
$conn->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO blog (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();
    echo "Article ajouté avec succès !";
}
?>