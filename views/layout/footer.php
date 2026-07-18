<?php
require_once __DIR__ . '/../../config/config.php';
?>
<footer class="vt-footer">
    <div class="vt-container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 py-4">
        <div class="vt-footer-brand">
            <span class="material-symbols-outlined">explore</span>
            <?= htmlspecialchars($siteName ?? 'Vocatio') ?>
        </div>
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <a href="#" class="vt-footer-link">Institucional</a>
            <a href="#" class="vt-footer-link">Contacto</a>
            <a href="#" class="vt-footer-link">Política de Privacidad</a>
        </div>
        <div class="vt-footer-copy">
            &copy; <?= (int) ($year ?? date('Y')) ?> <?= htmlspecialchars($siteName ?? 'Vocatio') ?>. Todos los derechos reservados.
        </div>
    </div>
</footer>