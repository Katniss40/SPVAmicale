<?php
session_start();
    include("connexion.php");

    $sql= "INSERT INTO `Users`(`Role`, `NomInput`, `PrenomInput`, `Adresse`, `PasswordInput`, `EmailInput`, `Telephone`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')";
    //$result = $conn->query($sql);

    // Redirection vers une autre page
        header("Location: /admin");
        exit();// Toujours utiliser exit après un header pour arrêter l'exécution du script

?>
