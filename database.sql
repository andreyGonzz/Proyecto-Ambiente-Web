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


create table if not exists carreras(
    id int auto_increment primary key,
    nombre varchar(250) not null,
    dificultad varchar(50) default 'Media',
    disponibilidad varchar(50) default 'Disponible',
    estado_id int not null default 1,
    imagen_url varchar(500) default '',
    descripcion text,
    duracion varchar(50) default '',
    salario varchar(100) default '',
    demanda varchar(50) default '',
    habilidades text
);
-- ESTADO_ID: 1 = Activo, 2 = Inactivo
-- HABILIDADES: texto en formato JSON (ej: '["Lógica de Programación"]')

-- Si la tabla carreras ya existía (instalaciones previas), ejecuta:
alter table carreras
    add column descripcion text after imagen_url,
    add column duracion varchar(50) default '' after descripcion,
    add column salario varchar(100) default '' after duracion,
    add column demanda varchar(50) default '' after salario,
    add column habilidades text after demanda;