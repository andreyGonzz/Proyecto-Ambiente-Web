<?php
$siteName = 'Vocatio';
$year = date('Y');
$baseUrl = '/Proyecto%20Ambiente%20Web';

$carrera = [
    'nombre' => 'Ingeniería de Software',
    'categoria' => 'Tecnología e Ingeniería',
    'icono_categoria' => 'science',
    'imagen' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBDPx4AFwuqXls9JZXmheTLYhpid21gIRO6liB2Y3Shht4NzwOEkI9RyQDG975orxsV3JguQz1gm8qDzZbAGZWmxXvNQ_22DBk7L22Re5nE0aK1b87sBRQ7SUqkf21b7a9VNfY2FzOPQ4_PkeQ49PuQVRjmpFTV_5S5RvhYnTVMhWF961LkVLByMT1ry8MvmI2CdgrTHLj6a5IhOk3fUW6D8ugRz0IxsFQZ7WK4CzL1AcKg6T5eaB9FnA',
    'descripcion' => 'La Ingeniería de Software es la disciplina de aplicar principios estructurados y metódicos al desarrollo, operación y mantenimiento de sistemas de software. Esta carrera te prepara para diseñar soluciones tecnológicas innovadoras que impactan la vida diaria de millones de personas.',
    'duracion' => '4 - 5 Años',
    'salario' => '$3,000 - $5,000 / mes',
    'demanda' => 'Muy Alta',
    'dificultad' => 'Alta (Matemáticas y Lógica)',
    'afinidad' => 85,
    'habilidades' => [
        'Lógica de Programación',
        'Resolución de Problemas',
        'Trabajo en Equipo',
        'Arquitectura de Sistemas',
    ],
    'campos_laborales' => [
        [
            'id' => 'web',
            'nombre' => 'Desarrollo Web',
            'icono' => 'web',
            'descripcion' => 'Creación de aplicaciones y sitios web interactivos para diversas industrias.',
        ],
        [
            'id' => 'mobile',
            'nombre' => 'Desarrollo Móvil',
            'icono' => 'smartphone',
            'descripcion' => 'Diseño y programación de aplicaciones para plataformas iOS y Android.',
        ],
        [
            'id' => 'data',
            'nombre' => 'Ingeniería de Datos',
            'icono' => 'database',
            'descripcion' => 'Gestión, estructuración y análisis de grandes volúmenes de información.',
        ],
        [
            'id' => 'security',
            'nombre' => 'Ciberseguridad',
            'icono' => 'security',
            'descripcion' => 'Protección de infraestructuras digitales, redes y datos confidenciales.',
        ],
    ],
];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($carrera['nombre']); ?> - Vocatio</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">

    <link rel="stylesheet" href="<?= $baseUrl; ?>/public/assets/styles/index.css">
    <link rel="stylesheet" href="<?= $baseUrl; ?>/public/assets/styles/header.css">
    <link rel="stylesheet" href="<?= $baseUrl; ?>/public/assets/styles/footer.css">
    <link rel="stylesheet" href="<?= $baseUrl; ?>/public/assets/styles/detalleCarrera.css">
</head>

<body>
    <?php require_once __DIR__ . '/../layout/header.php'; ?>

    <main class="vt-container vt-section">
        <div class="mb-4">
            <a href="<?= $baseUrl; ?>/views/areas/areas.php" class="btn-back">
                <span class="material-symbols-outlined">arrow_back</span>
                Volver al listado
            </a>
        </div>

        <section class="career-header">
            <div class="career-header-content">
                <img src="<?= htmlspecialchars($carrera['imagen']); ?>" alt="<?= htmlspecialchars($carrera['nombre']); ?>" class="career-image">

                <div class="career-info">
                    <div class="badge-category">
                        <span class="material-symbols-outlined"><?= htmlspecialchars($carrera['icono_categoria']); ?></span>
                        <?= htmlspecialchars($carrera['categoria']); ?>
                    </div>
                    <h1><?= htmlspecialchars($carrera['nombre']); ?></h1>
                    <p><?= htmlspecialchars($carrera['descripcion']); ?></p>
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
                            <p><?= htmlspecialchars($carrera['duracion']); ?></p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-item-icon">
                            <span class="material-symbols-outlined">monetization_on</span>
                        </div>
                        <div class="info-item-content">
                            <h3>Rango Salarial (Junior)</h3>
                            <p><?= htmlspecialchars($carrera['salario']); ?></p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-item-icon">
                            <span class="material-symbols-outlined">trending_up</span>
                        </div>
                        <div class="info-item-content">
                            <h3>Demanda Laboral</h3>
                            <p class="text-tertiary"><?= htmlspecialchars($carrera['demanda']); ?></p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-item-icon">
                            <span class="material-symbols-outlined">menu_book</span>
                        </div>
                        <div class="info-item-content">
                            <h3>Dificultad Percibida</h3>
                            <p><?= htmlspecialchars($carrera['dificultad']); ?></p>
                        </div>
                    </div>
                </div>

                <div class="skills-section">
                    <h3>Habilidades Clave</h3>
                    <div class="skills-list">
                        <?php foreach ($carrera['habilidades'] as $habilidad): ?>
                            <span class="skill-tag"><?= htmlspecialchars($habilidad); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </article>

            <aside class="affinity-card">
                <div class="affinity-content">
                    <h3>Tu Afinidad</h3>

                    <div class="affinity-circle">
                        <svg viewBox="0 0 100 100" aria-hidden="true">
                            <circle cx="50" cy="50" r="40" class="affinity-circle-bg"></circle>
                            <circle cx="50" cy="50" r="40" class="affinity-circle-progress" style="stroke-dasharray: 251.2; stroke-dashoffset: <?= (100 - $carrera['afinidad']) * 2.512; ?>"></circle>
                        </svg>
                        <div class="affinity-percentage">
                            <span class="affinity-percentage-number"><?= $carrera['afinidad']; ?></span>
                            <span class="affinity-percentage-symbol">%</span>
                        </div>
                    </div>

                    <p>Tus respuestas en el test indican un alto perfil analítico, ideal para esta carrera.</p>
                    <button type="button" class="btn-affinity">Ver desglose</button>
                </div>
            </aside>
        </section>

        <section class="related-fields">
            <h2>Campos laborales relacionados</h2>

            <div class="fields-grid">
                <?php foreach ($carrera['campos_laborales'] as $campo): ?>
                    <article class="field-card field-<?= htmlspecialchars($campo['id']); ?>">
                        <div class="field-icon-section">
                            <span class="material-symbols-outlined"><?= htmlspecialchars($campo['icono']); ?></span>
                        </div>
                        <div class="field-content">
                            <h3><?= htmlspecialchars($campo['nombre']); ?></h3>
                            <p><?= htmlspecialchars($campo['descripcion']); ?></p>
                            <a href="#" class="field-link">
                                Explorar
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
