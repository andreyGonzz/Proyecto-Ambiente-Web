<?php
// Variables globales
$siteName = "Vocatio";
$year = date("Y");
$baseUrl = '/Proyecto%20Ambiente%20Web';

// Datos de usuarios de ejemplo - en producción vendrían de la BD
$usuarios = [
    [
        'id' => 1,
        'nombre' => 'Ana Ramírez',
        'iniciales' => 'AR',
        'email' => 'ana.ramirez@example.com',
        'fecha_registro' => '12 Oct 2024',
        'estado' => 'activo',
        'color_avatar' => 'tertiary'
    ],
    [
        'id' => 2,
        'nombre' => 'Carlos Díaz',
        'iniciales' => 'CD',
        'email' => 'carlos.d@example.com',
        'fecha_registro' => '10 Oct 2024',
        'estado' => 'activo',
        'color_avatar' => 'primary'
    ],
    [
        'id' => 3,
        'nombre' => 'María Vargas',
        'iniciales' => 'MV',
        'email' => 'maria.vargas@example.com',
        'fecha_registro' => '08 Oct 2024',
        'estado' => 'inactivo',
        'color_avatar' => 'error'
    ],
    [
        'id' => 4,
        'nombre' => 'Javier López',
        'iniciales' => 'JL',
        'email' => 'jlopez99@example.com',
        'fecha_registro' => '01 Oct 2024',
        'estado' => 'activo',
        'color_avatar' => 'secondary'
    ]
];

$total_usuarios = count($usuarios);
$pagina_actual = 1;
$usuarios_por_pagina = 4;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - Vocatio Admin</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Symbols -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap">

    <!-- Google Font: Inter -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/assets/styles/index.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/assets/styles/header.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/assets/styles/footer.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/public/assets/styles/usuarios.css">
</head>

<body class="sidebar-open">

    <!-- Sidebar Navigation -->
    <aside class="admin-sidebar">
        <!-- Header -->
        <div class="sidebar-header">
            <h1>Vocatio Admin</h1>
        </div>

        <!-- User Profile -->
        <div class="sidebar-profile">
            <div class="profile-avatar">
                <span class="material-symbols-outlined">person</span>
            </div>
            <div class="profile-info">
                <h3>Perfil Admin</h3>
                <p>Portal de Gestión</p>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="sidebar-nav">
            <a href="#" class="nav-item">
                <span class="material-symbols-outlined">dashboard</span>
                Panel de Control
            </a>
            <a href="#" class="nav-item active">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">group</span>
                Usuarios
            </a>
            <a href="#" class="nav-item">
                <span class="material-symbols-outlined">work</span>
                Carreras
            </a>
        </nav>

        <!-- Footer Section -->
        <div class="sidebar-footer">
            <button class="logout-btn">
                <span class="material-symbols-outlined">logout</span>
                Cerrar sesión
            </button>
        </div>
    </aside>

    <!-- Main Content -->
    <main>
        <div class="content-container">

            <!-- Page Header -->
            <div class="page-header">
                <div class="page-header-content">
                    <h1>Gestión de Usuarios</h1>
                    <p>Administra las cuentas de estudiantes y asesores vocacionales.</p>
                </div>

                <!-- Header Actions -->
                <div class="page-header-actions">
                    <!-- Search Bar -->
                    <div class="search-container">
                        <span class="material-symbols-outlined">search</span>
                        <input type="text" class="search-input" placeholder="Buscar usuario...">
                    </div>

                    <!-- Add User Button -->
                    <button class="btn-primary">
                        <span class="material-symbols-outlined">add</span>
                        Agregar usuario
                    </button>
                </div>
            </div>

            <!-- Data Table -->
            <div class="data-table-card">
                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Fecha de Registro</th>
                                <th>Estado</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <!-- User Cell -->
                                    <td>
                                        <div class="user-cell">
                                            <div
                                                class="user-avatar <?php echo htmlspecialchars($usuario['color_avatar']); ?>">
                                                <?php echo htmlspecialchars($usuario['iniciales']); ?>
                                            </div>
                                            <span
                                                class="user-name"><?php echo htmlspecialchars($usuario['nombre']); ?></span>
                                        </div>
                                    </td>

                                    <!-- Email Cell -->
                                    <td>
                                        <span class="user-email"><?php echo htmlspecialchars($usuario['email']); ?></span>
                                    </td>

                                    <!-- Registration Date Cell -->
                                    <td>
                                        <span
                                            class="user-email"><?php echo htmlspecialchars($usuario['fecha_registro']); ?></span>
                                    </td>

                                    <!-- Status Cell -->
                                    <td>
                                        <span
                                            class="status-badge <?php echo $usuario['estado'] === 'activo' ? 'status-active' : 'status-inactive'; ?>">
                                            <?php echo ucfirst(htmlspecialchars($usuario['estado'])); ?>
                                        </span>
                                    </td>

                                    <!-- Actions Cell -->
                                    <td>
                                        <div class="table-actions">
                                            <button class="btn-icon" title="Editar">
                                                <span class="material-symbols-outlined">edit</span>
                                            </button>
                                            <button class="btn-icon btn-delete" title="Eliminar">
                                                <span class="material-symbols-outlined">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer with Pagination -->
                <div class="table-footer">
                    <span>Mostrando 1 a <?php echo $usuarios_por_pagina; ?> de <?php echo $total_usuarios; ?>
                        usuarios</span>
                    <div class="pagination">
                        <button class="pagination-btn" disabled>
                            <span class="material-symbols-outlined">chevron_left</span>
                        </button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">3</button>
                        <button class="pagination-btn">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>