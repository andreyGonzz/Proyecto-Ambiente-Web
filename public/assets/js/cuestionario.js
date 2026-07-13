// public/assets/js/cuestionario.js
document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.selection-card');
    const nextBtn = document.getElementById('nextBtn');

    function enableNext() {
        if (nextBtn) {
            nextBtn.disabled = false;
            nextBtn.classList.remove('disabled');
        }
    }

    function clearSelected() {
        cards.forEach(c => {
            c.classList.remove('selected');
            c.setAttribute('aria-pressed', 'false');
        });
    }

    cards.forEach(card => {
        card.addEventListener('click', function () {
            clearSelected();
            this.classList.add('selected');
            this.setAttribute('aria-pressed', 'true');
            enableNext();
            // Optional haptic feedback
            if (navigator.vibrate) navigator.vibrate(50);
        });

        // keyboard accessibility: activate on Enter or Space
        card.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });

    // Prevent form submit if inside a form
    if (nextBtn) {
        nextBtn.addEventListener('click', function () {
            // Here you can collect the selected value and submit via fetch or form
            const selected = document.querySelector('.selection-card.selected');
            const value = selected ? selected.getAttribute('data-value') : null;
            console.log('Siguiente pulsado. Opción:', value);
            // Example: dispatch custom event for upstream code
            document.dispatchEvent(new CustomEvent('cuestionario:next', {detail:{value}}));
        });
    }
});
