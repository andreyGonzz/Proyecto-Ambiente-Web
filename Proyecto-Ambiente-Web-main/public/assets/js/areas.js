document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.relleno').forEach((bar) => {
        const target = `${bar.getAttribute('data-target')}%`;
        setTimeout(() => {
            bar.style.width = target;
        }, 300);
    });
});
