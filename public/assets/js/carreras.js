(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', async function () {
        const API_ROOT = (typeof BASE_URL_ !== 'undefined' ? BASE_URL_ : '') + '/public/';
        if (!API_ROOT) return;

        const chipsContainer = document.getElementById('areaCarrusel');
        const grid = document.getElementById('carrerasGrid');
        const busqueda = document.getElementById('carrerasBusqueda');
        const titulo = document.getElementById('listaTitulo');
        const subtitulo = document.getElementById('listaSubtitulo');
        const carrusel = document.getElementById('areaCarrusel');
        const botonAnterior = document.getElementById('carruselAnterior');
        const botonSiguiente = document.getElementById('carruselSiguiente');

        const parametros = new URLSearchParams(window.location.search);
        const areaUrl = Number(parametros.get('area') || 0);

        let areas = [];
        let carreras = [];
        let chipActivo = areaUrl;

        function escapar(texto) {
            return String(texto ?? '').replace(/[&<>"']/g, (caracter) => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;',
            })[caracter]);
        }

        function chipDificultad(dificultad) {
            return {
                'Baja': 'vt-career-chip--baja',
                'Alta': 'vt-career-chip--alta',
                'Media': 'vt-career-chip--media',
            }[dificultad] || 'vt-career-chip--media';
        }

        function renderChips() {
            chipsContainer.innerHTML = '';
            const botonTodas = document.createElement('button');
            botonTodas.type = 'button';
            botonTodas.className = 'vt-careers-chip' + (chipActivo === 0 ? ' is-active' : '');
            botonTodas.dataset.area = 0;
            botonTodas.textContent = 'Todas';
            botonTodas.addEventListener('click', function () {
                chipActivo = 0;
                renderChips();
                aplicarFiltros();
            });
            chipsContainer.appendChild(botonTodas);

            areas.forEach(function (area) {
                const boton = document.createElement('button');
                boton.type = 'button';
                boton.className = 'vt-careers-chip' + (Number(area.area_id) === chipActivo ? ' is-active' : '');
                boton.dataset.area = area.area_id;
                boton.innerHTML = '<span class="material-symbols-outlined">' + escapar(area.icono) + '</span>' + escapar(area.nombre);
                boton.addEventListener('click', function () {
                    chipActivo = Number(area.area_id);
                    renderChips();
                    aplicarFiltros();
                });
                chipsContainer.appendChild(boton);
            });
        }

        function renderGrid(lista) {
            if (!lista.length) {
                grid.innerHTML = '<div class="col-12 text-center text-muted py-5">No hay carreras disponibles por el momento.</div>';
                return;
            }

            grid.innerHTML = lista.map(function (carrera) {
                const imagen = carrera.imagen
                    ? '<img src="' + escapar(carrera.imagen) + '" alt="' + escapar(carrera.nombre) + '" class="vt-career-image">'
                    : '<div class="vt-career-image vt-career-image-placeholder"><span class="material-symbols-outlined">school</span></div>';

                const iconoDisponibilidad = carrera.disponibilidad === 'No disponible' ? 'remove_circle' : 'check_circle';

                return '' +
                    '<article class="col-12 col-md-6 col-lg-4" data-area="' + Number(carrera.areaId) + '" data-nombre="' + escapar(carrera.nombre) + '">' +
                        '<div class="vt-career-card">' +
                            imagen +
                            '<div class="vt-career-body">' +
                                '<div class="vt-career-badge-row">' +
                                    '<span class="vt-career-chip ' + chipDificultad(carrera.dificultad) + '">Dificultad ' + escapar(carrera.dificultad) + '</span>' +
                                    '<span class="vt-career-bookmark material-symbols-outlined">bookmark</span>' +
                                '</div>' +
                                '<h2 class="vt-career-title">' + escapar(carrera.nombre) + '</h2>' +
                                (carrera.descripcion ? '<p class="vt-career-description">' + escapar(carrera.descripcion) + '</p>' : '') +
                                '<div class="vt-career-footer">' +
                                    '<span class="vt-career-duration">' +
                                        '<span class="material-symbols-outlined">' + iconoDisponibilidad + '</span>' +
                                        escapar(carrera.disponibilidad) +
                                    '</span>' +
                                    '<a href="' + API_ROOT + 'carrera/detalle/' + Number(carrera.carreraId) + '" class="vt-career-link">' +
                                        'Ver más' +
                                        '<span class="material-symbols-outlined">arrow_forward</span>' +
                                    '</a>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</article>';
            }).join('');
        }

        function aplicarFiltros() {
            const termino = (busqueda.value || '').trim().toLowerCase();

            const lista = carreras.filter(function (carrera) {
                const coincideArea = chipActivo === 0 || Number(carrera.areaId) === chipActivo;
                const coincideNombre = termino === '' || carrera.nombre.toLowerCase().indexOf(termino) !== -1;
                return coincideArea && coincideNombre;
            });

            renderGrid(lista);
        }

        function actualizarTitulo() {
            const area = areas.find(function (a) {
                return Number(a.area_id) === chipActivo;
            });

            if (area) {
                titulo.textContent = 'Carreras de ' + area.label;
                subtitulo.textContent = 'Carreras relacionadas con tu perfil. Explora las opciones y encuentra la ideal para ti. ';
                subtitulo.innerHTML += '<a href="' + API_ROOT + 'carrera/lista" class="vt-careers-link-all">Ver todas las carreras</a>';
            } else {
                titulo.textContent = 'Explora tu futuro';
                subtitulo.textContent = 'Explora el catálogo completo de carreras y encuentra la ideal para ti.';
            }
        }

        function desplazarCarrusel(cantidad) {
            if (carrusel) {
                carrusel.scrollBy({ left: cantidad, behavior: 'smooth' });
            }
        }

        if (botonAnterior) {
            botonAnterior.addEventListener('click', function () {
                desplazarCarrusel(-280);
            });
        }

        if (botonSiguiente) {
            botonSiguiente.addEventListener('click', function () {
                desplazarCarrusel(280);
            });
        }

        if (busqueda) {
            busqueda.addEventListener('input', aplicarFiltros);
        }

        try {
            const [respuestaAreas, respuestaCarreras] = await Promise.all([
                fetch(API_ROOT + 'carrera/apiAreas'),
                fetch(API_ROOT + 'carrera/apiList'),
            ]);

            const [jsonAreas, jsonCarreras] = await Promise.all([
                respuestaAreas.json(),
                respuestaCarreras.json(),
            ]);

            areas = (jsonAreas.success && Array.isArray(jsonAreas.data)) ? jsonAreas.data : [];
            carreras = (jsonCarreras.success && Array.isArray(jsonCarreras.data)) ? jsonCarreras.data : [];

            renderChips();
            actualizarTitulo();
            aplicarFiltros();
        } catch (error) {
            grid.innerHTML = '<div class="col-12 text-center text-muted py-5">No se pudieron cargar las carreras. Inténtalo de nuevo.</div>';
        }
    });
})();