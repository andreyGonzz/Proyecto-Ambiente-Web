<?php
require_once __DIR__ . '/../../config/config.php';

$areaId = $areaId ?? 0;
$areaLabel = $areaLabel ?? '';
$areaNombre = $areaNombre ?? '';

function chipDificultad($dificultad)
{
    return match ($dificultad) {
        'Baja' => 'vt-career-chip--baja',
        'Alta' => 'vt-career-chip--alta',
        default => 'vt-career-chip--media',
    };
}
?>
<?php
$pageTitle = ($areaLabel ? $areaLabel . ' - ' : '') . 'Carreras - ' . siteName;
$pageStyles = ['carreras-list.css'];
$pageScripts = ['carreras.js'];
$bodyClass = 'vt-careers-page';
require_once __DIR__ . '/../layout/header.php';
?>
    <main class="vt-container vt-section w-100">
        <section class="vt-careers-hero">
            <?php if ($areaLabel): ?>
                <h1 class="vt-careers-title vt-display">Carreras de <?php echo htmlspecialchars($areaLabel); ?></h1>
                <p class="vt-careers-subtitle">
                    Carreras relacionadas con tu perfil. Explora las opciones y encuentra la ideal para ti.
                    <a href="<?php echo BASE_URL; ?>/public/carrera/lista" class="vt-careers-link-all">Ver todas las carreras</a>
                </p>
            <?php else: ?>
                <h1 class="vt-careers-title vt-display">Explora tu futuro</h1>
            <?php endif; ?>
            <?php if (empty($carreras)): ?>
                <p class="text-center text-muted py-5">No hay carreras disponibles por el momento.</p>
            <?php else: ?>
            <div class="vt-careers-toolbar">
                    <div class="vt-careers-search">
                        <span class="material-symbols-outlined">search</span>
                        <input type="text" id="carrerasBusqueda" class="form-control" placeholder="Busca por carrera, área o interés...">
                    </div>
                </div>

                <div class="vt-careers-chip-list">
                    <button type="button" class="vt-careers-chip is-active" data-dificultad="Todas">Todas</button>
                    <button type="button" class="vt-careers-chip" data-dificultad="Baja">Baja</button>
                    <button type="button" class="vt-careers-chip" data-dificultad="Media">Media</button>
                    <button type="button" class="vt-careers-chip" data-dificultad="Alta">Alta</button>
                </div>
            </section>

            <section class="row g-4">
                <?php foreach ($carreras as $carrera): ?>
                    <article class="col-12 col-md-6 col-lg-4"
                             data-dificultad="<?= htmlspecialchars($carrera['dificultad']) ?>"
                             data-nombre="<?= htmlspecialchars($carrera['nombre']) ?>">
                        <div class="vt-career-card">
                            <?php if (!empty($carrera['imagen'])): ?>
                                <img src="<?= htmlspecialchars($carrera['imagen']) ?>" alt="<?= htmlspecialchars($carrera['nombre']) ?>" class="vt-career-image">
                            <?php else: ?>
                                <div class="vt-career-image vt-career-image-placeholder">
                                    <span class="material-symbols-outlined">school</span>
                                </div>
                            <?php endif; ?>

                            <div class="vt-career-body">
                                <div class="vt-career-badge-row">
                                    <span class="vt-career-chip <?= chipDificultad($carrera['dificultad']) ?>">
                                        Dificultad <?= htmlspecialchars($carrera['dificultad']) ?>
                                    </span>
                                    <span class="vt-career-bookmark material-symbols-outlined">bookmark</span>
                                </div>

                                <h2 class="vt-career-title"><?= htmlspecialchars($carrera['nombre']) ?></h2>

                                <?php if (!empty($carrera['descripcion'])): ?>
                                    <p class="vt-career-description"><?= htmlspecialchars($carrera['descripcion']) ?></p>
                                <?php endif; ?>

                                <div class="vt-career-footer">
                                    <span class="vt-career-duration">
                                        <span class="material-symbols-outlined"><?= $carrera['disponibilidad'] === 'No disponible' ? 'remove_circle' : 'check_circle' ?></span>
                                        <?= htmlspecialchars($carrera['disponibilidad']) ?>
                                    </span>
                                    <a href="<?= BASE_URL ?>/public/carrera/detalle/<?= (int) $carrera['carreraId'] ?>" class="vt-career-link">
                                        Ver más
                                        <span class="material-symbols-outlined">arrow_forward</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
            <?php endif; ?>
        </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>
