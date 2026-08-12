<?php
require_once __DIR__ . '/../../config/config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Variables opcionales que la vista puede definir antes de incluir este archivo
$pageTitle = $pageTitle ?? siteName;
$pageStyles = $pageStyles ?? [];
$bodyClass = $bodyClass ?? '';
$sinNavbar = !empty($sinNavbar);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Tipografía e iconos -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap">

    <!-- CSS común -->
    <link rel="stylesheet" href="<?= htmlspecialchars(BASE_URL) ?>/public/assets/styles/index.css">
    <link rel="stylesheet" href="<?= htmlspecialchars(BASE_URL) ?>/public/assets/styles/header.css">
    <link rel="stylesheet" href="<?= htmlspecialchars(BASE_URL) ?>/public/assets/styles/footer.css">

    <!-- CSS específico de la página -->
    <?php foreach ($pageStyles as $estilo): ?>
        <?php $estiloRuta = __DIR__ . '/../../../public/assets/styles/' . $estilo; ?>
        <link rel="stylesheet"
            href="<?= htmlspecialchars(BASE_URL) ?>/public/assets/styles/<?= htmlspecialchars($estilo) ?>?v=<?= file_exists($estiloRuta) ? filemtime($estiloRuta) : '' ?>">
    <?php endforeach; ?>
    <!-- Variables globales para JS -->
    <script>
        window.BASE_URL_ = <?= json_encode(BASE_URL) ?>;
        window.API_ROOT = encodeURI(<?= json_encode(BASE_URL) ?>) + '/public/';
    </script>
</head>

<body<?= $bodyClass !== '' ? ' class="' . htmlspecialchars($bodyClass) . '"' : '' ?>>

<?php if (!$sinNavbar): ?>
<header class="vt-navbar">
    <div class="vt-container d-flex justify-content-between align-items-center vt-navbar-inner">
        <div class="d-flex align-items-center gap-4">
            <a href="<?= htmlspecialchars(BASE_URL) ?>/public/" class="vt-brand">
                <span class="material-symbols-outlined">explore</span>
                <?= htmlspecialchars($siteName ?? 'Vocatio') ?>
            </a>
            <nav class="d-none d-md-flex gap-4">
                <a href="<?= htmlspecialchars(BASE_URL) ?>/public/" class="vt-nav-link">Inicio</a>
                <a href="<?= htmlspecialchars(BASE_URL) ?>/public/areas/index" class="vt-nav-link">Carreras</a>
            </nav>
        </div>
        <div class="d-flex align-items-center gap-3">
            <?php if (!empty($_SESSION['user_id'])): ?>
                <span class="vt-text-on-surface-variant d-none d-md-inline-block" id="navNombre">Bienvenido, <?= htmlspecialchars($_SESSION['user_nombre'] ?? $_SESSION['user_name'] ?? $_SESSION['user_correo'] ?? '') ?></span>
                <div id="navSesion" class="d-md-inline-flex align-items-center gap-3">
                    <a href="<?= htmlspecialchars(BASE_URL) ?>/public/auth/logout" class="vt-btn-primary vt-shadow-soft">
                        <span class="material-symbols-outlined">logout</span>
                        Cerrar sesión
                    </a>
                </div>
            <?php else: ?>
                <span class="vt-text-on-surface-variant d-none d-md-inline-block" id="navNombre"></span>
                <div id="navInvitado" class="d-md-inline-flex align-items-center gap-3">
                    <a href="<?= htmlspecialchars(BASE_URL) ?>/public/auth/login" class="vt-link-primary">Iniciar sesión</a>
                    <a href="<?= htmlspecialchars(BASE_URL) ?>/public/auth/register" class="vt-btn-primary vt-shadow-soft">Registrarse</a>
                </div>
            <?php endif; ?>

            <button type="button" class="btn vt-navbar-burger d-md-none" data-bs-toggle="offcanvas"
                data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-label="Abrir menú">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>
</header>

<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
    <div class="offcanvas-header">
        <span class="vt-brand" id="mobileMenuLabel">
            <span class="material-symbols-outlined">explore</span>
            <?= htmlspecialchars($siteName ?? 'Vocatio') ?>
        </span>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
        <div class="offcanvas-body d-flex flex-column">
        <nav class="d-flex flex-column mb-3">
            <a href="<?= htmlspecialchars(BASE_URL) ?>/public/" class="vt-nav-link vt-nav-link-mobile">Inicio</a>
            <a href="<?= htmlspecialchars(BASE_URL) ?>/public/areas/index" class="vt-nav-link vt-nav-link-mobile">Carreras</a>
        </nav>
        <hr>
        <div class="d-flex flex-column gap-2 mt-auto">
            <?php if (!empty($_SESSION['user_id'])): ?>
                <div class="text-center mb-2" id="navNombreMovil">Bienvenido, <?= htmlspecialchars($_SESSION['user_nombre'] ?? $_SESSION['user_name'] ?? $_SESSION['user_correo'] ?? '') ?></div>
                <div id="navSesionMovil" class="d-flex flex-column gap-2">
                    <a href="<?= htmlspecialchars(BASE_URL) ?>/public/auth/logout" class="vt-btn-primary justify-content-center">
                        <span class="material-symbols-outlined">logout</span>
                        Cerrar sesión
                    </a>
                </div>
            <?php else: ?>
                <div class="text-center mb-2" id="navNombreMovil"></div>
                <div id="navInvitadoMovil" class="d-flex flex-column gap-2">
                    <a href="<?= htmlspecialchars(BASE_URL) ?>/public/auth/login" class="vt-link-primary">Iniciar sesión</a>
                    <a href="<?= htmlspecialchars(BASE_URL) ?>/public/auth/register" class="vt-btn-primary justify-content-center">Registrarse</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>
