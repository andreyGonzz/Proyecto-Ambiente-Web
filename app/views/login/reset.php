<?php
require_once __DIR__ . '/../../config/config.php';
$error = $error ?? '';
$token = $token ?? '';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vocatio - Nueva contraseña</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/styles/index.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/styles/header.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/styles/footer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/styles/login.css">
</head>

<body class="bg-light min-vh-100 d-flex flex-column">
    <?php require_once __DIR__ . '/../layout/header.php'; ?>

    <main class="flex-grow-1 d-flex align-items-center py-5">
        <div class="vt-container w-100">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="vt-recovery-card bg-white rounded-4 shadow-sm border p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h1 class="vt-headline-md mb-2">Crea una nueva contraseña</h1>
                            <p class="vt-text-on-surface-variant mb-0">Elige una contraseña segura para tu cuenta.</p>
                        </div>

                        <?php if ($error !== ''): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($token !== ''): ?>
                            <form method="POST" action="<?php echo BASE_URL; ?>/public/auth/reset"
                                class="d-flex flex-column gap-3">
                                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                                <div>
                                    <label for="password" class="form-label vt-label">Nueva contraseña</label>
                                    <input type="password" id="password" name="password" class="form-control py-3"
                                        placeholder="Mínimo 6 caracteres" minlength="6" required>
                                </div>

                                <div>
                                    <label for="confirm_password" class="form-label vt-label">Confirmar contraseña</label>
                                    <input type="password" id="confirm_password" name="confirm_password"
                                        class="form-control py-3" placeholder="Repite la contraseña" minlength="6" required>
                                </div>

                                <button type="submit" class="vt-btn-primary vt-btn-lg w-100 justify-content-center">
                                    Guardar nueva contraseña
                                </button>
                            </form>
                        <?php else: ?>
                            <div class="text-center">
                                <a href="<?php echo BASE_URL; ?>/public/auth/recover"
                                    class="vt-link-primary d-inline-flex align-items-center gap-2">
                                    <span class="material-symbols-outlined">arrow_back</span>
                                    Solicitar un nuevo enlace de recuperación
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
