document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('confirm_password');
    const togglePasswordBtn = document.getElementById('togglePassword');
    const visibilityIcon = document.getElementById('visibilityIcon');
    const toggleConfirmBtn = document.getElementById('toggleConfirmPassword');
    const confirmVisibilityIcon = document.getElementById('confirmVisibilityIcon');
    const strengthEl = document.getElementById('passwordStrength');
    const strengthBars = strengthEl ? strengthEl.querySelectorAll('span') : [];
    const strengthLabel = document.getElementById('strengthLabel');

    function togglePassword(input, icon, button) {
        if (!input || !icon || !button) return;
        button.addEventListener('click', () => {
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            icon.textContent = type === 'password' ? 'visibility_off' : 'visibility';
        });
    }

    togglePassword(passwordInput, visibilityIcon, togglePasswordBtn);
    togglePassword(confirmInput, confirmVisibilityIcon, toggleConfirmBtn);

    if (!passwordInput || !strengthEl || !strengthBars.length || !strengthLabel) {
        return;
    }

    const strengthTexts = ['Débil', 'Media', 'Buena', 'Fuerte'];
    const levelColors = [
        'var(--color-error)',
        'var(--color-secondary)',
        'var(--color-tertiary)',
        'var(--color-tertiary)',
    ];

    passwordInput.addEventListener('input', () => {
        const value = passwordInput.value;
        let score = 0;

        if (value.length >= 8) score++;
        if (value.length >= 12) score++;
        if (/[a-z]/.test(value) && /[A-Z]/.test(value)) score++;
        if (/\d/.test(value)) score++;
        if (/[^A-Za-z0-9]/.test(value)) score++;

        const level = score <= 1 ? 1 : score === 2 ? 2 : score === 3 ? 3 : 4;

        strengthBars.forEach((bar, i) => {
            bar.classList.toggle('active', i < level);
        });

        strengthEl.classList.remove('level-1', 'level-2', 'level-3', 'level-4');
        strengthEl.classList.add('level-' + level);

        strengthLabel.textContent = strengthTexts[level - 1];
        strengthLabel.style.color = levelColors[level - 1];
    });
});
