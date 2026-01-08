<?php
require_once __DIR__ . '/db_connect.php'; // fichier de connexion à la BDD

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    if (empty($email)) {
        echo "Veuillez entrer votre adresse e-mail.";
        exit;
    }

    // Vérifier si l'utilisateur existe
    $stmt = $pdo->prepare("SELECT id FROM Users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Aucun compte trouvé avec cette adresse e-mail.";
        exit;
    }

    // Générer un token sécurisé
    $token = bin2hex(random_bytes(32));
    $tokenHash = hash('sha256', $token);
    $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));

    // Sauvegarder le token dans la BDD
    $stmt = $pdo->prepare("
        INSERT INTO password_reset_token (user_id, token_hash, expires_at, used)
        VALUES (?, ?, ?, 0)
    ");
    $stmt->execute([$user['id'], $tokenHash, $expiresAt]);

    // Préparer le lien de réinitialisation
    $resetLink = "https://www.pompiers-leon40.fr/pages/auth/reset_password.php?token=$token";

    // Envoyer le mail
    $to = $email;
    $subject = "Réinitialisation de votre mot de passe - Amicale des pompiers de Léon";
    $message = "Bonjour,\n\nCliquez sur le lien suivant pour réinitialiser votre mot de passe :\n$resetLink\n\nCe lien est valable pendant 1 heure.\n\nCordialement,\nAmicale des pompiers de Léon";
    $headers = "From: contact@pompiers-leon40.fr\r\nReply-To: contact@pompiers-leon40.fr";

    if (mail($to, $subject, $message, $headers)) {
        echo "Un lien de réinitialisation a été envoyé à votre adresse e-mail.";
    } else {
        echo "Erreur lors de l’envoi de l’e-mail. Réessayez plus tard.";
    }
}
?>