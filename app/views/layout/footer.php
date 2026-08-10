<?php
require_once __DIR__ . '/../../config/config.php';
$pageScripts = $pageScripts ?? [];
?>
<footer class="vt-footer">
    <div class="vt-container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 py-4">
        <div class="vt-footer-brand">
            <span class="material-symbols-outlined">explore</span>
            <?= htmlspecialchars($siteName ?? 'Vocatio') ?>
        </div>
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <a href="<?= htmlspecialchars(BASE_URL) ?>/public/" class="vt-footer-link">Institucional</a>
            <a href="<?= htmlspecialchars(BASE_URL) ?>/public/auth/login" class="vt-footer-link">Contacto</a>
            <a href="<?= htmlspecialchars(BASE_URL) ?>/public/auth/register" class="vt-footer-link">Política de Privacidad</a>
        </div>
        <div class="vt-footer-copy">
            &copy; <?= (int) ($year ?? date('Y')) ?> <?= htmlspecialchars($siteName ?? 'Vocatio') ?>. Todos los derechos reservados.
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Raíz de la API para los scripts -->
<script>window.API_ROOT = encodeURI('<?= BASE_URL ?>') + '/public/';</script>

<!-- JS específico de la página -->
<?php foreach ($pageScripts as $script): ?>
    <?php $scriptRuta = __DIR__ . '/../../../public/assets/js/' . $script; ?>
    <script src="<?= htmlspecialchars(BASE_URL) ?>/public/assets/js/<?= htmlspecialchars($script) ?>?v=<?= file_exists($scriptRuta) ? filemtime($scriptRuta) : '' ?>"></script>
<?php endforeach; ?>
</body>

</html>
