import { showAndHideElementsForRoles } from "./roleManager.js"; // 🧠 chemin à ajuster selon ton arborescence

document.addEventListener("click", async (e) => {
  if (e.target && e.target.id === "btnSignin") {
    e.preventDefault();

    const email = document.getElementById("EmailInput").value.trim();
    const password = document.getElementById("PasswordInput").value.trim();

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

      const text = await response.text();

      let data;
      try {
        data = JSON.parse(text);
      } catch {
        alert("Réponse invalide du serveur.");
        return;
      }

      if (data.success) {
        alert("✅ Connexion réussie !");

        // ✅ Sauvegarder le rôle utilisateur
        localStorage.setItem("userRole", data.role);
        if (data.userName) {
          localStorage.setItem("userName", data.userName);
        }
        document.cookie = `role=${data.role}; path=/; samesite=Lax`;
        document.cookie = `accesstoken=1; path=/; samesite=Lax`;

        // ✅ Met à jour la navbar immédiatement
        showAndHideElementsForRoles();

        // ✅ Redirige proprement (sans recharger toute la page)
        setTimeout(() => {
          if (typeof window.route === "function") {
            window.route({ target: { href: data.redirect }, preventDefault: () => {} });
          } else {
            window.location.href = data.redirect;
          }
        }, 300); // petit délai pour laisser la navbar se mettre à jour

      } else {
        alert(data.message || "❌ Identifiants incorrects.");
      }

    } catch (error) {
      alert("Erreur de connexion au serveur.");
    }
  }
}); // ✅ fermeture correcte du listener principal

// 🧩 Forcer la mise à jour des rôles après redirection
window.addEventListener("pageshow", () => {
  showAndHideElementsForRoles();
});