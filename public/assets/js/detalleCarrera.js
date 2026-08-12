document.addEventListener('DOMContentLoaded', async () => {
    const API_ROOT = (typeof BASE_URL_ !== 'undefined' ? BASE_URL_ : '') + '/public/';
    if (!API_ROOT) return;

    const contenedor = document.getElementById('carreraDetalle');
    if (!contenedor) return;

    const segmento = window.location.pathname.split('/').filter(Boolean).pop() || '';
    const id = /^\d+$/.test(segmento) ? Number(segmento) : 0;

    function escapar(texto) {
        return String(texto ?? '').replace(/[&<>"']/g, (caracter) => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;',
        })[caracter]);
    }

    function renderNoEncontrada() {
        contenedor.innerHTML = `
            <section class="career-header">
                <div class="career-header-content">
                    <div class="career-info">
                        <h1>Carrera no encontrada</h1>
                        <p>La carrera que buscas no existe o fue eliminada.</p>
                    </div>
                </div>
            </section>`;
    }

    function renderCarrera(carrera, afinidad) {
        const imagen = carrera.imagen
            ? `<img src="${escapar(carrera.imagen)}" alt="${escapar(carrera.nombre)}" class="career-image">`
            : `<div class="career-image career-image-placeholder"><span class="material-symbols-outlined">school</span></div>`;

        const descripcion = carrera.descripcion || (carrera.disponibilidad === 'No disponible'
            ? 'Carrera que actualmente no se encuentra disponible.'
            : 'Carrera que actualmente se encuentra disponible para matrícula.');

        const iconoDisponibilidad = carrera.disponibilidad === 'No disponible' ? 'remove_circle' : 'check_circle';

        let habilidades = [];
        try {
            const parseadas = JSON.parse(carrera.habilidades || '[]');
            if (Array.isArray(parseadas)) {
                habilidades = parseadas;
            }
        } catch (error) {
            habilidades = [];
        }

        const skillsHtml = habilidades.length
            ? `<div class="skills-section">
                    <h3>Habilidades Clave</h3>
                    <div class="skills-list">
                        ${habilidades.map((habilidad) => `<span class="skill-tag">${escapar(habilidad)}</span>`).join('')}
                    </div>
                </div>`
            : '';

        const afinidadHtml = afinidad !== null
            ? (() => {
                const anillo = 251.2;
                const desplazamiento = Math.round(anillo * (1 - afinidad / 100) * 100) / 100;
                return `
                    <div class="affinity-circle">
                        <svg viewBox="0 0 100 100" aria-hidden="true">
                            <circle cx="50" cy="50" r="40" class="affinity-circle-bg"></circle>
                            <circle cx="50" cy="50" r="40" class="affinity-circle-progress"
                                style="stroke-dasharray: ${anillo}; stroke-dashoffset: ${desplazamiento};"></circle>
                        </svg>
                        <div class="affinity-percentage">
                            <span class="affinity-percentage-number">${Number(afinidad)}</span>
                            <span class="affinity-percentage-symbol">%</span>
                        </div>
                    </div>
                    <p>Según tu resultado guardado, tu afinidad con esta área es de ${Number(afinidad)}%.</p>
                    <a href="${API_ROOT}cuestionario/resultado" class="btn-affinity">Ver desglose</a>`;
            })()
            : `
                <div class="affinity-circle affinity-circle--empty">
                    <span class="material-symbols-outlined">quiz</span>
                </div>
                <p>Completa el cuestionario vocacional para conocer tu afinidad con esta carrera.</p>
                <a href="${API_ROOT}cuestionario" class="btn-affinity">Hacer el cuestionario</a>`;

        contenedor.innerHTML = `
            <section class="career-header">
                <div class="career-header-content">
                    ${imagen}
                    <div class="career-info">
                        <div class="badge-category">
                            <span class="material-symbols-outlined">signal_cellular_alt</span>
                            Dificultad ${escapar(carrera.dificultad)}
                        </div>
                        <h1>${escapar(carrera.nombre)}</h1>
                        <p>${escapar(descripcion)}</p>
                    </div>
                </div>
            </section>

            <section class="bento-grid">
                <article class="bento-card">
                    <h2>Información General</h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-item-icon">
                                <span class="material-symbols-outlined">schedule</span>
                            </div>
                            <div class="info-item-content">
                                <h3>Duración Estimada</h3>
                                <p>${escapar(carrera.duracion || 'No especificada')}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-icon">
                                <span class="material-symbols-outlined">monetization_on</span>
                            </div>
                            <div class="info-item-content">
                                <h3>Rango Salarial (Junior)</h3>
                                <p>${escapar(carrera.salario || 'No especificado')}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-icon">
                                <span class="material-symbols-outlined">trending_up</span>
                            </div>
                            <div class="info-item-content">
                                <h3>Demanda Laboral</h3>
                                <p class="text-tertiary">${escapar(carrera.demanda || 'No especificada')}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-icon">
                                <span class="material-symbols-outlined">menu_book</span>
                            </div>
                            <div class="info-item-content">
                                <h3>Dificultad Percibida</h3>
                                <p>${escapar(carrera.dificultad)}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-icon">
                                <span class="material-symbols-outlined">${iconoDisponibilidad}</span>
                            </div>
                            <div class="info-item-content">
                                <h3>Disponibilidad</h3>
                                <p>${escapar(carrera.disponibilidad)}</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-icon">
                                <span class="material-symbols-outlined">verified_user</span>
                            </div>
                            <div class="info-item-content">
                                <h3>Estado</h3>
                                <p class="text-tertiary">${Number(carrera.estadoId) === 1 ? 'Activo' : 'Inactivo'}</p>
                            </div>
                        </div>
                    </div>
                    ${skillsHtml}
                </article>

                <aside class="affinity-card">
                    <div class="affinity-content">
                        <h3>Tu Afinidad</h3>
                        ${afinidadHtml}
                    </div>
                </aside>
            </section>`;
    }

    if (!id) {
        renderNoEncontrada();
        return;
    }

    try {
        const respuesta = await fetch(API_ROOT + 'carrera/apiDetalle/' + id);
        const json = await respuesta.json();

        if (!respuesta.ok || !json.success || !json.data) {
            renderNoEncontrada();
            return;
        }

        renderCarrera(json.data.carrera, json.data.afinidad);
    } catch (error) {
        renderNoEncontrada();
    }
});