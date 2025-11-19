const tokenCookieName = "accesstoken";
const RoleCookieName = "role";
const signoutBtn = document.getElementById("signout-btn");
if (signoutBtn) {
  signoutBtn.addEventListener("click", signout);
}

function getRole(){
    return getCookie(RoleCookieName);
}

function signout(){
    eraseCookie(tokenCookieName);
    eraseCookie(RoleCookieName);
    window.location.reload();
}

function setToken(token, days=7) {
    setCookie(tokenCookieName, token, days);
}

function getToken() {
    return getCookie(tokenCookieName);
}

function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        const date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + encodeURIComponent(value || "") + expires + "; path=/; samesite=Lax";
}


function getCookie(name) {
    let nameEQ = name + "=";
    let ca = document.cookie.split(';');
    for(let i=0;i < ca.length;i++){
        let c = ca[i].trim();
        if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length));
    }
    return null;
}


function eraseCookie(name) {
    document.cookie = name + "=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/";
}

function isConnected() {
    const t = getToken();
    return t !== null && t !== undefined && t !== '';
}

/* Test de co/deco
if(isConnected()) {
   // test 
   alert("Je suis connecté");
}
else {
    alert("Je ne suis pas connecté");
}*/


/*
disconnected
connected (admin ou spv)
    - admin
    - spv
*/

function showAndHideElementsForRoles(){
    const userConnected = isConnected();
    const role = getRole();

    let allElementsToEdit = document.querySelectorAll('[data-show]');

    allElementsToEdit.forEach(element =>{
        switch(element.dataset.show){
            case 'disconnected': 
                if(userConnected){
                    element.classList.add("d-none");
                }
                break;
            case 'connected': 
                if(!userConnected){
                    element.classList.add("d-none");
                }
                break;
            case 'admin': 
                if(!userConnected || role != "admin"){
                    element.classList.add("d-none");
                }
                break;
            case 'actif': 
                if(!userConnected || role != "actif"){
                    element.classList.add("d-none");
                }
                break;
            case 'old': 
                if(!userConnected || role != "old"){
                    element.classList.add("d-none");
                }
                break;
        }
    })
}

const form = document.querySelector('form');
if (form) {
  form.addEventListener('submit', function (event) {
    const name = document.getElementById('name')?.value || '';
    const email = document.getElementById('email')?.value || '';
    const subject = document.getElementById('subject')?.value || '';
    const message = document.getElementById('message')?.value || '';

    if (name === '' || email === '' || subject === '' || message === '') {
      alert('Veuillez remplir tous les champs.');
      event.preventDefault();
    }
  });
}



function togglePassword() {
      const passwordField = document.getElementById('password');
      const toggleButton = document.querySelector('.toggle-btn');
      
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleButton.textContent = 'Masquer';
      } else {
        passwordField.type = 'password';
        toggleButton.textContent = 'Afficher';
      }
    }

// Afficher ou cacher le bouton selon le défilement
window.onscroll = function () {
  const button = document.getElementById("backToTop");
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    button.style.display = "block";
  } else {
    button.style.display = "none";
  }
};

// Fonction pour remonter en haut de la page
function scrollToTop() {
  window.scrollTo({ top: 0, behavior: "smooth" });
}