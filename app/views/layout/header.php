<?php
require_once __DIR__ . '/../../config/config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$logueado = isset($_SESSION['user_id']);
$nombreUsuario = $logueado ? $_SESSION['user_nombre'] : '';
?>
<header class="vt-navbar">
    <div class="vt-container d-flex justify-content-between align-items-center vt-navbar-inner">
        <div class="d-flex align-items-center gap-4">
            <a href="<?= htmlspecialchars(BASE_URL) ?>/public/index.php" class="vt-brand">
                <span class="material-symbols-outlined">explore</span>
                <?= htmlspecialchars($siteName ?? 'Vocatio') ?>
            </a>
            <nav class="d-none d-md-flex gap-4">
                <a href="<?= htmlspecialchars(BASE_URL) ?>/public/index.php" class="vt-nav-link vt-nav-link-active">Inicio</a>
                <a href="<?= htmlspecialchars(BASE_URL) ?>/app/views/areas/areas.php" class="vt-nav-link">Carreras</a>
            </nav>
        </div>
        <div class="d-flex align-items-center gap-3">
            <?php if ($logueado): ?>
                <span class="vt-text-on-surface-variant d-none d-md-inline-block">
                    Hola, <?= htmlspecialchars($nombreUsuario) ?>
                </span>
                <a href="<?= htmlspecialchars(BASE_URL) ?>/public/auth/logout" class="vt-btn-primary vt-shadow-soft">
                    <span class="material-symbols-outlined">logout</span>
                    Cerrar sesión
                </a>
            <?php else: ?>
                <a href="<?= htmlspecialchars(BASE_URL) ?>/public/auth/login" class="vt-link-primary d-none d-md-inline-block">Iniciar sesión</a>
                <a href="<?= htmlspecialchars(BASE_URL) ?>/public/auth/register" class="vt-btn-primary vt-shadow-soft">Registrarse</a>
            <?php endif; ?>
        </div>
    </div>
</header>