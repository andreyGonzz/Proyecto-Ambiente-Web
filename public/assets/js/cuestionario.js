document.addEventListener('DOMContentLoaded', function () {
    const API_ROOT = (typeof BASE_URL_ !== 'undefined' ? BASE_URL_ : '') + '/public/';
    if (!API_ROOT) return;

    const cfg = {
        urlPreguntas: API_ROOT + 'cuestionario/apiPreguntas',
        urlGuardar: API_ROOT + 'cuestionario/apiGuardar',
        urlResultado: API_ROOT + 'cuestionario/resultado',
        urlLogin: API_ROOT + 'auth/login',
    };

    const letras = ['A', 'B', 'C', 'D', 'E'];
    const storageKey = 'vocatio_respuestas';

    const elTitulo = document.getElementById('preguntaTitulo');
    const elModulo = document.getElementById('preguntaModulo');
    const elGrid = document.getElementById('opcionesGrid');
    const elContador = document.getElementById('contadorPregunta');
    const elModuloLabel = document.getElementById('moduloLabel');
    const elBarra = document.getElementById('barraProgreso');
    const elPrev = document.getElementById('prevBtn');
    const elNext = document.getElementById('nextBtn');
    const elNextText = document.getElementById('nextBtnText');
    const elError = document.getElementById('mensajeError');

    let preguntas = [];
    let actual = 0;
    let respuestas = {};
    let guardando = false;

    try {
        respuestas = JSON.parse(localStorage.getItem(storageKey) || '{}');
    } catch (e) {
        respuestas = {};
    }

    const guardarLocales = () => {
        try {
            localStorage.setItem(storageKey, JSON.stringify(respuestas));
        } catch (e) { /* almacenamiento no disponible */ }
    };

    const mostrarError = (mensaje) => {
        elError.textContent = mensaje;
        elError.classList.remove('d-none');
    };

    const capitalizar = (texto) => texto.charAt(0).toUpperCase() + texto.slice(1);

    function renderPregunta() {
        const pregunta = preguntas[actual];
        const nro = actual + 1;

        elTitulo.textContent = pregunta.enunciado;
        elModulo.textContent = 'Módulo de ' + capitalizar(pregunta.modulo);
        elModuloLabel.textContent = 'Módulo de ' + capitalizar(pregunta.modulo);
        elContador.textContent = 'Pregunta ' + nro + ' de ' + preguntas.length;

        const pct = Math.round((nro - 1) / preguntas.length * 100);
        elBarra.style.width = pct + '%';
        elBarra.setAttribute('aria-valuenow', pct);

        elGrid.innerHTML = '';
        pregunta.opciones.forEach((opcion, i) => {
            const col = document.createElement('div');
            col.className = 'col-12 col-md-6';

            const boton = document.createElement('button');
            boton.type = 'button';
            boton.className = 'selection-card btn';
            boton.dataset.opcionId = opcion.opcion_id;
            boton.setAttribute('aria-pressed', 'false');
            if (String(opcion.opcion_id) === String(respuestas[pregunta.pregunta_id])) {
                boton.classList.add('selected');
                boton.setAttribute('aria-pressed', 'true');
            }

            boton.innerHTML =
                '<div class="d-flex align-items-start">' +
                    '<div class="icon-container flex-shrink-0">' + (letras[i] || '') + '</div>' +
                    '<div class="option-text ms-3 text-start">' +
                        '<div class="option-title">' + opcion.texto + '</div>' +
                    '</div>' +
                '</div>';

            boton.addEventListener('click', function () {
                seleccionar(pregunta.pregunta_id, opcion.opcion_id, this);
            });
            boton.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });

            col.appendChild(boton);
            elGrid.appendChild(col);
        });

        elPrev.disabled = actual === 0;
        elPrev.style.visibility = actual === 0 ? 'hidden' : 'visible';

        const esUltima = actual === preguntas.length - 1;
        elNextText.textContent = esUltima ? 'Ver resultados' : 'Siguiente';
        elNext.disabled = !respuestas[pregunta.pregunta_id];

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function seleccionar(preguntaId, opcionId, boton) {
        respuestas[preguntaId] = opcionId;
        guardarLocales();
        elGrid.querySelectorAll('.selection-card').forEach(c => {
            c.classList.remove('selected');
            c.setAttribute('aria-pressed', 'false');
        });
        boton.classList.add('selected');
        boton.setAttribute('aria-pressed', 'true');
        elNext.disabled = false;
        if (navigator.vibrate) navigator.vibrate(50);
    }

    async function enviarRespuestas() {
        if (guardando) return;
        guardando = true;
        elNext.disabled = true;
        elNextText.textContent = 'Guardando...';

        try {
            const data = {
                respuestas: Object.entries(respuestas).map(([preguntaId, opcionId]) => ({
                    pregunta_id: parseInt(preguntaId, 10),
                    opcion_id: parseInt(opcionId, 10),
                })),
            };

            const res = await fetch(cfg.urlGuardar, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data),
            });
            const json = await res.json();

            if (!res.ok || !json.success) {
                throw new Error(json.message || 'No se pudieron guardar tus respuestas.');
            }

            localStorage.removeItem(storageKey);
            window.location.href = cfg.urlResultado;
        } catch (e) {
            guardando = false;
            elNext.disabled = false;
            elNextText.textContent = 'Reintentar envío';
            mostrarError(e.message);
        }
    }

    elNext.addEventListener('click', function () {
        if (elNext.disabled) return;
        if (actual < preguntas.length - 1) {
            actual++;
            renderPregunta();
        } else {
            enviarRespuestas();
        }
    });

    elPrev.addEventListener('click', function () {
        if (actual > 0) {
            actual--;
            renderPregunta();
        }
    });

    fetch(cfg.urlPreguntas)
        .then(async res => {
            if (res.status === 401) {
                window.location.href = cfg.urlLogin;
                throw new Error('Debes iniciar sesión para continuar.');
            }
            return res.json();
        })
        .then(json => {
            if (!json.success || !Array.isArray(json.preguntas) || json.preguntas.length === 0) {
                throw new Error('No hay preguntas disponibles en la base de datos.');
            }
            preguntas = json.preguntas;
            const pendientes = Object.keys(respuestas).map(Number);
            if (pendientes.length > 0 && pendientes.length < preguntas.length) {
                actual = pendientes[pendientes.length - 1] - 1;
            }
            renderPregunta();
        })
        .catch(err => {
            elTitulo.textContent = 'No se pudo cargar el cuestionario';
            elGrid.innerHTML = '';
            mostrarError(err.message + ' Verifica tu conexión y recarga la página.');
        });
});