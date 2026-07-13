document.addEventListener('DOMContentLoaded', function () {
    const startButton = document.getElementById('startQuizBtn');

    if (!startButton) {
        return;
    }

    startButton.addEventListener('click', function (event) {
        const href = this.getAttribute('href');

        if (!href) {
            return;
        }

        event.preventDefault();
        this.classList.add('is-loading');
        this.setAttribute('aria-busy', 'true');

        const label = this.querySelector('.vt-btn-label');
        const icon = this.querySelector('.vt-btn-icon');

        if (label) {
            label.textContent = 'Preparando tu evaluación';
        }

        if (icon) {
            icon.textContent = 'hourglass_top';
        }

        window.setTimeout(function () {
            window.location.href = href;
        }, 650);
    });
});
