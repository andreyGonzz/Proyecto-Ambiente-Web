<?php
require_once __DIR__ . '/../../config/config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($areas)) {
    $areas = [];
    if (isset($_SESSION['user_id'])) {
        require_once __DIR__ . '/../../models/Cuestionario.php';
        $cuestionario = new Cuestionario();
        if ($cuestionario->haRespondido((int) $_SESSION['user_id'])) {
            $areas = $cuestionario->calcularResultado((int) $_SESSION['user_id']);
        }
    }
}

// Ordenar de mayor a menor afinidad
usort($areas, function ($a, $b) {
    return $b['porcentaje'] <=> $a['porcentaje'];
});

$principal = $areas[0] ?? null;
$secundaria = $areas[1] ?? null;
$areaPrincipalId = $areaPrincipalId ?? ($principal['area_id'] ?? 0);

if (!isset($carreraRecomendada)) {
    $carreraRecomendada = null;
    if ((int) $areaPrincipalId > 0) {
        require_once __DIR__ . '/../../models/Carrera.php';
        $carrerasArea = (new Carrera())->getByArea((int) $areaPrincipalId);
        $carreraRecomendada = $carrerasArea[0] ?? null;
    }
}
$anioActual = date('Y');

$pageTitle = 'Tus áreas de interés - ' . siteName;
$pageStyles = ['areas.css'];
$pageScripts = ['areas.js'];
require_once __DIR__ . '/../layout/header.php';
?>
    <!-- ============ Contenido principal ============ -->
    <main class="container-xxl">

        <div class="text-center mb-5">
            <h1 class="page-title display-5 mb-3"><?php echo htmlspecialchars('Tus áreas de interés'); ?></h1>
            <p class="page-subtitle">
                Basado en tus respuestas, hemos analizado tus afinidades profesionales.
                Aquí están los resultados de tu perfil vocacional.
            </p>
        </div>

        <?php if (!$principal): ?>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card-vocatio text-center p-4">
                        <span class="material-symbols-outlined mb-3" style="font-size: 48px;">quiz</span>
                        <h2 class="h4 mb-2">Aún no tienes resultados</h2>
                        <p class="text-color-on-surface-variant mb-4">
                            Completa el cuestionario vocacional para descubrir tus áreas de interés.
                        </p>
                        <a href="<?php echo BASE_URL; ?>/public/cuestionario" class="btn-explorar">
                            Comenzar cuestionario
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
        <div class="row g-4">

            <!-- Tarjeta principal de recomendación -->
            <div class="col-12 col-md-8">
                <div class="card-vocatio d-flex flex-column justify-content-between">
                    <div>
                        <span class="badge-principal">
                            <span class="material-symbols-outlined" style="font-size:16px;">star</span>
                            Principal Recomendación
                        </span>
                        <h2 class="h3 mb-2"><?php echo htmlspecialchars($principal['label']); ?></h2>
                        <p class="text-color-on-surface-variant mb-4"
                            style="color: var(--color-on-surface-variant); max-width: 32rem;">
                            <?php echo htmlspecialchars($principal['descripcion']); ?>
                        </p>

                        <?php if ($carreraRecomendada): ?>
                            <div class="carrera-recomendada">
                                <span class="carrera-recomendada-chip">
                                    <span class="material-symbols-outlined" style="font-size:16px;">school</span>
                                    Tu carrera recomendada
                                </span>
                                <h3 class="carrera-recomendada-nombre"><?php echo htmlspecialchars($carreraRecomendada['nombre']); ?></h3>
                                <p class="carrera-recomendada-desc">
                                    <?php echo htmlspecialchars($carreraRecomendada['descripcion'] ?: 'Una opción profesional que conecta con tu perfil.'); ?>
                                </p>
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    <a href="<?php echo BASE_URL; ?>/public/carrera/detalle/<?php echo (int) $carreraRecomendada['carreraId']; ?>"
                                        class="btn-explorar">
                                        Ver esta carrera
                                        <span class="material-symbols-outlined">arrow_forward</span>
                                    </a>
                                    <a href="<?php echo BASE_URL; ?>/public/carrera/lista?area=<?php echo (int) $areaPrincipalId; ?>"
                                        class="btn-explorar btn-explorar--ghost">
                                        Explorar carreras relacionadas
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <div class="d-flex flex-column">
                            <span class="afinidad-numero"><?php echo (int) $principal['porcentaje']; ?>%</span>
                            <span class="afinidad-label">Afinidad</span>
                        </div>
                        <div class="icono-circulo icono-circulo-grande bg-color-<?php echo htmlspecialchars($principal['color']); ?>">
                            <span class="material-symbols-outlined"><?php echo htmlspecialchars($principal['icono']); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desglose de afinidad -->
            <div class="col-12 col-md-4">
                <div class="card-vocatio d-flex flex-column gap-4">
                    <h3 class="h5 mb-0">Desglose de Afinidad</h3>
                    <div class="d-flex flex-column gap-3">
                        <?php foreach ($areas as $area): ?>
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="d-flex align-items-center gap-2 small">
                                        <span class="material-symbols-outlined text-color-<?php echo htmlspecialchars($area['color']); ?>"
                                            style="font-size:16px;">
                                            <?php echo htmlspecialchars($area['icono']); ?>
                                        </span>
                                        <?php echo htmlspecialchars($area['nombre']); ?>
                                    </span>
                                    <span class="small" style="color: var(--color-on-surface-variant);">
                                        <?php echo (int) $area['porcentaje']; ?>%
                                    </span>
                                </div>
                                <div class="barra-afinidad">
                                    <div class="relleno bg-color-<?php echo htmlspecialchars($area['color']); ?>"
                                        data-target="<?php echo (int) $area['porcentaje']; ?>" style="width:0%;"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="card-cta card-cta--desglose">
                        <h3 class="h5 mb-4">¿Listo para dar el siguiente paso?</h3>
                        <a href="<?php echo BASE_URL; ?>/public/carrera/lista?area=<?php echo (int) $areaPrincipalId; ?>" class="btn-explorar">
                            Explorar carreras relacionadas
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </a>
                        <a href="<?php echo BASE_URL; ?>/public/cuestionario/reiniciar" class="btn-explorar btn-explorar--ghost mt-3">
                            Volver a intentar el cuestionario
                            <span class="material-symbols-outlined">replay</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <?php endif; ?>
    </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>