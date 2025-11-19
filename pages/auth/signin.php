<?php
session_start();
?>

<div class="hero-scene text-center text-white">
  <div class="hero-scene-content">
    <h1 class="hero-scene-text">Connexion Réservée au STAFF</h1>
  </div>
</div>

<br><br><br><br><br><br>

<div class="container">
  <h3>Connexion</h3>
  <br>

  <form id="signinForm" method="POST">
    <div class="mb-3">
      <label for="EmailInput" class="form-label">Adresse Mail</label>
      <input type="email" class="form-control" id="EmailInput" name="EmailInput" placeholder="votre email@mail.fr" required>
      <div class="invalid-feedback">
        Le mail et/ou le mot de passe ne correspondent pas.
      </div>
    </div>

    <div class="mb-3">
      <label for="PasswordInput" class="form-label">Mot de Passe</label>
      <input type="password" class="form-control" id="PasswordInput" name="PasswordInput" required>
    </div>

    <div class="text-center">
      <button type="button" class="btn btn-primary" id="btnSignin">Connexion</button>
    </div>
  </form>

  <br>

  <p style="text-align:center; margin-top:15px;">
  <a href="/pages/auth/forgot-password.php" style="color:#2E7D32; text-decoration:none; font-weight:500;">
    Mot de passe oublié ?
  </a>
</p>
  <!--<a>Vous avez oublié vos infos de connexion ? Contactez le président de l'amicale.</a>-->
</div>

<!-- ✅ Script unique -->
<script>
document.addEventListener("DOMContentLoaded", () => {
  const btnSignin = document.getElementById("btnSignin");
  const emailInput = document.getElementById("EmailInput");
  const passwordInput = document.getElementById("PasswordInput");

  if (!btnSignin) {
    console.error("❌ Bouton de connexion non trouvé !");
    return;
  }

  btnSignin.addEventListener("click", async (e) => {
    e.preventDefault();
    console.log("🟢 Clic détecté sur Connexion");

    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();

    if (!email || !password) {
      alert("Merci de remplir tous les champs.");
      return;
    }

    try {
      const response = await fetch("/php/verification.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `EmailInput=${encodeURIComponent(email)}&PasswordInput=${encodeURIComponent(password)}`
      });

      const data = await response.json();
      console.log("Réponse serveur :", data);

      if (response.ok && data.success) {
        alert("✅ Connexion réussie !");
        window.location.href = data.redirect || "/";
      } else {
        alert(data.message || "❌ Identifiants incorrects.");
      }
    } catch (error) {
      console.error("Erreur réseau :", error);
      alert("Erreur de connexion au serveur.");
          }
  });
});
</script>