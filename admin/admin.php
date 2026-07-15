<!DOCTYPE html>

<html lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Vocatio - Panel de Administración</title>
<!-- Tailwind removed: using local styles -->
<link rel="stylesheet" href="admin.css" />
<link rel="stylesheet" href="tailwind-fallback.css" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Tailwind config removed; color and spacing variables are provided in fallback CSS -->
<style>
        body { background-color: #f7f9fb; }
        .soft-shadow { box-shadow: 0 4px 20px rgba(0, 74, 198, 0.05); }
        .hover-lift:hover { transform: translateY(-4px); box-shadow: 0 8px 25px rgba(0, 74, 198, 0.08); }
    </style>
</head>
<body class="bg-background font-body-md text-on-surface h-screen flex overflow-hidden">
<!-- SideNavBar (Shared Component) -->
<aside class="hidden md:flex bg-surface dark:bg-inverse-surface h-screen left-0 w-64 bg-surface-container dark:bg-surface-dim flex-col h-full py-stack-md shrink-0 border-r border-outline-variant/30">
<div class="px-gutter mb-stack-lg">
<h1 class="text-headline-sm font-headline-sm font-bold text-primary">Vocatio Admin</h1>
</div>
<div class="px-gutter mb-stack-md flex items-center gap-3">
<div class="w-10 h-10 rounded-full overflow-hidden bg-primary-container flex items-center justify-center text-on-primary-container">
<span class="material-symbols-outlined" data-icon="person">person</span>
</div>
<div>
<p class="font-label-md text-label-md text-on-surface">Perfil Admin</p>
<p class="font-caption text-caption text-on-surface-variant">Portal de Gestión</p>
</div>
</div>
<nav class="flex-1 px-2 flex flex-col gap-1 overflow-y-auto">
<!-- Active Tab: Dashboard -->
<a class="bg-primary-container dark:bg-primary text-on-primary-container dark:text-on-primary rounded-lg mx-2 my-1 flex items-center gap-3 px-3 py-2 transition-transform scale-100 hover:scale-[0.98]" href="#">
<span class="material-symbols-outlined" data-icon="dashboard" data-weight="fill" style='font-variation-settings: "FILL" 1;'>dashboard</span>
<span class="font-label-md text-label-md">Panel de Control</span>
</a>
<a class="text-on-surface-variant dark:text-outline-variant mx-2 my-1 hover:bg-surface-container-high dark:hover:bg-surface-variant transition-all rounded-lg flex items-center gap-3 px-3 py-2" href="#">
<span class="material-symbols-outlined" data-icon="group">group</span>
<span class="font-label-md text-label-md">Usuarios</span>
</a>
<a class="text-on-surface-variant dark:text-outline-variant mx-2 my-1 hover:bg-surface-container-high dark:hover:bg-surface-variant transition-all rounded-lg flex items-center gap-3 px-3 py-2" href="#">
<span class="material-symbols-outlined" data-icon="work">work</span>
<span class="font-label-md text-label-md">Carreras</span>
</a>
</nav>
<div class="px-2 mt-auto pt-stack-md border-t border-outline-variant/30">
<a class="text-on-surface-variant dark:text-outline-variant mx-2 my-1 hover:bg-surface-container-high dark:hover:bg-surface-variant transition-all rounded-lg flex items-center gap-3 px-3 py-2" href="#">
<span class="material-symbols-outlined" data-icon="settings">settings</span>
<span class="font-label-md text-label-md">Configuración</span>
</a>
<button class="w-full text-left text-error mx-2 my-1 hover:bg-error-container hover:text-on-error-container transition-all rounded-lg flex items-center gap-3 px-3 py-2 mt-2">
<span class="material-symbols-outlined" data-icon="logout">logout</span>
<span class="font-label-md text-label-md">Cerrar sesión</span>
</button>
</div>
</aside>
<!-- Mobile Top Nav (for small screens) -->
<header class="md:hidden flex justify-between items-center w-full px-gutter h-16 bg-surface border-b border-outline-variant/30 shrink-0">
<h1 class="text-headline-md font-headline-md font-bold text-primary">Vocatio</h1>
<button class="p-2 text-on-surface-variant">
<span class="material-symbols-outlined" data-icon="menu">menu</span>
</button>
</header>
<!-- Main Content Canvas -->
<main class="flex-1 overflow-y-auto bg-background p-gutter md:p-section-padding">
<header class="mb-stack-lg flex justify-between items-end">
<div>
<h2 class="font-headline-lg text-headline-lg text-on-surface">Resumen del Panel</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Métricas de la plataforma y actividad reciente.</p>
</div>
<div class="hidden sm:block">
<span class="font-caption text-caption text-outline px-3 py-1 bg-surface-container rounded-full">Última actualización: Hoy, 09:41 AM</span>
</div>
</header>
<!-- Summary Cards (Bento style grid) -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter mb-stack-lg">
<div class="bg-surface-container-lowest rounded-xl p-gutter soft-shadow hover-lift transition-all duration-300 relative overflow-hidden group">
<div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
<span class="material-symbols-outlined text-[64px] text-primary" data-icon="group">group</span>
</div>
<div class="flex justify-between items-start mb-stack-md relative z-10">
<div>
<p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">TOTAL DE USUARIOS</p>
<h3 class="font-display-lg text-display-lg text-on-surface mt-1">12,450</h3>
</div>
<div class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center text-primary">
<span class="material-symbols-outlined" data-icon="group">group</span>
</div>
</div>
<div class="flex items-center gap-2 relative z-10 mt-4">
<span class="font-caption text-caption text-tertiary flex items-center bg-tertiary-container/20 px-2 py-0.5 rounded-full">
<span class="material-symbols-outlined text-[14px] mr-1" data-icon="trending_up">trending_up</span>
                        +12%
                    </span>
<span class="font-caption text-caption text-on-surface-variant">vs el mes pasado</span>
</div>
</div>
<div class="bg-surface-container-lowest rounded-xl p-gutter soft-shadow hover-lift transition-all duration-300 relative overflow-hidden group">
<div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
<span class="material-symbols-outlined text-[64px] text-secondary" data-icon="task_alt">task_alt</span>
</div>
<div class="flex justify-between items-start mb-stack-md relative z-10">
<div>
<p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">TESTS COMPLETADOS</p>
<h3 class="font-display-lg text-display-lg text-on-surface mt-1">8,210</h3>
</div>
<div class="w-12 h-12 rounded-full bg-secondary-fixed flex items-center justify-center text-secondary">
<span class="material-symbols-outlined" data-icon="task_alt">task_alt</span>
</div>
</div>
<div class="flex items-center gap-2 relative z-10 mt-4">
<span class="font-caption text-caption text-tertiary flex items-center bg-tertiary-container/20 px-2 py-0.5 rounded-full">
<span class="material-symbols-outlined text-[14px] mr-1" data-icon="trending_up">trending_up</span>
                        +5.4%
                    </span>
<span class="font-caption text-caption text-on-surface-variant">vs el mes pasado</span>
</div>
</div>
<div class="bg-surface-container-lowest rounded-xl p-gutter soft-shadow hover-lift transition-all duration-300 relative overflow-hidden group">
<div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
<span class="material-symbols-outlined text-[64px] text-tertiary" data-icon="work">work</span>
</div>
<div class="flex justify-between items-start mb-stack-md relative z-10">
<div>
<p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">CARRERAS REGISTRADAS</p>
<h3 class="font-display-lg text-display-lg text-on-surface mt-1">142</h3>
</div>
<div class="w-12 h-12 rounded-full bg-tertiary-fixed flex items-center justify-center text-tertiary">
<span class="material-symbols-outlined" data-icon="work">work</span>
</div>
</div>
<div class="flex items-center gap-2 relative z-10 mt-4">
<span class="font-caption text-caption text-outline flex items-center bg-surface-container px-2 py-0.5 rounded-full">
<span class="material-symbols-outlined text-[14px] mr-1" data-icon="horizontal_rule">horizontal_rule</span>
                        Estable
                    </span>
<span class="font-caption text-caption text-on-surface-variant">Catálogo activo</span>
</div>
</div>
</div>
<!-- Recent Activity Table Section -->
<div class="bg-surface-container-lowest rounded-xl soft-shadow overflow-hidden">
<div class="p-gutter border-b border-outline-variant/30 flex justify-between items-center">
<h3 class="font-headline-md text-headline-md text-on-surface">Evaluaciones Recientes</h3>
<button class="font-label-md text-label-md text-primary hover:text-primary-fixed-variant transition-colors">Ver todo</button>
</div>
<div class="overflow-x-auto w-full">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low text-on-surface-variant font-label-md text-label-md">
<th class="py-3 px-gutter font-medium">Nombre del Estudiante</th>
<th class="py-3 px-gutter font-medium">Fecha de Finalización</th>
<th class="py-3 px-gutter font-medium">Principal Afinidad</th>
<th class="py-3 px-gutter font-medium text-right">Estado</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/20 font-body-md text-body-md">
<tr class="hover:bg-surface-container-lowest/50 transition-colors">
<td class="py-4 px-gutter text-on-surface font-medium">Elena Rodriguez</td>
<td class="py-4 px-gutter text-on-surface-variant">24 oct, 2023</td>
<td class="py-4 px-gutter text-on-surface-variant">Software Engineering</td>
<td class="py-4 px-gutter text-right">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-caption text-caption bg-tertiary-container/20 text-tertiary">
                                    Completado
                                </span>
</td>
</tr>
<tr class="hover:bg-surface-container-lowest/50 transition-colors">
<td class="py-4 px-gutter text-on-surface font-medium">Marcus Chen</td>
<td class="py-4 px-gutter text-on-surface-variant">24 oct, 2023</td>
<td class="py-4 px-gutter text-on-surface-variant">Industrial Design</td>
<td class="py-4 px-gutter text-right">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-caption text-caption bg-tertiary-container/20 text-tertiary">
                                    Completado
                                </span>
</td>
</tr>
<tr class="hover:bg-surface-container-lowest/50 transition-colors">
<td class="py-4 px-gutter text-on-surface font-medium">Sarah Jenkins</td>
<td class="py-4 px-gutter text-on-surface-variant">23 oct, 2023</td>
<td class="py-4 px-gutter text-on-surface-variant">Nursing</td>
<td class="py-4 px-gutter text-right">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-caption text-caption bg-tertiary-container/20 text-tertiary">
                                    Completado
                                </span>
</td>
</tr>
<tr class="hover:bg-surface-container-lowest/50 transition-colors">
<td class="py-4 px-gutter text-on-surface font-medium">David Kim</td>
<td class="py-4 px-gutter text-on-surface-variant">23 oct, 2023</td>
<td class="py-4 px-gutter text-on-surface-variant">Pendiente...</td>
<td class="py-4 px-gutter text-right">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-caption text-caption bg-secondary-container/20 text-secondary">
                                    En Progreso
                                </span>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</main>
</body></html>