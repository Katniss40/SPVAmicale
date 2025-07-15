document.addEventListener('DOMContentLoaded', function () {

    function clearErrors() {
        document.querySelectorAll('.error-message').forEach(error => error.remove());
    }

    document.getElementById('signupForm').addEventListener('submit', function (e) {
        
        clearErrors();
        
        let formIsValid = true;
        
        document.querySelectorAll('.error').forEach(error => error.remove());

        const Role = document.getElementById('Role');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const confirm = document.getElementById('confirm_password');
        const niveau = document.getElementById('niveau');

        if (pseudo.value.trim().length < 4) {
            showError(Role, "Le Role doit contenir au moins 3 caractères.");
            formIsValid = false;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value.trim())) {
            showError(email, "Adresse email invalide.");
            formIsValid = false;
        }

        if (niveau.value === '') {
            showError(niveau, "Veuillez choisir votre niveau.");
            formIsValid = false;
        }

        const passwordValue = password.value;
        const confirmValue = confirm.value;
        const passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;

        if (!passwordRegex.test(passwordValue)) {
            showError(password, "Le mot de passe doit contenir au moins 8 caractères, une majuscule et un chiffre.");
            formIsValid = false;
        }

        if (passwordValue !== confirmValue) {
            showError(confirm, "Les mots de passe ne correspondent pas.");
            formIsValid = false;
        }

        if (!formIsValid) {
            e.preventDefault();
        }
    });

    function showError(input, message) {
        let errorElement = input.nextElementSibling;
        if (!errorElement || !errorElement.classList.contains('error-message')) {
            errorElement = document.createElement('div');
            errorElement.classList.add('error-message');
            errorElement.style.color = 'red';
            errorElement.style.fontSize = '0.9em';
            input.parentNode.insertBefore(errorElement, input.nextSibling);
        }
        errorElement.textContent = message;
    }
});