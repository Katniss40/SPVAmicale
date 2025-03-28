// Test ==>
// alert("Hello world");

const mailInput = document.getElementById("EmailInput");
const passwordInput = document.getElementById("PassewordInput");
const btnSignin = document.getElementById("btnSignin");


btnSignin.addEventListener("click", checkCredentials);

function checkCredentials() {
    //test ==>
    //alert("bouton cliqué");


    // Ici, il faudra appeler l'API pour vérifier les credentials en BDD

    if(mailInput.value == "admin@email.com" && passwordInput.value =="Admin-2025") {
        // Test ==>
        // alert("vous etes connecté");

        // Il faudra récuperer le vrai token
        const token = "lkjsdngfljsqdnglkjdbglkjqskjgkfjgbqslkfdgbskldfgdjgsdgf";
        setToken(token);

        // Placer ce token en cookie
        setCookie(RoleCookieName, "admin", 7);
        window.location.replace("/");
    }
    if(mailInput.value == "spv@email.com" && passwordInput.value =="Spv-2025") {
        // Test ==>
        // alert("vous etes connecté");

        // Il faudra récuperer le vrai token
        const token = "lkjsdngfljsqdnglkjdbglkjqskjgkfjgbqslkfdgbskldfgdjgsdgf";
        setToken(token);

        // Placer ce token en cookie
        setCookie(RoleCookieName, "spv", 7);
        window.location.replace("/");
    }
    else{
        mailInput.classList.add("is-invalid");
        passwordInput.classList.add("is-invalid");
    }
}