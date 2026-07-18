<?php
$siteName = 'Vocatio';
$year = date('Y');
$baseUrl = '/Proyecto-Ambiente-Web-main';

$stats = [
    [
        'label' => 'Total de usuarios',
        'value' => '12,450',
        'icon' => 'group',
        'theme' => 'primary',
        'detail' => '+12% vs el mes pasado',
        'caption' => 'Crecimiento sostenido',
    ],
    [
        'label' => 'Tests completados',
        'value' => '8,210',
        'icon' => 'task_alt',
        'theme' => 'secondary',
        'detail' => '+5.4% vs el mes pasado',
        'caption' => 'Progreso activo',
    ],
    [
        'label' => 'Carreras registradas',
        'value' => '142',
        'icon' => 'work',
        'theme' => 'tertiary',
        'detail' => 'Estable',
        'caption' => 'Catálogo activo',
    ],
];

$recentEvaluations = [
    [
        'student' => 'Elena Rodríguez',
        'date' => '24 oct, 2023',
        'affinity' => 'Software Engineering',
        'status' => 'Completado',
        'statusClass' => 'vt-admin-badge--success',
    ],
    [
        'student' => 'Marcus Chen',
        'date' => '24 oct, 2023',
        'affinity' => 'Industrial Design',
        'status' => 'Completado',
        'statusClass' => 'vt-admin-badge--success',
    ],
    [
        'student' => 'Sarah Jenkins',
        'date' => '23 oct, 2023',
        'affinity' => 'Nursing',
        'status' => 'Completado',
        'statusClass' => 'vt-admin-badge--success',
    ],
    [
        'student' => 'David Kim',
        'date' => '23 oct, 2023',
        'affinity' => 'Pendiente...',
        'status' => 'En progreso',
        'statusClass' => 'vt-admin-badge--pending',
    ],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administración - <?= htmlspecialchars($siteName) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap">

    <link rel="stylesheet" href="<?= htmlspecialchars($baseUrl) ?>/public/assets/styles/index.css">
    <link rel="stylesheet" href="<?= htmlspecialchars($baseUrl) ?>/public/assets/styles/header.css">
    <link rel="stylesheet" href="<?= htmlspecialchars($baseUrl) ?>/public/assets/styles/footer.css">
    <link rel="stylesheet" href="<?= htmlspecialchars($baseUrl) ?>/public/assets/styles/admin.css">
</head>
<body class="vt-admin-page">

<?php include __DIR__ . '/../layout/header.php'; ?>

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
            <a class="vt-admin-nav-link active" href="#">
                <span class="material-symbols-outlined">dashboard</span>
                Panel de Control
            </a>
            <a class="vt-admin-nav-link" href="#">
                <span class="material-symbols-outlined">group</span>
                Usuarios
            </a>
            <a class="vt-admin-nav-link" href="#">
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
        <section class="vt-admin-topbar d-flex justify-content-between align-items-center">
            <div>
                <h1 class="vt-admin-title">Resumen del panel</h1>
                <p class="vt-admin-topbar-label">Métricas de la plataforma y actividad reciente.</p>
            </div>
            <div class="d-none d-sm-block">
                <span class="vt-admin-pill">Última actualización: Hoy, 09:41 a. m.</span>
            </div>
        </section>

        <section class="vt-admin-main">
            <div class="vt-admin-section">
                <div class="row g-4">
                    <?php foreach ($stats as $item): ?>
                        <div class="col-12 col-lg-4">
                            <div class="vt-admin-card vt-admin-card--<?= htmlspecialchars($item['theme']) ?>">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <p class="vt-admin-card-label"><?= htmlspecialchars($item['label']) ?></p>
                                        <h2 class="vt-admin-card-value"><?= htmlspecialchars($item['value']) ?></h2>
                                    </div>
                                    <div class="vt-admin-card-icon vt-admin-card-icon--<?= htmlspecialchars($item['theme']) ?>">
                                        <span class="material-symbols-outlined"><?= htmlspecialchars($item['icon']) ?></span>
                                    </div>
                                </div>
                                <div class="vt-admin-card-meta">
                                    <span class="vt-admin-chip"><?= htmlspecialchars($item['detail']) ?></span>
                                    <span class="vt-admin-caption"><?= htmlspecialchars($item['caption']) ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <section class="vt-admin-section">
                <div class="vt-admin-section-header">
                    <div>
                        <h2 class="vt-admin-section-title">Evaluaciones recientes</h2>
                        <p class="vt-admin-description">Seguimiento rápido del avance de los usuarios.</p>
                    </div>
                    <a href="#" class="vt-admin-link">Ver todo</a>
                </div>

                <div class="vt-admin-table-card">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 vt-admin-table">
                            <thead>
                                <tr>
                                    <th>Nombre del estudiante</th>
                                    <th>Fecha</th>
                                    <th>Afinidad</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentEvaluations as $evaluation): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($evaluation['student']) ?></td>
                                        <td><?= htmlspecialchars($evaluation['date']) ?></td>
                                        <td><?= htmlspecialchars($evaluation['affinity']) ?></td>
                                        <td>
                                            <span class="vt-admin-badge <?= htmlspecialchars($evaluation['statusClass']) ?>">
                                                <?= htmlspecialchars($evaluation['status']) ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </section>
    </main>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
