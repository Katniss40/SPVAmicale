<?php
/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    $to = "aspleon@gmail.com"; // Remplacez par votre adresse e-mail
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
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validation des données (exemple simple)
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "Tous les champs sont obligatoires.";
    } else {
        // Envoi de l'e-mail
        $to = "bourdeloux.corinne@orange.fr";
        $headers = "From: $name <$email>";
        mail($to, $subject, $message, $headers);
        echo "Votre message a été envoyé avec succès.";
    }
}

?>