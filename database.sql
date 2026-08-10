create database vocatio;
use vocatio;

create table if not exists usuarios(
id int auto_increment primary key,
nombre varchar(250),
correo varchar(250),
contrasena varchar(250),
rol varchar(250),
token varchar(64),
token_expira datetime
);
-- ROL: ADMIN, USUARIO


insert into usuarios (nombre, correo, contrasena, rol) values ('Admin', 'admin@admin.com', '$2y$10$mHTsxtlyxSSy4s5ULRybEufBSP3bi2HDb8/2GfSJZvD4Hdj3nlWlC', 'ADMIN');
--contraseña : admin123


create table if not exists areas(
    area_id int auto_increment primary key,
    nombre varchar(50) not null,
    label varchar(100) not null,
    icono varchar(50) default 'explore',
    color varchar(30) default 'primary',
    descripcion text
);

create table if not exists preguntas(
    pregunta_id int auto_increment primary key,
    modulo varchar(50) not null,
    enunciado text not null,
    orden int not null default 0
);

create table if not exists opciones(
    opcion_id int auto_increment primary key,
    pregunta_id int not null,
    texto varchar(300) not null,
    area_id int not null,
    puntos int not null default 1,
    foreign key (pregunta_id) references preguntas(pregunta_id) on delete cascade,
    foreign key (area_id) references areas(area_id)
);

create table if not exists respuestas(
    respuesta_id int auto_increment primary key,
    usuario_id int not null,
    pregunta_id int not null,
    opcion_id int not null,
    fecha timestamp default current_timestamp,
    unique key uq_usuario_pregunta (usuario_id, pregunta_id),
    foreign key (usuario_id) references usuarios(id) on delete cascade,
    foreign key (pregunta_id) references preguntas(pregunta_id) on delete cascade,
    foreign key (opcion_id) references opciones(opcion_id)
);

-- Snapshot del resultado de cada intento del cuestionario (historial consultable)
create table if not exists resultados(
    resultado_id int auto_increment primary key,
    usuario_id int not null,
    area_principal_id int not null,
    area_principal_label varchar(100) not null,
    afinidad_principal int not null,
    carrera_id int null,
    carrera_nombre varchar(250) not null default '',
    desglose text, -- JSON: [{area_id, nombre, label, icono, color, puntos, porcentaje}]
    fecha timestamp default current_timestamp,
    foreign key (usuario_id) references usuarios(id) on delete cascade
);

-- Carreras asociadas a un área (1=Tech 2=Business 3=Education 4=Arts 5=Health)
create table if not exists carreras(
    id int auto_increment primary key,
    area_id int not null default 1,
    nombre varchar(250) not null,
    dificultad varchar(50) default 'Media',
    disponibilidad varchar(50) default 'Disponible',
    estado_id int not null default 1,
    imagen_url varchar(500) default '',
    descripcion text,
    duracion varchar(50) default '',
    salario varchar(100) default '',
    demanda varchar(50) default '',
    habilidades text,
    foreign key (area_id) references areas(area_id)
);
-- ESTADO_ID: 1 = Activo, 2 = Inactivo
-- HABILIDADES: texto en formato JSON (ej: '["Lógica de Programación"]')
-- Si la tabla carreras ya existía sin area_id (instalaciones previas):
-- alter table carreras add column area_id int not null default 1 after id;


-- ÁREAS
insert into areas (area_id, nombre, label, icono, color, descripcion) values
(1, 'Tech', 'Tecnología e Innovación', 'computer', 'primary', 'Muestras una fuerte inclinación hacia la resolución de problemas lógicos, el desarrollo de sistemas y la innovación digital. Carreras como Ingeniería de Software, Ciencia de Datos o Diseño UX podrían ser ideales para ti.'),
(2, 'Business', 'Liderazgo y Negocios', 'storefront', 'secondary', 'Tu perfil indica habilidades para la gestión, la organización y el emprendimiento. Carreras como Administración, Marketing o Finanzas resuenan con tu forma de pensar.'),
(3, 'Education', 'Educación y Formación', 'school', 'tertiary', 'Tienes afinidad por la enseñanza y la transmisión de conocimiento. Carreras como Educación, Pedagogía o Psicopedagogía pueden encajar contigo.'),
(4, 'Arts', 'Artes y Diseño', 'palette', 'error', 'Tu perfil tiene una fuerte conexión con la expresión creativa. Diseño Gráfico, Arquitectura, Artes Visuales o Comunicación Audiovisual son tu terreno.'),
(5, 'Health', 'Salud y Bienestar', 'favorite', 'info', 'Tu vocación se orienta al cuidado de las personas. Medicina, Enfermería, Psicología o Nutrición son caminos que conectan con tu perfil.');


-- PREGUNTAS (15 en total, 5 por módulo)
insert into preguntas (pregunta_id, modulo, enunciado, orden) values
(1,  'Intereses',   '¿Cómo prefieres resolver un problema complejo?', 1),
(2,  'Intereses',   '¿Qué actividad te resulta más atractiva en tu tiempo libre?', 2),
(3,  'Intereses',   '¿Qué tipo de contenido te llama más la atención?', 3),
(4,  'Intereses',   '¿Qué proyecto te gustaría emprender?', 4),
(5,  'Intereses',   'Si pudieras tomar un curso gratis, ¿cuál elegirías?', 5),
(6,  'Habilidades', '¿Qué se te da mejor casi sin esfuerzo?', 6),
(7,  'Habilidades', '¿Cuál de estas tareas haces con más facilidad?', 7),
(8,  'Habilidades', '¿Qué habilidad te gustaría perfeccionar?', 8),
(9,  'Habilidades', '¿Cuál es tu fortaleza más reconocida?', 9),
(10, 'Habilidades', '¿Qué harías primero en un trabajo por equipo?', 10),
(11, 'Valores',     '¿Qué valor rige más tus decisiones?', 11),
(12, 'Valores',     '¿Qué piensas del trabajo en equipo?', 12),
(13, 'Valores',     '¿Qué te parece más importante en un trabajo?', 13),
(14, 'Valores',     '¿Con qué frase estás más de acuerdo?', 14),
(15, 'Valores',     '¿Qué prefieres en un compañero de equipo?', 15);


-- OPCIONES (4 por pregunta, 12 por área). Áreas: 1=Tech 2=Business 3=Education 4=Arts 5=Health
insert into opciones (pregunta_id, texto, area_id, puntos) values
(1,  'Analizo los datos, busco patrones y estructuro un plan lógico.', 1, 1),
(1,  'Organizo un equipo y delego tareas para enfrentarlo juntos.', 2, 1),
(1,  'Lo explico en pasos claros a otros para entenderlo mejor.', 3, 1),
(1,  'Consulto a especialistas y evalúo el impacto en las personas.', 5, 1),
(2,  'Aprender sobre nuevas tecnologías o programar algo.', 1, 1),
(2,  'Organizar eventos, vender o liderar un grupo.', 2, 1),
(2,  'Dibujar, pintar, tocar un instrumento o escribir.', 4, 1),
(2,  'Hacer deporte, cuidar de alguien o hacer voluntariado.', 5, 1),
(3,  'Documentales de ciencia y tecnología.', 1, 1),
(3,  'Muestras de arte, cine o literatura.', 4, 1),
(3,  'Videos educativos y documentales de historia.', 3, 1),
(3,  'Contenido sobre salud, nutrición o bienestar.', 5, 1),
(4,  'Abrir un negocio o dirigir una empresa.', 2, 1),
(4,  'Crear una obra artística o montar una exposición.', 4, 1),
(4,  'Diseñar un curso o un programa educativo.', 3, 1),
(4,  'Un programa de salud comunitaria o prevención.', 5, 1),
(5,  'Programación y ciberseguridad.', 1, 1),
(5,  'Marketing y administración de empresas.', 2, 1),
(5,  'Historia del arte o diseño gráfico.', 4, 1),
(5,  'Pedagogía y técnicas de enseñanza.', 3, 1),
(6,  'Entender cómo funcionan las máquinas y los sistemas.', 1, 1),
(6,  'Negociar y convencer a otros.', 2, 1),
(6,  'Explicar ideas complejas de forma sencilla.', 3, 1),
(6,  'Percibir cuándo alguien no se siente bien.', 5, 1),
(7,  'Resolver problemas con lógica y números.', 1, 1),
(7,  'Organizar personas y recursos.', 2, 1),
(7,  'Imaginar y generar ideas nuevas.', 4, 1),
(7,  'Trabajar en equipo y apoyar a otros.', 5, 1),
(8,  'Programación o análisis de datos.', 1, 1),
(8,  'Comunicación visual o expresión artística.', 4, 1),
(8,  'Oratoria y capacidad de enseñar.', 3, 1),
(8,  'Primeros auxilios y cuidado de personas.', 5, 1),
(9,  'Tomar decisiones y dirigir.', 2, 1),
(9,  'Creatividad e imaginación.', 4, 1),
(9,  'Paciencia para enseñar una y otra vez.', 3, 1),
(9,  'Empatía y escucha activa.', 5, 1),
(10, 'Proponer la herramienta o el método técnico.', 1, 1),
(10, 'Definir los roles y los objetivos.', 2, 1),
(10, 'Proponer la idea o el concepto creativo.', 4, 1),
(10, 'Asegurarme de que todos entiendan la tarea.', 3, 1),
(11, 'La exactitud y el rigor técnico.', 1, 1),
(11, 'La eficiencia y la productividad.', 2, 1),
(11, 'El aprendizaje continuo.', 3, 1),
(11, 'La responsabilidad con los demás.', 5, 1),
(12, 'La mejor solución sale del mejor análisis.', 1, 1),
(12, 'La mejor solución sale de una buena organización.', 2, 1),
(12, 'La mejor solución sale de ideas distintas.', 4, 1),
(12, 'El equipo debe cuidarse como una familia.', 5, 1),
(13, 'Que funcione de manera correcta.', 1, 1),
(13, 'Que sea innovador y original.', 4, 1),
(13, 'Que deje un aprendizaje.', 3, 1),
(13, 'Que beneficie a las personas.', 5, 1),
(14, '"El que no arriesga, no gana".', 2, 1),
(14, '"La imaginación no tiene límites".', 4, 1),
(14, '"Enseñar es aprender dos veces".', 3, 1),
(14, '"Ayudar a otros es ayudarte a ti mismo".', 5, 1),
(15, 'Que sea técnicamente sólido.', 1, 1),
(15, 'Que sea cumplido y organizado.', 2, 1),
(15, 'Que aporte ideas distintas.', 4, 1),
(15, 'Que sepa explicar y compartir lo que sabe.', 3, 1);


-- CARRERAS (3 por área)
insert into carreras (area_id, nombre, dificultad, disponibilidad, estado_id, descripcion, duracion, salario, demanda, habilidades) values
(1, 'Ingeniería de Software', 'Alta', 'Disponible', 1, 'Diseña, desarrolla y mantén sistemas informáticos que impulsan el mundo digital.', '5 años', 'S/ 2,500 - S/ 4,500', 'Muy Alta', '["Lógica de Programación","Trabajo en equipo","Resolución de problemas"]'),
(1, 'Ciencia de Datos', 'Alta', 'Disponible', 1, 'Analiza grandes volúmenes de información para tomar decisiones basadas en datos.', '4 años', 'S/ 3,000 - S/ 5,000', 'Muy Alta', '["Estadística","Python / SQL","Pensamiento analítico"]'),
(1, 'Ciberseguridad', 'Alta', 'Disponible', 1, 'Protege sistemas y redes frente a amenazas y ataques digitales.', '5 años', 'S/ 2,800 - S/ 5,200', 'Muy Alta', '["Redes","Criptografía","Análisis de riesgos"]'),
(2, 'Administración de Empresas', 'Media', 'Disponible', 1, 'Lidera organizaciones, optimiza recursos y desarrolla estrategias de crecimiento.', '4 años', 'S/ 1,800 - S/ 3,500', 'Alta', '["Liderazgo","Finanzas","Planificación estratégica"]'),
(2, 'Marketing Digital', 'Media', 'Disponible', 1, 'Crea estrategias para conectar marcas con sus audiencias en el mundo digital.', '4 años', 'S/ 1,600 - S/ 3,000', 'Alta', '["Creatividad","Analítica web","Comunicación"]'),
(2, 'Contabilidad y Finanzas', 'Media', 'Disponible', 1, 'Gestiona la información económica y financiera de las organizaciones.', '5 años', 'S/ 1,700 - S/ 3,200', 'Alta', '["Precisión","Análisis numérico","Normativa tributaria"]'),
(3, 'Educación Primaria', 'Media', 'Disponible', 1, 'Forma a niños y niñas en sus primeros años de aprendizaje escolar.', '5 años', 'S/ 1,500 - S/ 2,800', 'Media', '["Paciencia","Didáctica","Empatía"]'),
(3, 'Pedagogía', 'Media', 'Disponible', 1, 'Diseña métodos y estrategias de enseñanza para distintos niveles educativos.', '5 años', 'S/ 1,600 - S/ 3,000', 'Media', '["Diseño curricular","Evaluación","Comunicación"]'),
(3, 'Psicopedagogía', 'Alta', 'Disponible', 1, 'Apoya el aprendizaje de personas con necesidades educativas especiales.', '5 años', 'S/ 1,800 - S/ 3,200', 'Media', '["Psicología del aprendizaje","Inclusión","Orientación"]'),
(4, 'Diseño Gráfico', 'Baja', 'Disponible', 1, 'Comunica ideas a través de medios visuales e identidades de marca.', '4 años', 'S/ 1,300 - S/ 2,600', 'Alta', '["Illustrator / Photoshop","Composición visual","Creatividad"]'),
(4, 'Arquitectura', 'Alta', 'Disponible', 1, 'Proyecta espacios y edificaciones que combinan estética, función y seguridad.', '6 años', 'S/ 2,000 - S/ 3,800', 'Media', '["Diseño espacial","AutoCAD / Revit","Gestión de proyectos"]'),
(4, 'Comunicación Audiovisual', 'Baja', 'Disponible', 1, 'Crea y produce contenido para cine, televisión y plataformas digitales.', '4 años', 'S/ 1,400 - S/ 2,800', 'Alta', '["Edición de video","Narrativa","Trabajo en equipo"]'),
(5, 'Medicina', 'Alta', 'Disponible', 1, 'Diagnostica, trata y previene enfermedades para cuidar la salud de las personas.', '7 años', 'S/ 3,500 - S/ 7,000', 'Muy Alta', '["Ciencias biológicas","Diagnóstico clínico","Vocación de servicio"]'),
(5, 'Enfermería', 'Media', 'Disponible', 1, 'Acompaña y brinda cuidados directos a pacientes en su proceso de salud.', '5 años', 'S/ 1,800 - S/ 3,200', 'Muy Alta', '["Cuidado del paciente","Trabajo en equipo","Empatía"]'),
(5, 'Psicología', 'Media', 'Disponible', 1, 'Estudia el comportamiento humano y acompaña la salud mental de las personas.', '5 años', 'S/ 1,700 - S/ 3,500', 'Alta', '["Escucha activa","Evaluación psicológica","Ética profesional"]');