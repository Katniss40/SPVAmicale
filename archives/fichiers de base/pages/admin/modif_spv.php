<?php
    // Connexion à la base de données
    include("connexion.php");
    session_start();
    //if($_SESSION['username'] !== ""){
    //$user = $_SESSION['username'];
    //afficher un message
    echo "Bonjour $user, vous êtes connecté";
    //}

    $sql= "INSERT INTO `users`(`NomInput`, `PasswordInput`, `PrenomInput`, `Role`, `Adresse`, `Telephone`, `email`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')";
    //$result = $conn->query($sql);

    // Redirection avec des paramètres GET
    header("Location: admin.php");
    exit;

?>

