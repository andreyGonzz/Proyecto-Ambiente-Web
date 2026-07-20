<?php
require_once __DIR__ . '/../config/config.php';

$steps = [
    [
        "number" => 1,
        "icon" => "person_add",
        "iconBg" => "vt-bg-primary-fixed vt-text-on-primary-fixed",
        "title" => "Registro",
        "text" => "Crea tu cuenta gratuita en minutos y prepárate para explorar tu potencial.",
    ],
    [
        "number" => 2,
        "icon" => "assignment",
        "iconBg" => "vt-bg-secondary-fixed vt-text-on-secondary-fixed",
        "title" => "Cuestionario",
        "text" => "Responde preguntas sobre tus intereses, habilidades y valores profesionales.",
    ],
    [
        "number" => 3,
        "icon" => "lightbulb",
        "iconBg" => "vt-bg-tertiary-fixed vt-text-on-tertiary-fixed",
        "title" => "Recomendaciones",
        "text" => "Recibe un análisis detallado y sugerencias de carreras que encajan contigo.",
    ],
];

$bentoSecondary = [
    [
        "bg" => "vt-bento-bg--health",
        "icon" => "medical_services",
        "title" => "Salud",
    ],
    [
        "bg" => "vt-bento-bg--business",
        "icon" => "trending_up",
        "title" => "Negocios",
    ],
    [
        "bg" => "vt-bento-bg--education",
        "icon" => "school",
        "title" => "Educación",
    ],
    [
        "bg" => "vt-bento-bg--arts",
        "icon" => "palette",
        "title" => "Artes y Diseño",
    ],
];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($siteName) ?> - Descubre tu futuro profesional</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Tipografía e iconos -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap">

    <!-- CSS propio (vanilla) -->
    <link rel="stylesheet" href="assets/styles/index.css">
    <link rel="stylesheet" href="assets/styles/header.css">
    <link rel="stylesheet" href="assets/styles/footer.css">
</head>

<body>

    <!-- ============ HEADER / NAVBAR ============ -->
    <?php require_once __DIR__ . '/../views/layout/header.php'; ?>

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
                            <a href="<?= htmlspecialchars($baseUrl) ?>/views/areas/antes-comenzar.php" class="vt-btn-primary vt-btn-lg vt-shadow-soft">
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
                    <h2 class="vt-headline-lg">¿Cómo funciona <?= htmlspecialchars($siteName) ?>?</h2>
                    <p class="vt-text-on-surface-variant mx-auto vt-max-w-2xl">
                        Un proceso simple de 3 pasos diseñado para guiarte con claridad hacia tu mejor opción
                        profesional.
                    </p>
                </div>
                <div class="row g-4">
                    <?php foreach ($steps as $step): ?>
                        <div class="col-md-4">
                            <div class="vt-step-card vt-shadow-soft vt-hover-lift">
                                <div class="vt-step-number"><?= (int) $step["number"] ?></div>
                                <div class="vt-step-icon <?= htmlspecialchars($step["iconBg"]) ?>">
                                    <span class="material-symbols-outlined">
                                        <?= htmlspecialchars($step["icon"]) ?>
                                    </span>
                                </div>
                                <h3 class="vt-headline-md"><?= htmlspecialchars($step["title"]) ?></h3>
                                <p class="vt-text-on-surface-variant"><?= htmlspecialchars($step["text"]) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
                        <div class="vt-bento-content vt-bento-content--split">
                            <div>
                                <span class="vt-bento-tag">Alta Demanda</span>
                                <h3 class="vt-headline-lg">Tecnología y Software</h3>
                                <p class="vt-bento-desc">Desarrollo, análisis de datos, inteligencia artificial y
                                    ciberseguridad.</p>
                            </div>
                            <span class="material-symbols-outlined fs-2">terminal</span>
                        </div>
                    </div>

                    <?php foreach ($bentoSecondary as $item): ?>
                        <div class="vt-bento-item vt-hover-lift">
                            <div class="vt-bento-bg <?= htmlspecialchars($item["bg"]) ?>"></div>
                            <div class="vt-bento-overlay vt-bento-overlay--sm"></div>
                            <div class="vt-bento-content">
                                <h3 class="vt-headline-md"><?= htmlspecialchars($item["title"]) ?></h3>
                            </div>
                            <span class="material-symbols-outlined vt-bento-icon-corner">
                                <?= htmlspecialchars($item["icon"]) ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

    </main>

    <!-- ============ FOOTER ============ -->
    <?php require_once __DIR__ . '/../views/layout/footer.php'; ?>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>