<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle = 'Carreras - ' . siteName;
$pageStyles = ['carreras-list.css'];
$pageScripts = ['carreras.js'];
$bodyClass = 'vt-careers-page';
require_once __DIR__ . '/../layout/header.php';
?>
    <main class="vt-container vt-section w-100">
        <section class="vt-careers-hero">
            <h1 class="vt-careers-title vt-display" id="listaTitulo">Explorando carreras...</h1>
            <p class="vt-careers-subtitle" id="listaSubtitulo">
                Cargando las opciones disponibles...
            </p>
            <div class="vt-careers-toolbar">
                <div class="vt-careers-search">
                    <span class="material-symbols-outlined">search</span>
                    <input type="text" id="carrerasBusqueda" class="form-control" placeholder="Busca por carrera, área o interés...">
                </div>
            </div>

            <div class="vt-careers-chip-carousel">
                <button type="button" class="vt-careers-carousel-arrow" id="carruselAnterior" aria-label="Anterior">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <div class="vt-careers-chip-list" id="areaCarrusel">
                    <button type="button" class="vt-careers-chip is-active" data-area="0">Todas</button>
                </div>
                <button type="button" class="vt-careers-carousel-arrow" id="carruselSiguiente" aria-label="Siguiente">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
        </section>

        <section class="row g-4" id="carrerasGrid">
            <div class="col-12 text-center text-muted py-5">Cargando carreras desde la base de datos...</div>
        </section>
    </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>