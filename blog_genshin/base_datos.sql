CREATE DATABASE IF NOT EXISTS blog;
USE blog;
SET NAMES UTF8;

DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios(
  id            int(255) auto_increment not null primary key,
  nombre        varchar(100) not null,
  apellidos       varchar(100) not null,
  email         varchar(255) not null,
  password      varchar(255) not null,
  rol           int(50) not null,
  fecha         date not null
);

DROP TABLE IF EXISTS categorias;
CREATE TABLE categorias(
  id            int(255) auto_increment not null primary key,
  nombre        varchar(100)
);

DROP TABLE IF EXISTS entradas;
CREATE TABLE entradas(
  id            int(255) auto_increment not null primary key,
  usuario_id    int(255) not null,
  categoria_id  int(255) not null,
  titulo        varchar(255) not null,
  descripcion   varchar(255),
  fecha         date not null,
  FOREIGN KEY(usuario_id) REFERENCES usuarios(id),
  FOREIGN KEY(categoria_id) REFERENCES categorias(id)
);
