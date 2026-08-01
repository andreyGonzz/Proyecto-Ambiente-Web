document.addEventListener('DOMContentLoaded', () => {
    const recoverForm = document.getElementById('recover-form');
    const recoveryFormSection = document.getElementById('recovery-form-section');
    const confirmationSection = document.getElementById('confirmation-section');
    const emailInput = document.getElementById('email');
    const resetButton = document.querySelector('[data-action="reset-form"]');
    const messageArea = document.getElementById('messageArea');
    const messageText = document.getElementById('messageText');
    const messageIcon = document.getElementById('messageIcon');

    if (!recoverForm || !recoveryFormSection || !confirmationSection || !emailInput) {
        return;
    }

    const showMessage = (type, text) => {
        if (!messageArea || !messageText || !messageIcon) {
            return;
        }
        messageArea.className = 'rounded-3 p-3 d-flex align-items-center gap-2';
        if (type === 'error') {
            messageArea.classList.add('bg-danger-subtle', 'text-danger');
            messageIcon.textContent = 'error';
        } else {
            messageArea.classList.add('bg-success-subtle', 'text-success');
            messageIcon.textContent = 'check_circle';
        }
        messageText.textContent = text;
    };

    recoverForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        const email = emailInput.value.trim();

        if (!email) {
            return;
        }

        const submitBtn = recoverForm.querySelector('button[type="submit"]');
        submitBtn.disabled = true;

        try {
            const response = await fetch(recoverForm.action, {
                method: 'POST',
                body: new FormData(recoverForm),
            });

            const data = await response.json();

            if (data.ok) {
                recoveryFormSection.classList.add('d-none');
                confirmationSection.classList.remove('d-none');
            } else {
                showMessage('error', data.message || 'Ocurrió un error. Inténtalo de nuevo.');
            }
        } catch (error) {
            showMessage('error', 'No se pudo conectar con el servidor. Inténtalo de nuevo.');
        } finally {
            submitBtn.disabled = false;
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
