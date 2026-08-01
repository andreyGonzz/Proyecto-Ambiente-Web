<?php
require_once __DIR__ . '/../../config/config.php';
$error = $error ?? '';
$token = $token ?? '';

$pageTitle = 'Vocatio - Nueva contraseña';
$pageStyles = ['login.css'];
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

                        <?php if ($error !== ''): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($token !== ''): ?>
                            <form method="POST" action="<?php echo BASE_URL; ?>/public/auth/reset"
                                class="d-flex flex-column gap-3">
                                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

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
                        <?php else: ?>
                            <div class="text-center">
                                <a href="<?php echo BASE_URL; ?>/public/auth/recover"
                                    class="vt-link-primary d-inline-flex align-items-center gap-2">
                                    <span class="material-symbols-outlined">arrow_back</span>
                                    Solicitar un nuevo enlace de recuperación
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>
