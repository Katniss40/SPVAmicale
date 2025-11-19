<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("mysql-pompiers-leon.alwaysdata.net", "408942", "@Admin-2025@", "pompiers-leon_admin");

                if ($conn->connect_error) {
                    die("Échec de la connexion : " . $conn->connect_error);
                }


//require_once __DIR__ . 'connexion.php'; // connexion à la BDD
 //include("connexion.php");

// 🧩 Vérification du paramètre "token" dans l'URL
if (!isset($_GET['token']) || empty($_GET['token'])) {
    echo "<div style='text-align:center; margin-top:80px; color:red; font-weight:bold;'>
        ⚠️ Lien invalide ou manquant.<br>
        Merci de cliquer sur le lien reçu par e-mail pour réinitialiser votre mot de passe.
    </div>";
    exit;
}

$token = $_GET['token'];
$tokenHash = hash('sha256', $token);


// Vérifier le token dans la BDD
$stmt = $conn->prepare("SELECT * FROM password_reset_tokens WHERE token_hash = ? AND used = 0 AND expires_at > NOW()");
$stmt->bind_param("s", $tokenHash);
$stmt->execute();
$result = $stmt->get_result();
$tokenData = $result->fetch_assoc();

if (!$tokenData) {
    die("<div style='text-align:center; margin-top:80px; color:red; font-weight:bold;'>
        ❌ Lien de réinitialisation invalide ou expiré.
    </div>");
}



// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if (empty($newPassword) || empty($confirmPassword)) {
        echo "<div style='color:red;'>Veuillez remplir tous les champs.</div>";
    } elseif ($newPassword !== $confirmPassword) {
        echo "<div style='color:red;'>Les mots de passe ne correspondent pas.</div>";
    } else {
        // ⚠️ Mot de passe en clair (pas de hash)
        $stmt = $conn->prepare("UPDATE Users SET PasswordInput = ? WHERE ID = ?");
        $stmt->bind_param("si", $newPassword, $tokenData['user_id']);
        $stmt->execute();

        // Marquer le token comme utilisé
        $stmt = $conn->prepare("UPDATE password_reset_tokens SET used = 1 WHERE id = ?");
        $stmt->bind_param("i", $tokenData['id']);
        $stmt->execute();

        echo "<script>alert('✅ Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter.');</script>";
        header("Refresh:2; url=/signin");
        exit;
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
	<title>Amicale des Sapeurs-Pompiers - Reset</title>
    
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/global.css">
  <link rel="stylesheet" href="/assets/css/resetPassword.css"> <!-- si nécessaire -->
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


<section class="container">    
  <div class="row bg-arc-mint-green-light-staff py-3">
    <div class="card-list-employe mt-3"><br><br><br><br>
      <h2 class="titre-section">Réinitialisation de votre mot de passe</h2>
        <br><br>
    </div>


    <div class="container"> <!-- Ca fonctionne-->
      <br> <!-- action="forgot-password.php" -->
        <form method="POST"  class="form-contact">
          <div class="form-row">
            <input type="password" name="password" placeholder="Nouveau mot de passe" required>
        <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required>
        
          </div>
          <br>
          <div class="form-actions">
            <button type="submit">Valider</button>
          </div>
        </form>
    </div>

  </div>
</section>

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