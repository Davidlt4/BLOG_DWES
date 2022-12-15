CREATE DATABASE IF NOT EXISTS blog;
USE blog;
SET NAMES UTF8;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-12-2022 a las 15:54:47
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `blog`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'personajes'),
(5, 'builds'),
(6, 'enemigos'),
(9, 'cofres'),
(11, 'regiones'),
(12, 'hola'),
(13, 'armas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id` int(255) NOT NULL,
  `usuario_id` int(255) NOT NULL,
  `categoria_id` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id`, `usuario_id`, `categoria_id`, `titulo`, `descripcion`, `fecha`) VALUES
(2, 10, 1, 'Xiao', 'Es el mejor personaje', '2022-12-11'),
(3, 9, 5, 'Build Zhongli', 'Estos son los mejores artefactos para él:\r\nflor y caliz.', '2022-12-13'),
(25, 9, 6, 'Hilichurl', 'Enemigo básico', '2022-12-13'),
(27, 7, 9, 'En liyue', 'aqui', '2022-12-13'),
(33, 15, 1, 'Ganyu', 'Personaje de tipo cryo con arco', '2022-12-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` int(50) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `rol`, `fecha`) VALUES
(4, 'Alejandro', 'Ruiz', 'alex@gmail.com', '$2y$04$5BPm89.KMA2VfdHt8K7MDu/ebp0KAwsKKy6LmPwaXqSEA13icbjGq', 2, '2022-12-09'),
(7, 'David', 'admin', 'd@gmail.com', '$2y$04$fAv5opm6CtBhHb1FayLoGO.3QQ3IBpByls.0PI5h/B2J3oYmsq0WS', 1, '2022-12-09'),
(9, 'a', 'a', 'a@gmail.com', '$2y$04$YpUS9aQXC.rKibzLKpKO6uvfDQ1VGo.13/uw2/spOYWFVEXPb8mDi', 2, '2022-12-10'),
(10, 'c', 'c', 'c@gmail.com', '$2y$04$K/nh1TXM4wKq9eU4frZu7uRweWKwHXQy9db/e4hWcyXuzYQMwl3ru', 2, '2022-12-10'),
(11, 'ana', 'a', 'belen@gmail.com', '$2y$04$XqhHOTHLvAfaGVkwABjew.OOYN9cvlajFPqDfwVVqWHcVVDUJzCBW', 2, '2022-12-13'),
(12, 'Niu', 'no', 'n@gmail.com', '$2y$04$sK8GWvededilFiTKf0CK6.bWZFbXfq6UlLy4SjV7LJAorjYUYbe4K', 2, '2022-12-14'),
(13, 'Gra', 'gra', 'gra@gmail.com', '$2y$04$fQ4IptVV8.C.ZyS7f4FoXu7XpJLA8D4fFxwvLSM3GlMG2IJCaN/MS', 2, '2022-12-14'),
(14, 'admin', 'admin', 'admin@gmail.com', '$2y$04$Y34oolobN3mAGu6em7RFF.38Ehwoh48g1Igl39ECPpzYj887XvM76', 1, '2022-12-15'),
(15, 'Juan', 'Perico', 'juan@gmail.com', '$2y$04$JrhM0JscQYUOyyvcKMR0gupX1Unpng987e9.10u/jtHHN.zTNmo3K', 2, '2022-12-15');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `entradas_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

