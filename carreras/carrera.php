<!DOCTYPE html>

<html class="light" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Vocatio Admin - Gestión de Carreras</title>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&amp;display=swap" rel="stylesheet"/>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { background-color: #f7f9fb; }
        .soft-shadow { box-shadow: 0 4px 20px rgba(0, 74, 198, 0.05); }
    </style>
<!-- Local styles instead of Tailwind -->
<link rel="stylesheet" href="carrera.css" />
<link rel="stylesheet" href="../admin/tailwind-fallback.css" />
</head>
<body class="bg-background text-on-background font-body-md text-body-md flex min-h-screen overflow-hidden">
<!-- SideNavBar Component - Fixed height and width -->
<aside class="hidden md:flex flex-col w-64 h-screen bg-surface-container border-r border-outline-variant/30 py-stack-md shrink-0 sticky top-0">
<div class="px-gutter mb-stack-lg">
<h1 class="text-headline-sm font-bold text-primary">Vocatio Admin</h1>
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
<!-- Dashboard Tab -->
<a class="text-on-surface-variant mx-2 my-1 hover:bg-surface-container-high transition-all rounded-lg flex items-center gap-3 px-3 py-2" href="#">
<span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
<span class="font-label-md text-label-md">Panel de Control</span>
</a>
<!-- Users Tab -->
<a class="text-on-surface-variant mx-2 my-1 hover:bg-surface-container-high transition-all rounded-lg flex items-center gap-3 px-3 py-2" href="#">
<span class="material-symbols-outlined" data-icon="group">group</span>
<span class="font-label-md text-label-md">Usuarios</span>
</a>
<!-- Careers Tab (Active) -->
<a class="bg-primary-container text-on-primary-container rounded-lg mx-2 my-1 flex items-center gap-3 px-3 py-2 transition-transform scale-100 shadow-sm" href="#">
<span class="material-symbols-outlined" data-icon="work" style="font-variation-settings: 'FILL' 1;">work</span>
<span class="font-label-md text-label-md">Carreras</span>
</a>
</nav>
<div class="px-2 mt-auto pt-stack-md border-t border-outline-variant/30">
<a class="text-on-surface-variant mx-2 my-1 hover:bg-surface-container-high transition-all rounded-lg flex items-center gap-3 px-3 py-2" href="#">
<span class="material-symbols-outlined" data-icon="settings">settings</span>
<span class="font-label-md text-label-md">Configuración</span>
</a>
<button class="w-full text-left text-error mx-2 my-1 hover:bg-error-container hover:text-on-error-container transition-all rounded-lg flex items-center gap-3 px-3 py-2 mt-2">
<span class="material-symbols-outlined" data-icon="logout">logout</span>
<span class="font-label-md text-label-md">Cerrar sesión</span>
</button>
</div>
</aside>
<!-- Main Content Area -->
<main class="flex-1 overflow-y-auto p-gutter md:p-section-padding">
<!-- Page Header -->
<header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-stack-lg">
<div>
<h2 class="font-headline-lg text-headline-lg text-on-surface">Gestión de Carreras</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-1">Administra el catálogo de carreras profesionales y sus áreas asociadas.</p>
</div>
<button class="inline-flex items-center justify-center gap-2 bg-primary text-on-primary rounded-full px-6 py-3 font-label-md text-label-md soft-shadow hover:-translate-y-0.5 transition-all duration-200">
<span class="material-symbols-outlined text-[20px]">add</span>
            Agregar carrera
        </button>
</header>
<!-- Data Table Container (Card) -->
<div class="bg-surface-container-lowest rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-outline-variant/30 overflow-hidden mb-gutter">
<!-- Table Toolbar -->
<div class="p-gutter border-b border-outline-variant/30 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-surface-bright">
<div class="relative w-full max-w-md">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
<input class="w-full pl-10 pr-4 py-2.5 bg-surface-container-lowest border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" placeholder="Buscar por nombre o área..." type="text"/>
</div>
<div class="flex items-center gap-3 w-full sm:w-auto">
<button class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 text-on-surface-variant hover:text-primary font-label-md text-label-md px-4 py-2.5 rounded-lg border border-outline-variant hover:bg-surface-container-low transition-colors">
<span class="material-symbols-outlined text-[20px]">filter_list</span>
                    Filtrar
                </button>
<button class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 text-on-surface-variant hover:text-primary font-label-md text-label-md px-4 py-2.5 rounded-lg border border-outline-variant hover:bg-surface-container-low transition-colors">
<span class="material-symbols-outlined text-[20px]">download</span>
                    Exportar
                </button>
</div>
</div>
<!-- Table -->
<div class="overflow-x-auto w-full">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low border-b border-outline-variant/50">
<th class="px-gutter py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Nombre de la Carrera</th>
<th class="px-gutter py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Área de Estudio</th>
<th class="px-gutter py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Estado</th>
<th class="px-gutter py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Modificación</th>
<th class="px-gutter py-4 font-label-md text-label-md text-on-surface-variant uppercase tracking-wider text-right">Acciones</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/20">
<!-- Row 1 -->
<tr class="hover:bg-surface-container-low/50 transition-colors group">
<td class="px-gutter py-4 font-body-md text-on-surface font-medium">Ingeniería en Sistemas Computacionales</td>
<td class="px-gutter py-4">
<span class="inline-flex items-center px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed font-caption text-caption">Tecnología y Sistemas</span>
</td>
<td class="px-gutter py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full font-caption text-caption bg-tertiary-container/20 text-tertiary">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span> Activo
                            </span>
</td>
<td class="px-gutter py-4 font-caption text-on-surface-variant">28 Oct, 2023</td>
<td class="px-gutter py-4 text-right">
<div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-2 text-on-surface-variant hover:text-primary hover:bg-primary-container/10 rounded-lg transition-colors" title="Editar"><span class="material-symbols-outlined text-[20px]">edit</span></button>
<button class="p-2 text-on-surface-variant hover:text-error hover:bg-error-container/10 rounded-lg transition-colors" title="Eliminar"><span class="material-symbols-outlined text-[20px]">delete</span></button>
</div>
</td>
</tr>
<!-- Row 2 -->
<tr class="hover:bg-surface-container-low/50 transition-colors group">
<td class="px-gutter py-4 font-body-md text-on-surface font-medium">Medicina General</td>
<td class="px-gutter py-4">
<span class="inline-flex items-center px-3 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-caption text-caption">Ciencias de la Salud</span>
</td>
<td class="px-gutter py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full font-caption text-caption bg-tertiary-container/20 text-tertiary">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span> Activo
                            </span>
</td>
<td class="px-gutter py-4 font-caption text-on-surface-variant">25 Oct, 2023</td>
<td class="px-gutter py-4 text-right">
<div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-2 text-on-surface-variant hover:text-primary hover:bg-primary-container/10 rounded-lg transition-colors" title="Editar"><span class="material-symbols-outlined text-[20px]">edit</span></button>
<button class="p-2 text-on-surface-variant hover:text-error hover:bg-error-container/10 rounded-lg transition-colors" title="Eliminar"><span class="material-symbols-outlined text-[20px]">delete</span></button>
</div>
</td>
</tr>
<!-- Row 3 -->
<tr class="hover:bg-surface-container-low/50 transition-colors group">
<td class="px-gutter py-4 font-body-md text-on-surface font-medium">Diseño Gráfico Digital</td>
<td class="px-gutter py-4">
<span class="inline-flex items-center px-3 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-caption text-caption">Arte y Diseño</span>
</td>
<td class="px-gutter py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full font-caption text-caption bg-tertiary-container/20 text-tertiary">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span> Activo
                            </span>
</td>
<td class="px-gutter py-4 font-caption text-on-surface-variant">22 Oct, 2023</td>
<td class="px-gutter py-4 text-right">
<div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-2 text-on-surface-variant hover:text-primary hover:bg-primary-container/10 rounded-lg transition-colors" title="Editar"><span class="material-symbols-outlined text-[20px]">edit</span></button>
<button class="p-2 text-on-surface-variant hover:text-error hover:bg-error-container/10 rounded-lg transition-colors" title="Eliminar"><span class="material-symbols-outlined text-[20px]">delete</span></button>
</div>
</td>
</tr>
<!-- Row 4 -->
<tr class="hover:bg-surface-container-low/50 transition-colors group">
<td class="px-gutter py-4 font-body-md text-on-surface font-medium">Administración de Empresas</td>
<td class="px-gutter py-4">
<span class="inline-flex items-center px-3 py-1 rounded-full bg-surface-variant text-on-surface-variant font-caption text-caption border border-outline-variant/30">Negocios y Finanzas</span>
</td>
<td class="px-gutter py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full font-caption text-caption bg-outline/10 text-outline">
<span class="w-1.5 h-1.5 rounded-full bg-outline"></span> Inactivo
                            </span>
</td>
<td class="px-gutter py-4 font-caption text-on-surface-variant">15 Oct, 2023</td>
<td class="px-gutter py-4 text-right">
<div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-2 text-on-surface-variant hover:text-primary hover:bg-primary-container/10 rounded-lg transition-colors" title="Editar"><span class="material-symbols-outlined text-[20px]">edit</span></button>
<button class="p-2 text-on-surface-variant hover:text-error hover:bg-error-container/10 rounded-lg transition-colors" title="Eliminar"><span class="material-symbols-outlined text-[20px]">delete</span></button>
</div>
</td>
</tr>
<!-- Row 5 -->
<tr class="hover:bg-surface-container-low/50 transition-colors group">
<td class="px-gutter py-4 font-body-md text-on-surface font-medium">Derecho y Ciencias Políticas</td>
<td class="px-gutter py-4">
<span class="inline-flex items-center px-3 py-1 rounded-full bg-surface-variant text-on-surface-variant font-caption text-caption border border-outline-variant/30">Ciencias Sociales</span>
</td>
<td class="px-gutter py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full font-caption text-caption bg-tertiary-container/20 text-tertiary">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span> Activo
                            </span>
</td>
<td class="px-gutter py-4 font-caption text-on-surface-variant">12 Oct, 2023</td>
<td class="px-gutter py-4 text-right">
<div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-2 text-on-surface-variant hover:text-primary hover:bg-primary-container/10 rounded-lg transition-colors" title="Editar"><span class="material-symbols-outlined text-[20px]">edit</span></button>
<button class="p-2 text-on-surface-variant hover:text-error hover:bg-error-container/10 rounded-lg transition-colors" title="Eliminar"><span class="material-symbols-outlined text-[20px]">delete</span></button>
</div>
</td>
</tr>
<!-- Row 6 -->
<tr class="hover:bg-surface-container-low/50 transition-colors group">
<td class="px-gutter py-4 font-body-md text-on-surface font-medium">Arquitectura y Urbanismo</td>
<td class="px-gutter py-4">
<span class="inline-flex items-center px-3 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-caption text-caption">Arte y Diseño</span>
</td>
<td class="px-gutter py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full font-caption text-caption bg-tertiary-container/20 text-tertiary">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span> Activo
                            </span>
</td>
<td class="px-gutter py-4 font-caption text-on-surface-variant">10 Oct, 2023</td>
<td class="px-gutter py-4 text-right">
<div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-2 text-on-surface-variant hover:text-primary hover:bg-primary-container/10 rounded-lg transition-colors" title="Editar"><span class="material-symbols-outlined text-[20px]">edit</span></button>
<button class="p-2 text-on-surface-variant hover:text-error hover:bg-error-container/10 rounded-lg transition-colors" title="Eliminar"><span class="material-symbols-outlined text-[20px]">delete</span></button>
</div>
</td>
</tr>
<!-- Row 7 -->
<tr class="hover:bg-surface-container-low/50 transition-colors group">
<td class="px-gutter py-4 font-body-md text-on-surface font-medium">Ingeniería Mecatrónica</td>
<td class="px-gutter py-4">
<span class="inline-flex items-center px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed font-caption text-caption">Tecnología y Sistemas</span>
</td>
<td class="px-gutter py-4">
<span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full font-caption text-caption bg-tertiary-container/20 text-tertiary">
<span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span> Activo
                            </span>
</td>
<td class="px-gutter py-4 font-caption text-on-surface-variant">08 Oct, 2023</td>
<td class="px-gutter py-4 text-right">
<div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
<button class="p-2 text-on-surface-variant hover:text-primary hover:bg-primary-container/10 rounded-lg transition-colors" title="Editar"><span class="material-symbols-outlined text-[20px]">edit</span></button>
<button class="p-2 text-on-surface-variant hover:text-error hover:bg-error-container/10 rounded-lg transition-colors" title="Eliminar"><span class="material-symbols-outlined text-[20px]">delete</span></button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination -->
<div class="px-gutter py-4 border-t border-outline-variant/30 bg-surface-bright flex items-center justify-between">
<span class="font-caption text-caption text-on-surface-variant">Mostrando <span class="font-medium">7</span> de <span class="font-medium">142</span> carreras</span>
<div class="flex items-center gap-2">
<button class="p-2 rounded-lg text-outline hover:bg-surface-container-high hover:text-on-surface disabled:opacity-30 transition-colors" disabled="">
<span class="material-symbols-outlined text-[20px]">chevron_left</span>
</button>
<div class="flex items-center">
<button class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary text-on-primary font-label-md text-caption">1</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg text-on-surface-variant hover:bg-surface-container-high font-label-md text-caption">2</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg text-on-surface-variant hover:bg-surface-container-high font-label-md text-caption">3</button>
<span class="px-1 text-outline">...</span>
<button class="w-8 h-8 flex items-center justify-center rounded-lg text-on-surface-variant hover:bg-surface-container-high font-label-md text-caption">21</button>
</div>
<button class="p-2 rounded-lg text-outline hover:bg-surface-container-high hover:text-on-surface transition-colors">
<span class="material-symbols-outlined text-[20px]">chevron_right</span>
</button>
</div>
</div>
</div>
</main>
</body></html>