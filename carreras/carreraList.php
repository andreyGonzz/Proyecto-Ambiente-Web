<!DOCTYPE html><html lang="es"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Carreras - Vocatio</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<!-- Local styles instead of Tailwind -->
<link rel="stylesheet" href="carrera.css" />
<link rel="stylesheet" href="../admin/tailwind-fallback.css" />
<style>
        body { background-color: #f7f9fb; }
        .ambient-shadow { box-shadow: 0 4px 20px rgba(0, 74, 198, 0.05); }
        .hover-lift:hover { transform: translateY(-4px); box-shadow: 0 8px 25px rgba(0, 74, 198, 0.08); transition: all 0.3s ease; }
    </style>
</head>
<body class="bg-background text-on-background font-body-md text-body-md min-h-screen flex flex-col">
<!-- TopNavBar -->
<nav class="fixed top-0 w-full z-50 bg-surface-container-lowest shadow-sm flex justify-between items-center px-gutter max-w-container-max mx-auto h-16">
<div class="flex items-center gap-8">
<div class="text-headline-md font-headline-md font-bold text-primary">Vocatio</div>
<div class="hidden md:flex gap-6">
<a class="text-on-surface-variant font-body-md text-body-md hover:text-primary transition-colors duration-200" href="#">Inicio</a>
<a class="text-primary font-bold border-b-2 border-primary font-body-md text-body-md hover:text-primary transition-colors duration-200" href="#">Carreras</a>
</div>
</div>
<div class="flex items-center gap-4 hidden md:flex">
<button class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors duration-200">Iniciar sesión</button>
<button class="bg-primary text-on-primary font-label-md text-label-md px-4 py-2 rounded-full hover:opacity-90 transition-opacity">Registrarse</button>
</div>
</nav>
<!-- Main Content -->
<main class="flex-grow pt-24 pb-section-padding px-gutter max-w-container-max mx-auto w-full">
<!-- Header & Search -->
<div class="mb-stack-lg">
<h1 class="font-display-lg text-display-lg text-on-surface mb-stack-md hidden md:block">Explora tu futuro</h1>
<h1 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface mb-stack-md md:hidden">Explora tu futuro</h1>
<div class="flex flex-col md:flex-row gap-4 mb-stack-md">
<div class="relative flex-grow">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
<input class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-full focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors font-body-md text-body-md text-on-surface" placeholder="Busca por carrera, área o interés..." type="text">
</div>
<button class="bg-surface-container-lowest border border-outline-variant text-on-surface flex items-center justify-center gap-2 px-6 py-3 rounded-full hover:bg-surface-container-low transition-colors font-label-md text-label-md">
<span class="material-symbols-outlined">filter_list</span>
                    Filtros
                </button>
</div>
<!-- Chips -->
<div class="flex flex-wrap gap-2">
<button class="bg-primary-container text-on-primary-container px-4 py-1.5 rounded-full font-label-md text-label-md">Todas</button>
<button class="bg-surface-container-low text-on-surface-variant border border-outline-variant px-4 py-1.5 rounded-full font-label-md text-label-md hover:bg-surface-container transition-colors">Tecnología</button>
<button class="bg-surface-container-low text-on-surface-variant border border-outline-variant px-4 py-1.5 rounded-full font-label-md text-label-md hover:bg-surface-container transition-colors">Salud</button>
<button class="bg-surface-container-low text-on-surface-variant border border-outline-variant px-4 py-1.5 rounded-full font-label-md text-label-md hover:bg-surface-container transition-colors">Arte y Diseño</button>
<button class="bg-surface-container-low text-on-surface-variant border border-outline-variant px-4 py-1.5 rounded-full font-label-md text-label-md hover:bg-surface-container transition-colors">Negocios</button>
</div>
</div>
<!-- Careers Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
<!-- Card 1 -->
<div class="bg-surface-container-lowest rounded-xl overflow-hidden ambient-shadow hover-lift flex flex-col cursor-pointer border border-transparent hover:border-primary/20">
<div class="bg-cover bg-center w-full h-48" data-alt="A modern software engineering workspace with multiple glowing screens displaying code, a mechanical keyboard, and a hot cup of coffee. The room has a bright, light-mode aesthetic with soft white lighting and accents of primary blue. The mood is focused, professional, and technologically advanced." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuB6W_X0Mx6dR_iubx92fLnaBRpvk9hLuvNFZTX5esDqhQFpGKc-369-b5f3bQ6A0oTd8dBkCoxHQaGuZGz9nQTaq2Qtpj_hID5StEXoFbnxAYiA6CASDkHGm9BfZe1_HiCBCtvlzMjhe0mByeXeUNE2yudFisze6nQMVlmMByRzLUz9eVWrzTerhhfiMYwcWBauVuZKP5Yy_HhRGJIN9JpKHnxQ28TDRS-X0Ls5IfXE6sSLE7Eboc9sTQ')"></div>
<div class="p-6 flex flex-col flex-grow">
<div class="flex justify-between items-start mb-2">
<span class="bg-secondary-fixed text-on-secondary-fixed px-3 py-1 rounded-full font-caption text-caption">Tecnología</span>
<span class="material-symbols-outlined text-outline-variant hover:text-primary transition-colors" style="font-variation-settings: 'FILL' 0;">bookmark</span>
</div>
<h3 class="font-headline-md text-headline-md text-on-surface mb-2">Ingeniería de Software</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6 flex-grow">Diseña, desarrolla y mantén sistemas informáticos complejos que impulsan el mundo digital.</p>
<div class="flex justify-between items-center mt-auto pt-4 border-t border-surface-container">
<span class="font-caption text-caption text-on-surface-variant flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> 5 Años</span>
<button class="text-primary font-label-md text-label-md hover:text-primary-fixed-variant transition-colors flex items-center gap-1">Ver más <span class="material-symbols-outlined text-[18px]">arrow_forward</span></button>
</div>
</div>
</div>
<!-- Card 2 -->
<div class="bg-surface-container-lowest rounded-xl overflow-hidden ambient-shadow hover-lift flex flex-col cursor-pointer border border-transparent hover:border-primary/20">
<div class="bg-cover bg-center w-full h-48" data-alt="A brightly lit modern hospital corridor or lab setting. In focus is a stethoscope resting on a clean white desk next to digital medical tablets showing charts. The lighting is crisp, soft white, conveying cleanliness and modern healthcare. The color palette features whites, light blues, and soft greens." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDFAvxsLqCdX3OKT2Dxu9OSzNmQRQoC3BJsN4HGrv4KOeUhp5LYVT1j-EyxUnMmFmGSIpe9jiiuGfZRJgxLWkkLMYl_86bua0lz43Qmt9CQSXvEYxQgUnbteOZOJhrqKUwX9yE2oBsY4681lLcNOm01axwIhImu7-JVvVTgxpDYDQvh6_1tpRfphC_xiX3-b0FFS3zgyWKDX4hTcWCO0FPjfMGdmekCEeuUbkGMuGKK685fRST82ntJXA')"></div>
<div class="p-6 flex flex-col flex-grow">
<div class="flex justify-between items-start mb-2">
<span class="bg-tertiary-fixed text-on-tertiary-fixed px-3 py-1 rounded-full font-caption text-caption">Salud</span>
<span class="material-symbols-outlined text-outline-variant hover:text-primary transition-colors" style="font-variation-settings: 'FILL' 0;">bookmark</span>
</div>
<h3 class="font-headline-md text-headline-md text-on-surface mb-2">Medicina General</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6 flex-grow">Diagnostica, trata y prevén enfermedades para mejorar la calidad de vida de las personas.</p>
<div class="flex justify-between items-center mt-auto pt-4 border-t border-surface-container">
<span class="font-caption text-caption text-on-surface-variant flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> 6 Años</span>
<button class="text-primary font-label-md text-label-md hover:text-primary-fixed-variant transition-colors flex items-center gap-1">Ver más <span class="material-symbols-outlined text-[18px]">arrow_forward</span></button>
</div>
</div>
</div>
<!-- Card 3 -->
<div class="bg-surface-container-lowest rounded-xl overflow-hidden ambient-shadow hover-lift flex flex-col cursor-pointer border border-transparent hover:border-primary/20">
<div class="bg-cover bg-center w-full h-48" data-alt="A clean, minimalist design studio workspace. A large digital drawing tablet lies on a pristine white desk alongside color swatches and a minimalist stylus. Soft natural light floods the scene from a nearby window, creating a calm, inspiring, and creative light-mode aesthetic with subtle purple accents." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuB14c6GQwTfhScuEBnxp0VApVDWgsdgPz55iCyG2Y4a8ARLtaWC4YegrvDpvK1rW4OVSCt1RzY39QUQ9aITo-DCovDPjSp564xgfsBZyxeBnYf_onRs6P9jHD9Kf2pdJFXlFb6YhPDp1XVbGPwBs2AJ8qwAYyybxJrbO19XrLjCCsAIpIo1p9_j6gDmHxhL_XGEgpRGLAnxCWd5Oxpof0stcYq43-guz4ajVS-C90pMQv-rQ-AD-GiMSQ')"></div>
<div class="p-6 flex flex-col flex-grow">
<div class="flex justify-between items-start mb-2">
<span class="bg-primary-fixed text-on-primary-fixed px-3 py-1 rounded-full font-caption text-caption">Arte y Diseño</span>
<span class="material-symbols-outlined text-outline-variant hover:text-primary transition-colors" style="font-variation-settings: 'FILL' 0;">bookmark</span>
</div>
<h3 class="font-headline-md text-headline-md text-on-surface mb-2">Diseño Gráfico Digital</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6 flex-grow">Comunica ideas a través de medios visuales, creando identidades de marca e interfaces atractivas.</p>
<div class="flex justify-between items-center mt-auto pt-4 border-t border-surface-container">
<span class="font-caption text-caption text-on-surface-variant flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> 4 Años</span>
<button class="text-primary font-label-md text-label-md hover:text-primary-fixed-variant transition-colors flex items-center gap-1">Ver más <span class="material-symbols-outlined text-[18px]">arrow_forward</span></button>
</div>
</div>
</div>
<!-- Card 4 -->
<div class="bg-surface-container-lowest rounded-xl overflow-hidden ambient-shadow hover-lift flex flex-col cursor-pointer border border-transparent hover:border-primary/20">
<div class="bg-cover bg-center w-full h-48" data-alt="A modern corporate boardroom table viewed from a slight angle. The table is white and features financial documents with clean bar charts and a sleek laptop. The room is flooded with bright, diffused daylight. The aesthetic is professional, clean, light-mode, with subtle cool gray and blue tones." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAhTTlg_pXX5pEbMmnmp4pNCOYt6cJaFPlQx0-D3rUEBpEYWG1OJzNtXRDyMCWCOP15pDZdjPy1e9YSIjiKDyucOUAXTWit0jlOHmnAX3bbajNC4sISnUIfXCrO21oZLMkELok3pp5Io4Zbbv8a4w8IK7NknzEJeaPiV74CiXwkwzOWDxy1Qg1aN6ELUHya8kBM08XHkpb1eYY4yTRyF_ce4GbqjvUYAo34jBdKpK-YHpIs_J5g1PpdIw')"></div>
<div class="p-6 flex flex-col flex-grow">
<div class="flex justify-between items-start mb-2">
<span class="bg-surface-container-high text-on-surface px-3 py-1 rounded-full font-caption text-caption">Negocios</span>
<span class="material-symbols-outlined text-outline-variant hover:text-primary transition-colors" style="font-variation-settings: 'FILL' 0;">bookmark</span>
</div>
<h3 class="font-headline-md text-headline-md text-on-surface mb-2">Administración de Empresas</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-6 flex-grow">Lidera organizaciones, optimiza recursos y desarrolla estrategias para el crecimiento comercial.</p>
<div class="flex justify-between items-center mt-auto pt-4 border-t border-surface-container">
<span class="font-caption text-caption text-on-surface-variant flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> 4 Años</span>
<button class="text-primary font-label-md text-label-md hover:text-primary-fixed-variant transition-colors flex items-center gap-1">Ver más <span class="material-symbols-outlined text-[18px]">arrow_forward</span></button>
</div>
</div>
</div>
</div>
</main>
<!-- Footer -->
<footer class="bg-surface-container-highest border-t border-outline-variant mt-auto">
<div class="flex flex-col md:flex-row justify-between items-center w-full px-gutter py-stack-lg max-w-container-max mx-auto gap-4">
<div class="text-headline-sm font-headline-sm font-bold text-on-surface">Vocatio</div>
<div class="flex gap-6 font-body-md text-body-md">
<a class="text-on-surface-variant hover:text-secondary transition-colors" href="#">Institutional</a>
<a class="text-on-surface-variant hover:text-secondary transition-colors" href="#">Contact</a>
<a class="text-on-surface-variant hover:text-secondary transition-colors" href="#">Privacy Policy</a>
</div>
<div class="font-caption text-caption text-on-surface-variant">© 2024 Vocatio. All rights reserved.</div>
</div>
</footer>
</body></html>