// Image editing UI disabled.
// This file is left as a stub to avoid errors if other code attempts to load it.
(function(){
  window.adminImagesInit = function(){
    console.info('admin-images: disabled');
    // ensure any existing panel is removed
    try{ Array.from(document.querySelectorAll('#admin-images-panel')).forEach(e=>e.remove()); }catch(e){}
  };
})();
