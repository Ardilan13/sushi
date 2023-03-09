-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-03-2023 a las 21:01:12
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sushi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(100) NOT NULL,
  `id_producto` int(100) NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` double(11,1) NOT NULL,
  `precio` double(50,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `id_producto`, `fecha`, `cantidad`, `precio`) VALUES
(2, 1, '2023-02-14', 2.0, 25000.00),
(3, 2, '2023-02-15', 5.0, 1500.00),
(4, 2, '2023-02-15', 200.0, 550.00),
(5, 3, '2023-02-15', 100.0, 1200.00),
(6, 1, '2023-02-15', 15.0, 140000.00),
(7, 3, '2023-02-15', 14222.3, 25000.00),
(8, 3, '2023-02-16', 14.5, 25400.32),
(10, 1, '2023-02-16', 5.0, 1.00),
(11, 1, '2023-02-16', 14.0, 0.50),
(12, 1, '2023-02-15', 12.0, 2.00),
(13, 1, '2023-02-25', 22.0, 1.00),
(14, 1, '2023-02-27', 12.0, 0.03),
(15, 1, '2023-02-27', 10.0, 2.00),
(16, 1, '2023-02-27', 82.0, 3.00),
(17, 1, '2023-02-27', 65.0, 1.00),
(18, 1, '2023-03-09', 12.0, 0.50),
(19, 1, '2023-03-09', 11.0, 2.00),
(20, 1, '2023-03-09', 10.0, 2.00),
(21, 1, '2023-03-09', 10.0, 2.00),
(22, 1, '2023-03-09', 10.0, 2.00),
(23, 1, '2023-03-09', 1.0, 2.00),
(24, 1, '2023-03-09', 1.0, 2.00),
(25, 1, '2023-03-09', 1.0, 2.00),
(26, 1, '2023-03-09', 1.0, 2.00),
(27, 1, '2023-03-09', 2.0, 2.00),
(28, 1, '2023-03-09', 2.0, 2.00),
(29, 1, '2023-03-09', 1.0, 2.00),
(30, 1, '2023-03-09', 1.0, 2.00),
(31, 1, '2023-03-09', 2.0, 2.00),
(32, 1, '2023-03-09', 2.0, 2.00),
(33, 1, '2023-03-09', 12.0, 3.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `id` int(100) NOT NULL,
  `id_preparacion` int(100) NOT NULL,
  `id_diario` int(100) NOT NULL,
  `cantidad` double(11,2) NOT NULL,
  `valor` double(50,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diario`
--

CREATE TABLE `diario` (
  `id` int(100) NOT NULL,
  `fecha` date NOT NULL,
  `valor` double(50,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

CREATE TABLE `ingredientes` (
  `id` int(100) NOT NULL,
  `id_preparacion` int(100) NOT NULL,
  `id_producto` int(100) NOT NULL,
  `cantidad` int(100) NOT NULL,
  `valor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`id`, `id_preparacion`, `id_producto`, `cantidad`, `valor`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 2, 100, 15000200),
(3, 1, 5, 12, 48),
(4, 1, 6, 1, 1),
(5, 2, 1, 10, 20),
(6, 2, 5, 5, 20),
(7, 3, 1, 120, 240),
(8, 1, 3, 2, 50800),
(9, 4, 2, 200, 30000400),
(10, 7, 2, 0, 15000.2),
(11, 6, 13, 1, 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` int(100) NOT NULL,
  `id_producto` int(100) NOT NULL,
  `tipo` int(2) NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` double(10,2) NOT NULL,
  `motivo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `id_producto`, `tipo`, `fecha`, `cantidad`, `motivo`) VALUES
(1, 5, 0, '2023-02-15', 40.00, 'asfsgdfghf'),
(2, 1, 0, '2023-02-16', 5.00, '1'),
(3, 5, 0, '2023-02-16', 100.00, 'siiii'),
(4, 5, 1, '2023-02-16', 53.00, 'xd'),
(5, 5, 0, '2023-02-15', 20.00, '111'),
(6, 2, 0, '2023-02-15', 999.00, 'hola'),
(7, 2, 0, '2023-02-15', 123123.00, '1'),
(8, 1, 1, '2023-02-15', 61.30, 'siiii'),
(9, 5, 1, '2023-02-15', 1.00, '1'),
(10, 1, 0, '2023-02-27', 25.00, 'Jsjd'),
(11, 2, 0, '2023-02-27', 2555.00, 'm,k'),
(12, 1, 0, '2023-02-27', 58.00, 'OBSEQUIO'),
(13, 3, 1, '2023-02-27', 5.00, 'dañado cocina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preparaciones`
--

CREATE TABLE `preparaciones` (
  `id` int(10) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `tipo` int(2) NOT NULL,
  `unidad` int(2) NOT NULL,
  `cantidad` float(50,2) DEFAULT NULL,
  `valor` float(50,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `preparaciones`
--

INSERT INTO `preparaciones` (`id`, `nombre`, `tipo`, `unidad`, `cantidad`, `valor`) VALUES
(1, 'prueba', 1, 0, NULL, 15051000.00),
(2, 'prueba', 1, 0, NULL, 40.00),
(3, 'prueba', 1, 0, NULL, 240.00),
(4, 'preparacion', 1, 0, NULL, 30000400.00),
(5, 'hola', 1, 1, NULL, NULL),
(6, 'asda', 2, 2, NULL, 35.00),
(7, 'bolsa de arroz 1 kg', 1, 1, NULL, 15000.20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(100) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `status` int(2) DEFAULT NULL,
  `tipo` int(2) NOT NULL,
  `proveedor` text DEFAULT NULL,
  `unidad` int(2) NOT NULL,
  `merma` int(4) NOT NULL DEFAULT 0,
  `cantidad` double(11,2) NOT NULL,
  `precio` double(50,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `status`, `tipo`, `proveedor`, `unidad`, `merma`, `cantidad`, `precio`) VALUES
(1, 'arroz_123', 1, 3, 'a', 2, 1, 39.00, 3.00),
(2, 'cxarne', 0, 4, '1', 2, 0, 126716.00, 150002.00),
(3, 'b', NULL, 2, 'a', 3, 1, 11.00, 25400.00),
(5, 'arroz', NULL, 1, 'a', 1, 0, 20.00, 4.00),
(6, 'prueba', NULL, 1, '1', 1, 0, 1.00, 1.00),
(7, 'prueba', NULL, 2, '', 1, 0, 12.00, 0.00),
(8, 'dilan11', NULL, 1, '', 1, 0, 2.00, 0.00),
(9, 'dilan112', NULL, 1, '', 1, 0, 0.00, 0.00),
(10, 'prueba', NULL, 1, '', 1, 0, 12.00, 0.00),
(11, 'juan', NULL, 2, '', 1, 0, 12.00, 0.00),
(12, 'hola', NULL, 1, '', 1, 0, 100.00, 0.00),
(13, 'prueba', NULL, 1, '', 1, 0, 12.00, 0.00),
(14, 'prueba', NULL, 2, '', 1, 0, 12.00, 0.00),
(15, 'juan', NULL, 1, '', 1, 0, 0.00, 0.00),
(16, 'prueba', NULL, 1, NULL, 1, 0, 35.00, NULL),
(17, 'produccion', NULL, 6, NULL, 3, 0, 10.00, NULL),
(18, 'prueba', NULL, 2, NULL, 1, 0, 12.00, NULL),
(19, 'bolsa de arroz 1 kg', NULL, 1, NULL, 3, 0, 1.00, NULL),
(20, 'jfnajnkdanj', NULL, 2, NULL, 2, 0, 11.00, NULL),
(21, 'dilan', NULL, 2, NULL, 1, 0, 10.00, NULL),
(22, 'dilan', NULL, 1, NULL, 1, 0, 100.00, NULL),
(23, 'dilan', NULL, 4, NULL, 2, 0, 250.00, NULL),
(24, 'nfdesjewksd', NULL, 1, NULL, 3, 0, 10.00, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_comprado` (`id_producto`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuentas_diarias` (`id_diario`),
  ADD KEY `preparaciones_diarias` (`id_preparacion`);

--
-- Indices de la tabla `diario`
--
ALTER TABLE `diario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_preparacion` (`id_producto`),
  ADD KEY `preparacion` (`id_preparacion`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_movimiento` (`id_producto`);

--
-- Indices de la tabla `preparaciones`
--
ALTER TABLE `preparaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `diario`
--
ALTER TABLE `diario`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `preparaciones`
--
ALTER TABLE `preparaciones`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `producto_comprado` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD CONSTRAINT `cuentas_diarias` FOREIGN KEY (`id_diario`) REFERENCES `diario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `preparaciones_diarias` FOREIGN KEY (`id_preparacion`) REFERENCES `preparaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD CONSTRAINT `preparacion` FOREIGN KEY (`id_preparacion`) REFERENCES `preparaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_preparacion` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `producto_movimiento` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
