<?php
require_once __DIR__ . '/../../config/config.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionario completado - Vocatio</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap">

    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/assets/styles/index.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/assets/styles/header.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/assets/styles/footer.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/assets/styles/cuestionario-completado.css">
</head>

<body class="vt-page-completed">
    <?php require_once __DIR__ . '/../layout/header.php'; ?>

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
                                <a href="<?php echo $baseUrl; ?>/views/areas/areas.php"
                                    class="btn btn-primary vt-btn-completed d-flex align-items-center justify-content-center gap-2">
                                    Ver mis resultados
                                    <span class="material-symbols-outlined vt-btn-icon">arrow_forward</span>
                                </a>
                                <a href="<?php echo $baseUrl; ?>/public/index.php" class="vt-secondary-link">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $baseUrl; ?>/public/assets/js/cuestionario-completado.js"></script>
</body>

</html>
