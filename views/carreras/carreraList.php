<?php
$siteName = 'Vocatio';
$year = date('Y');
$baseUrl = '/Proyecto%20Ambiente%20Web';

$carreras = [
    [
        'nombre' => 'Ingeniería de Software',
        'categoria' => 'Tecnología',
        'categoriaClass' => 'vt-career-chip--technology',
        'duracion' => '5 Años',
        'descripcion' => 'Diseña, desarrolla y mantén sistemas informáticos complejos que impulsan el mundo digital.',
        'imagen' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB6W_X0Mx6dR_iubx92fLnaBRpvk9hLuvNFZTX5esDqhQFpGKc-369-b5f3bQ6A0oTd8dBkCoxHQaGuZGz9nQTaq2Qtpj_hID5StEXoFbnxAYiA6CASDkHGm9BfZe1_HiCBCtvlzMjhe0mByeXeUNE2yudFisze6nQMVlmMByRzLUz9eVWrzTerhhfiMYwcWBauVuZKP5Yy_HhRGJIN9JpKHnxQ28TDRS-X0Ls5IfXE6sSLE7Eboc9sTQ',
        'detalleUrl' => $baseUrl . '/views/carreras/detalleCarrera.php',
    ],
    [
        'nombre' => 'Medicina General',
        'categoria' => 'Salud',
        'categoriaClass' => 'vt-career-chip--health',
        'duracion' => '6 Años',
        'descripcion' => 'Diagnostica, trata y prevén enfermedades para mejorar la calidad de vida de las personas.',
        'imagen' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDFAvxsLqCdX3OKT2Dxu9OSzNmQRQoC3BJsN4HGrv4KOeUhp5LYVT1j-EyxUnMmFmGSIpe9jiiuGfZRJgxLWkkLMYl_86bua0lz43Qmt9CQSXvEYxQgUnbteOZOJhrqKUwX9yE2oBsY4681lLcNOm01axwIhImu7-JVvVTgxpDYDQvh6_1tpRfphC_xiX3-b0FFS3zgyWKDX4hTcWCO0FPjfMGdmekCEeuUbkGMuGKK685fRST82ntJXA',
        'detalleUrl' => $baseUrl . '/views/carreras/detalleCarrera.php',
    ],
    [
        'nombre' => 'Diseño Gráfico Digital',
        'categoria' => 'Arte y Diseño',
        'categoriaClass' => 'vt-career-chip--design',
        'duracion' => '4 Años',
        'descripcion' => 'Comunica ideas a través de medios visuales, creando identidades de marca e interfaces atractivas.',
        'imagen' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB14c6GQwTfhScuEBnxp0VApVDWgsdgPz55iCyG2Y4a8ARLtaWC4YegrvDpvK1rW4OVSCt1RzY39QUQ9aITo-DCovDPjSp564xgfsBZyxeBnYf_onRs6P9jHD9Kf2pdJFXlFb6YhPDp1XVbGPwBs2AJ8qwAYyybxJrbO19XrLjCCsAIpIo1p9_j6gDmHxhL_XGEgpRGLAnxCWd5Oxpof0stcYq43-guz4ajVS-C90pMQv-rQ-AD-GiMSQ',
        'detalleUrl' => $baseUrl . '/views/carreras/detalleCarrera.php',
    ],
    [
        'nombre' => 'Administración de Empresas',
        'categoria' => 'Negocios',
        'categoriaClass' => 'vt-career-chip--business',
        'duracion' => '4 Años',
        'descripcion' => 'Lidera organizaciones, optimiza recursos y desarrolla estrategias para el crecimiento comercial.',
        'imagen' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAhTTlg_pXX5pEbMmnmp4pNCOYt6cJaFPlQx0-D3rUEBpEYWG1OJzNtXRDyMCWCOP15pDZdjPy1e9YSIjiKDyucOUAXTWit0jlOHmnAX3bbajNC4sISnUIfXCrO21oZLMkELok3pp5Io4Zbbv8a4w8IK7NknzEJeaPiV74CiXwkwzOWDxy1Qg1aN6ELUHya8kBM08XHkpb1eYY4yTRyF_ce4GbqjvUYAo34jBdKpK-YHpIs_J5g1PpdIw',
        'detalleUrl' => $baseUrl . '/views/carreras/detalleCarrera.php',
    ],
];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carreras - <?= htmlspecialchars($siteName) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap">

    <link rel="stylesheet" href="<?= htmlspecialchars($baseUrl) ?>/public/assets/styles/index.css">
    <link rel="stylesheet" href="<?= htmlspecialchars($baseUrl) ?>/public/assets/styles/header.css">
    <link rel="stylesheet" href="<?= htmlspecialchars($baseUrl) ?>/public/assets/styles/footer.css">
    <link rel="stylesheet" href="<?= htmlspecialchars($baseUrl) ?>/public/assets/styles/carreras-list.css">
</head>

<body class="vt-careers-page">
    <?php require_once __DIR__ . '/../layout/header.php'; ?>

    <main class="vt-container vt-section">
        <section class="vt-careers-hero">
            <h1 class="vt-careers-title vt-display">Explora tu futuro</h1>
            <div class="vt-careers-toolbar">
                <div class="vt-careers-search">
                    <span class="material-symbols-outlined">search</span>
                    <input type="text" class="form-control" placeholder="Busca por carrera, área o interés...">
                </div>
                <button type="button" class="vt-careers-filter-btn btn btn-outline-secondary rounded-pill d-flex align-items-center gap-2">
                    <span class="material-symbols-outlined">filter_list</span>
                    Filtros
                </button>
            </div>

            <div class="vt-careers-chip-list">
                <a href="#" class="vt-careers-chip is-active">Todas</a>
                <a href="#" class="vt-careers-chip">Tecnología</a>
                <a href="#" class="vt-careers-chip">Salud</a>
                <a href="#" class="vt-careers-chip">Arte y Diseño</a>
                <a href="#" class="vt-careers-chip">Negocios</a>
            </div>
        </section>

        <section class=" row g-4">
            <?php foreach ($carreras as $carrera): ?>
                <article class="col-12 col-md-6 col-lg-4">
                    <div class="vt-career-card">
                        <img src="<?= htmlspecialchars($carrera['imagen']) ?>" alt="<?= htmlspecialchars($carrera['nombre']) ?>" class="vt-career-image">

                        <div class="vt-career-body">
                            <div class="vt-career-badge-row">
                                <span class="vt-career-chip <?= htmlspecialchars($carrera['categoriaClass']) ?>">
                                    <?= htmlspecialchars($carrera['categoria']) ?>
                                </span>
                                <span class="vt-career-bookmark material-symbols-outlined">bookmark</span>
                            </div>

                            <h2 class="vt-career-title"><?= htmlspecialchars($carrera['nombre']) ?></h2>
                            <p class="vt-career-description"><?= htmlspecialchars($carrera['descripcion']) ?></p>

                            <div class="vt-career-footer">
                                <span class="vt-career-duration">
                                    <span class="material-symbols-outlined">schedule</span>
                                    <?= htmlspecialchars($carrera['duracion']) ?>
                                </span>
                                <a href="<?= htmlspecialchars($carrera['detalleUrl']) ?>" class="vt-career-link">
                                    Ver más
                                    <span class="material-symbols-outlined">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
    </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
