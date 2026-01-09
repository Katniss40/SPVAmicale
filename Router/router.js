import Route from "./Route.js";
import { allRoutes, websiteName } from "./allRoutes.js";
import { isConnected, getRole, showAndHideElementsForRoles } from "../JS/auth/roleManager.js";

// 🔹 Route par défaut pour les erreurs 404
const route404 = new Route("404", "Page introuvable", "/pages/404.html", []);

// 🔹 Trouver la route correspondant à l’URL actuelle
const getRouteByUrl = (url) => {
  let currentRoute = null;
  allRoutes.forEach((element) => {
    if (element.url === url) {
      currentRoute = element;
    }
  });
  return currentRoute || route404;
};

// 🔹 Fonction principale pour charger une page dynamiquement
const LoadContentPage = async () => {
  const path = window.location.pathname;
  const actualRoute = getRouteByUrl(path);

  // --- 🔐 Vérification des droits d'accès ---
  const allRolesArray = actualRoute.authorize || [];
  const userRole = getRole();

  if (allRolesArray.length > 0) {
    if (allRolesArray.includes("disconnected")) {
      if (isConnected()) {
        if (path === "/signin") return; // Évite la boucle après connexion
        alert("🚫 Accès refusé : vous êtes déjà connecté.");
        window.location.replace("/");
        return;
      }
    } else if (!allRolesArray.includes(userRole)) {
      alert("🚫 Accès refusé : vous n'avez pas les droits nécessaires.");
      window.location.replace("/");
      return;
    }
  }

  // --- 📄 Chargement du contenu HTML ---
  try {
    const html = await fetch(actualRoute.pathHtml).then((res) => res.text());
    document.getElementById("main-page").innerHTML = html;
  } catch (err) {
    document.getElementById("main-page").innerHTML =
      "<h2>Erreur de chargement de la page</h2>";
    return;
  }

  // --- 🧩 Chargement du script JS associé ---
  if (actualRoute.pathJS) {
    const scriptTag = document.createElement("script");
    scriptTag.type = "module"; // ✅ Autorise les imports
    scriptTag.src = actualRoute.pathJS;
    scriptTag.onload = () => {
      showAndHideElementsForRoles(); // ✅ Réapplique la logique d’affichage des rôles
      // Si le script expose une initialisation spécifique (ex: adminDatesInit), l'appeler
      try {
        const pageKey = actualRoute.url && actualRoute.url.startsWith('/') ? actualRoute.url.slice(1) : actualRoute.url;
        if (window.adminDatesInit && typeof window.adminDatesInit === 'function') {
          window.adminDatesInit(pageKey);
        }
      } catch (e) {
        // Erreur silencieuse si pas d'initialisation
      }
    };
    document.body.appendChild(scriptTag);
  } else {
    showAndHideElementsForRoles();
  }

  // --- 🧭 Mise à jour du titre de la page ---
  document.title = `${actualRoute.title} - ${websiteName}`;
};

// --- 🧠 Gérer les clics sur les liens internes ---
const routeEvent = (event) => {
  event.preventDefault();
  window.history.pushState({}, "", event.target.href);
  LoadContentPage();
};

// --- 🔙 Gérer les retours arrière du navigateur ---
window.onpopstate = LoadContentPage;

// --- 🌐 Exposer la fonction pour une utilisation globale ---
window.route = routeEvent;

// --- 🚀 Chargement initial ---
window.addEventListener("DOMContentLoaded", () => {
  showAndHideElementsForRoles();
  LoadContentPage();
});
