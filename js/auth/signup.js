// Test ==>
alert("Hello world"); 

// Implementer le JS de ma page

const mailInput = document.getElementById("EmailInput");
const passwordInput = document.getElementById("PassewordInput");
const btnSignin = document.getElementById("btnSignin");

if(btnSignin) btnSignin.addEventListener("click", checkCredentials);

async function checkCredentials(e) {
    e && e.preventDefault();
    const email = mailInput.value.trim();
    const password = passwordInput.value;

    if(!email || !password){
        mailInput.classList.add("is-invalid");
        passwordInput.classList.add("is-invalid");
        return;
    }

    try {
        const resp = await fetch('/php/verification.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `EmailInput=${encodeURIComponent(email)}&PassewordInput=${encodeURIComponent(password)}`
        });

        const json = await resp.json();

        if(resp.ok && json.success){
            // si PHP a déjà mis les cookies via setcookie, on peut s'en servir.
            // Sinon, on va créer le cookie côté client à partir de la réponse.
            if(json.data && json.data.token && json.data.role){
                setCookie('accesstoken', json.data.token, 7);
                setCookie('role', json.data.role, 7);
            }
            // redirection vers la home (ou la route souhaitée)
            window.location.replace('/');
        } else {
            // échec
            mailInput.classList.add("is-invalid");
            passwordInput.classList.add("is-invalid");
        }
    } catch(err) {
        alert('Erreur réseau. Réessaye plus tard.');
    }
}