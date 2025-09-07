const images = document.querySelectorAll('.gallery img');
images.forEach(img => {
  img.addEventListener('click', () => {
    const fullImg = document.createElement('img');
    fullImg.src = img.src;
    fullImg.style.width = '100%';
    fullImg.style.position = 'fixed';
    fullImg.style.top = '0';
    fullImg.style.left = '0';
    fullImg.style.zIndex = '1000';
    document.body.appendChild(fullImg);
    fullImg.addEventListener('click', () => {
      document.body.removeChild(fullImg);
    });
  });
});


// class="gallery"