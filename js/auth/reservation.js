// /js/auth/reservation.js
export default function initReservationPage() {
  const calendarEl = document.getElementById('calendar');
  const inputDebut = document.getElementById('date_debut');
  const inputFin = document.getElementById('date_fin');
  const nomInput = document.getElementById('nom_reservant');
  const montantEl = document.getElementById('montant-total');
  const prixParJour = 15;

  if (!calendarEl || !inputDebut || !inputFin || !nomInput || !montantEl) return;

  // --- Calcul du nombre de jours inclusifs ---
  function calcNbJours(start, end) {
    const s = new Date(start.getFullYear(), start.getMonth(), start.getDate());
    const e = new Date(end.getFullYear(), end.getMonth(), end.getDate());
    const diff = (e - s) / (1000 * 60 * 60 * 24);
    return diff >= 0 ? diff + 1 : 0;
  }

  // --- Mise à jour du montant ---
  function updateMontant() {
    if (!inputDebut.value) {
      montantEl.textContent = `Montant total : 0 €`;
      return;
    }
    const start = new Date(inputDebut.value);
    let end = inputFin.value ? new Date(inputFin.value) : start;

    // Correction si AU < DU
    if (end < start) end = start;

    const nb = calcNbJours(start, end);
    montantEl.textContent = `Montant total : ${nb * prixParJour} €`;
  }

  inputDebut.addEventListener('change', updateMontant);
  inputFin.addEventListener('change', updateMontant);

  // --- FullCalendar ---
  const calendar = new FullCalendar.Calendar(calendarEl, {
    locale: 'fr',
    selectable: true,
    selectMirror: true,
    initialView: 'dayGridMonth',
    headerToolbar: { left: 'prev,next today', center: 'title', right: '' },
    events: '/php/get_reservations.php',

    select: function(info) {
      let endInclusive = new Date(info.end);
      endInclusive.setDate(endInclusive.getDate() + 1);

      // Correction si end < start
      if (endInclusive < info.start) endInclusive = new Date(info.start);

      // Remplissage des inputs en format yyyy-MM-dd
      inputDebut.value = info.start.toISOString().split('T')[0];
      inputFin.value = endInclusive.toISOString().split('T')[0];

      updateMontant();
    },

    eventClick: function(info) {
      const title = info.event.title || '';
      if (title.includes(nomInput.value)) {
        if (confirm("Voulez-vous annuler cette réservation ?")) {
          const start = info.event.startStr;
          const end = info.event.endStr || start;
          fetch("/php/reservation.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "annuler_debut=" + encodeURIComponent(start) +
                  "&annuler_fin=" + encodeURIComponent(end)
          })
          .then(r => r.json())
          .then(d => {
            alert(d.message);
            if (d.success) calendar.refetchEvents();
          });
        }
      } else {
        alert("Vous ne pouvez annuler que vos propres réservations.");
      }
    }
  });

  calendar.render();

  // --- Soumission formulaire ---
  const form = document.getElementById('formResa');
  if (form) {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      let start = inputDebut.value;
      let end = inputFin.value;
      const nom = nomInput.value.trim();

      if (!start || !end || !nom) {
        alert('Veuillez remplir tous les champs.');
        return;
      }

      // Correction si AU < DU
      if (new Date(end) < new Date(start)) end = start;

      try {
        const resp = await fetch('/php/add_reservation.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ date_debut: start, date_fin: end, nom_reservant: nom })
        });
        const data = await resp.json();
        alert(data.message);
        if (data.success) calendar.refetchEvents();
      } catch (err) {
        console.error(err);
        alert('Erreur réseau.');
      }
    });
  }

  // --- Annulation via bouton ---
  const btnAnnuler = document.getElementById('btnAnnuler');
  if (btnAnnuler) {
    btnAnnuler.addEventListener('click', () => {
      const date = inputDebut.value;
      if (!date) {
        alert("Veuillez sélectionner une date à annuler.");
        return;
      }
      if (confirm(`Voulez-vous vraiment annuler la réservation du ${date} ?`)) {
        fetch("/php/delete_reservation.php", {
          method: "POST",
          headers: {"Content-Type": "application/json"},
          body: JSON.stringify({ date_debut: date, date_fin: inputFin.value })
        })
        .then(r => r.json())
        .then(d => {
          alert(d.message);
          if (d.success) location.reload();
        });
      }
    });
  }
}