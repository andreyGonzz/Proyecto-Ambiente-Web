<?php
require_once __DIR__ . '/../../config/config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/public/auth/login');
    exit;
}

$pageTitle = 'Cuestionario completado - ' . siteName;
$pageStyles = ['cuestionario-completado.css'];
$pageScripts = ['cuestionario-completado.js'];
$bodyClass = 'vt-page-completed';
require_once __DIR__ . '/../layout/header.php';
?>
    <div class="vt-confetti-container" id="confetti-container" aria-hidden="true"></div>

    <main class="vt-completed-page d-flex align-items-center justify-content-center py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <section class="vt-completed-card card border-0 soft-shadow text-center overflow-hidden">
                        <div class="card-body py-5 px-4">
                            <div class="vt-completed-icon-wrap mb-4 mx-auto d-inline-flex align-items-center justify-content-center">
                                <span class="material-symbols-outlined vt-completed-icon">check_circle</span>
                            </div>
                            <h1 class="vt-completed-title mb-3">¡Cuestionario completado!</h1>
                            <p class="vt-completed-copy mb-5">
                                Hemos analizado tus respuestas. Descubre los caminos profesionales que mejor se adaptan a tu perfil.
                            </p>

                            <div class="d-grid gap-3">
                                <a href="<?php echo BASE_URL; ?>/app/views/areas/areas.php"
                                    class="btn btn-primary vt-btn-completed d-flex align-items-center justify-content-center gap-2">
                                    Ver mis resultados
                                    <span class="material-symbols-outlined vt-btn-icon">arrow_forward</span>
                                </a>
                                <a href="<?php echo BASE_URL; ?>/public/index.php" class="vt-secondary-link">
                                    Volver al inicio
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>
