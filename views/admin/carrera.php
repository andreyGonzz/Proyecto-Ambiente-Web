<?php
require_once __DIR__ . '/../../config/config.php';

$carreras = [
    [
        'nombre' => 'Ingeniería en Sistemas Computacionales',
        'area' => 'Tecnología y Sistemas',
        'estado' => 'activo',
        'estadoLabel' => 'Activo',
        'estadoClass' => 'vt-carrera-badge--active',
        'areaClass' => 'vt-carrera-pill--technology',
        'modificacion' => '28 Oct, 2023',
    ],
    [
        'nombre' => 'Medicina General',
        'area' => 'Ciencias de la Salud',
        'estado' => 'activo',
        'estadoLabel' => 'Activo',
        'estadoClass' => 'vt-carrera-badge--active',
        'areaClass' => 'vt-carrera-pill--health',
        'modificacion' => '25 Oct, 2023',
    ],
    [
        'nombre' => 'Diseño Gráfico Digital',
        'area' => 'Arte y Diseño',
        'estado' => 'activo',
        'estadoLabel' => 'Activo',
        'estadoClass' => 'vt-carrera-badge--active',
        'areaClass' => 'vt-carrera-pill--design',
        'modificacion' => '22 Oct, 2023',
    ],
    [
        'nombre' => 'Administración de Empresas',
        'area' => 'Negocios y Finanzas',
        'estado' => 'inactivo',
        'estadoLabel' => 'Inactivo',
        'estadoClass' => 'vt-carrera-badge--inactive',
        'areaClass' => 'vt-carrera-pill--business',
        'modificacion' => '15 Oct, 2023',
    ],
    [
        'nombre' => 'Derecho y Ciencias Políticas',
        'area' => 'Ciencias Sociales',
        'estado' => 'activo',
        'estadoLabel' => 'Activo',
        'estadoClass' => 'vt-carrera-badge--active',
        'areaClass' => 'vt-carrera-pill--social',
        'modificacion' => '12 Oct, 2023',
    ],
    [
        'nombre' => 'Arquitectura y Urbanismo',
        'area' => 'Arte y Diseño',
        'estado' => 'activo',
        'estadoLabel' => 'Activo',
        'estadoClass' => 'vt-carrera-badge--active',
        'areaClass' => 'vt-carrera-pill--design',
        'modificacion' => '10 Oct, 2023',
    ],
    [
        'nombre' => 'Ingeniería Mecatrónica',
        'area' => 'Tecnología y Sistemas',
        'estado' => 'activo',
        'estadoLabel' => 'Activo',
        'estadoClass' => 'vt-carrera-badge--active',
        'areaClass' => 'vt-carrera-pill--technology',
        'modificacion' => '08 Oct, 2023',
    ],
];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Carreras - <?= htmlspecialchars($siteName) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap">

    <link rel="stylesheet" href="<?= htmlspecialchars($baseUrl) ?>/public/assets/styles/index.css">
    <link rel="stylesheet" href="<?= htmlspecialchars($baseUrl) ?>/public/assets/styles/header.css">
    <link rel="stylesheet" href="<?= htmlspecialchars($baseUrl) ?>/public/assets/styles/footer.css">
    <link rel="stylesheet" href="<?= htmlspecialchars($baseUrl) ?>/public/assets/styles/admin.css">
    <link rel="stylesheet" href="<?= htmlspecialchars($baseUrl) ?>/public/assets/styles/carreras.css">
</head>

<body class="vt-admin-page">

    <?php require_once __DIR__ . '/../layout/header.php'; ?>

    <div class="vt-admin-shell">
        <aside class="vt-admin-sidebar d-none d-md-flex">
            <div class="vt-admin-brand">Vocatio Admin</div>

            <div class="vt-admin-profile">
                <div class="vt-admin-avatar">
                    <span class="material-symbols-outlined">person</span>
                </div>
                <div>
                    <p class="vt-admin-profile-title">Perfil Admin</p>
                    <p class="vt-admin-profile-text">Portal de Gestión</p>
                </div>
            </div>

            <nav class="vt-admin-nav">
                <a class="vt-admin-nav-link" href="<?php echo $baseUrl; ?>/views/admin/admin.php">
                    <span class="material-symbols-outlined">dashboard</span>
                    Panel de Control
                </a>
                <a class="vt-admin-nav-link" href="<?php echo $baseUrl; ?>/views/admin/usuarios.php">
                    <span class="material-symbols-outlined">group</span>
                    Usuarios
                </a>
                <a class="vt-admin-nav-link active" href="<?php echo $baseUrl; ?>/views/admin/carrera.php">
                    <span class="material-symbols-outlined">work</span>
                    Carreras
                </a>
            </nav>

            <div class="vt-admin-sidebar-footer">
                <button type="button" class="vt-admin-logout-btn">
                    <span class="material-symbols-outlined">logout</span>
                    Cerrar sesión
                </button>
            </div>
        </aside>

        <main class="vt-admin-content">
            <section class="vt-admin-topbar d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h1 class="vt-admin-title">Gestión de Carreras</h1>
                    <p class="vt-admin-topbar-label">Administra el catálogo de carreras profesionales y sus áreas asociadas.</p>
                </div>
                <button type="button" class="btn btn-primary rounded-pill px-4 py-2">
                    <span class="material-symbols-outlined align-middle">add</span>
                    <span class="align-middle">Agregar carrera</span>
                </button>
            </section>

            <section class="vt-admin-main">
                <div class="vt-carrera-toolbar">
                    <div class="vt-carrera-toolbar-search">
                        <span class="material-symbols-outlined">search</span>
                        <input type="text" placeholder="Buscar por nombre o área..." aria-label="Buscar carrera">
                    </div>

                    <div class="vt-carrera-action-group">
                        <button type="button" class="vt-carrera-btn">
                            <span class="material-symbols-outlined">filter_list</span>
                            Filtrar
                        </button>
                        <button type="button" class="vt-carrera-btn">
                            <span class="material-symbols-outlined">download</span>
                            Exportar
                        </button>
                    </div>
                </div>

                <div class="vt-carrera-table-card">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 vt-carrera-table">
                            <thead>
                                <tr>
                                    <th>Nombre de la Carrera</th>
                                    <th>Área de Estudio</th>
                                    <th>Estado</th>
                                    <th>Modificación</th>
                                    <th class="text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($carreras as $carrera): ?>
                                    <tr>
                                        <td class="fw-semibold text-dark"><?= htmlspecialchars($carrera['nombre']) ?></td>
                                        <td>
                                            <span class="vt-carrera-pill <?= htmlspecialchars($carrera['areaClass']) ?>">
                                                <?= htmlspecialchars($carrera['area']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="vt-carrera-badge <?= htmlspecialchars($carrera['estadoClass']) ?>">
                                                <?= htmlspecialchars($carrera['estadoLabel']) ?>
                                            </span>
                                        </td>
                                        <td class="text-body-secondary">
                                            <?= htmlspecialchars($carrera['modificacion']) ?>
                                        </td>
                                        <td>
                                            <div class="vt-carrera-action-buttons">
                                                <button type="button" class="vt-carrera-action-btn" title="Editar" aria-label="Editar">
                                                    <span class="material-symbols-outlined">edit</span>
                                                </button>
                                                <button type="button" class="vt-carrera-action-btn vt-carrera-action-btn--danger" title="Eliminar" aria-label="Eliminar">
                                                    <span class="material-symbols-outlined">delete</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="vt-carrera-pagination">
                        <span class="vt-admin-topbar-label">Mostrando <span class="fw-semibold text-dark">7</span> de <span class="fw-semibold text-dark">142</span> carreras</span>
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="vt-carrera-page-btn" disabled aria-label="Página anterior">
                                <span class="material-symbols-outlined">chevron_left</span>
                            </button>
                            <button type="button" class="vt-carrera-page-btn active">1</button>
                            <button type="button" class="vt-carrera-page-btn">2</button>
                            <button type="button" class="vt-carrera-page-btn">3</button>
                            <span class="text-body-secondary">...</span>
                            <button type="button" class="vt-carrera-page-btn">21</button>
                            <button type="button" class="vt-carrera-page-btn" aria-label="Página siguiente">
                                <span class="material-symbols-outlined">chevron_right</span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
