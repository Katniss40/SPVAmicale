<?php
/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    $to = "pompiers.leon@pompiers-leon40.fr"; // Remplacez par votre adresse e-mail
    $subject = "Nouveau message de contact de $name";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    $body = "Nom: $name\nEmail: $email\n\nMessage:\n$message";
    
    if (mail($to, $subject, $body, $headers)) {
        echo "Merci, votre message a été envoyé.";
    } else {
        echo "Désolé, une erreur s'est produite. Veuillez réessayer.";
    }
}*/


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validation des données (exemple simple)
    if (empty($name) || empty($surname) || empty($email) || empty($telephone) || empty($subject) || empty($message)) {
        echo "Tous les champs sont obligatoires.";
    } else {
        // Envoi de l'e-mail
        $to = "pompiers.leon@pompiers-leon40.fr";
        $headers = "From: $name <$email>";
        mail($to, $subject, $message, $headers);
        
        // Définir le message d'alerte
        $messageA = "Votre message a été envoyé avec succès!";

        // Afficher le message d'alerte en utilisant JavaScript
        echo "<script type='text/javascript'>alert('$messageA');</script>";
        echo "Votre message a été envoyé avec succès.";
        // Redirigez vers la page principale
        header("Location: /");
        exit();
    }
}

?>