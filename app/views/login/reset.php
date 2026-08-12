<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle = 'Vocatio - Nueva contraseña';
$pageStyles = ['login.css'];
$pageScripts = ['reset.js'];
$bodyClass = 'bg-light min-vh-100 d-flex flex-column';
require_once __DIR__ . '/../layout/header.php';
?>
    <main class="flex-grow-1 d-flex align-items-center py-5">
        <div class="vt-container w-100">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="vt-recovery-card bg-white rounded-4 shadow-sm border p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h1 class="vt-headline-md mb-2">Crea una nueva contraseña</h1>
                            <p class="vt-text-on-surface-variant mb-0">Elige una contraseña segura para tu cuenta.</p>
                        </div>

                        <div id="resetCargando" class="text-center text-muted py-4">
                            Validando el enlace de recuperación...
                        </div>

                        <div id="resetFormSection" class="d-none">
                            <form method="POST" action="<?php echo BASE_URL; ?>/public/auth/reset"
                                class="d-flex flex-column gap-3" id="resetForm">
                                <input type="hidden" name="token" id="resetToken">

                                <div id="resetError" class="alert alert-danger d-none" role="alert"></div>

                                <div>
                                    <label for="password" class="form-label vt-label">Nueva contraseña</label>
                                    <input type="password" id="password" name="password" class="form-control py-3"
                                        placeholder="Mínimo 6 caracteres" minlength="6" required>
                                </div>

                                <div>
                                    <label for="confirm_password" class="form-label vt-label">Confirmar contraseña</label>
                                    <input type="password" id="confirm_password" name="confirm_password"
                                        class="form-control py-3" placeholder="Repite la contraseña" minlength="6" required>
                                </div>

                                <button type="submit" class="vt-btn-primary vt-btn-lg w-100 justify-content-center">
                                    Guardar nueva contraseña
                                </button>
                            </form>
                        </div>

                        <div id="resetInvalido" class="d-none text-center">
                            <p class="vt-text-on-surface-variant mb-4">
                                El enlace es inválido o ha expirado. Solicita uno nuevo para restablecer tu contraseña.
                            </p>
                            <a href="<?php echo BASE_URL; ?>/public/auth/recover"
                                class="vt-link-primary d-inline-flex align-items-center gap-2">
                                <span class="material-symbols-outlined">arrow_back</span>
                                Solicitar un nuevo enlace de recuperación
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>