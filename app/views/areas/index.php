<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle = 'Tus áreas de interés - ' . siteName;
$pageStyles = ['areas.css'];
$pageScripts = ['areas.js'];
require_once __DIR__ . '/../layout/header.php';
?>
    <!-- ============ Contenido principal ============ -->
    <main class="container-xxl">

        <div class="text-center mb-5">
            <h1 class="page-title display-5 mb-3">Tus áreas de interés</h1>
            <p class="page-subtitle">
                Basado en tus respuestas, hemos analizado tus afinidades profesionales.
                Aquí están los resultados de tu perfil vocacional.
            </p>
        </div>

        <div id="resultadoCargando" class="text-center text-muted py-5">
            Cargando tus resultados...
        </div>

        <div id="sinResultados" class="d-none">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card-vocatio text-center p-4">
                        <span class="material-symbols-outlined mb-3" style="font-size: 48px;">quiz</span>
                        <h2 class="h4 mb-2">Aún no tienes resultados</h2>
                        <p class="text-color-on-surface-variant mb-4">
                            Completa el cuestionario vocacional para descubrir tus áreas de interés.
                        </p>
                        <a href="<?php echo BASE_URL; ?>/public/cuestionario" class="btn-explorar">
                            Comenzar cuestionario
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div id="conResultados" class="d-none">
            <div class="row g-4">

                <!-- Tarjeta principal de recomendación -->
                <div class="col-12 col-md-8">
                    <div class="card-vocatio d-flex flex-column justify-content-between">
                        <div>
                            <span class="badge-principal">
                                <span class="material-symbols-outlined" style="font-size:16px;">star</span>
                                Principal Recomendación
                            </span>
                            <h2 class="h3 mb-2" id="principalLabel"></h2>
                            <p class="text-color-on-surface-variant mb-4"
                                style="color: var(--color-on-surface-variant); max-width: 32rem;" id="principalDescripcion">
                            </p>

                            <div class="carrera-recomendada d-none" id="carreraRecomendada">
                                <span class="carrera-recomendada-chip">
                                    <span class="material-symbols-outlined" style="font-size:16px;">school</span>
                                    Tu carrera recomendada
                                </span>
                                <h3 class="carrera-recomendada-nombre" id="carreraRecomendadaNombre"></h3>
                                <p class="carrera-recomendada-desc" id="carreraRecomendadaDesc"></p>
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    <a id="linkVerCarrera" href="#" class="btn-explorar">
                                        Ver esta carrera
                                        <span class="material-symbols-outlined">arrow_forward</span>
                                    </a>
                                    <a id="linkExplorarArea" href="#" class="btn-explorar btn-explorar--ghost">
                                        Explorar carreras relacionadas
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <div class="d-flex flex-column">
                                <span class="afinidad-numero" id="afinidadNumero"></span>
                                <span class="afinidad-label">Afinidad</span>
                            </div>
                            <div class="icono-circulo icono-circulo-grande" id="iconoPrincipal">
                                <span class="material-symbols-outlined" id="iconoPrincipalIcon"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Desglose de afinidad -->
                <div class="col-12 col-md-4">
                    <div class="card-vocatio d-flex flex-column gap-4">
                        <h3 class="h5 mb-0">Desglose de Afinidad</h3>
                        <div class="d-flex flex-column gap-3" id="desgloseLista"></div>
                        <div class="card-cta card-cta--desglose">
                            <h3 class="h5 mb-4">¿Listo para dar el siguiente paso?</h3>
                            <a id="linkExplorarArea2" href="#" class="btn-explorar">
                                Explorar carreras relacionadas
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </a>
                            <a id="btnReiniciar" href="#" class="btn-explorar btn-explorar--ghost mt-3">
                                <span class="material-symbols-outlined">replay</span>
                                Volver a intentar el cuestionario
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>