<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Traitement du formulaire de récupération de mot de passe
    $email = htmlspecialchars($_POST['email']);

    // Connexion a la base de donnée
    $conn = new mysqli("mysql-pompiers-leon.alwaysdata.net", "408942", "@Admin-2025@", "pompiers-leon_admin");
    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    // Requete pour verifier l'email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // L'email existe, envoyer un lien de réinitialisation
        $user = $result->fetch_assoc();
        $token = bin2hex(random_bytes(50));
        $stmt = $conn->prepare("UPDATE users SET reset_token = ? WHERE id = ?");
        $stmt->bind_param("si", $token, $user['id']);
        $stmt->execute();

        // Envoyer l'email
        $to = $email;
        $subject = "Réinitialisation de votre mot de passe";
        $message = "Cliquez sur ce lien pour réinitialiser votre mot de passe : ";
        $message .= "https://votre-site.com/reset.php?token=" . $token;
        mail($to, $subject, $message);

        echo "Un lien de réinitialisation a été envoyé à votre adresse email.";
    } else {
        echo "Aucun utilisateur trouvé avec cet email.";
    }

    $stmt->close();
    $conn->close();
}