create database vocatio;
use vocatio;

create table if not exists usuarios(
id int auto_increment primary key,
nombre varchar(250),
correo varchar(250),
contrasena varchar(250)
);