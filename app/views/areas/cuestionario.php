<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle = 'Cuestionario Vocacional - ' . siteName;
$pageStyles = ['cuestionario.css'];
$pageScripts = ['cuestionario.js'];
$bodyClass = 'page-cuestionario';
$sinNavbar = true;
require_once __DIR__ . '/../layout/header.php';
?>
    <header class="site-header bg-white border-bottom">
        <div class="container container-max d-flex align-items-center justify-content-between py-3">
            <div class="brand d-flex align-items-center gap-2">
                <span class="material-symbols-outlined brand-icon">school</span>
                <span class="brand-title">Vocatio</span>
            </div>
            <a href="<?php echo BASE_URL; ?>/public/index.php" class="btn btn-link text-muted save-exit">
                <span class="material-symbols-outlined">close</span>
                <span class="d-none d-sm-inline"></span>
            </a>
        </div>
    </header>

    <main class="py-5">
        <div class="container container-max">
            <div class="progress-section mb-4">
                <div class="d-flex justify-content-between small text-muted">
                    <span id="moduloLabel">Cargando...</span>
                    <span id="contadorPregunta" class="fw-semibold text-primary"></span>
                </div>
                <div class="progress progress-custom mt-2" aria-hidden="true">
                    <div class="progress-bar progress-fill" id="barraProgreso" role="progressbar"
                        aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"></div>
                </div>
            </div>

            <div class="card ambient-shadow mb-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h1 class="question-title" id="preguntaTitulo">Preparando tus preguntas...</h1>
                        <p class="text-muted question-desc" id="preguntaModulo"></p>
                    </div>

                    <div class="row g-3 options-grid" id="opcionesGrid">
                        <div class="col-12 text-center text-muted py-4">Cargando preguntas desde la base de datos...</div>
                    </div>
                </div>
            </div>

            <div id="mensajeError" class="alert alert-danger d-none" role="alert"></div>

            <div class="d-flex justify-content-between align-items-center">
                <button type="button" id="prevBtn" class="btn btn-outline-secondary d-flex align-items-center gap-2">
                    <span class="material-symbols-outlined">arrow_back</span>
                    <span>Anterior</span>
                </button>

                <button type="button" id="nextBtn" class="btn btn-primary d-flex align-items-center gap-2" disabled>
                    <span id="nextBtnText">Siguiente</span>
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
            </div>
        </div>
    </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>