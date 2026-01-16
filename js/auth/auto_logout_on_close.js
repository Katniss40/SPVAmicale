// Auto-logout on tab/window close: uses navigator.sendBeacon or fetch keepalive
(function(){
  const SIGNOUT_PATH = '/php/signout.php';
  const signoutUrl = (function(){
    try { return new URL(SIGNOUT_PATH, window.location.origin).toString(); }
    catch(e){ return SIGNOUT_PATH; }
  })();

  function sendSignoutViaBeacon() {
    try {
      if (navigator.sendBeacon) {
        // sendBeacon uses POST and sends cookies on same-origin
        navigator.sendBeacon(signoutUrl);
        console.debug('auto-logout: sendBeacon sent to', signoutUrl);
        return true;
      }
    } catch(e){ console.debug('auto-logout: sendBeacon failed', e); }
    return false;
  }

  async function sendSignoutViaFetch() {
    try {
      await fetch(signoutUrl, { method: 'POST', keepalive: true, credentials: 'same-origin' });
      console.debug('auto-logout: fetch keepalive sent to', signoutUrl);
      return true;
    } catch(e){ console.debug('auto-logout: fetch failed', e); }
    return false;
  }

  function signoutTry() {
    // Try sendBeacon first, then fetch keepalive
    if (!sendSignoutViaBeacon()) {
      // best-effort async call
      sendSignoutViaFetch();
    }
  }

  // pagehide: fired on tab close / page unload in most browsers
  window.addEventListener('pagehide', function(ev){
    signoutTry();
  }, {capture: true});

  // visibilitychange: when tab becomes hidden (e.g., user switches app)
  document.addEventListener('visibilitychange', function(){
    if (document.visibilityState === 'hidden') signoutTry();
  });

  // fallback: beforeunload
  window.addEventListener('beforeunload', function(){
    signoutTry();
  });

})();
