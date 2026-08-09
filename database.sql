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


insert into ususarios () values ('Admin', 'admin@admin.com', '$2y$10$mHTsxtlyxSSy4s5ULRybEufBSP3bi2HDb8/2GfSJZvD4Hdj3nlWlC')
--contraseña : admin123
