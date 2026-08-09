<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle = 'Vocatio - Recuperar Contraseña';
$pageStyles = ['login.css'];
$pageScripts = ['recover.js'];
$bodyClass = 'bg-light min-vh-100 d-flex flex-column';
require_once __DIR__ . '/../layout/header.php';
?>
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

                            <form id="recover-form" method="POST"
                                action="<?php echo BASE_URL; ?>/public/auth/recover" class="d-flex flex-column gap-3">
                                <div>
                                    <label for="email" class="form-label vt-label">Correo electrónico</label>
                                    <input type="email" id="email" name="email" class="form-control py-3"
                                        placeholder="correo@ejemplo.com" required>
                                </div>

                                <div id="messageArea" class="d-none rounded-3 p-3 align-items-center gap-2">
                                    <span class="material-symbols-outlined" id="messageIcon">info</span>
                                    <span id="messageText"></span>
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
                        <a href="<?php echo BASE_URL; ?>/public/auth/login"
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