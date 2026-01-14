// /js/auth/reservation.js
// Appel automatique à l'import du module (SPA/routage)
initReservationPage();

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
  // Détecter mobile

  const isMobile = window.innerWidth <= 600;
  if (!isMobile) {
    // Desktop : FullCalendar classique
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
        if (endInclusive < info.start) endInclusive = new Date(info.start);
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
    return;
  }

  // MOBILE : Listing par semaine

  // --- Navigation mobile par mois ---
  let mobileMonth = (new Date()).getMonth();
  let mobileYear = (new Date()).getFullYear();

  function renderMobileMonth() {
    fetch('/php/get_reservations.php')
      .then(r => r.json())
      .then(events => {
        const year = mobileYear;
        const month = mobileMonth;
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        // Indexer les réservations par date
        const reserved = {};
        events.forEach(ev => {
          const d = new Date(ev.start);
          if (d.getFullYear() === year && d.getMonth() === month) {
            reserved[d.getDate()] = true;
          }
        });
        // Générer le HTML par semaine
        let html = '<div class="resa-mobile-nav"><button class="resa-mobile-btn" id="resaPrevMonth">◀</button>';
        html += `<span class="resa-mobile-month">${getMonthName(month)} ${year}</span>`;
        html += '<button class="resa-mobile-btn" id="resaNextMonth">▶</button></div>';
        html += '<div class="resa-listing-mobile-week">';
        let week = [];
        let firstDay = new Date(year, month, 1).getDay(); // 0=dimanche, 1=lundi
        firstDay = firstDay === 0 ? 7 : firstDay; // Pour commencer la semaine au lundi
        for (let i = 1; i < firstDay; i++) {
          week.push(null);
        }
        for (let d = 1; d <= daysInMonth; d++) {
          week.push(d);
          if (week.length === 7 || d === daysInMonth) {
            html += '<div class="resa-week-row">';
            week.forEach(day => {
              if (day === null) {
                html += '<div class="resa-day-cell empty"></div>';
              } else {
                const isReserved = reserved[day];
                // Ajout d'un data-date pour la sélection JS
                html += `<div class="resa-day-cell${isReserved ? ' reserved' : ' free'}" data-day="${day}">
                  <span class="dot ${isReserved ? 'dot-red' : 'dot-green'}"></span>
                  <div class="resa-day-num">${day}</div>
                </div>`;
              }
            });
            html += '</div>';
            week = [];
          }
        }
        html += '</div>';
        calendarEl.innerHTML = html;
        // Ajout listeners navigation
        document.getElementById('resaPrevMonth').onclick = () => {
          if (mobileMonth === 0) { mobileMonth = 11; mobileYear--; } else { mobileMonth--; }
          renderMobileMonth();
        };
        document.getElementById('resaNextMonth').onclick = () => {
          if (mobileMonth === 11) { mobileMonth = 0; mobileYear++; } else { mobileMonth++; }
          renderMobileMonth();
        };

        // Sélection interactive des dates libres
        const dayCells = calendarEl.querySelectorAll('.resa-day-cell.free');
        let selectionStep = 0; // 0: début, 1: fin
        let firstDate = null;
        dayCells.forEach(cell => {
          cell.onclick = () => {
            const day = cell.getAttribute('data-day');
            const dateStr = `${year}-${(month+1).toString().padStart(2,'0')}-${day.toString().padStart(2,'0')}`;
            if (selectionStep === 0) {
              document.getElementById('date_debut').value = dateStr;
              document.getElementById('date_fin').value = '';
              firstDate = dateStr;
              selectionStep = 1;
            } else {
              // Si la 2e date est avant la 1re, on inverse
              let d1 = new Date(firstDate);
              let d2 = new Date(dateStr);
              if (d2 < d1) {
                document.getElementById('date_debut').value = dateStr;
                document.getElementById('date_fin').value = firstDate;
              } else {
                document.getElementById('date_fin').value = dateStr;
              }
              selectionStep = 0;
            }
            // Mettre à jour le montant
            if (typeof updateMontant === 'function') updateMontant();
          };
        });
      });
  }

  function getMonthName(m) {
    return ['janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre'][m];
  }

  renderMobileMonth();

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

      // Correction si AU < DU (toujours envoyer la plage complète)
      let d1 = new Date(start);
      let d2 = new Date(end);
      if (d2 < d1) {
        [start, end] = [end, start];
      }

      try {
        const resp = await fetch('/php/add_reservation.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ date_debut: start, date_fin: end, nom_reservant: nom })
        });
        if (!resp.ok) throw new Error('Erreur réseau ou serveur.');
        const data = await resp.json();
        alert(data.message);
        // Rechargement du listing mobile ou du calendrier desktop
        if (typeof renderMobileMonth === 'function') renderMobileMonth();
        if (typeof calendar !== 'undefined' && calendar.refetchEvents) calendar.refetchEvents();
      } catch (err) {
        alert('Erreur réseau ou serveur.');
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