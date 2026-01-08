// JS/contact.js

// On cible le formulaire de contact (le premier <form> trouvé sur la page)
const contactForm = document.querySelector('form');

if (contactForm) {
  contactForm.addEventListener('submit', function(event) {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const subject = document.getElementById('subject').value.trim();
    const message = document.getElementById('message').value.trim();

    if (name === '' || email === '' || subject === '' || message === '') {
      alert('Veuillez remplir tous les champs, Merci.');
      event.preventDefault(); // Empêche l’envoi du formulaire vide
    }
  });
}