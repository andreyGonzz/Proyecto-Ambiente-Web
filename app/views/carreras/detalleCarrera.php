<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle = 'Detalle de carrera - ' . siteName;
$pageStyles = ['detalleCarrera.css'];
$pageScripts = ['detalleCarrera.js'];
require_once __DIR__ . '/../layout/header.php';
?>
    <main class="vt-container vt-section">
        <div class="mb-4">
            <a href="<?= BASE_URL; ?>/public/carrera/lista" class="btn-back">
                <span class="material-symbols-outlined">arrow_back</span>
                Volver al listado
            </a>
        </div>

        <div id="carreraDetalle">
            <div class="text-center text-muted py-5">Cargando información de la carrera...</div>
        </div>
    </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>