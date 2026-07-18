<?php
// Datos de ejemplo - en producción estos vendrían de una base de datos
$siteName = "Vocatio";
$year = date("Y");
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
        'Arquitectura de Sistemas'
    ],
    'campos_laborales' => [
        [
            'id' => 'web',
            'nombre' => 'Desarrollo Web',
            'icono' => 'web',
            'descripcion' => 'Creación de aplicaciones y sitios web interactivos para diversas industrias.'
        ],
        [
            'id' => 'mobile',
            'nombre' => 'Desarrollo Móvil',
            'icono' => 'smartphone',
            'descripcion' => 'Diseño y programación de aplicaciones para plataformas iOS y Android.'
        ],
        [
            'id' => 'data',
            'nombre' => 'Ingeniería de Datos',
            'icono' => 'database',
            'descripcion' => 'Gestión, estructuración y análisis de grandes volúmenes de información.'
        ],
        [
            'id' => 'security',
            'nombre' => 'Ciberseguridad',
            'icono' => 'security',
            'descripcion' => 'Protección de infraestructuras digitales, redes y datos confidenciales.'
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($carrera['nombre']); ?> - Vocatio</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap">

    <!-- Google Font: Inter -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/assets/styles/index.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/assets/styles/header.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/assets/styles/footer.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/assets/styles/detalleCarrera.css">
</head>
<body>

    <!-- Header -->
    <?php include dirname(__DIR__) . '/views/layout/header.php'; ?>

    <!-- Main Content -->
    <main class="container-xxl py-5">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="<?php echo $baseUrl; ?>/views/areas/areas.php" class="btn-back">
                <span class="material-symbols-outlined">arrow_back</span>
                Volver al listado
            </a>
        </div>

        <!-- Career Header -->
        <div class="career-header">
            <div class="career-header-content">
                <!-- Career Image -->
                <img src="<?php echo htmlspecialchars($carrera['imagen']); ?>" 
                     alt="<?php echo htmlspecialchars($carrera['nombre']); ?>" 
                     class="career-image">

                <!-- Career Info -->
                <div class="career-info">
                    <div class="badge-category">
                        <span class="material-symbols-outlined"><?php echo htmlspecialchars($carrera['icono_categoria']); ?></span>
                        <?php echo htmlspecialchars($carrera['categoria']); ?>
                    </div>
                    <h1><?php echo htmlspecialchars($carrera['nombre']); ?></h1>
                    <p><?php echo htmlspecialchars($carrera['descripcion']); ?></p>
                </div>
            </div>
        </div>

        <!-- Bento Grid: General Info + Affinity Card -->
        <div class="bento-grid">
            <!-- General Information Card -->
            <div class="bento-card">
                <h2>Información General</h2>

                <!-- Info Items -->
                <div class="info-grid">
                    <!-- Duration -->
                    <div class="info-item">
                        <div class="info-item-icon">
                            <span class="material-symbols-outlined">schedule</span>
                        </div>
                        <div class="info-item-content">
                            <h3>Duración Estimada</h3>
                            <p><?php echo htmlspecialchars($carrera['duracion']); ?></p>
                        </div>
                    </div>

                    <!-- Salary -->
                    <div class="info-item">
                        <div class="info-item-icon">
                            <span class="material-symbols-outlined">monetization_on</span>
                        </div>
                        <div class="info-item-content">
                            <h3>Rango Salarial (Junior)</h3>
                            <p><?php echo htmlspecialchars($carrera['salario']); ?></p>
                        </div>
                    </div>

                    <!-- Labor Demand -->
                    <div class="info-item">
                        <div class="info-item-icon">
                            <span class="material-symbols-outlined">trending_up</span>
                        </div>
                        <div class="info-item-content">
                            <h3>Demanda Laboral</h3>
                            <p class="text-tertiary"><?php echo htmlspecialchars($carrera['demanda']); ?></p>
                        </div>
                    </div>

                    <!-- Difficulty -->
                    <div class="info-item">
                        <div class="info-item-icon">
                            <span class="material-symbols-outlined">menu_book</span>
                        </div>
                        <div class="info-item-content">
                            <h3>Dificultad Percibida</h3>
                            <p><?php echo htmlspecialchars($carrera['dificultad']); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Skills Section -->
                <div class="skills-section">
                    <h3>Habilidades Clave</h3>
                    <div class="skills-list">
                        <?php foreach ($carrera['habilidades'] as $habilidad): ?>
                            <span class="skill-tag"><?php echo htmlspecialchars($habilidad); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Affinity Card -->
            <div class="affinity-card">
                <div class="affinity-content">
                    <h3>Tu Afinidad</h3>

                    <!-- Circular Progress -->
                    <div class="affinity-circle">
                        <svg viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="40" class="affinity-circle-bg"></circle>
                            <circle cx="50" cy="50" r="40" class="affinity-circle-progress"
                                    style="stroke-dasharray: 251.2; stroke-dashoffset: <?php echo (100 - $carrera['afinidad']) * 2.512; ?>"></circle>
                        </svg>
                        <div class="affinity-percentage">
                            <span class="affinity-percentage-number"><?php echo $carrera['afinidad']; ?></span>
                            <span class="affinity-percentage-symbol">%</span>
                        </div>
                    </div>

                    <p>Tus respuestas en el test indican un alto perfil analítico, ideal para esta carrera.</p>
                    <button class="btn-affinity">Ver desglose</button>
                </div>
            </div>
        </div>

        <!-- Related Career Fields Section -->
        <section class="related-fields">
            <h2>Campos laborales relacionados</h2>

            <div class="fields-grid">
                <?php foreach ($carrera['campos_laborales'] as $campo): ?>
                    <div class="field-card field-<?php echo htmlspecialchars($campo['id']); ?>">
                        <div class="field-icon-section">
                            <span class="material-symbols-outlined"><?php echo htmlspecialchars($campo['icono']); ?></span>
                        </div>
                        <div class="field-content">
                            <h3><?php echo htmlspecialchars($campo['nombre']); ?></h3>
                            <p><?php echo htmlspecialchars($campo['descripcion']); ?></p>
                            <a href="#" class="field-link">
                                Explorar
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <?php include dirname(__DIR__) . '/views/layout/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<body class="bg-background text-on-background font-body-md min-h-screen flex flex-col">
<!-- TopNavBar -->
<nav class="bg-surface-container-lowest shadow-sm w-full top-0 sticky z-50">
<div class="flex justify-between items-center w-full px-gutter max-w-container-max mx-auto h-16">
<div class="text-headline-md font-headline-md font-bold text-primary">Vocatio</div>
<div class="hidden md:flex gap-6 items-center">
<a class="text-on-surface-variant hover:text-primary transition-colors duration-200 font-label-md text-label-md" href="#">Inicio</a>
<a class="text-primary font-bold border-b-2 border-primary opacity-80 transition-opacity font-label-md text-label-md" href="#">Carreras</a>
</div>
<div class="flex gap-4">
<button class="text-primary font-label-md text-label-md hover:bg-surface-container-low px-4 py-2 rounded-full transition-colors">Iniciar sesión</button>
<button class="bg-primary text-on-primary font-label-md text-label-md px-4 py-2 rounded-full hover:bg-primary-container transition-colors">Registrarse</button>
</div>
</div>
</nav>
<!-- Main Content Canvas -->
<main class="flex-grow w-full max-w-container-max mx-auto px-gutter py-section-padding">
<div class="mb-stack-lg">
<button class="flex items-center text-primary font-label-md text-label-md hover:bg-surface-container-low px-4 py-2 rounded-full transition-colors border border-primary bg-surface-container-lowest">
<span class="material-symbols-outlined mr-2 text-[18px]">arrow_back</span>
                Back to list
            </button>
</div>
<!-- Career Header -->
<header class="bg-surface-container-lowest rounded-xl shadow-sm p-8 mb-stack-lg flex flex-col md:flex-row gap-8 items-start relative overflow-hidden">
<div class="absolute inset-0 bg-gradient-to-br from-primary-container/10 to-transparent pointer-events-none"></div>
<div class="w-full md:w-1/3 aspect-[4/3] rounded-lg overflow-hidden shrink-0">
<img class="w-full h-full object-cover" data-alt="A brightly lit modern university campus laboratory or studio space, representing a vibrant career path. The setting features sleek white surfaces, soft natural sunlight streaming through large windows, and subtle accents of primary blue and secondary purple to match the Vocatio brand. Students are engaged in collaborative, focused work, radiating calm confidence and optimism." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBDPx4AFwuqXls9JZXmheTLYhpid21gIRO6liB2Y3Shht4NzwOEkI9RyQDG975orxsV3JguQz1gm8qDzZbAGZWmxXvNQ_22DBk7L22Re5nE0aK1b87sBRQ7SUqkf21b7a9VNfY2FzOPQ4_PkeQ49PuQVRjmpFTV_5S5RvhYnTVMhWF961LkVLByMT1ry8MvmI2CdgrTHLj6a5IhOk3fUW6D8ugRz0IxsFQZ7WK4CzL1AcKg6T5eaB9FnA">
</div>
<div class="flex-grow z-10">
<div class="inline-flex items-center bg-secondary-container/20 text-secondary-container px-3 py-1 rounded-full font-label-md text-caption mb-4">
<span class="material-symbols-outlined text-[16px] mr-1">science</span>
                    Tecnología e Ingeniería
                </div>
<h1 class="font-display-lg text-display-lg text-on-surface mb-stack-sm">Ingeniería de Software</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl">
                    La Ingeniería de Software es la disciplina de aplicar principios estructurados y metódicos al desarrollo, operación y mantenimiento de sistemas de software. Esta carrera te prepara para diseñar soluciones tecnológicas innovadoras que impactan la vida diaria de millones de personas.
                </p>
</div>
</header>
<!-- Bento Grid Layout -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
<!-- General Info Bento -->
<div class="md:col-span-2 bg-surface-container-lowest rounded-xl shadow-sm p-8 flex flex-col gap-6">
<h2 class="font-headline-md text-headline-md text-on-surface border-b border-outline-variant pb-2">Información General</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
<div class="flex items-start gap-4">
<div class="bg-primary-container text-primary p-3 rounded-lg flex items-center justify-center">
<span class="material-symbols-outlined">schedule</span>
</div>
<div>
<h3 class="font-label-md text-label-md text-on-surface-variant">Duración Estimada</h3>
<p class="font-body-md text-body-md text-on-surface font-semibold">4 - 5 Años</p>
</div>
</div>
<div class="flex items-start gap-4">
<div class="bg-primary-container text-primary p-3 rounded-lg flex items-center justify-center">
<span class="material-symbols-outlined">monetization_on</span>
</div>
<div>
<h3 class="font-label-md text-label-md text-on-surface-variant">Rango Salarial (Junior)</h3>
<p class="font-body-md text-body-md text-on-surface font-semibold">$3,000 - $5,000 / mes</p>
</div>
</div>
<div class="flex items-start gap-4">
<div class="bg-primary-container text-primary p-3 rounded-lg flex items-center justify-center">
<span class="material-symbols-outlined">trending_up</span>
</div>
<div>
<h3 class="font-label-md text-label-md text-on-surface-variant">Demanda Laboral</h3>
<p class="font-body-md text-body-md text-on-surface font-semibold text-tertiary">Muy Alta</p>
</div>
</div>
<div class="flex items-start gap-4">
<div class="bg-primary-container text-primary p-3 rounded-lg flex items-center justify-center">
<span class="material-symbols-outlined">menu_book</span>
</div>
<div>
<h3 class="font-label-md text-label-md text-on-surface-variant">Dificultad Percibida</h3>
<p class="font-body-md text-body-md text-on-surface font-semibold">Alta (Matemáticas y Lógica)</p>
</div>
</div>
</div>
<div class="mt-4">
<h3 class="font-label-md text-label-md text-on-surface-variant mb-2">Habilidades Clave</h3>
<div class="flex flex-wrap gap-2">
<span class="bg-surface-container text-on-surface-variant px-3 py-1 rounded-full text-caption font-label-md">Lógica de Programación</span>
<span class="bg-surface-container text-on-surface-variant px-3 py-1 rounded-full text-caption font-label-md">Resolución de Problemas</span>
<span class="bg-surface-container text-on-surface-variant px-3 py-1 rounded-full text-caption font-label-md">Trabajo en Equipo</span>
<span class="bg-surface-container text-on-surface-variant px-3 py-1 rounded-full text-caption font-label-md">Arquitectura de Sistemas</span>
</div>
</div>
</div>
<!-- Match Score Bento -->
<div class="bg-surface-container-highest rounded-xl shadow-sm p-8 flex flex-col items-center justify-center text-center relative overflow-hidden group hover:-translate-y-1 transition-transform duration-300">
<div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
<span class="material-symbols-outlined text-display-lg text-primary" style="font-size: 120px;">radar</span>
</div>
<h3 class="font-headline-sm text-headline-md text-on-surface mb-2 z-10">Tu Afinidad</h3>
<div class="relative w-32 h-32 flex items-center justify-center z-10 mb-4">
<svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
<circle class="stroke-surface-dim" cx="50" cy="50" fill="none" r="40" stroke-width="8"></circle>
<circle class="stroke-primary" cx="50" cy="50" fill="none" r="40" stroke-dasharray="251.2" stroke-dashoffset="37.68" stroke-linecap="round" stroke-width="8"></circle> <!-- 85% -->
</svg>
<div class="absolute flex flex-col items-center">
<span class="font-display-lg text-display-lg text-primary leading-none">85<span class="text-headline-md">%</span></span>
</div>
</div>
<p class="font-body-md text-body-md text-on-surface-variant z-10">Tus respuestas en el test indican un alto perfil analítico, ideal para esta carrera.</p>
<button class="mt-4 bg-primary text-on-primary font-label-md text-label-md px-6 py-2 rounded-full hover:bg-primary-container transition-colors z-10 w-full">Ver desglose</button>
</div>
</div>
<!-- Campos Laborales Relacionados -->
<section class="mt-section-padding">
<h2 class="font-headline-lg text-headline-lg text-on-surface mb-stack-lg">Campos laborales relacionados</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
<!-- Card 1 -->
<div class="bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-outline-variant/30 overflow-hidden flex flex-col group cursor-pointer hover:-translate-y-1 transform">
<div class="h-32 bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-on-primary transition-colors duration-300">
<span class="material-symbols-outlined text-display-lg">web</span>
</div>
<div class="p-6 flex-grow flex flex-col">
<h3 class="font-headline-md text-label-md font-bold text-on-surface mb-2">Desarrollo Web</h3>
<p class="font-body-md text-caption text-on-surface-variant mb-4 flex-grow">Creación de aplicaciones y sitios web interactivos para diversas industrias.</p>
<div class="flex items-center text-primary font-label-md text-caption mt-auto group-hover:underline">
                            Explorar <span class="material-symbols-outlined text-[16px] ml-1">arrow_forward</span>
</div>
</div>
</div>
<!-- Card 2 -->
<div class="bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-outline-variant/30 overflow-hidden flex flex-col group cursor-pointer hover:-translate-y-1 transform">
<div class="h-32 bg-secondary/10 flex items-center justify-center text-secondary group-hover:bg-secondary group-hover:text-on-secondary transition-colors duration-300">
<span class="material-symbols-outlined text-display-lg">smartphone</span>
</div>
<div class="p-6 flex-grow flex flex-col">
<h3 class="font-headline-md text-label-md font-bold text-on-surface mb-2">Desarrollo Móvil</h3>
<p class="font-body-md text-caption text-on-surface-variant mb-4 flex-grow">Diseño y programación de aplicaciones para plataformas iOS y Android.</p>
<div class="flex items-center text-secondary font-label-md text-caption mt-auto group-hover:underline">
                            Explorar <span class="material-symbols-outlined text-[16px] ml-1">arrow_forward</span>
</div>
</div>
</div>
<!-- Card 3 -->
<div class="bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-outline-variant/30 overflow-hidden flex flex-col group cursor-pointer hover:-translate-y-1 transform">
<div class="h-32 bg-tertiary/10 flex items-center justify-center text-tertiary group-hover:bg-tertiary group-hover:text-on-tertiary transition-colors duration-300">
<span class="material-symbols-outlined text-display-lg">database</span>
</div>
<div class="p-6 flex-grow flex flex-col">
<h3 class="font-headline-md text-label-md font-bold text-on-surface mb-2">Ingeniería de Datos</h3>
<p class="font-body-md text-caption text-on-surface-variant mb-4 flex-grow">Gestión, estructuración y análisis de grandes volúmenes de información.</p>
<div class="flex items-center text-tertiary font-label-md text-caption mt-auto group-hover:underline">
                            Explorar <span class="material-symbols-outlined text-[16px] ml-1">arrow_forward</span>
</div>
</div>
</div>
<!-- Card 4 -->
<div class="bg-surface-container-lowest rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-outline-variant/30 overflow-hidden flex flex-col group cursor-pointer hover:-translate-y-1 transform">
<div class="h-32 bg-on-surface/5 flex items-center justify-center text-on-surface group-hover:bg-on-surface group-hover:text-surface-container-lowest transition-colors duration-300">
<span class="material-symbols-outlined text-display-lg">security</span>
</div>
<div class="p-6 flex-grow flex flex-col">
<h3 class="font-headline-md text-label-md font-bold text-on-surface mb-2">Ciberseguridad</h3>
<p class="font-body-md text-caption text-on-surface-variant mb-4 flex-grow">Protección de infraestructuras digitales, redes y datos confidenciales.</p>
<div class="flex items-center text-on-surface font-label-md text-caption mt-auto group-hover:underline">
                            Explorar <span class="material-symbols-outlined text-[16px] ml-1">arrow_forward</span>
</div>
</div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-surface-container-highest mt-auto border-t border-outline-variant w-full">
<div class="flex flex-col md:flex-row justify-between items-center w-full px-gutter py-stack-lg max-w-container-max mx-auto gap-4">
<div class="text-headline-sm font-headline-sm font-bold text-on-surface">Vocatio</div>
<div class="flex gap-6">
<a class="text-on-surface-variant hover:text-secondary transition-colors font-body-md text-body-md" href="#">Institutional</a>
<a class="text-on-surface-variant hover:text-secondary transition-colors font-body-md text-body-md" href="#">Contact</a>
<a class="text-on-surface-variant hover:text-secondary transition-colors font-body-md text-body-md" href="#">Privacy Policy</a>
</div>
<div class="text-on-surface-variant font-caption text-caption">
                © 2024 Vocatio. All rights reserved.
            </div>
</div>
</footer>
</body></html>