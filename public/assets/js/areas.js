document.addEventListener('DOMContentLoaded', async () => {
    const API_ROOT = (typeof BASE_URL_ !== 'undefined' ? BASE_URL_ : '') + '/public/';
    if (!API_ROOT) return;

    const cargando = document.getElementById('resultadoCargando');
    const sinResultados = document.getElementById('sinResultados');
    const conResultados = document.getElementById('conResultados');

    function escapar(texto) {
        return String(texto ?? '').replace(/[&<>"']/g, (caracter) => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;',
        })[caracter]);
    }

    async function reiniciarCuestionario(evento) {
        evento.preventDefault();
        try {
            await fetch(API_ROOT + 'cuestionario/reiniciar', { method: 'POST' });
        } catch (error) {
            // se continúa aunque la petición falle
        }
        window.location.href = API_ROOT + 'cuestionario';
    }

    try {
        const respuesta = await fetch(API_ROOT + 'cuestionario/apiResultado');
        const json = await respuesta.json();

        if (respuesta.status === 401 || !json.success) {
            window.location.href = API_ROOT + 'auth/login';
            return;
        }

        cargando.classList.add('d-none');

        if (!json.haRespondido) {
            sinResultados.classList.remove('d-none');
            return;
        }

        const areas = json.areas || [];
        const principal = areas[0] || null;
        const areaPrincipalId = json.areaPrincipalId;
        const carreraRecomendada = json.carreraRecomendada;

        if (!principal) {
            sinResultados.classList.remove('d-none');
            return;
        }

        conResultados.classList.remove('d-none');

        document.getElementById('principalLabel').textContent = principal.label;
        document.getElementById('principalDescripcion').textContent = principal.descripcion;
        document.getElementById('afinidadNumero').textContent = principal.porcentaje + '%';

        const iconoPrincipal = document.getElementById('iconoPrincipal');
        iconoPrincipal.classList.add('bg-color-' + escapar(principal.color));
        document.getElementById('iconoPrincipalIcon').textContent = principal.icono;

        const bloqueCarrera = document.getElementById('carreraRecomendada');
        if (carreraRecomendada) {
            bloqueCarrera.classList.remove('d-none');
            document.getElementById('carreraRecomendadaNombre').textContent = carreraRecomendada.nombre;
            document.getElementById('carreraRecomendadaDesc').textContent =
                carreraRecomendada.descripcion || 'Una opción profesional que conecta con tu perfil.';
            document.getElementById('linkVerCarrera').href = API_ROOT + 'carrera/detalle/' + Number(carreraRecomendada.carreraId);
        }

        const urlExplorar = API_ROOT + 'carrera/lista?area=' + Number(areaPrincipalId);
        document.getElementById('linkExplorarArea').href = urlExplorar;
        document.getElementById('linkExplorarArea2').href = urlExplorar;

        const desgloseLista = document.getElementById('desgloseLista');
        desgloseLista.innerHTML = areas.map((area) => `
            <div>
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="d-flex align-items-center gap-2 small">
                        <span class="material-symbols-outlined text-color-${escapar(area.color)}" style="font-size:16px;">
                            ${escapar(area.icono)}
                        </span>
                        ${escapar(area.nombre)}
                    </span>
                    <span class="small" style="color: var(--color-on-surface-variant);">
                        ${Number(area.porcentaje)}%
                    </span>
                </div>
                <div class="barra-afinidad">
                    <div class="relleno bg-color-${escapar(area.color)}"
                        data-target="${Number(area.porcentaje)}" style="width:0%;"></div>
                </div>
            </div>
        `).join('');

        document.querySelectorAll('.relleno').forEach((bar) => {
            const target = `${bar.getAttribute('data-target')}%`;
            setTimeout(() => {
                bar.style.width = target;
            }, 300);
        });

        const btnReiniciar = document.getElementById('btnReiniciar');
        if (btnReiniciar) {
            btnReiniciar.addEventListener('click', reiniciarCuestionario);
        }
    } catch (error) {
        if (cargando) {
            cargando.textContent = 'No se pudieron cargar tus resultados. Inténtalo de nuevo.';
        }
    }
});