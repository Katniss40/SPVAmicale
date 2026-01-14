// JS pour la page d'annulation admin fendeuse
export default async function initAnnulFendeusePage() {
  // Listing des réservations avec bouton annulation
  async function loadReservations() {
    const container = document.getElementById('resa-listing');
    if (!container) return;
    container.innerHTML = '<em>Chargement...</em>';
    const resp = await fetch('/php/get_reservations.php');
    const data = await resp.json();
    if (!Array.isArray(data) || data.length === 0) {
      container.innerHTML = '<div class="alert alert-info">Aucune réservation en cours.</div>';
      return;
    }
    let html = '<table class="table table-bordered"><thead><tr><th>Nom</th><th>Du</th><th>Au</th><th>Action</th></tr></thead><tbody>';
    for (const resa of data) {
      html += `<tr><td>${resa.title}</td><td>${resa.start.slice(0,10)}</td><td>${resa.end ? new Date(new Date(resa.end).getTime()-86400000).toISOString().slice(0,10) : ''}</td><td><button class="btn btn-danger btn-sm" data-id="${resa.id}">Annuler tout</button></td></tr>`;
    }
    html += '</tbody></table>';
    container.innerHTML = html;
    // Ajout listeners sur les boutons
    container.querySelectorAll('button[data-id]').forEach(btn => {
      btn.addEventListener('click', async e => {
        if (!confirm('Confirmer l\'annulation complète de cette réservation ?')) return;
        const id = btn.getAttribute('data-id');
        const resp = await fetch('/php/delete_reservation.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ id })
        });
        const d = await resp.json();
        alert(d.message || 'Annulation effectuée.');
        loadReservations();
      });
    });
  }
  await loadReservations();
  // Soumission AJAX annulation partielle (dates)
  const form = document.getElementById('formAnnul');
  if (form) {
    form.addEventListener('submit', async function(e) {
      e.preventDefault();
      const dateDebut = document.getElementById('date_debut').value;
      const dateFin = document.getElementById('date_fin').value;
      if (!dateDebut || !dateFin) {
        alert('Veuillez remplir les deux dates.');
        return;
      }
      const body = { date_debut: dateDebut, date_fin: dateFin };
      try {
        const resp = await fetch('/php/delete_reservation.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(body)
        });
        const d = await resp.json();
        alert(d.message || 'Annulation effectuée.');
        loadReservations();
      } catch (err) {
        alert('Erreur réseau ou serveur : ' + err.message);
      }
    });
  }
}
