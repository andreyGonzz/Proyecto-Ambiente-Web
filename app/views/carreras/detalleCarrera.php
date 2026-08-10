<?php
require_once __DIR__ . '/../../config/config.php';

$carrera = $carrera ?? null;

$habilidades = json_decode($carrera['habilidades'] ?? '', true);
if (!is_array($habilidades)) {
    $habilidades = [];
}
?>
<?php
$pageTitle = ($carrera ? $carrera['nombre'] . ' - ' : 'Carrera no encontrada - ') . siteName;
$pageStyles = ['detalleCarrera.css'];
require_once __DIR__ . '/../layout/header.php';
?>
    <main class="vt-container vt-section">
        <div class="mb-4">
            <a href="<?= BASE_URL; ?>/public/carrera/lista" class="btn-back">
                <span class="material-symbols-outlined">arrow_back</span>
                Volver al listado
            </a>
        </div>

        <?php if (!$carrera): ?>
            <section class="career-header">
                <div class="career-header-content">
                    <div class="career-info">
                        <h1>Carrera no encontrada</h1>
                        <p>La carrera que buscas no existe o fue eliminada.</p>
                    </div>
                </div>
            </section>
        <?php else: ?>
        <section class="career-header">
            <div class="career-header-content">
                <?php if (!empty($carrera['imagen'])): ?>
                    <img src="<?= htmlspecialchars($carrera['imagen']); ?>" alt="<?= htmlspecialchars($carrera['nombre']); ?>" class="career-image">
                <?php else: ?>
                    <div class="career-image career-image-placeholder">
                        <span class="material-symbols-outlined">school</span>
                    </div>
                <?php endif; ?>

                <div class="career-info">
                    <div class="badge-category">
                        <span class="material-symbols-outlined">signal_cellular_alt</span>
                        Dificultad <?= htmlspecialchars($carrera['dificultad']); ?>
                    </div>
                    <h1><?= htmlspecialchars($carrera['nombre']); ?></h1>
                    <p><?= htmlspecialchars($carrera['descripcion'] ?: ($carrera['disponibilidad'] === 'No disponible' ? 'Carrera que actualmente no se encuentra disponible.' : 'Carrera que actualmente se encuentra disponible para matrícula.')); ?></p>
                </div>
            </div>
        </section>

        <section class="bento-grid">
            <article class="bento-card">
                <h2>Información General</h2>

                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-item-icon">
                            <span class="material-symbols-outlined">schedule</span>
                        </div>
                        <div class="info-item-content">
                            <h3>Duración Estimada</h3>
                            <p><?= htmlspecialchars($carrera['duracion'] ?: 'No especificada'); ?></p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-item-icon">
                            <span class="material-symbols-outlined">monetization_on</span>
                        </div>
                        <div class="info-item-content">
                            <h3>Rango Salarial (Junior)</h3>
                            <p><?= htmlspecialchars($carrera['salario'] ?: 'No especificado'); ?></p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-item-icon">
                            <span class="material-symbols-outlined">trending_up</span>
                        </div>
                        <div class="info-item-content">
                            <h3>Demanda Laboral</h3>
                            <p class="text-tertiary"><?= htmlspecialchars($carrera['demanda'] ?: 'No especificada'); ?></p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-item-icon">
                            <span class="material-symbols-outlined">menu_book</span>
                        </div>
                        <div class="info-item-content">
                            <h3>Dificultad Percibida</h3>
                            <p><?= htmlspecialchars($carrera['dificultad']); ?></p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-item-icon">
                            <span class="material-symbols-outlined"><?= $carrera['disponibilidad'] === 'No disponible' ? 'remove_circle' : 'check_circle'; ?></span>
                        </div>
                        <div class="info-item-content">
                            <h3>Disponibilidad</h3>
                            <p><?= htmlspecialchars($carrera['disponibilidad']); ?></p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-item-icon">
                            <span class="material-symbols-outlined">verified_user</span>
                        </div>
                        <div class="info-item-content">
                            <h3>Estado</h3>
                            <p class="text-tertiary"><?= $carrera['estadoId'] == 1 ? 'Activo' : 'Inactivo'; ?></p>
                        </div>
                    </div>
                </div>

                <?php if ($habilidades): ?>
                    <div class="skills-section">
                        <h3>Habilidades Clave</h3>
                        <div class="skills-list">
                            <?php foreach ($habilidades as $habilidad): ?>
                                <span class="skill-tag"><?= htmlspecialchars($habilidad); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </article>

            <aside class="affinity-card">
                <div class="affinity-content">
                    <h3>Tu Afinidad</h3>

                    <div class="affinity-circle">
                        <svg viewBox="0 0 100 100" aria-hidden="true">
                            <circle cx="50" cy="50" r="40" class="affinity-circle-bg"></circle>
                            <circle cx="50" cy="50" r="40" class="affinity-circle-progress" style="stroke-dasharray: 251.2; stroke-dashoffset: 37.68;"></circle>
                        </svg>
                        <div class="affinity-percentage">
                            <span class="affinity-percentage-number">85</span>
                            <span class="affinity-percentage-symbol">%</span>
                        </div>
                    </div>

                    <p>Tus respuestas en el test indican un alto perfil analítico, ideal para esta carrera.</p>
                    <a href="<?= BASE_URL; ?>/public/areas/index" class="btn-affinity">Ver desglose</a>
                </div>
            </aside>
        </section>
        <?php endif; ?>
    </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>
