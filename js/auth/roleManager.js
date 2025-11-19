// ===============================
// 🔹 ROLE MANAGER SIMPLIFIÉ
// ===============================

function getCookie(name) {
  return document.cookie
    .split("; ")
    .find(row => row.startsWith(name + "="))
    ?.split("=")[1];
}

export function isConnected() {
  const role = localStorage.getItem("userRole") || getCookie("role");
  return !!role && role !== "disconnected";
}

export function getRole() {
  return localStorage.getItem("userRole") || getCookie("role") || "disconnected";
}

// ===============================
// 🔹 HIÉRARCHIE DES RÔLES
// ===============================
const roleHierarchy = {
  admin: 2,
  actif: 1,
  disconnected: 0
};

// ===============================
// 🔹 VISIBILITÉ DES ÉLÉMENTS
// ===============================
export function showAndHideElementsForRoles() {
  const role = getRole();
  const userLevel = roleHierarchy[role] || 0;

  // Masquer tout par défaut
  document.querySelectorAll("[data-show]").forEach(el => {
    el.classList.add("d-none");
  });

  // Gérer les affichages selon rôle
  document.querySelectorAll("[data-show]").forEach(el => {
    const allowedRole = el.dataset.show;

    if (allowedRole === "disconnected" && userLevel === 0) el.classList.remove("d-none");
    if (allowedRole === "connected" && userLevel > 0) el.classList.remove("d-none");
    if (allowedRole === role) el.classList.remove("d-none");


  });

  console.log(`🎭 Rôle actuel : ${role}`);
}

document.addEventListener("DOMContentLoaded", showAndHideElementsForRoles);