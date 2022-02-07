-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-02-2022 a las 14:52:33
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

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

DROP TABLE IF EXISTS `bar`;
CREATE TABLE `bar` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `terraza` tinyint(1) NOT NULL DEFAULT 0,
  `latitud` float NOT NULL,
  `longitud` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bar`
--

INSERT INTO `bar` (`id`, `nombre`, `direccion`, `terraza`, `latitud`, `longitud`) VALUES
(1, 'Ángel', 'Calle del Laurel, 12, 26001 Logroño, La Rioja', 0, 42.4656, -2.44827),
(2, 'Afuego', 'C/ San Agustín, 29, 26001 Logroño, La Rioja', 1, 42.4658, -2.44935);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_bar`
--

DROP TABLE IF EXISTS `imagen_bar`;
CREATE TABLE `imagen_bar` (
  `id` int(11) NOT NULL,
  `id_bar` int(50) NOT NULL,
  `ruta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagen_bar`
--

INSERT INTO `imagen_bar` (`id`, `id_bar`, `ruta`) VALUES
(1, 1, 'view/img/bares/1/pincho6.jpg'),
(2, 1, 'view/img/bares/1/pincho9.jpg'),
(3, 2, 'view/img/bares/2/pincho7.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_pincho`
--

DROP TABLE IF EXISTS `imagen_pincho`;
CREATE TABLE `imagen_pincho` (
  `id` int(11) NOT NULL,
  `id_pincho` int(50) NOT NULL,
  `ruta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagen_pincho`
--

INSERT INTO `imagen_pincho` (`id`, `id_pincho`, `ruta`) VALUES
(1, 1, 'view/img/pinchos/1/pincho2.jpg'),
(2, 3, 'view/img/pinchos/3/pincho5.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `me_gusta`
--

DROP TABLE IF EXISTS `me_gusta`;
CREATE TABLE `me_gusta` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_valoracion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pincho`
--

DROP TABLE IF EXISTS `pincho`;
CREATE TABLE `pincho` (
  `id` int(11) NOT NULL,
  `id_bar` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pincho`
--

INSERT INTO `pincho` (`id`, `id_bar`, `nombre`, `descripcion`) VALUES
(1, 1, 'Champiñón a la plancha', 'Champiñón a la plancha con gamba y salsa de la casa.'),
(3, 2, 'Chuletilla de cordero', 'Preparadas a la brasa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `ruta_imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `admin`, `correo`, `clave`, `nombre`, `ruta_imagen`) VALUES
(1, 1, 'valentincastravete@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Valentín Castravete', ''),
(3, 0, 'test@test.com', '9afb0eabe1ebe3440fc1655a8e8551d9745289e7', 'test2', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion`
--

DROP TABLE IF EXISTS `valoracion`;
CREATE TABLE `valoracion` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_pincho` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `calificacion` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `valoracion`
--

INSERT INTO `valoracion` (`id`, `id_usuario`, `id_pincho`, `descripcion`, `calificacion`) VALUES
(3, 3, 3, 'Está buenísimo', 5),
(6, 3, 1, 'Está bueno', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bar`
--
ALTER TABLE `bar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagen_bar`
--
ALTER TABLE `imagen_bar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bar` (`id_bar`);

--
-- Indices de la tabla `imagen_pincho`
--
ALTER TABLE `imagen_pincho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pincho` (`id_pincho`);

--
-- Indices de la tabla `me_gusta`
--
ALTER TABLE `me_gusta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_valoracion` (`id_valoracion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `pincho`
--
ALTER TABLE `pincho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bar` (`id_bar`);

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
  ADD KEY `usuario_fk` (`id_usuario`),
  ADD KEY `id_pincho` (`id_pincho`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bar`
--
ALTER TABLE `bar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `imagen_bar`
--
ALTER TABLE `imagen_bar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `imagen_pincho`
--
ALTER TABLE `imagen_pincho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `me_gusta`
--
ALTER TABLE `me_gusta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pincho`
--
ALTER TABLE `pincho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagen_bar`
--
ALTER TABLE `imagen_bar`
  ADD CONSTRAINT `imagen_bar_ibfk_1` FOREIGN KEY (`id_bar`) REFERENCES `bar` (`id`);

--
-- Filtros para la tabla `imagen_pincho`
--
ALTER TABLE `imagen_pincho`
  ADD CONSTRAINT `imagen_pincho_ibfk_1` FOREIGN KEY (`id_pincho`) REFERENCES `pincho` (`id`);

--
-- Filtros para la tabla `me_gusta`
--
ALTER TABLE `me_gusta`
  ADD CONSTRAINT `me_gusta_ibfk_1` FOREIGN KEY (`id_valoracion`) REFERENCES `valoracion` (`id`),
  ADD CONSTRAINT `me_gusta_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pincho`
--
ALTER TABLE `pincho`
  ADD CONSTRAINT `pincho_ibfk_1` FOREIGN KEY (`id_bar`) REFERENCES `bar` (`id`);

--
-- Filtros para la tabla `valoracion`
--
ALTER TABLE `valoracion`
  ADD CONSTRAINT `usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `valoracion_ibfk_1` FOREIGN KEY (`id_pincho`) REFERENCES `pincho` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
