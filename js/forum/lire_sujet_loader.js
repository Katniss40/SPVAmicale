// JS/forum/lire_sujet_loader.js
export default async function initLireSujetPage() {
  // Récupère l'id du sujet depuis l'URL
  const params = new URLSearchParams(window.location.search);
  const idSujet = params.get('id_sujet_a_lire');
  if (!idSujet) {
    document.getElementById('main-page').innerHTML = '<div class="admin-card"><h2 class="titre-section">Sujet non défini.</h2></div>';
    return;
  }
  // Fetch la version partielle
  const url = `/forum/lire_sujet_content.php?id_sujet_a_lire=${encodeURIComponent(idSujet)}`;
  try {
    const html = await fetch(url, { credentials: 'include' }).then(r => r.text());
    document.getElementById('main-page').innerHTML = html;
    // Recharger le CSS spécifique si besoin
    if (!document.getElementById('lireSujetCss')) {
      const link = document.createElement('link');
      link.rel = 'stylesheet';
      link.href = '/assets/css/lire_sujet.css';
      link.id = 'lireSujetCss';
      document.head.appendChild(link);
    }
  } catch (err) {
    document.getElementById('main-page').innerHTML = '<h2>Erreur de chargement du sujet</h2>';
  }
}
