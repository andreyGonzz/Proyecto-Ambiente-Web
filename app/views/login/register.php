<?php
require_once __DIR__ . '/../../config/config.php';
$error = $error ?? '';

$pageTitle = 'Vocatio - Crear cuenta';
$pageStyles = ['login.css'];
$pageScripts = ['register.js'];
$bodyClass = 'bg-light min-vh-100 d-flex flex-column';
require_once __DIR__ . '/../layout/header.php';
?>
    <main class="flex-grow-1 d-flex align-items-center py-5">
        <div class="vt-container w-100">
            <div class="row g-0 rounded-4 overflow-hidden shadow-sm bg-white vt-register-shell">
                <section class="col-12 col-lg-6 d-flex flex-column justify-content-center px-4 px-md-5 py-4 py-lg-5 bg-white vt-register-form-panel">
                    <div class="mx-auto vt-register-form-wrapper">
                        <div class="text-center text-lg-start mb-4">
                            <a href="<?php echo BASE_URL; ?>/public/" class="vt-register-brand mb-3 d-inline-flex align-items-center justify-content-center justify-content-lg-start">
                                <span class="material-symbols-outlined">explore</span>
                                <span>Vocatio</span>
                            </a>
                            <h1 class="vt-headline-lg mb-2">Crea tu cuenta</h1>
                            <p class="vt-text-on-surface-variant">Únete para descubrir tu camino profesional con confianza.</p>
                        </div>

                        <form class="d-flex flex-column gap-3" method="POST"
                            action="<?php echo BASE_URL; ?>/public/auth/register">
                            <?php if ($error !== ''): ?>
                                <div class="alert alert-danger mb-0" role="alert">
                                    <?= htmlspecialchars($error) ?>
                                </div>
                            <?php endif; ?>
                            <div class="position-relative">
                                <input class="form-control vt-register-input" id="fullname" name="fullname" type="text" placeholder="Nombre completo" required>
                                <label class="vt-register-label" for="fullname">Nombre completo</label>
                            </div>

                            <div class="position-relative">
                                <input class="form-control vt-register-input" id="email" name="email" type="email" placeholder="Correo electrónico" required>
                                <label class="vt-register-label" for="email">Correo electrónico</label>
                            </div>

                            <div class="position-relative">
                                <input class="form-control vt-register-input" id="password" name="password" type="password" placeholder="Contraseña" required>
                                <label class="vt-register-label" for="password">Contraseña</label>
                                <button type="button"
                                    class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-0 text-muted"
                                    id="togglePassword" aria-label="Mostrar u ocultar contraseña">
                                    <span class="material-symbols-outlined"
                                        id="visibilityIcon">visibility_off</span>
                                </button>
                            </div>

                            <div class="position-relative">
                                <input class="form-control vt-register-input" id="confirm_password" name="confirm_password" type="password" placeholder="Confirmar contraseña" required>
                                <label class="vt-register-label" for="confirm_password">Confirmar contraseña</label>
                                <button type="button"
                                    class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-0 text-muted"
                                    id="toggleConfirmPassword" aria-label="Mostrar u ocultar contraseña">
                                    <span class="material-symbols-outlined"
                                        id="confirmVisibilityIcon">visibility_off</span>
                                </button>
                            </div>

                            <div class="d-flex flex-column gap-2 mt-1">
                                <div class="vt-register-strength" id="passwordStrength" aria-label="Indicador de seguridad de contraseña">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <span class="vt-caption text-end text-muted" id="strengthLabel">Débil</span>
                            </div>

                            <div class="d-flex align-items-start gap-2">
                                <input class="form-check-input vt-register-checkbox" id="terms" name="terms" type="checkbox" required>
                                <label class="form-check-label vt-register-terms" for="terms">
                                    Acepto los <a href="#">Términos y Condiciones</a> y la <a href="#">Política de Privacidad</a>.
                                </label>
                            </div>

                            <button class="btn vt-btn-primary vt-btn-lg w-100 justify-content-center vt-register-submit" type="submit">
                                Crear cuenta
                            </button>
                        </form>

                        <div class="text-center mt-4 pt-4 border-top">
                            <p class="mb-0 vt-text-on-surface-variant">
                                ¿Ya tienes una cuenta?
                                <a href="<?php echo BASE_URL; ?>/public/auth/login" class="vt-link-primary ms-1">Iniciar sesión</a>
                            </p>
                        </div>
                    </div>
                </section>

                <section class="col-lg-6 d-none d-lg-flex position-relative align-items-center justify-content-center vt-register-hero">
                    <div class="vt-register-hero-image"></div>
                    <div class="vt-register-hero-overlay"></div>
                    <div class="position-relative z-2 text-white px-4 py-5 vt-register-hero-content">
                        <p class="vt-badge vt-bg-secondary-fixed vt-text-on-secondary-fixed mb-3">Vocatio</p>
                        <h2 class="vt-display mb-3">Tu siguiente paso comienza aquí.</h2>
                        <p class="vt-body-lg mb-0 vt-max-w-lg">
                            Únete a una experiencia guiada para encontrar tu camino profesional con mayor claridad.
                        </p>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>
