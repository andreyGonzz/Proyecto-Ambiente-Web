<?php
require_once __DIR__ . '/../../config/config.php';

$resultados = $resultados ?? [];

$pageTitle = 'Resultados del Cuestionario - ' . siteName;
$pageStyles = ['admin.css', 'usuarios.css'];
$pageScripts = ['admin.js'];
$bodyClass = 'vt-admin-page';
require_once __DIR__ . '/../layout/header.php';
?>
    <div class="vt-admin-shell">
        <aside class="vt-admin-sidebar d-none d-md-flex">
            <nav class="vt-admin-nav">
                <a class="vt-admin-nav-link" href="<?php echo BASE_URL; ?>/public/usuario/index">
                    <span class="material-symbols-outlined">group</span>
                    Usuarios
                </a>
                <a class="vt-admin-nav-link" href="<?php echo BASE_URL; ?>/public/carrera/index">
                    <span class="material-symbols-outlined">work</span>
                    Carreras
                </a>
                <a class="vt-admin-nav-link active" href="<?php echo BASE_URL; ?>/public/usuario/resultados">
                    <span class="material-symbols-outlined">assessment</span>
                    Resultados
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
                    <h1 class="vt-admin-title">Resultados del Cuestionario</h1>
                    <p class="vt-admin-topbar-label">Consulta los resultados vocacionales guardados de todos los usuarios.</p>
                </div>
            </section>

            <section class="vt-admin-main">
                <div class="vt-usuarios-toolbar">
                    <div class="search-container">
                        <span class="material-symbols-outlined">search</span>
                        <input type="text" class="search-input" placeholder="Buscar por usuario, correo o carrera..." id="resultadoBusqueda">
                    </div>
                </div>

                <div class="data-table-card">
                    <div class="table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Correo</th>
                                    <th>Área principal</th>
                                    <th>Afinidad</th>
                                    <th>Carrera recomendada</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody id="resultadosTableBody">
                                <?php if (empty($resultados)): ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            Aún no hay resultados guardados. Cuando un usuario complete el cuestionario, aparecerá aquí.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($resultados as $r): ?>
                                        <tr data-busqueda="<?php echo htmlspecialchars(strtolower($r['usuario_nombre'] . ' ' . $r['usuario_correo'] . ' ' . $r['carrera_nombre'])); ?>">
                                            <td><?php echo htmlspecialchars($r['usuario_nombre']); ?></td>
                                            <td><?php echo htmlspecialchars($r['usuario_correo']); ?></td>
                                            <td><?php echo htmlspecialchars($r['area_principal_label']); ?></td>
                                            <td>
                                                <span class="badge rounded-pill text-bg-primary"><?php echo (int) $r['afinidad_principal']; ?>%</span>
                                            </td>
                                            <td><?php echo htmlspecialchars($r['carrera_nombre'] ?: '—'); ?></td>
                                            <td><?php echo htmlspecialchars($r['fecha']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>