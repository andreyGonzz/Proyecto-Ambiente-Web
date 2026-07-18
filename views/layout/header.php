<?php
require_once __DIR__ . '/../../config/config.php';
?>
<header class="vt-navbar">
    <div class="vt-container d-flex justify-content-between align-items-center vt-navbar-inner">
        <div class="d-flex align-items-center gap-4">
            <a href="/Proyecto%20Ambiente%20Web/public/index.php" class="vt-brand">
                <span class="material-symbols-outlined">explore</span>
                <?= htmlspecialchars($siteName ?? 'Vocatio') ?>
            </a>
            <nav class="d-none d-md-flex gap-4">
                <a href="/Proyecto%20Ambiente%20Web/public/index.php" class="vt-nav-link vt-nav-link-active">Inicio</a>
                <a href="/Proyecto%20Ambiente%20Web/views/areas/areas.php" class="vt-nav-link">Carreras</a>
            </nav>
        </div>
        <div class="d-flex align-items-center gap-3">
            <a href="/Proyecto%20Ambiente%20Web/views/login/login.php" class="vt-link-primary d-none d-md-inline-block">Iniciar sesión</a>
            <a href="/Proyecto%20Ambiente%20Web/views/login/register.php" class="vt-btn-primary vt-shadow-soft">Registrarse</a>
        </div>
    </div>
</header>