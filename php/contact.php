<?php

// Configurer le serveur SMTP
ini_set('SMTP', 'smtp.free.fr'); // Remplacez par l'adresse de votre serveur SMTP
ini_set('smtp_port', '25'); // Port SMTP (par défaut 25, 465, ou 587 pour TLS)

// Configurer l'adresse de l'expéditeur
//ini_set('sendmail_from', 'pompiers.leon@gmail.com');

// Préparer l'e-mail
//$to = 'destinataire@example.com';
//$subject = 'Test d\'envoi de mail';
//$message = 'Ceci est un test d\'envoi de mail via PHP.';
//$headers = 'From: votre-email@example.com';

// Envoyer l'e-mail
//if (mail($to, $subject, $message, $headers)) {
//    echo 'E-mail envoyé avec succès.';
//} else {
//    echo 'Échec de l\'envoi de l\'e-mail.';
//}


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validation des données
    if(empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "Tous les champs sont obligatoires.";
    } else {
        // envoi de l'email
        //$to = 'aspleon40@gmail.com';
        $to = 'pompiers.leon@gmail.com';
        $headers = "From: $name<$email>";
        $messageEnvoye = true; // Simulez que le message a été envoyé avec succès
        mail($to, $subject, $message, $headers);
        echo "Votre message a été envoyé avec succès.";
        if ($messageEnvoye) {
        // Générer un script JavaScript pour afficher un pop-up
        echo "<script>alert('Votre message a été envoyé avec succès !');</script>";
    }  
    }
}
    // Redirection vers une autre page
        header("Location: /");
        exit();// Toujours utiliser exit après un header pour arrêter l'exécution du script
    
    ?>