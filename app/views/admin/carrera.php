<?php
require_once __DIR__ . '/../../config/config.php';

$pageTitle = 'Gestión de Carreras - ' . siteName;
$pageStyles = ['admin.css', 'carreras.css'];
$pageScripts = ['admin.js'];
$bodyClass = 'vt-admin-page';
require_once __DIR__ . '/../layout/header.php';
?>
    <div class="vt-admin-shell">
        <aside class="vt-admin-sidebar d-none d-md-flex">
            <nav class="vt-admin-nav">
                <a class="vt-admin-nav-link" href="<?php echo BASE_URL; ?>/public/usuario/index">
                    <span class="material-symbols-outlined">group</span>
                    Usuarios
                </a>
                <a class="vt-admin-nav-link active" href="<?php echo BASE_URL; ?>/public/carrera/index">
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
                    <h1 class="vt-admin-title">Gestión de Carreras</h1>
                    <p class="vt-admin-topbar-label">Administra el catálogo de carreras profesionales y sus áreas asociadas.</p>
                </div>
                <button type="button" class="btn btn-primary rounded-pill px-4 py-2" data-open-career-modal>
                    <span class="material-symbols-outlined align-middle">add</span>
                    <span class="align-middle">Agregar carrera</span>
                </button>
            </section>

            <section class="vt-admin-main">
                <div class="vt-carrera-toolbar">
                    <div class="vt-carrera-toolbar-search">
                        <span class="material-symbols-outlined">search</span>
                        <input type="text" placeholder="Buscar por nombre o área..." aria-label="Buscar carrera" id="carreraBusqueda">
                    </div>

                    <div class="vt-carrera-action-group">
                        <button type="button" class="vt-carrera-btn">
                            <span class="material-symbols-outlined">filter_list</span>
                            Filtrar
                        </button>
                        <button type="button" class="vt-carrera-btn">
                            <span class="material-symbols-outlined">download</span>
                            Exportar
                        </button>
                    </div>
                </div>

                <div class="vt-carrera-table-card">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 vt-carrera-table">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Nombre de la Carrera</th>
                                    <th>Dificultad</th>
                                    <th>Estado</th>
                                    <th>Disponibilidad</th>
                                    <th class="text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="carrerasTableBody"></tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <div class="modal fade" id="carreraModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="carreraForm">
                <div class="modal-header">
                    <h5 class="modal-title">Carrera</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="carrera_id" value="">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input class="form-control" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL de la imagen</label>
                        <input class="form-control" name="imagen" placeholder="https://ejemplo.com/imagen-carrera.jpg">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dificultad</label>
                        <select class="form-select" name="dificultad">
                            <option value="Baja">Baja</option>
                            <option value="Media">Media</option>
                            <option value="Alta">Alta</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Disponibilidad</label>
                        <select class="form-select" name="disponibilidad">
                            <option value="Disponible">Disponible</option>
                            <option value="No disponible">No disponible</option>
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
