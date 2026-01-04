let currentPhotoIndex = 0;
let photos = [];

// Attacher les fonctions à window pour qu'elles soient accessibles depuis onclick
window.openLightbox = function(element) {
    initGallery();
    const img = element.querySelector('img');
    const src = img.getAttribute('data-full-src');
    currentPhotoIndex = photos.findIndex(p => p.src === src);
    displayPhoto();
    document.getElementById('photoLightbox').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

window.closeLightbox = function() {
    document.getElementById('photoLightbox').style.display = 'none';
    document.body.style.overflow = 'auto';
}

window.nextPhoto = function() {
    currentPhotoIndex = (currentPhotoIndex + 1) % photos.length;
    displayPhoto();
}

window.prevPhoto = function() {
    currentPhotoIndex = (currentPhotoIndex - 1 + photos.length) % photos.length;
    displayPhoto();
}

function initGallery() {
    const photoCards = document.querySelectorAll('.photo-card');
    photos = Array.from(photoCards).map(card => {
        const img = card.querySelector('img');
        return {
            src: img.getAttribute('data-full-src'),
            comment: img.getAttribute('data-comment')
        };
    });
}

function displayPhoto() {
    const photo = photos[currentPhotoIndex];
    document.getElementById('lightboxImage').src = photo.src;
    document.getElementById('lightboxComment').textContent = photo.comment;
}

// Navigation au clavier
document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('photoLightbox');
    if (lightbox && lightbox.style.display === 'flex') {
        if (e.key === 'ArrowRight') nextPhoto();
        if (e.key === 'ArrowLeft') prevPhoto();
        if (e.key === 'Escape') closeLightbox();
    }
});

// Fermer en cliquant en dehors
document.addEventListener('DOMContentLoaded', function() {
    const lightbox = document.getElementById('photoLightbox');
    if (lightbox) {
        lightbox.addEventListener('click', function(e) {
            if (e.target === this) closeLightbox();
        });
    }
});
