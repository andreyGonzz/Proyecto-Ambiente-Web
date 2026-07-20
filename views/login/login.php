<?php
require_once __DIR__ . '/../../config/config.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vocatio - Iniciar sesión</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/assets/styles/index.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/assets/styles/header.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/assets/styles/footer.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/assets/styles/login.css">
</head>

<body class="bg-light min-vh-100 d-flex flex-column">
    <?php require_once __DIR__ . '/../layout/header.php'; ?>

    <main class="flex-grow-1 d-flex align-items-center py-5">
        <div class="vt-container w-100">
            <div class="row g-0 rounded-4 overflow-hidden shadow-sm bg-white">
                <section
                    class="col-lg-6 d-none d-lg-flex position-relative p-5 align-items-center justify-content-center vt-login-hero">
                    <div class="position-absolute top-0 start-0 w-100 h-100 vt-login-hero-overlay"></div>
                    <div class="position-relative z-1 text-white">
                        <p class="vt-badge vt-bg-secondary-fixed vt-text-on-secondary-fixed mb-3">Vocatio</p>
                        <h1 class="vt-display mb-3">Descubre tu camino ideal.</h1>
                        <p class="vt-body-lg mb-4 vt-max-w-lg">
                            Una plataforma diseñada para guiarte en tu descubrimiento vocacional con claridad y
                            confianza.
                        </p>
                    </div>
                </section>

                <section class="col-12 col-lg-6 p-4 p-md-5 bg-white">
                    <div class="mx-auto" style="max-width: 420px;">
                        <div class="text-center text-lg-start mb-4">
                            <h2 class="vt-headline-lg mb-2">Bienvenido de nuevo</h2>
                            <p class="vt-text-on-surface-variant">Ingresa tus credenciales para continuar.</p>
                        </div>

                        <form class="d-flex flex-column gap-3" id="loginForm">
                            <div>
                                <label for="email" class="form-label vt-label">Correo electrónico</label>
                                <div class="position-relative">
                                    <span
                                        class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">mail</span>
                                    <input type="email" id="email" name="email" class="form-control ps-5 py-3"
                                        placeholder="tu@correo.com" required>
                                </div>
                            </div>

                            <div>
                                <label for="password" class="form-label vt-label">Contraseña</label>
                                <div class="position-relative">
                                    <span
                                        class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">lock</span>
                                    <input type="password" id="password" name="password"
                                        class="form-control ps-5 pe-5 py-3" placeholder="••••••••" required>
                                    <button type="button"
                                        class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-0 text-muted"
                                        id="togglePassword" aria-label="Mostrar u ocultar contraseña">
                                        <span class="material-symbols-outlined"
                                            id="visibilityIcon">visibility_off</span>
                                    </button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label vt-text-on-surface-variant"
                                        for="remember">Recordarme</label>
                                </div>
                                <a href="<?php echo $baseUrl; ?>/views/login/recover.php"
                                    class="vt-link-primary">¿Olvidaste tu contraseña?</a>
                            </div>

                            <div id="messageArea" class="d-none rounded-3 p-3 align-items-center gap-2">
                                <span class="material-symbols-outlined" id="messageIcon">info</span>
                                <span id="messageText"></span>
                            </div>

                            <button type="submit" class="vt-btn-primary vt-btn-lg w-100 justify-content-center">
                                Iniciar sesión
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </button>
                        </form>

                        <div class="mt-4 pt-4 border-top text-center">
                            <p class="mb-0 vt-text-on-surface-variant">
                                ¿No tienes una cuenta?
                                <a href="<?php echo $baseUrl; ?>/views/login/register.php"
                                    class="vt-link-primary ms-1">Regístrate aquí</a>
                            </p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $baseUrl; ?>/public/assets/js/login.js"></script>

</body>

</html>