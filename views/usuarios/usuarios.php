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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap">

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
                                            <div class="user-avatar <?php echo htmlspecialchars($usuario['color_avatar']); ?>">
                                                <?php echo htmlspecialchars($usuario['iniciales']); ?>
                                            </div>
                                            <span class="user-name"><?php echo htmlspecialchars($usuario['nombre']); ?></span>
                                        </div>
                                    </td>

                                    <!-- Email Cell -->
                                    <td>
                                        <span class="user-email"><?php echo htmlspecialchars($usuario['email']); ?></span>
                                    </td>

                                    <!-- Registration Date Cell -->
                                    <td>
                                        <span class="user-email"><?php echo htmlspecialchars($usuario['fecha_registro']); ?></span>
                                    </td>

                                    <!-- Status Cell -->
                                    <td>
                                        <span class="status-badge <?php echo $usuario['estado'] === 'activo' ? 'status-active' : 'status-inactive'; ?>">
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
                    <span>Mostrando 1 a <?php echo $usuarios_por_pagina; ?> de <?php echo $total_usuarios; ?> usuarios</span>
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
</html>urface-variant transition-all rounded-lg flex items-center gap-3 px-3 py-2" href="#"><span class="material-symbols-outlined">settings</span><span class="font-label-md text-label-md">Settings</span></a><button class="w-full text-left text-error mx-2 my-1 hover:bg-error-container hover:text-on-error-container transition-all rounded-lg flex items-center gap-3 px-3 py-2 mt-2"><span class="material-symbols-outlined">logout</span><span class="font-label-md text-label-md">Logout</span></button></div></aside>
<!-- Main Content Canvas -->
<main class="flex-1 overflow-y-auto bg-background p-gutter md:p-section-padding">
<!-- Header Actions -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-stack-lg max-w-container-max mx-auto">
<div>
<h1 class="font-headline-lg text-headline-lg text-on-background mb-1">Gestión de Usuarios</h1>
<p class="font-body-md text-body-md text-on-surface-variant">Administra las cuentas de estudiantes y asesores vocacionales.</p>
</div>
<div class="flex flex-col sm:flex-row gap-3">
<!-- Search Bar -->
<div class="relative w-full sm:w-64">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
<input class="w-full pl-10 pr-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-full text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" placeholder="Buscar usuario..." type="text">
</div>
<!-- Add User Button -->
<button class="bg-primary text-on-primary px-6 py-2 rounded-full font-label-md text-label-md hover:opacity-90 transition-opacity flex items-center justify-center gap-2 shadow-sm whitespace-nowrap">
<span class="material-symbols-outlined text-[20px]">add</span>
                    Agregar usuario
                </button>
</div>
</div>
<!-- Data Table Card (Glassmorphism inspired) -->
<div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant overflow-hidden max-w-container-max mx-auto">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead class="bg-surface-container text-on-surface font-label-md text-label-md">
<tr>
<th class="p-4 font-medium border-b border-outline-variant">Nombre</th>
<th class="p-4 font-medium border-b border-outline-variant">Email</th>
<th class="p-4 font-medium border-b border-outline-variant">Fecha de Registro</th>
<th class="p-4 font-medium border-b border-outline-variant">Estado</th>
<th class="p-4 font-medium border-b border-outline-variant text-right">Acciones</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant">
<!-- Row 1 -->
<tr class="hover:bg-surface-container-low transition-colors group">
<td class="p-4">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-label-md">
                                        AR
                                    </div>
<span class="font-medium text-on-surface">Ana Ramírez</span>
</div>
</td>
<td class="p-4 text-on-surface-variant">ana.ramirez@example.com</td>
<td class="p-4 text-on-surface-variant">12 Oct 2024</td>
<td class="p-4">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-caption bg-tertiary-container text-on-tertiary-container">
                                    Activo
                                </span>
</td>
<td class="p-4 text-right">
<button class="text-on-surface-variant hover:text-primary transition-colors p-1" title="Editar">
<span class="material-symbols-outlined text-[20px]">edit</span>
</button>
<button class="text-on-surface-variant hover:text-error transition-colors p-1 ml-2" title="Eliminar">
<span class="material-symbols-outlined text-[20px]">delete</span>
</button>
</td>
</tr>
<!-- Row 2 -->
<tr class="hover:bg-surface-container-low transition-colors group">
<td class="p-4">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-label-md">
                                        CD
                                    </div>
<span class="font-medium text-on-surface">Carlos Díaz</span>
</div>
</td>
<td class="p-4 text-on-surface-variant">carlos.d@example.com</td>
<td class="p-4 text-on-surface-variant">10 Oct 2024</td>
<td class="p-4">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-caption bg-tertiary-container text-on-tertiary-container">
                                    Activo
                                </span>
</td>
<td class="p-4 text-right">
<button class="text-on-surface-variant hover:text-primary transition-colors p-1" title="Editar">
<span class="material-symbols-outlined text-[20px]">edit</span>
</button>
<button class="text-on-surface-variant hover:text-error transition-colors p-1 ml-2" title="Eliminar">
<span class="material-symbols-outlined text-[20px]">delete</span>
</button>
</td>
</tr>
<!-- Row 3 -->
<tr class="hover:bg-surface-container-low transition-colors group">
<td class="p-4">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-full bg-error-container text-on-error-container flex items-center justify-center font-label-md">
                                        MV
                                    </div>
<span class="font-medium text-on-surface">María Vargas</span>
</div>
</td>
<td class="p-4 text-on-surface-variant">maria.vargas@example.com</td>
<td class="p-4 text-on-surface-variant">08 Oct 2024</td>
<td class="p-4">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-caption bg-surface-variant text-on-surface-variant">
                                    Inactivo
                                </span>
</td>
<td class="p-4 text-right">
<button class="text-on-surface-variant hover:text-primary transition-colors p-1" title="Editar">
<span class="material-symbols-outlined text-[20px]">edit</span>
</button>
<button class="text-on-surface-variant hover:text-error transition-colors p-1 ml-2" title="Eliminar">
<span class="material-symbols-outlined text-[20px]">delete</span>
</button>
</td>
</tr>
<!-- Row 4 -->
<tr class="hover:bg-surface-container-low transition-colors group">
<td class="p-4">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-full bg-secondary-fixed-dim text-on-secondary-fixed flex items-center justify-center font-label-md">
                                        JL
                                    </div>
<span class="font-medium text-on-surface">Javier López</span>
</div>
</td>
<td class="p-4 text-on-surface-variant">jlopez99@example.com</td>
<td class="p-4 text-on-surface-variant">01 Oct 2024</td>
<td class="p-4">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-caption bg-tertiary-container text-on-tertiary-container">
                                    Activo
                                </span>
</td>
<td class="p-4 text-right">
<button class="text-on-surface-variant hover:text-primary transition-colors p-1" title="Editar">
<span class="material-symbols-outlined text-[20px]">edit</span>
</button>
<button class="text-on-surface-variant hover:text-error transition-colors p-1 ml-2" title="Eliminar">
<span class="material-symbols-outlined text-[20px]">delete</span>
</button>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination Footer -->
<div class="p-4 border-t border-outline-variant bg-surface-container-lowest flex items-center justify-between text-on-surface-variant font-caption text-caption">
<span class="">Mostrando 1 a 4 de 24 usuarios</span>
<div class="flex space-x-2">
<button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant hover:bg-surface-container disabled:opacity-50" disabled="">
<span class="material-symbols-outlined text-[18px]">chevron_left</span>
</button>
<button class="w-8 h-8 flex items-center justify-center rounded bg-primary text-on-primary">
                        1
                    </button>
<button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant hover:bg-surface-container">
                        2
                    </button>
<button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant hover:bg-surface-container">
                        3
                    </button>
<button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant hover:bg-surface-container">
<span class="material-symbols-outlined text-[18px]">chevron_right</span>
</button>
</div>
</div>
</div>
</main>


</body></html>