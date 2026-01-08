import { showAndHideElementsForRoles } from "./roleManager.js";

// 🧹 Fonction de déconnexion complète (appelle le serveur pour détruire la session PHP)
async function signOutUser() {
  try {
    // Appel serveur pour détruire la session
    await fetch('/php/signout.php', { method: 'POST' });
  } catch (e) {
    // Ne pas bloquer la déconnexion côté client si l'appel échoue
    console.warn('Erreur lors de la déconnexion serveur', e);
  }

  // Supprimer les cookies (rôle et token) côté client
  document.cookie = "role=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
  document.cookie = "accesstoken=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";

  // Supprimer la donnée locale
  localStorage.removeItem("userRole");

  alert("✅ Vous avez été déconnecté avec succès.");

  // Actualiser la navbar (masquer les boutons protégés)
  showAndHideElementsForRoles();

  // Redirection vers la page d’accueil
  window.location.href = "/";
}

// 🎯 Écoute du clic sur le bouton de déconnexion
document.addEventListener("click", (e) => {
  if (e.target && e.target.id === "btnSignout") {
    e.preventDefault();
    signOutUser();
  }
});