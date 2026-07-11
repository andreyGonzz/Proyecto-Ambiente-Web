document.addEventListener('DOMContentLoaded', () => {
    const recoverForm = document.getElementById('recover-form');
    const recoveryFormSection = document.getElementById('recovery-form-section');
    const confirmationSection = document.getElementById('confirmation-section');
    const emailInput = document.getElementById('email');
    const resetButton = document.querySelector('[data-action="reset-form"]');

    if (!recoverForm || !recoveryFormSection || !confirmationSection || !emailInput) {
        return;
    }

    recoverForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const email = emailInput.value.trim();

        if (email) {
            recoveryFormSection.classList.add('d-none');
            confirmationSection.classList.remove('d-none');
        }
    });

    if (resetButton) {
        resetButton.addEventListener('click', () => {
            recoverForm.reset();
            confirmationSection.classList.add('d-none');
            recoveryFormSection.classList.remove('d-none');
        });
    }
});
