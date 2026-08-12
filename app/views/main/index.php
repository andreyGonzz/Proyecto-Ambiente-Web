<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle = siteName . ' - Descubre tu futuro profesional';
require_once __DIR__ . '/../layout/header.php';
?>

    <main class="flex-grow-1">

        <!-- ============ HERO ============ -->
        <section class="vt-hero vt-section">
            <div class="vt-hero-bg"></div>
            <div class="vt-container vt-hero-content">
                <div class="row align-items-center g-5">
                    <div class="col-md-6 d-flex flex-column gap-3">
                        <span class="vt-badge vt-bg-secondary-fixed vt-text-on-secondary-fixed vt-label">Orientación
                            Vocacional</span>
                        <h1 class="vt-display">Descubre tu futuro profesional</h1>
                        <p class="vt-body-lg vt-text-on-surface-variant vt-max-w-lg">
                            Encuentra la carrera ideal para ti a través de una evaluación personalizada que conecta tus
                            intereses y habilidades con las mejores oportunidades del mercado.
                        </p>
                        <div class="pt-2 d-flex flex-column flex-sm-row gap-3">
                            <a href="<?= htmlspecialchars(BASE_URL) ?>/public/areas/antesComenzar"
                                class="vt-btn-primary vt-btn-lg vt-shadow-soft">
                                Descubre tu vocación
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="vt-hero-image-wrap vt-shadow-soft">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBc7s-Vk_FseBWzpGQ5OUc951hKSFuSx51CPmVIgYAF5EZes1rMmZgn-dUT2X52DE2cGt7oHWYX3uKaiZTtZ9LbJJB4UAwjKLuucsFNl-PybMXQznNxpVy3nxJCdxb-lBLPKO-UeYXZqkwpalwa6s7iJgXF4DrlYz6AYQ7Ikzvn4t3jNJz38-VI1EkZLJ2S_Lt5MKLCx6aqn50lZ68Kf8brxgbUYOxxbN1GXeRLT2-wKkoTSAdtgZfToA"
                                alt="Estudiantes explorando su vocación con una tablet" class="vt-hero-image">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ CÓMO FUNCIONA ============ -->
        <section class="vt-section vt-bg-surface">
            <div class="vt-container">
                <div class="text-center mb-5 d-flex flex-column gap-2">
                    <h2 class="vt-headline-lg">¿Cómo funciona <?= htmlspecialchars(siteName) ?>?</h2>
                    <p class="vt-text-on-surface-variant mx-auto vt-max-w-2xl">
                        Un proceso simple de 3 pasos diseñado para guiarte con claridad hacia tu mejor opción
                        profesional.
                    </p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="vt-step-card vt-shadow-soft vt-hover-lift">
                            <div class="vt-step-number">1</div>
                            <div class="vt-step-icon vt-bg-primary-fixed vt-text-on-primary-fixed">
                                <span class="material-symbols-outlined">person_add</span>
                            </div>
                            <h3 class="vt-headline-md">Registro</h3>
                            <p class="vt-text-on-surface-variant">Crea tu cuenta gratuita en minutos y prepárate para explorar tu potencial.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="vt-step-card vt-shadow-soft vt-hover-lift">
                            <div class="vt-step-number">2</div>
                            <div class="vt-step-icon vt-bg-secondary-fixed vt-text-on-secondary-fixed">
                                <span class="material-symbols-outlined">assignment</span>
                            </div>
                            <h3 class="vt-headline-md">Cuestionario</h3>
                            <p class="vt-text-on-surface-variant">Responde preguntas sobre tus intereses, habilidades y valores profesionales.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="vt-step-card vt-shadow-soft vt-hover-lift">
                            <div class="vt-step-number">3</div>
                            <div class="vt-step-icon vt-bg-tertiary-fixed vt-text-on-tertiary-fixed">
                                <span class="material-symbols-outlined">lightbulb</span>
                            </div>
                            <h3 class="vt-headline-md">Recomendaciones</h3>
                            <p class="vt-text-on-surface-variant">Recibe un análisis detallado y sugerencias de carreras que encajan contigo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ ÁREAS DESTACADAS (BENTO GRID) ============ -->
        <section class="vt-section vt-bg-surface-lowest">
            <div class="vt-container">
                <div class="mb-5">
                    <h2 class="vt-headline-lg mb-2">Áreas Destacadas</h2>
                    <p class="vt-text-on-surface-variant">Explora los sectores con mayor proyección y descubre dónde
                        podrías encajar.</p>
                </div>

                <div class="vt-bento">
                    <!-- Tecnología (grande) -->
                    <div class="vt-bento-item vt-bento-item--large vt-hover-lift">
                        <div class="vt-bento-bg vt-bento-bg--tech"></div>
                        <div class="vt-bento-overlay"></div>
                        <div class="vt-bento-content">
                            <h3 class="vt-headline-md">Tecnología y Software</h3>
                        </div>
                        <span class="material-symbols-outlined vt-bento-icon-corner">
                            terminal
                        </span>
                    </div>

                    <div class="vt-bento-item vt-hover-lift">
                        <div class="vt-bento-bg vt-bento-bg--health"></div>
                        <div class="vt-bento-overlay vt-bento-overlay--sm"></div>
                        <div class="vt-bento-content">
                            <h3 class="vt-headline-md">Salud</h3>
                        </div>
                        <span class="material-symbols-outlined vt-bento-icon-corner">
                            medical_services
                        </span>
                    </div>

                    <div class="vt-bento-item vt-hover-lift">
                        <div class="vt-bento-bg vt-bento-bg--business"></div>
                        <div class="vt-bento-overlay vt-bento-overlay--sm"></div>
                        <div class="vt-bento-content">
                            <h3 class="vt-headline-md">Negocios</h3>
                        </div>
                        <span class="material-symbols-outlined vt-bento-icon-corner">
                            trending_up
                        </span>
                    </div>

                    <div class="vt-bento-item vt-hover-lift">
                        <div class="vt-bento-bg vt-bento-bg--education"></div>
                        <div class="vt-bento-overlay vt-bento-overlay--sm"></div>
                        <div class="vt-bento-content">
                            <h3 class="vt-headline-md">Educación</h3>
                        </div>
                        <span class="material-symbols-outlined vt-bento-icon-corner">
                            school
                        </span>
                    </div>

                    <div class="vt-bento-item vt-hover-lift">
                        <div class="vt-bento-bg vt-bento-bg--arts"></div>
                        <div class="vt-bento-overlay vt-bento-overlay--sm"></div>
                        <div class="vt-bento-content">
                            <h3 class="vt-headline-md">Artes y Diseño</h3>
                        </div>
                        <span class="material-symbols-outlined vt-bento-icon-corner">
                            palette
                        </span>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>
