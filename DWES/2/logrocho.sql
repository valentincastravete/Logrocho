-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-01-2022 a las 17:32:04
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `logrocho`
--
CREATE DATABASE IF NOT EXISTS `logrocho` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `logrocho`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bar`
--

CREATE TABLE `bar` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `localizacion` varchar(20) NOT NULL,
  `id_valoracion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bar_pincho`
--

CREATE TABLE `bar_pincho` (
  `id_bar` int(11) NOT NULL,
  `id_pincho` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pincho`
--

CREATE TABLE `pincho` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_valoracion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `admin`, `correo`, `password`, `nombre`) VALUES
(1, 1, 'valentincastravete@gmail.ccom', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Valentín Castravete');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion`
--

CREATE TABLE `valoracion` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `calificacion` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bar`
--
ALTER TABLE `bar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `valoracion` (`id_valoracion`);

--
-- Indices de la tabla `bar_pincho`
--
ALTER TABLE `bar_pincho`
  ADD PRIMARY KEY (`id_bar`,`id_pincho`),
  ADD KEY `id_pincho` (`id_pincho`);

--
-- Indices de la tabla `pincho`
--
ALTER TABLE `pincho`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `valoracion` (`id_valoracion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_fk` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bar`
--
ALTER TABLE `bar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pincho`
--
ALTER TABLE `pincho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bar_pincho`
--
ALTER TABLE `bar_pincho`
  ADD CONSTRAINT `bar_pincho_ibfk_1` FOREIGN KEY (`id_pincho`) REFERENCES `pincho` (`id`),
  ADD CONSTRAINT `bar_pincho_ibfk_2` FOREIGN KEY (`id_bar`) REFERENCES `bar` (`id`);

--
-- Filtros para la tabla `pincho`
--
ALTER TABLE `pincho`
  ADD CONSTRAINT `valoracion_pincho` FOREIGN KEY (`id_valoracion`) REFERENCES `valoracion` (`id`);

--
-- Filtros para la tabla `valoracion`
--
ALTER TABLE `valoracion`
  ADD CONSTRAINT `usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
