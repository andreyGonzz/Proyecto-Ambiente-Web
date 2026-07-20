<?php
require_once __DIR__ . '/../../config/config.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vocatio - Recuperar Contraseña</title>

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
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="text-center mb-4">
                        <h1 class="vt-headline-lg mb-2">Vocatio</h1>
                        <p class="vt-text-on-surface-variant">Recupera el acceso a tu cuenta</p>
                    </div>

                    <div class="vt-recovery-card bg-white rounded-4 shadow-sm border p-4 p-md-5">
                        <section id="recovery-form-section">
                            <h2 class="vt-headline-md mb-3">¿Olvidaste tu contraseña?</h2>
                            <p class="vt-text-on-surface-variant mb-4">
                                Ingresa tu dirección de correo electrónico y te enviaremos las instrucciones para
                                restablecer tu contraseña.
                            </p>

                            <form id="recover-form" class="d-flex flex-column gap-3">
                                <div>
                                    <label for="email" class="form-label vt-label">Correo electrónico</label>
                                    <input type="email" id="email" name="email" class="form-control py-3"
                                        placeholder="correo@ejemplo.com" required>
                                </div>

                                <button type="submit" class="vt-btn-primary vt-btn-lg w-100 justify-content-center">
                                    Enviar enlace de recuperación
                                </button>
                            </form>
                        </section>

                        <section id="confirmation-section" class="text-center py-3 d-none">
                            <div class="vt-recovery-icon mb-3">
                                <span class="material-symbols-outlined">check_circle</span>
                            </div>
                            <h2 class="vt-headline-md mb-2">Revisa tu correo</h2>
                            <p class="vt-text-on-surface-variant mb-4">
                                Hemos enviado un enlace de recuperación al correo proporcionado. Revisa tu bandeja de
                                entrada y spam.
                            </p>
                            <button type="button" class="btn btn-link vt-link-primary" data-action="reset-form">
                                ¿No lo recibiste? Inténtalo de nuevo.
                            </button>
                        </section>
                    </div>

                    <div class="text-center mt-4">
                        <a href="<?php echo $baseUrl; ?>/views/login/login.php"
                            class="vt-link-primary d-inline-flex align-items-center gap-2">
                            <span class="material-symbols-outlined">arrow_back</span>
                            Volver a Iniciar sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $baseUrl; ?>/public/assets/js/recover.js"></script>
</body>

</html>