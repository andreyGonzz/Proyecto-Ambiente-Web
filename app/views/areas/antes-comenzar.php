<?php
require_once __DIR__ . '/../../config/config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/public/auth/login');
    exit;
}

$pageTitle = 'Antes de comenzar - ' . siteName;
$pageStyles = ['antes-comenzar.css'];
$pageScripts = ['antes-comenzar.js'];
$bodyClass = 'vt-page-intro';
require_once __DIR__ . '/../layout/header.php';
?>
    <main class="vt-main py-5">
        <div class="container-xxl">
            <div class="row align-items-center g-5">
                <div class="col-12 col-lg-6">
                    <div class="vt-intro-content">
                        <span class="vt-badge vt-badge-primary">Paso 1 de 4</span>
                        <h1 class="vt-intro-title">Antes de comenzar</h1>
                        <p class="vt-intro-text">
                            Estás a punto de iniciar una experiencia diseñada para descubrir tus intereses y fortalezas
                            profesionales.
                            Lee atentamente cómo funciona el proceso.
                        </p>

                        <div class="vt-card-stack">
                            <article class="vt-info-card">
                                <div class="vt-info-icon vt-info-icon-primary">
                                    <span class="material-symbols-outlined">timer</span>
                                </div>
                                <div>
                                    <h2>Tiempo estimado</h2>
                                    <p>El test tomará aproximadamente 15 a 20 minutos. Busca un lugar tranquilo donde no
                                        tengas interrupciones.</p>
                                </div>
                            </article>

                            <article class="vt-info-card">
                                <div class="vt-info-icon vt-info-icon-secondary">
                                    <span class="material-symbols-outlined">quiz</span>
                                </div>
                                <div>
                                    <h2>Formato de preguntas</h2>
                                    <p>Encontrarás 60 preguntas de opción múltiple basadas en escenarios del mundo real.
                                    </p>
                                </div>
                            </article>

                            <article class="vt-info-card">
                                <div class="vt-info-icon vt-info-icon-tertiary">
                                    <span class="material-symbols-outlined">psychology</span>
                                </div>
                                <div>
                                    <h2>Sé honesto contigo</h2>
                                    <p>No hay respuestas correctas o incorrectas. Responde basándote en lo que realmente
                                        disfrutas.</p>
                                </div>
                            </article>
                        </div>

                        <div class="vt-actions">
                            <a href="<?php echo BASE_URL; ?>/app/views/areas/cuestionario.php" class="btn vt-btn-cta"
                                id="startQuizBtn" data-label="Comenzar cuestionario">
                                <span class="vt-btn-label">Comenzar cuestionario</span>
                                <span class="material-symbols-outlined vt-btn-icon">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="vt-visual-card">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCfk7B68UCWLZlufPN2DtikPsWToYdKfShe-N9rLWvdZpncy7eZA9A6OZyZ_M8UTw55pZgY1kJW7Vf3KCkhPWNIe46eqHx9FGiLop-87uKuBHmiHyFouVLtUl_IWwh9eSva2qtIg2qQ4jTP4BnONkIn-3vQz8MeLA5Ku9iP51Hk89p5YQnHFV8UBwedspCQzKoYaj8PYs_36zFAZI022o396owbZwbZ25vkjbBg5LY1E6g-YKd_9lKN3A"
                            alt="Estudiante preparándose para el test de orientación vocacional">
                        <div class="vt-visual-caption">
                            <span class="vt-visual-caption-title">Descubre tu próxima oportunidad</span>
                            <span class="vt-visual-caption-text">Una experiencia guiada para entender mejor tus
                                intereses.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>