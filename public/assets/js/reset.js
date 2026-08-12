document.addEventListener('DOMContentLoaded', async () => {
    const API_ROOT = (typeof BASE_URL_ !== 'undefined' ? BASE_URL_ : '') + '/public/';
    if (!API_ROOT) return;

    const cargando = document.getElementById('resetCargando');
    const seccionFormulario = document.getElementById('resetFormSection');
    const seccionInvalido = document.getElementById('resetInvalido');
    const formulario = document.getElementById('resetForm');
    const campoTokken = document.getElementById('resetToken');
    const bloqueError = document.getElementById('resetError');

    const segmentos = window.location.pathname.split('/').filter(Boolean);
    const token = segmentos.length > 1 && /^[0-9a-f]{20,}$/i.test(segmentos[segmentos.length - 1])
        ? segmentos[segmentos.length - 1]
        : '';

    function mostrarMensaje(mensaje) {
        if (bloqueError) {
            bloqueError.textContent = mensaje;
            bloqueError.classList.remove('d-none');
        }
    }

    function validarToken() {
        return fetch(API_ROOT + 'auth/apiValidarToken/' + token)
            .then((res) => res.json())
            .then((data) => Boolean(data.ok && data.valido));
    }

    try {
        const valido = token ? await validarToken() : false;

        if (cargando) {
            cargando.classList.add('d-none');
        }

        if (!valido) {
            if (seccionInvalido) {
                seccionInvalido.classList.remove('d-none');
            }
            return;
        }

        if (seccionFormulario) {
            seccionFormulario.classList.remove('d-none');
        }

        if (campoTokken) {
            campoTokken.value = token;
        }

        if (formulario) {
            formulario.addEventListener('submit', async (event) => {
                event.preventDefault();

                if (bloqueError) {
                    bloqueError.classList.add('d-none');
                }

                const contrasena = formulario.querySelector('[name="password"]').value;
                const confirmacion = formulario.querySelector('[name="confirm_password"]').value;

                if (contrasena !== confirmacion) {
                    mostrarMensaje('Las contraseñas no coinciden.');
                    return;
                }

                const submitBtn = formulario.querySelector('button[type="submit"]');
                submitBtn.disabled = true;

                try {
                    const respuesta = await fetch(formulario.action, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ token, password: contrasena, confirm_password: confirmacion }),
                    });

                    const data = await respuesta.json();

                    if (data.ok) {
                        if (typeof Swal !== 'undefined') {
                            await Swal.fire({
                                icon: 'success',
                                title: '¡Contraseña actualizada!',
                                text: data.message,
                                timer: 2500,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            });
                        }
                        window.location.href = API_ROOT + 'auth/login';
                    } else {
                        mostrarMensaje(data.message || 'No se pudo actualizar la contraseña. Inténtalo de nuevo.');
                    }
                } catch (error) {
                    mostrarMensaje('No se pudo conectar con el servidor. Inténtalo de nuevo.');
                } finally {
                    submitBtn.disabled = false;
                }
            });
        }
    } catch (error) {
        if (cargando) {
            cargando.classList.add('d-none');
        }
        if (seccionInvalido) {
            seccionInvalido.classList.remove('d-none');
        }
    }
});