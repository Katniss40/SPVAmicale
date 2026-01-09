<?php
session_start();
?>

<div class="hero-scene text-center text-white">
  <div class="hero-scene-content">
    <h1 class="hero-scene-text">Connexion Réservée au STAFF</h1>
  </div>
</div>

<br><br>

<style>

/* Espaces pour éviter que le contenu ne passe sous la hero-scene */
/*.hero-scene {
  margin-top: 70px; /* compense la navbar fixe */
 /* margin-bottom: 24px;
}*/
</style>

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
      <div class="input-group">
        <input type="password" class="form-control" id="PasswordInput" name="PasswordInput" required autocomplete="current-password" style="color:#000; background:#fff; caret-color:#000;">
        <input type="text" class="form-control d-none" id="PasswordText" autocomplete="off" style="color:#000; background:#fff; caret-color:#000;">
        <button type="button" class="input-group-text btn btn-outline-secondary" id="togglePassword" aria-label="Afficher ou masquer le mot de passe" aria-pressed="false" style="border-color: #ced4da; min-width:48px;" onclick="togglePasswordVisibility(event)">
          <span id="togglePasswordIcon" aria-hidden="true" style="display:flex; align-items:center; justify-content:center; width:100%;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8z"/>
              <path d="M8 5.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5z" fill="#fff"/>
            </svg>
          </span>
        </button>
      </div>
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
  const passwordText = document.getElementById("PasswordText");
  const togglePassword = document.getElementById("togglePassword");
  const togglePasswordIcon = document.getElementById("togglePasswordIcon");

  if (!btnSignin) {
    return;
  }

  btnSignin.addEventListener("click", async (e) => {
    e.preventDefault();

    const email = emailInput.value.trim();
    const password = (passwordText && !passwordText.classList.contains("d-none") ? passwordText.value : passwordInput.value).trim();

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

      if (response.ok && data.success) {
        window.location.href = data.redirect || "/";
      } else {
        alert(data.message || "❌ Identifiants incorrects.");
      }
    } catch (error) {
      alert("Erreur de connexion au serveur.");
          }
  });

  const toggleHandler = () => {
    if (!passwordInput) return;
    const showingPassword = passwordText && !passwordText.classList.contains("d-none");
    // toggle between two inputs to avoid any browser masking quirks
    if (!showingPassword) {
      if (passwordText) {
        passwordText.value = passwordInput.value;
        passwordText.classList.remove("d-none");
        passwordInput.classList.add("d-none");
      } else {
        // fallback: toggle type
        const isPassword = passwordInput.type === "password";
        passwordInput.type = isPassword ? "text" : "password";
        passwordInput.classList.toggle("show-password", isPassword);
      }
    } else {
      if (passwordText) {
        passwordInput.value = passwordText.value;
        passwordText.classList.add("d-none");
        passwordInput.classList.remove("d-none");
      } else {
        const isPassword = passwordInput.type === "password";
        passwordInput.type = isPassword ? "text" : "password";
        passwordInput.classList.toggle("show-password", isPassword);
      }
    }
    if (togglePasswordIcon) {
      togglePasswordIcon.innerHTML = isPassword
        ? `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
            <path d="M13.359 11.238 15.07 12.95a.75.75 0 1 1-1.06 1.06l-1.782-1.781C11.18 12.73 9.65 13.5 8 13.5 3 13.5 0 8 0 8c.497-.913 1.19-1.91 2.067-2.824a.75.75 0 0 1 1.078 1.04A12.94 12.94 0 0 0 1.72 8c.233.343.482.692.746 1.03a.75.75 0 0 1 1.06-.08l1.076 1.076A2.5 2.5 0 0 0 9.876 6.75l1.133 1.134a.75.75 0 0 1 1.06 1.06L13.36 11.24Z"/>
            <path d="M5.354 6.207 7.2 8.053a.75.75 0 0 1-1.06 1.06L4.293 7.268a.75.75 0 1 1 1.06-1.06Z"/>
          </svg>`
        : `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8z"/>
            <path d="M8 5.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5z" fill="#fff"/>
          </svg>`;
    }
    const nowShowing = passwordText && !passwordText.classList.contains("d-none");
    togglePassword?.setAttribute("aria-label", nowShowing ? "Masquer le mot de passe" : "Afficher le mot de passe");
    togglePassword?.setAttribute("aria-pressed", nowShowing.toString());
    (nowShowing ? passwordText : passwordInput).focus({ preventScroll: true });
  };

  window.togglePasswordVisibility = () => toggleHandler();

  if (togglePassword) {
    togglePassword.addEventListener("click", toggleHandler);
  }
});
</script>