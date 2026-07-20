document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.selection-card');

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
            if (navigator.vibrate) navigator.vibrate(50);
        });

        card.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });
});
