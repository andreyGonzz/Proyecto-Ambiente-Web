document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('confetti-container');
    const colors = ['vt-confetti-color-1', 'vt-confetti-color-2', 'vt-confetti-color-3', 'vt-confetti-color-4'];
    const itemCount = 45;

    for (let i = 0; i < itemCount; i += 1) {
        const confetti = document.createElement('div');
        confetti.classList.add('vt-confetti-piece');
        confetti.classList.add(colors[i % colors.length]);

        if (Math.random() > 0.5) {
            confetti.classList.add('vt-confetti-shape-circle');
        }

        confetti.style.left = `${Math.random() * 100}%`;
        confetti.style.animationDelay = `${Math.random() * 3}s`;
        confetti.style.animationDuration = `${Math.random() * 2 + 3}s`;

        container.appendChild(confetti);
    }
});
