document.addEventListener('DOMContentLoaded', () => {
    const togglePasswordBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const visibilityIcon = document.getElementById('visibilityIcon');
    const messageArea = document.getElementById('messageArea');
    const messageText = document.getElementById('messageText');
    const messageIcon = document.getElementById('messageIcon');
    const loginForm = document.getElementById('loginForm');

    if (!togglePasswordBtn || !passwordInput || !visibilityIcon || !messageArea || !messageText || !messageIcon || !loginForm) {
        return;
    }

    togglePasswordBtn.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        visibilityIcon.textContent = type === 'password' ? 'visibility_off' : 'visibility';
    });

    loginForm.addEventListener('submit', (event) => {
        event.preventDefault();
        messageArea.className = 'rounded-3 p-3 d-flex align-items-center gap-2';
        const email = document.getElementById('email').value;

        if (email.includes('error')) {
            messageArea.classList.add('bg-danger-subtle', 'text-danger');
            messageIcon.textContent = 'error';
            messageText.textContent = 'Las credenciales ingresadas son incorrectas. Inténtalo de nuevo.';
        } else {
            messageArea.classList.add('bg-success-subtle', 'text-success');
            messageIcon.textContent = 'check_circle';
            messageText.textContent = 'Inicio de sesión exitoso. Redirigiendo...';
        }
    });
});
