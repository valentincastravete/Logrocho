-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2021 a las 17:59:53
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
-- Base de datos: `dwes_pedidos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `CodCat` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`CodCat`, `Nombre`, `Descripcion`) VALUES
(1, 'Verduras', 'Todo tipo de veduras'),
(2, 'Frutas', 'Todo tipo de frutas'),
(3, 'Bebidas alcohólicas', 'Todo tipo de bebidas alcohólicas'),
(4, 'Bebidas sin alcohol', 'Todo tipo de bebidas sin alcohol'),
(5, 'Lácteos', 'Todo tipo de lácteos'),
(6, 'Quesos', 'Todo tipo de quesos'),
(7, 'Conservas', 'Todo tipo de conservas'),
(8, 'Congelados', 'Todo tipo de congelados'),
(9, 'Carnes', 'Todo tipo de carnes'),
(10, 'Pescados', 'Todo tipo de pescados'),
(11, 'Panes', 'Todo tipo de panes'),
(12, 'Dulces', 'Todo tipo de dulces');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `CodPed` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Enviado` tinyint(1) NOT NULL,
  `CodResFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`CodPed`, `Fecha`, `Enviado`, `CodResFK`) VALUES
(1, '2021-11-04', 1, 1),
(2, '2021-11-04', 1, 1),
(3, '2021-11-05', 1, 1),
(4, '2021-11-05', 1, 1),
(5, '2021-11-05', 1, 1),
(6, '2021-11-05', 1, 1),
(7, '2021-11-05', 1, 1),
(8, '2021-11-05', 1, 1),
(9, '2021-11-05', 1, 1),
(10, '2021-11-05', 1, 1),
(11, '2021-11-05', 1, 1),
(12, '2021-11-05', 1, 1),
(13, '2021-11-05', 1, 1),
(14, '2021-11-05', 1, 1),
(15, '2021-11-05', 1, 1),
(16, '2021-11-05', 1, 1),
(17, '2021-11-05', 1, 1),
(18, '2021-11-05', 1, 1),
(19, '2021-11-05', 1, 1),
(20, '2021-11-05', 1, 1),
(21, '2021-11-05', 1, 1),
(22, '2021-11-05', 1, 1),
(23, '2021-11-09', 1, 1),
(24, '2021-11-12', 1, 1),
(25, '2021-11-16', 1, 1),
(26, '2021-11-16', 1, 1),
(27, '2021-11-16', 1, 1),
(28, '2021-11-16', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidoproducto`
--

CREATE TABLE `pedidoproducto` (
  `ID` int(11) NOT NULL,
  `CodPed` int(11) NOT NULL,
  `CodProd` int(11) NOT NULL,
  `Unidades` int(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidoproducto`
--

INSERT INTO `pedidoproducto` (`ID`, `CodPed`, `CodProd`, `Unidades`) VALUES
(1, 1, 9, 10),
(2, 1, 13, 5),
(3, 1, 17, 1),
(4, 2, 1, 10),
(5, 2, 20, 1),
(6, 3, 4, 1),
(7, 4, 1, 1),
(8, 5, 7, 5),
(9, 6, 1, 1),
(10, 7, 1, 1),
(11, 8, 7, 1),
(12, 9, 1, 1),
(13, 10, 1, 5),
(14, 10, 9, 3),
(15, 11, 1, 1),
(16, 12, 10, 1),
(17, 13, 4, 1),
(18, 14, 1, 1),
(19, 15, 12, 1),
(20, 16, 12, 1),
(21, 17, 12, 1),
(22, 18, 10, 1),
(23, 19, 6, 5),
(24, 19, 7, 8),
(27, 22, 4, 5),
(28, 23, 7, 1),
(29, 23, 9, 1),
(30, 24, 4, 1),
(31, 25, 7, 1),
(32, 26, 1, 1),
(33, 27, 1, 1),
(34, 28, 7, 5),
(35, 28, 11, 3),
(36, 28, 8, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `CodProd` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `Peso` float NOT NULL,
  `Stock` int(10) NOT NULL,
  `CodCatFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`CodProd`, `Nombre`, `Descripcion`, `Peso`, `Stock`, `CodCatFK`) VALUES
(1, 'Pimiento verde', 'Prueba', 0.34, 5, 1),
(2, 'Zanahoria', 'Prueba', 0.28, 8, 1),
(3, 'Lechuga', 'Prueba', 0.23, 3, 1),
(4, 'Manzana', 'Prueba', 0.32, 1, 2),
(5, 'Plátano', 'Prueba', 0.45, 0, 2),
(6, 'Pera', 'Prueba', 0.4, 10, 2),
(7, 'Cerveza', 'Prueba', 1, 34, 3),
(8, 'Vino', 'Prueba', 0.75, 6, 3),
(9, 'Cerveza 0,0', 'Prueba', 0.33, 8, 4),
(10, 'Champin', 'Prueba', 1.25, 5, 4),
(11, 'Leche entera', 'Prueba', 6, 3, 5),
(12, 'Yogur natural', 'Prueba', 0.65, 2, 5),
(13, 'Queso tierno', 'Prueba', 0.5, 15, 6),
(14, 'Atún con tomate', 'Prueba', 0.25, 3, 6),
(15, 'Croquetas', 'Prueba', 0.5, 0, 7),
(16, 'Pizza Ristorante', 'Prueba', 0.6, 6, 7),
(17, 'Pollo entero', 'Prueba', 2, 8, 8),
(18, 'Lubina', 'Prueba', 0.4, 7, 10),
(19, 'Salmón', 'Prueba', 0.63, 7, 10),
(20, 'Tarta de chocolate', 'Prueba', 1.5, 17, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurante`
--

CREATE TABLE `restaurante` (
  `CodRes` int(11) NOT NULL,
  `Correo` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Clave` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Direccion` varchar(255) CHARACTER SET utf8 NOT NULL,
  `CP` int(5) NOT NULL,
  `Pais` varchar(2) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `restaurante`
--

INSERT INTO `restaurante` (`CodRes`, `Correo`, `Clave`, `Direccion`, `CP`, `Pais`) VALUES
(1, 'valentincastravete@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'Calle de prueba 55 5ºB', 26004, 'ES'),
(7, 'test@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'Test street', 26005, 'Es'),
(13, 'test2@test.com', '109f4b3c50d7b0df729d299bc6f8e9ef9066971f', 'Test address', 26001, 'Sp'),
(20, 'awdw@test.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', 0, ''),
(21, 'pepe@test.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', 0, ''),
(22, 'prueba@test.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ada', 123, 'ae');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`CodCat`),
  ADD UNIQUE KEY `UNIQUE` (`Nombre`) USING BTREE;

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`CodPed`);

--
-- Indices de la tabla `pedidoproducto`
--
ALTER TABLE `pedidoproducto`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UNIQUE_CodProd_CodPed` (`CodProd`,`CodPed`) USING BTREE,
  ADD KEY `CodPedFK` (`CodPed`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`CodProd`),
  ADD UNIQUE KEY `UNIQUE_Nombre` (`Nombre`);

--
-- Indices de la tabla `restaurante`
--
ALTER TABLE `restaurante`
  ADD PRIMARY KEY (`CodRes`),
  ADD UNIQUE KEY `UNIQUE` (`Correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `CodCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `CodPed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `pedidoproducto`
--
ALTER TABLE `pedidoproducto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `CodProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `restaurante`
--
ALTER TABLE `restaurante`
  MODIFY `CodRes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `CodResFK` FOREIGN KEY (`CodResFK`) REFERENCES `restaurante` (`CodRes`);

--
-- Filtros para la tabla `pedidoproducto`
--
ALTER TABLE `pedidoproducto`
  ADD CONSTRAINT `CodPedFK` FOREIGN KEY (`CodPed`) REFERENCES `pedido` (`CodPed`),
  ADD CONSTRAINT `CodProdFK` FOREIGN KEY (`CodProd`) REFERENCES `producto` (`CodProd`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `CodCatFK` FOREIGN KEY (`CodCatFK`) REFERENCES `categoria` (`CodCat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
