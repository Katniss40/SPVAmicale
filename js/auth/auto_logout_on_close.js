// Auto-logout on tab/window close: uses navigator.sendBeacon or fetch keepalive
(function(){
  async function signoutKeepalive() {
    const url = '/php/signout.php';
    try {
      if (navigator.sendBeacon) {
        navigator.sendBeacon(url);
      } else {
        await fetch(url, { method: 'POST', keepalive: true });
      }
    } catch(e) {
      // ignore errors
    }
  }

  // pagehide fires on tab close / navigation; reliable for sendBeacon
  window.addEventListener('pagehide', function(ev){
    // Only sign out when page is being unloaded (not when navigating within SPA)
    signoutKeepalive();
  }, {capture: true});

  // also try beforeunload as fallback
  window.addEventListener('beforeunload', function(ev){
    try { if (navigator.sendBeacon) navigator.sendBeacon('/php/signout.php');
          else navigator.fetch && fetch('/php/signout.php', { method:'POST', keepalive:true });
    } catch(e){}
  });
})();
