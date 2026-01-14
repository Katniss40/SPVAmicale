<?php
// Page d'annulation réservée à l'admin
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'aucun';
echo '<div style="background:#ffc; color:#333; padding:8px; text-align:center;">Rôle détecté : <b>' . htmlspecialchars($role) . '</b></div>';
$isAdmin = ($role === 'admin');
if (!$isAdmin) {
  echo '<div style="color:red; text-align:center;">Accès refusé : vous n\'êtes pas administrateur.</div>';
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Annulation Réservation Fendeuse (Admin)</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/global.css">
  <link rel="stylesheet" href="/assets/css/reservation-fendeuse.css">
  <link rel="stylesheet" href="/scss/main.css">
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
<!-- Navbar blanche -->
<nav class="navbar navbar-light bg-white">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Accueil</a>
    <span class="navbar-text">Admin - Annulation Réservation Fendeuse</span>
  </div>
</nav>
<!-- Hero scene verte -->
<div class="hero-scene admin-hero text-center text-white" style="background:#388e3c;">
  <div class="hero-scene-content">
    <h1 class="hero-scene-text">Annulation de réservation (Admin)</h1>
  </div>
</div>
<!-- Navbar verte -->
<nav class="navbar navbar-expand-lg bg-success admin-subnav" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/admin">Tableau de bord Administrateur</a>
    <a class="navbar-brand" href="/fendeuse">Réservation fendeuse</a>
    <a class="navbar-brand" href="/">Retour site</a>
  </div>
</nav>
  <nav class="navbar navbar-expand-lg bg-success admin-subnav" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/admin">Tableau de bord Administrateur</a>
      <a class="navbar-brand" href="/fendeuse">Réservation fendeuse</a>
      <a class="navbar-brand" href="/annul-fendeuse">Annulation Fendeuse</a>
      <a class="navbar-brand" href="/">Retour site</a>
    </div>
  </nav>
<main class="resa-container">
  <h2 class="mb-4">📋 Liste des réservations</h2>
  <div id="resa-listing"></div>
  <script type="module">
    async function loadReservations() {
      const container = document.getElementById('resa-listing');
      container.innerHTML = '<div>Chargement des réservations...</div>';
      try {
        const res = await fetch('/php/get_reservations.php');
        const data = await res.json();
        if (!Array.isArray(data) || data.length === 0) {
          container.innerHTML = '<div>Aucune réservation trouvée.</div>';
          return;
        }
        let html = '<table class="table table-bordered table-striped"><thead><tr>' +
          '<th>Nom</th><th>Date début</th><th>Date fin</th><th>Action</th></tr></thead><tbody>';
        for (const resa of data) {
          html += `<tr>
            <td>${resa.title}</td>
            <td>${resa.start}</td>
            <td>${resa.end}</td>
            <td><button class="btn btn-danger btn-sm" data-id="${resa.id}" onclick="annulReservation(${resa.id}, '${resa.start}', '${resa.end}')">Annuler dernier jour</button></td>
          </tr>`;
        }
        html += '</tbody></table>';
        container.innerHTML = html;
      } catch (e) {
        container.innerHTML = '<div>Erreur de chargement des réservations.</div>';
      }
    }

    window.annulReservation = async function(id, dateDebut, dateFin) {
      if (!confirm("Confirmer l'annulation du dernier jour de cette réservation ?")) return;
      // Calculer la nouvelle date de fin (veille du dernier jour)
      const d = new Date(dateFin);
      d.setDate(d.getDate() - 1);
      // Format Y-m-d
      const pad = n => n < 10 ? '0' + n : n;
      const newFin = `${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())}`;
      if (newFin < dateDebut) {
        // Si la nouvelle date de fin est avant la date de début, on supprime la réservation
        if (!confirm("La réservation va être supprimée. Confirmer ?")) return;
      }
      // Appel backend
      try {
        const res = await fetch('/php/update_reservation.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ id, date_debut: dateDebut, date_fin: newFin })
        });
        const result = await res.json();
        if (result.success) {
          alert(result.deleted ? "Réservation supprimée." : "Dernier jour annulé, réservation mise à jour.");
          loadReservations();
          if (window.refreshCalendar) window.refreshCalendar();
        } else {
          alert((result.message ? result.message : "Erreur lors de l'annulation.") + "\n\nDétail JSON :\n" + JSON.stringify(result, null, 2));
        }
      } catch (e) {
        alert("Erreur serveur : " + e);
      }
    }

    loadReservations();
  </script>
  <h2 class="mb-4">📅 Annuler une ou plusieurs dates</h2>
  <form id="formAnnul" style="max-width:500px;margin:40px auto 0;">
    <div class="mb-3">
      <label for="date_debut" class="form-label">Du :</label>
      <input type="date" id="date_debut" name="date_debut" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="date_fin" class="form-label">Au :</label>
      <input type="date" id="date_fin" name="date_fin" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-danger w-100">Annuler la plage</button>
  </form>
</main>
<footer class="footer bg-light text-center py-3 mt-5">
  <span>&copy; 2026 Amicale SPV Léon</span>
</footer>

</body>
</html>
