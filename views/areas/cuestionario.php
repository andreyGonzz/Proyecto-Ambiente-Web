<?php
// views/areas/cuestionario.php
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cuestionario Vocacional - Vocatio</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Material Symbols -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="/Proyecto%20Ambiente%20Web/public/assets/styles/index.css">
    <link rel="stylesheet" href="/Proyecto%20Ambiente%20Web/public/assets/styles/cuestionario.css">
    <link rel="stylesheet" href="/Proyecto%20Ambiente%20Web/public/assets/styles/header.css">
    <link rel="stylesheet" href="/Proyecto%20Ambiente%20Web/public/assets/styles/footer.css">
</head>

<body class="page-cuestionario">
    <header class="site-header bg-white border-bottom">
        <div class="container container-max d-flex align-items-center justify-content-between py-3">
            <div class="brand d-flex align-items-center gap-2">
                <span class="material-symbols-outlined brand-icon">school</span>
                <span class="brand-title">Vocatio</span>
            </div>
            <button class="btn btn-link text-muted save-exit">
                <span class="material-symbols-outlined">close</span>
                <span class="d-none d-sm-inline"></span>
            </button>
        </div>
    </header>

    <main class="py-5">
        <div class="container container-max">
            <div class="progress-section mb-4">
                <div class="d-flex justify-content-between small text-muted">
                    <span>Módulo de Intereses</span>
                    <span class="fw-semibold text-primary">Pregunta 3 de 15</span>
                </div>
                <div class="progress progress-custom mt-2" aria-hidden="true">
                    <div class="progress-bar progress-fill" role="progressbar" aria-valuemin="0" aria-valuemax="100"
                        aria-valuenow="20"></div>
                </div>
            </div>

            <div class="card ambient-shadow mb-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h1 class="question-title">¿Cómo prefieres resolver un problema complejo?</h1>
                        <p class="text-muted question-desc">Piensa en una situación donde tienes un desafío nuevo frente
                            a ti. ¿Cuál es tu instinto natural?</p>
                    </div>

                    <div class="row g-3 options-grid">
                        <div class="col-12 col-md-6 ">
                            <button type="button" class="selection-card btn" data-value="A">
                                <div class="d-flex align-items-start">

                                    <div class="option-text ms-3 text-start">
                                        <div class="option-title">Analizo los datos</div>
                                        <div class="option-desc text-muted">Busco patrones, números y estructuro un plan
                                            lógico antes de actuar.</div>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div class="col-12 col-md-6">
                            <button type="button" class="selection-card btn" data-value="B">
                                <div class="d-flex align-items-start">

                                    <div class="option-text ms-3 text-start">
                                        <div class="option-title">Discuto con otros</div>
                                        <div class="option-desc text-muted">Prefiero hacer una lluvia de ideas con un
                                            equipo para encontrar soluciones conjuntas.</div>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div class="col-12 col-md-6">
                            <button type="button" class="selection-card btn" data-value="C">
                                <div class="d-flex align-items-start">

                                    <div class="option-text ms-3 text-start">
                                        <div class="option-title">Pruebo ideas creativas</div>
                                        <div class="option-desc text-muted">Boceto, diseño o experimento con enfoques
                                            poco convencionales.</div>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div class="col-12 col-md-6">
                            <button type="button" class="selection-card btn" data-value="D">
                                <div class="d-flex align-items-start">

                                    <div class="option-text ms-3 text-start">
                                        <div class="option-title">Manos a la obra</div>
                                        <div class="option-desc text-muted">Construyo un prototipo rápido o empiezo a
                                            ejecutar para ver qué funciona.</div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-outline-secondary d-flex align-items-center gap-2 prev-btn">
                    <span class="material-symbols-outlined">arrow_back</span>
                    <span>Anterior</span>
                </button>

                <button id="nextBtn" type="button" class="btn btn-primary d-flex align-items-center gap-2" disabled>
                    <span>Siguiente</span>
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
            </div>
        </div>
    </main>

    <script src="/Proyecto%20Ambiente%20Web/public/assets/js/cuestionario.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>