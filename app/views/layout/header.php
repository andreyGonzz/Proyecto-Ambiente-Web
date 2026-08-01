<?php
require_once __DIR__ . '/../../config/config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$logueado = isset($_SESSION['user_id']);
$nombreUsuario = $logueado ? $_SESSION['user_nombre'] : '';

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
        <link rel="stylesheet" href="<?= htmlspecialchars(BASE_URL) ?>/public/assets/styles/<?= htmlspecialchars($estilo) ?>">
    <?php endforeach; ?>
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
                <a href="<?= htmlspecialchars(BASE_URL) ?>/public/" class="vt-nav-link vt-nav-link-active">Inicio</a>
                <a href="<?= htmlspecialchars(BASE_URL) ?>/public/areas/index" class="vt-nav-link">Carreras</a>
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
<?php endif; ?>
