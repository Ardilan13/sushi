-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-03-2023 a las 05:48:43
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
(2, 1, '2023-03-23', 1000.0, 1200.00),
(3, 1, '2023-03-23', 1000.0, 2000.00),
(4, 1, '2023-03-22', 1000.0, 1500.00),
(5, 1, '2023-03-23', 1100.0, 1100.00),
(6, 1, '2023-03-23', 100.0, 1000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `id` int(100) NOT NULL,
  `tipo` int(1) NOT NULL,
  `id_preparacion` int(100) NOT NULL,
  `id_diario` int(100) NOT NULL,
  `cantidad` double(11,2) NOT NULL,
  `valor` double(50,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`id`, `tipo`, `id_preparacion`, `id_diario`, `cantidad`, `valor`) VALUES
(1, 0, 1, 1, 1000.00, 100.00),
(2, 0, 1, 2, 150.00, 1200.00),
(3, 0, 1, 2, 10.00, 1000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diario`
--

CREATE TABLE `diario` (
  `id` int(100) NOT NULL,
  `fecha` date NOT NULL,
  `valor` double(50,2) NOT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `diario`
--

INSERT INTO `diario` (`id`, `fecha`, `valor`, `status`) VALUES
(1, '2023-03-23', 100.00, 1),
(2, '2023-03-24', 11200.00, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

CREATE TABLE `ingredientes` (
  `id` int(100) NOT NULL,
  `tipo` int(1) NOT NULL,
  `id_preparacion` int(100) NOT NULL,
  `id_producto` int(100) NOT NULL,
  `cantidad` int(100) NOT NULL,
  `valor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`id`, `tipo`, `id_preparacion`, `id_producto`, `cantidad`, `valor`) VALUES
(1, 0, 1, 1, 10, 100),
(2, 0, 1, 1, 5, 1000),
(3, 0, 3, 1, 5, 100),
(4, 0, 3, 3, 1, 500),
(5, 0, 2, 4, 5, 100);

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
(1, 1, 1, '2023-03-23', 100.00, 'asd'),
(2, 1, 1, '2023-03-23', 3010.00, 'asda');

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
(1, 'prueba_sushi', 1, 1, NULL, 6000.00),
(2, 'prueba', 2, 1, NULL, 500.00),
(3, 'dilan', 1, 1, NULL, 1000.00),
(4, 'dilan', 2, 2, NULL, NULL),
(5, 'prueba12345', 1, 3, NULL, NULL),
(6, 'SISTEMAS DIGITALES123456', 2, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(100) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `status` int(2) DEFAULT NULL,
  `tipo` int(2) DEFAULT NULL,
  `proveedor` text DEFAULT NULL,
  `unidad` int(2) NOT NULL,
  `merma` int(4) DEFAULT 0,
  `cantidad` double(11,2) NOT NULL,
  `precio` double(50,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `status`, `tipo`, `proveedor`, `unidad`, `merma`, `cantidad`, `precio`) VALUES
(1, 'prueba', 0, 1, 'si', 1, 0, 50.00, 1000.00),
(3, 'prueba_sushi', NULL, 0, NULL, 1, 0, 0.00, 6000.00),
(4, 'dilan', NULL, 0, NULL, 1, 0, 15.00, 1000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `nombre`) VALUES
(1, 'prueba');

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
  ADD KEY `cuentas_diarias` (`id_diario`);

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
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `diario`
--
ALTER TABLE `diario`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `preparaciones`
--
ALTER TABLE `preparaciones`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `cuentas_diarias` FOREIGN KEY (`id_diario`) REFERENCES `diario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD CONSTRAINT `preparacion` FOREIGN KEY (`id_preparacion`) REFERENCES `preparaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `producto_movimiento` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
