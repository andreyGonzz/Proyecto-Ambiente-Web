document.addEventListener('DOMContentLoaded', async () => {
    const API_ROOT = (typeof BASE_URL_ !== 'undefined' ? BASE_URL_ : '') + '/public/';
    if (!API_ROOT) return;

    const nombreEl = document.getElementById('navNombre');
    const nombreMovilEl = document.getElementById('navNombreMovil');
    const sesionEl = document.getElementById('navSesion');
    const sesionMovilEl = document.getElementById('navSesionMovil');
    const invitadoEl = document.getElementById('navInvitado');
    const invitadoMovilEl = document.getElementById('navInvitadoMovil');

    try {
        const respuesta = await fetch(API_ROOT + 'auth/apiSesion');
        const data = await respuesta.json();

        if (!respuesta.ok || !data.ok) {
            return;
        }

        const logueado = Boolean(data.logueado);

        if (logueado) {
            if (nombreEl) {
                nombreEl.textContent = 'Hola, ' + (data.nombre || '');
                nombreEl.classList.remove('d-none');
            }
            if (nombreMovilEl) {
                nombreMovilEl.textContent = 'Hola, ' + (data.nombre || '');
                nombreMovilEl.classList.remove('d-none');
            }
            if (sesionEl) {
                sesionEl.classList.remove('d-none');
            }
            if (sesionMovilEl) {
                sesionMovilEl.classList.remove('d-none');
            }
            if (invitadoEl) {
                invitadoEl.classList.add('d-none');
            }
            if (invitadoMovilEl) {
                invitadoMovilEl.classList.add('d-none');
            }
        } else {
            if (sesionEl) {
                sesionEl.classList.add('d-none');
            }
            if (sesionMovilEl) {
                sesionMovilEl.classList.add('d-none');
            }
            if (invitadoEl) {
                invitadoEl.classList.remove('d-none');
            }
            if (invitadoMovilEl) {
                invitadoMovilEl.classList.remove('d-none');
            }
        }
    } catch (error) {
        // sin sesión conocida se mantiene el estado oculto
    }
});