<?php
require_once __DIR__ . '/../../config/config.php';

$areas = [
    [
        'nombre' => 'Tech',
        'label' => 'Tecnología e Innovación',
        'icono' => 'computer',
        'porcentaje' => 85,
        'color' => 'primary',
        'descripcion' => 'Muestras una fuerte inclinación hacia la resolución de problemas lógicos, el desarrollo de sistemas y la innovación digital. Carreras como Ingeniería de Software, Ciencia de Datos o Diseño UX podrían ser ideales para ti.',
    ],
    [
        'nombre' => 'Business',
        'label' => 'Liderazgo y Negocios',
        'icono' => 'storefront',
        'porcentaje' => 70,
        'color' => 'secondary',
        'descripcion' => 'Tu segundo punto fuerte indica habilidades para la gestión, organización y emprendimiento.',
    ],
    [
        'nombre' => 'Education',
        'label' => 'Educación',
        'icono' => 'school',
        'porcentaje' => 45,
        'color' => 'tertiary',
        'descripcion' => 'Interés moderado por la enseñanza y la transmisión de conocimiento.',
    ],
    [
        'nombre' => 'Arts',
        'label' => 'Artes',
        'icono' => 'palette',
        'porcentaje' => 30,
        'color' => 'error',
        'descripcion' => 'Cierta afinidad con la expresión creativa y el diseño.',
    ],
    [
        'nombre' => 'Health',
        'label' => 'Salud',
        'icono' => 'favorite',
        'porcentaje' => 25,
        'color' => 'info',
        'descripcion' => 'Afinidad baja con el cuidado y cuidado de la salud.',
    ],
];

// Ordenar de mayor a menor afinidad
usort($areas, function ($a, $b) {
    return $b['porcentaje'] <=> $a['porcentaje'];
});

$principal = $areas[0];
$secundaria = $areas[1] ?? null;
$anioActual = date('Y');

$pageTitle = 'Tus áreas de interés - ' . siteName;
$pageStyles = ['areas.css'];
$pageScripts = ['areas.js'];
require_once __DIR__ . '/../layout/header.php';
?>
    <!-- ============ Contenido principal ============ -->
    <main class="container-xxl">

        <div class="text-center mb-5">
            <h1 class="page-title display-5 mb-3"><?php echo htmlspecialchars('Tus áreas de interés'); ?></h1>
            <p class="page-subtitle">
                Basado en tus respuestas, hemos analizado tus afinidades profesionales.
                Aquí están los resultados de tu perfil vocacional.
            </p>
        </div>

        <div class="row g-4">

            <!-- Tarjeta principal de recomendación -->
            <div class="col-12 col-md-8">
                <div class="card-vocatio d-flex flex-column justify-content-between">
                    <div>
                        <span class="badge-principal">
                            <span class="material-symbols-outlined" style="font-size:16px;">star</span>
                            Principal Recomendación
                        </span>
                        <h2 class="h3 mb-2"><?php echo htmlspecialchars($principal['label']); ?></h2>
                        <p class="text-color-on-surface-variant mb-4"
                            style="color: var(--color-on-surface-variant); max-width: 32rem;">
                            <?php echo htmlspecialchars($principal['descripcion']); ?>
                        </p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <div class="d-flex flex-column">
                            <span class="afinidad-numero"><?php echo (int) $principal['porcentaje']; ?>%</span>
                            <span class="afinidad-label">Afinidad</span>
                        </div>
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAO5jwISjYqYTLKw3dtJej1BDDtvaeZu0oD7YUNhHu2zWwtcBcdnTrfUKICJrjNGG1q8-G5y0F4d2zORZVmjgF8NtdwteDZyxSH2YkH6X2s1Hff3CEyPEHM8lfBHRdcrElWX67vXmmlASuzFDn9Tymd7nmB12eTYHo0ZiCmzvIu-BUzfkbNr8drx92fa305MAYzMxtN1pS62U-Z4_iKF6YnPOvt3LK6aPk7ACHOcmA7XEpemM_LPPdPKg"
                            alt="Tech Illustration" class="d-none d-sm-block"
                            style="width:8rem;height:8rem;object-fit:contain;opacity:0.8;">
                    </div>
                </div>
            </div>

            <!-- Desglose de afinidad -->
            <div class="col-12 col-md-4">
                <div class="card-vocatio d-flex flex-column gap-4">
                    <h3 class="h5 mb-0">Desglose de Afinidad</h3>
                    <div class="d-flex flex-column gap-3">
                        <?php foreach ($areas as $area): ?>
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="d-flex align-items-center gap-2 small">
                                        <span class="material-symbols-outlined text-color-<?php echo $area['color']; ?>"
                                            style="font-size:16px;">
                                            <?php echo htmlspecialchars($area['icono']); ?>
                                        </span>
                                        <?php echo htmlspecialchars($area['nombre']); ?>
                                    </span>
                                    <span class="small" style="color: var(--color-on-surface-variant);">
                                        <?php echo (int) $area['porcentaje']; ?>%
                                    </span>
                                </div>
                                <div class="barra-afinidad">
                                    <div class="relleno bg-color-<?php echo $area['color']; ?>"
                                        data-target="<?php echo (int) $area['porcentaje']; ?>" style="width:0%;"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de interés secundario -->
            <?php if ($secundaria): ?>
                <div class="col-12 col-md-6">
                    <div class="card-vocatio d-flex flex-row align-items-start gap-3">
                        <div class="icono-circulo">
                            <span
                                class="material-symbols-outlined"><?php echo htmlspecialchars($secundaria['icono']); ?></span>
                        </div>
                        <div>
                            <h3 class="h5 mb-2"><?php echo htmlspecialchars($secundaria['label']); ?></h3>
                            <p class="mb-0" style="color: var(--color-on-surface-variant);">
                                <?php echo htmlspecialchars($secundaria['descripcion']); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Tarjeta CTA -->
            <div class="col-12 col-md-6">
                <div class="card-cta">
                    <h3 class="h5 mb-4">¿Listo para dar el siguiente paso?</h3>
                    <a href="<?php echo BASE_URL; ?>/public/carrera/lista" class="btn-explorar">
                        Explorar carreras relacionadas
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
            </div>

        </div>
    </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>