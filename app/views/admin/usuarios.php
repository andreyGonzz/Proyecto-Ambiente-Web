<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle = 'Gestión de Usuarios - ' . siteName;
$pageStyles = ['admin.css', 'usuarios.css'];
$pageScripts = ['admin.js'];
$bodyClass = 'vt-admin-page';
require_once __DIR__ . '/../layout/header.php';
?>

    <div class="vt-admin-shell">
        <aside class="vt-admin-sidebar d-none d-md-flex">
            <nav class="vt-admin-nav">
                <a class="vt-admin-nav-link active" href="<?php echo BASE_URL; ?>/public/usuario/index">
                    <span class="material-symbols-outlined">group</span>
                    Usuarios
                </a>
                <a class="vt-admin-nav-link" href="<?php echo BASE_URL; ?>/public/carrera/index">
                    <span class="material-symbols-outlined">work</span>
                    Carreras
                </a>
            </nav>

            <div class="vt-admin-sidebar-footer">
                <button type="button" class="vt-admin-logout-btn">
                    <span class="material-symbols-outlined">logout</span>
                    Cerrar sesión
                </button>
            </div>
        </aside>

        <main class="vt-admin-content">
            <section class="vt-admin-topbar d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h1 class="vt-admin-title">Gestión de Usuarios</h1>
                    <p class="vt-admin-topbar-label">Administra las cuentas de estudiantes y asesores vocacionales.</p>
                </div>
                <button type="button" class="btn btn-primary rounded-pill px-4 py-2" data-open-user-modal>
                    <span class="material-symbols-outlined align-middle">add</span>
                    <span class="align-middle">Agregar usuario</span>
                </button>
            </section>

            <section class="vt-admin-main">
                <div class="vt-usuarios-toolbar">
                    <div class="search-container">
                        <span class="material-symbols-outlined">search</span>
                        <input type="text" class="search-input" placeholder="Buscar usuario..." id="usuarioBusqueda">
                    </div>
                </div>

                <div class="data-table-card">
                    <div class="table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Rol</th>
                                    <th class="text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="usuariosTableBody"></tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <div class="modal fade" id="usuarioModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="usuarioForm">
                <div class="modal-header">
                    <h5 class="modal-title">Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="usuario_id" value="">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input class="form-control" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input class="form-control" type="email" name="correo" required>
                    </div>
                    <div class="mb-3" id="campoContrasena">
                        <label class="form-label">Contraseña</label>
                        <input class="form-control" type="password" name="contrasena">
                    </div>
                    <div class="mb-3" id="campoRol">
                        <label class="form-label">Rol</label>
                        <select class="form-select" name="rol">
                            <option value="USUARIO">Usuario</option>
                            <option value="ADMIN">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>