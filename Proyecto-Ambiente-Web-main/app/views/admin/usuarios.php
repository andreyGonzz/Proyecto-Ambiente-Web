<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle = 'Gestión de Usuarios - Vocatio Admin';
$pageStyles = ['usuarios.css'];
$pageScripts = ['admin.js'];
$bodyClass = 'sidebar-open';
$sinNavbar = true;
require_once __DIR__ . '/../layout/header.php';
?>

    <aside class="admin-sidebar">
        <div class="sidebar-header">
            <h1>Vocatio Admin</h1>
        </div>

        <div class="sidebar-profile">
            <div class="profile-avatar">
                <span class="material-symbols-outlined">person</span>
            </div>
            <div class="profile-info">
                <h3>Perfil Admin</h3>
                <p>Portal de Gestión</p>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="<?php echo BASE_URL; ?>/app/views/admin/admin.php" class="nav-item">
                <span class="material-symbols-outlined">dashboard</span>
                Panel de Control
            </a>
            <a href="<?php echo BASE_URL; ?>/app/views/admin/usuarios.php" class="nav-item active">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">group</span>
                Usuarios
            </a>
            <a href="<?php echo BASE_URL; ?>/app/views/admin/carrera.php" class="nav-item">
                <span class="material-symbols-outlined">work</span>
                Carreras
            </a>
        </nav>

        <div class="sidebar-footer">
            <button class="logout-btn" type="button">
                <span class="material-symbols-outlined">logout</span>
                Cerrar sesión
            </button>
        </div>
    </aside>

    <main>
        <div class="content-container">
            <div class="page-header">
                <div class="page-header-content">
                    <h1>Gestión de Usuarios</h1>
                    <p>Administra las cuentas de estudiantes y asesores vocacionales.</p>
                </div>

                <div class="page-header-actions">
                    <div class="search-container">
                        <span class="material-symbols-outlined">search</span>
                        <input type="text" class="search-input" placeholder="Buscar usuario...">
                    </div>

                    <button class="btn-primary" type="button" data-open-user-modal data-bs-toggle="modal" data-bs-target="#usuarioModal">
                        <span class="material-symbols-outlined">add</span>
                        Agregar usuario
                    </button>
                </div>
            </div>

            <div class="data-table-card">
                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido materno</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="usuariosTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

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
                        <label class="form-label">Apellido paterno</label>
                        <input class="form-control" name="apellidoPaterno">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apellido materno</label>
                        <input class="form-control" name="apellidoMaterno">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo de usuario</label>
                        <select class="form-select" name="tipoUsuario">
                            <option value="Alumno">Alumno</option>
                            <option value="Profesor">Profesor</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select" name="estadoId">
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
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