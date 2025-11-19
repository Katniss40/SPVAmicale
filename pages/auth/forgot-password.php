<?php
//require_once "connexion.php"; // adapte ce chemin si ton fichier est ailleurs

$conn = new mysqli("mysql-pompiers-leon.alwaysdata.net", "408942", "@Admin-2025@", "pompiers-leon_admin");

                if ($conn->connect_error) {
                    die("Échec de la connexion : " . $conn->connect_error);
                }

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);

    if (!empty($email)) {
        // Vérifier si l'utilisateur existe
        $stmt = $conn->prepare("SELECT ID FROM Users WHERE EmailInput = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Générer un token unique
            $token = bin2hex(random_bytes(32));
            $tokenHash = hash('sha256', $token);
            $expiresAt = date("Y-m-d H:i:s", time() + 3600); // expire dans 1h

            // Insérer le token en base
            $stmt = $conn->prepare("INSERT INTO password_reset_tokens (user_id, token_hash, expires_at, used) VALUES (?, ?, ?, 0)");
            $stmt->bind_param("iss", $user['ID'], $tokenHash, $expiresAt);
            $stmt->execute();

            // Générer le lien complet
            $resetLink = "https://www.pompiers-leon40.fr/pages/auth/resetPassword.php?token=" . $token;
            //$resetLink = "https://www.pompiers-leon40.fr/reset?token=" . $token;

            // Contenu de l'email
            $subject = "Réinitialisation de votre mot de passe";
            $message = "
                <p>Bonjour,</p>
                <p>Vous avez demandé à réinitialiser votre mot de passe.</p>
                <p>Cliquez sur ce lien pour le réinitialiser :</p>
                <p><a href='$resetLink'>$resetLink</a></p>
                <p>Ce lien est valable 1 heure.</p>
                <p>Amicalement,<br>L'équipe de l'Amicale des Pompiers de Léon</p>
            ";

            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8\r\n";
            $headers .= "From: Amicale Pompiers Léon <contact@pompiers-leon40.fr>\r\n";

            // Envoi de l'email
          if (mail($email, $subject, $message, $headers)) {
    // ✅ Redirection vers la page d'accueil après 3 secondes
            echo "<div style='text-align:center; margin-top:80px; color:green; font-weight:bold;'>
                ✅ Un lien de réinitialisation vous a été envoyé à $email.<br><br>
                ⏳ Vous allez être redirigé vers la page d'accueil...
            </div>";
            echo "<script>
                setTimeout(function(){
                    window.location.href = '/'; // ou simplement '/'
                }, 3000);
            </script>";
        } else {
            $error = error_get_last();
            echo "<div style='text-align:center; margin-top:80px; color:red; font-weight:bold;'>
                ⚠️ L’envoi de l’e-mail a échoué.<br>
                <small>" . print_r($error, true) . "</small>
            </div>";
        }

            echo "<br><div style='text-align:center;'>
                🔗 Lien de test : <a href='$resetLink'>$resetLink</a>
            </div>";

        } else {
            echo "<div style='text-align:center; margin-top:80px; color:red; font-weight:bold;'>
                ⚠️ Aucune adresse e-mail trouvée.
            </div>";
        }
    } else {
        echo "<div style='text-align:center; margin-top:80px; color:red; font-weight:bold;'>
            ⚠️ Veuillez entrer une adresse e-mail.
        </div>";
    }
}


?>

<!-- --- Interface HTML --- -->

<!-- --- Interface HTML --- -->

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Amicale des Sapeurs-Pompiers - Récupetation</title>
    
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/global.css">
  <link rel="stylesheet" href="/assets/css/forgot-password.css"> <!-- si nécessaire -->
</head>

<body>

<header>
    <section class="hero-scene text-center text-white">
            <div class="hero-scene-content">
                <h1 style="color: white;" class="hero-scene-text">Récuperation du votre mot de passe</h1>
            </div>        
    </section>

    <nav class="navbar">        
        <div class="navbar" style="background-color: #2E7D32;"> 
            <img src="/Images/Logo_SPleon3.png" alt="Logo" width="70" height="50" class="d-inline-block align-text-top"></a> 
                <a class="navbar-brand" href="/Blog" data-show="actif" >Tableau de bord </a>
                <span class="navbar-toggler-icon"></span>  
                    <a class="nav-link" href="/liens">Liens Utiles</a>
                    <a class="nav-link" href="/calendrier">Calendrier des Gardes</a>
                    <a class="nav-link" href="/VideGrenier">Vide grenier</a>
                    <a class="nav-link" href="/GalerieSPV">Gestion des Photos</a>
                    <a class="nav-link" href="/Blog">Discussions</a>
                    <a class="nav-link" href="/pages/auth/reservation.php">Réservation fendeuse</a>
                    <a class="nav-link" href="/forum/account.php">Mon Compte</a>                
        </div>
    </nav>
</header>




<br><br><br><br><br>

<section class="container">    
  <div class="row bg-arc-mint-green-light-staff py-3">
    <div class="card-list-employe mt-3">
      <h2 class="titre-section">Mot de passe oublié</h2>
        <br><br>
    </div>


    <div class="container"> <!-- Ca fonctionne-->
      <br> <!-- action="forgot-password.php" -->
        <form method="POST"  class="form-contact">
          <div class="form-row">
            <label for="email">Votre adresse mail :</label>
            <input type="email" name="email" placeholder="" required>
          </div>
          <br>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Envoyer le lien</button>
          </div>
        </form>
    </div>

  </div>
</section>


</body>



<!-- Bouton retour haut --><

<button id="backToTop" aria-label="Retour en haut" title="Retour en haut">↑ Haut</button>
<footer class="footer">
  

  <div class="footer-container">
    <div class="footer-col">
      <h3>Nous contacter</h3>
      <p>Adresse M@il : 
        <a class="mail" href="mailto:aspleon40@gmail.com">aspleon40@gmail.com</a>
      </p>
      <div class="social-buttons">
        <button class="facebook" onclick="window.location.href='https://www.facebook.com/csleon.sapeurspompiers';">
          <i class="bi bi-facebook"></i> Facebook
        </button>
        <button class="instagram" onclick="window.location.href='https://www.instagram.com/sapeurs_pompiers_de_leon';">
          <i class="bi bi-instagram"></i> Instagram
        </button>
      </div>
    </div>

    <div class="footer-col">
      <p>
        Centre de secours et d'incendie <br>
        Route de Laguens <br>
        40550 Léon <br>
        Tel Chef de centre : 06.89.76.78.67 <br>
        Tel Président Amicale : 06.14.81.77.03
      </p>
    </div>

    <div class="footer-col">
      <p>Mentions légales</p>
      <a href="/fichiers/mentions_legales_spv.docx" class="btn-mentions">Télécharger ICI</a>
      <p class="copyright">© 2025 Amicale des Sapeurs-Pompiers de Léon<br>Tous droits réservés</p>
    </div>
  </div>

  <div class="signature">
    <p>Site conçu gracieusement par Bourdeloux Corinne - Web-Crea 2.0 - contactez-moi 
      <a class="mail" href="mailto:w3b.cre4@gmail.com">ICI</a>
    </p>
  </div>
</footer>  


<script>
  // Smooth scroll to top
  function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  // Afficher / cacher le bouton selon la position de la page
  document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('backToTop');

    // Ne pas continuer si bouton introuvable
    if (!btn) return;

    // Au chargement, cacher le bouton
    btn.classList.remove('visible');

    window.addEventListener('scroll', function () {
      // Affiche le bouton quand on a défilé de 300px (à adapter)
      if (window.scrollY > 300) {
        btn.classList.add('visible');
      } else {
        btn.classList.remove('visible');
      }
    });

    // Optionnel : fermer le menu mobile si nécessaire quand on clique (exemple)
    btn.addEventListener('click', scrollToTop);
  });
</script>


</body>
</html>