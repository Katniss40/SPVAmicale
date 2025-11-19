/* admin-dates.js
   - adminDatesInit(page)
   Loads editable dates for the given page and, if the connected user is admin,
   injects a small admin panel to edit them.
*/
(function () {
  async function fetchJson(url, opts) {
    const res = await fetch(url, opts);
    if (!res.ok) throw new Error('HTTP ' + res.status);
    return res.json();
  }

  async function loadDates(page) {
    try {
      const dates = await fetchJson('/php/get_dates.php?page=' + encodeURIComponent(page));
      Object.keys(dates).forEach(key => {
        const el = document.getElementById(key);
        if (!el) return;
        // If this is a team list, render as inline member badges for compact display
        if (key.startsWith('equipe_')) {
          el.innerHTML = formatTeamForDisplay(dates[key]);
        } else {
          el.innerHTML = dates[key];
        }
      });
      return dates;
    } catch (e) {
      console.warn('Impossible de charger les dates', e);
      return {};
    }
  }

  // Convert stored value (which may contain <br> or commas or newlines) into
  // an HTML fragment with .team-members and .member spans for inline display.
  function formatTeamForDisplay(raw) {
    if (!raw) return '';
    // Normalize: replace <br> with newline, then split on newlines or commas
    const normalized = String(raw).replace(/<br\s*\/?/gi, '\n');
    // Split on newlines, or on commas if no newlines found
    let parts = normalized.split(/\n+/).map(s => s.trim()).filter(Boolean);
    if (parts.length === 1) {
      // maybe comma-separated
      parts = parts[0].split(/\s*,\s*/).map(s => s.trim()).filter(Boolean);
    }
    // Build HTML
    const membersHtml = parts.map((p) => '<span class="member">' + escapeHtml(p.replace(/^[-\s]+/, '')) + '</span>').join(',\n                            ');
    return '<span class="team-members">' + membersHtml + '</span>';
  }

  // small helper to avoid injecting raw HTML when building member spans
  function escapeHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }

  async function checkIsAdmin() {
    try {
      const info = await fetchJson('/php/verification.php');
      return info.role === 'admin';
    } catch (e) {
      return false;
    }
  }

  async function saveDate(page, key, value, inputEl, statusEl) {
    try {
      statusEl.textContent = 'Enregistrement...';
      const res = await fetch('/php/update_date.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ page, key, value })
      });
      const j = await res.json();
      if (res.ok && j.success) {
  const span = document.getElementById(key);
  if (span) {
    if (key.startsWith('equipe_')) {
      span.innerHTML = formatTeamForDisplay(value);
    } else {
      span.innerHTML = value;
    }
  }
        statusEl.textContent = 'OK';
        setTimeout(() => statusEl.textContent = '', 1500);
      } else {
        statusEl.textContent = j.message || 'Erreur';
      }
    } catch (e) {
      statusEl.textContent = 'Erreur réseau';
    }
  }

  window.adminDatesInit = async function (page) {
    // Normaliser la clé de page : la route '/' peut produire une string vide => utiliser 'home'
    const pageKey = (page && String(page).trim()) ? String(page).trim() : 'home';
    // Avoid duplicate panels: if one exists, we'll remove it and recreate for the
    // requested page. Also if the user is not admin but a panel exists (left by
    // a previous navigation), remove it.
    const existingPanel = document.getElementById('admin-dates-panel');
    const isAdmin = await checkIsAdmin();
    if (!isAdmin) {
      if (existingPanel) existingPanel.remove();
      return;
    }
    if (existingPanel) existingPanel.remove();
    const dates = await loadDates(pageKey);

    // build panel
    const panel = document.createElement('div');
    panel.id = 'admin-dates-panel';
    panel.style.border = '1px solid #ccc';
    panel.style.padding = '12px';
    panel.style.margin = '12px';
    panel.style.background = '#f8f9fa';
    panel.style.maxWidth = '720px';
    panel.innerHTML = '<h4>Admin — modifier les dates</h4>';

    const list = document.createElement('div');
    // helper : generate friendly label
    const friendlyLabel = (k) => {
      if (k.startsWith('equipe_')) return k.replace('equipe_', 'Équipe ').replace(/_/g, ' ');
      if (k === 'title_bal_pompiers') return 'Titre — Bal des Pompiers';
      if (k.startsWith('date_')) return k.replace('date_', '').replace(/_/g, ' ');
      if (k.startsWith('horaires')) return 'Horaires — ' + k.replace('horaires_', '').replace(/_/g, ' ');
      return k;
    };

    Object.keys(dates).forEach(key => {
      const row = document.createElement('div');
      row.style.display = 'flex';
      row.style.flexDirection = 'row';
      row.style.gap = '8px';
      row.style.alignItems = 'center';
      row.style.marginBottom = '8px';

      const label = document.createElement('label');
      label.textContent = friendlyLabel(key);
      label.style.minWidth = '180px';
      label.htmlFor = 'admin_input_' + key;

      // Use textarea for multiline/team lists or when value contains <br>
      const isMultiline = key.startsWith('equipe_') || (String(dates[key] || '').includes('<br>'));
      let input;
      if (isMultiline) {
        input = document.createElement('textarea');
        input.rows = 6;
        input.style.resize = 'vertical';
        // convert <br> to newlines for editing
        input.value = String(dates[key] || '').replace(/<br\s*\/?>/gi, '\n');
      } else {
        input = document.createElement('input');
        input.type = 'text';
        input.value = dates[key] || '';
      }
      input.id = 'admin_input_' + key;
      input.style.flex = '1';

      const btn = document.createElement('button');
      btn.type = 'button';
      btn.textContent = 'Enregistrer';
      btn.style.marginLeft = '6px';

      const status = document.createElement('span');
      status.style.marginLeft = '8px';
      status.style.color = '#28a745';

      btn.addEventListener('click', () => {
        // prepare value: convert newlines to <br> for multiline fields
        let outVal = input.value.trim();
        if (isMultiline) outVal = outVal.replace(/\r?\n/g, '<br>');
        saveDate(pageKey, key, outVal, input, status);
      });

      row.appendChild(label);
      row.appendChild(input);
      row.appendChild(btn);
      row.appendChild(status);
      list.appendChild(row);
    });

    panel.appendChild(list);

      // Insertion strategy (prefer the injected page area). We must account for
      // timing: the router may call adminDatesInit before the page fragment is
      // fully inserted into #main-page. We'll poll briefly for elements inside
      // #main-page (nav.navbar or .hero-scene) and prefer those. If nothing
      // appears within the timeout we fall back to the global selectors.
      function doInsert() {
        // highest priority: explicit anchor inside injected content
        const anchor = document.querySelector('#main-page #admin-panel-anchor');
        if (anchor) {
          anchor.replaceWith(panel);
          return true;
        }
        // fresh queries each attempt
        let navs = document.querySelectorAll('#main-page nav.navbar');
        if (!navs || navs.length === 0) navs = document.querySelectorAll('nav.navbar');
        const heroInMain = document.querySelector('#main-page .hero-scene');

        if (navs && navs.length > 0) {
          const lastNav = navs[navs.length - 1];
          lastNav.insertAdjacentElement('afterend', panel);
          return true;
        } else if (heroInMain && heroInMain.parentNode) {
          heroInMain.insertAdjacentElement('afterend', panel);
          return true;
        } else {
          const hero = document.querySelector('.hero-scene');
          if (hero && hero.parentNode) {
            hero.insertAdjacentElement('afterend', panel);
            return true;
          } else {
            const target = document.querySelector('.container') || document.body;
            target.insertAdjacentElement('afterbegin', panel);
            return true;
          }
        }
      }

      // Poll a few times to wait for #main-page content to be inserted.
      // If nothing appears within ~600ms we perform the fallback insertion.
      const maxAttempts = 12; // 12 * 50ms = 600ms
      let attempt = 0;
      const tryInsert = () => {
        attempt += 1;
        // If hero or nav in #main-page exists now, prefer it; otherwise retry.
        const heroInMainNow = document.querySelector('#main-page .hero-scene');
        const navsInMainNow = document.querySelectorAll('#main-page nav.navbar');
        if ((heroInMainNow && heroInMainNow.parentNode) || (navsInMainNow && navsInMainNow.length > 0) || attempt >= maxAttempts) {
          doInsert();
        } else {
          setTimeout(tryInsert, 50);
        }
      };
      tryInsert();
  };

})();
