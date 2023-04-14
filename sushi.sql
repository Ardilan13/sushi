-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-04-2023 a las 03:41:00
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
  `cantidad` double(11,3) NOT NULL,
  `precio` double(50,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `id_producto`, `fecha`, `cantidad`, `precio`) VALUES
(2, 1, '2023-03-23', 1000.000, 1200.000),
(3, 1, '2023-03-23', 1000.000, 2000.000),
(4, 1, '2023-03-22', 1000.000, 1500.000),
(5, 1, '2023-03-23', 1100.000, 1100.000),
(6, 1, '2023-03-23', 100.000, 1000.000),
(7, 3, '2023-03-29', 100.000, 1000.000),
(8, 3, '2023-04-03', 25.000, 12121.000),
(9, 1, '2023-04-09', 150.000, 1231.000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `id` int(100) NOT NULL,
  `tipo` int(1) NOT NULL,
  `id_preparacion` int(100) NOT NULL,
  `id_diario` int(100) NOT NULL,
  `cantidad` double(11,3) NOT NULL,
  `valor` double(50,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`id`, `tipo`, `id_preparacion`, `id_diario`, `cantidad`, `valor`) VALUES
(1, 0, 1, 1, 1000.000, 100.000),
(2, 0, 1, 2, 150.000, 1200.000),
(3, 0, 1, 2, 10.000, 1000.000),
(4, 0, 1, 2, 10.000, 120.000),
(5, 0, 3, 3, 10.000, 1120.000),
(6, 1, 7, 3, 50.000, 1050.000),
(7, 1, 7, 4, 10.000, 1111.000),
(8, 1, 7, 4, 20.000, 1250.000),
(9, 1, 6, 5, 12.000, 123123.000),
(10, 1, 6, 6, 10.000, 111.000),
(11, 1, 6, 7, 10.000, 12.000),
(12, 1, 2, 8, 2.000, 121.000),
(13, 1, 2, 9, 2.000, 12.000),
(14, 1, 6, 10, 12.000, 1234.000),
(15, 1, 4, 11, 12.000, 1213.000),
(16, 1, 4, 12, 12.000, 120.000),
(17, 1, 4, 13, 23.000, 12312.000),
(18, 1, 4, 14, 123.000, 1231.000),
(19, 1, 7, 15, 20.000, 1111.000),
(20, 0, 3, 15, 10.000, 1212.000),
(23, 1, 8, 16, 15.000, 121.000),
(26, 0, 5, 16, 10.000, 121.000),
(27, 1, 8, 17, 15.000, 121.000),
(28, 0, 1, 18, 30.000, 12341.000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diario`
--

CREATE TABLE `diario` (
  `id` int(100) NOT NULL,
  `fecha` date NOT NULL,
  `valor` double(50,3) NOT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `diario`
--

INSERT INTO `diario` (`id`, `fecha`, `valor`, `status`) VALUES
(1, '2023-03-23', 100.000, 1),
(2, '2023-03-24', 12400.000, 1),
(3, '2023-03-29', 63700.000, 1),
(4, '2023-03-30', 36110.000, 1),
(5, '2023-03-30', 1477476.000, 1),
(6, '2023-03-29', 1110.000, 1),
(7, '2023-03-30', 120.000, 1),
(8, '2023-03-31', 242.000, 1),
(9, '2023-03-30', 24.000, 1),
(10, '2023-03-31', 14808.000, 1),
(11, '2023-03-31', 14556.000, 1),
(12, '2023-03-15', 1440.000, 1),
(13, '2023-03-01', 283176.000, 1),
(14, '2023-03-17', 151413.000, 1),
(15, '2023-04-06', 34340.000, 1),
(16, '2023-04-03', 2484520.000, NULL),
(17, '2023-04-03', 1815.000, NULL),
(18, '2023-04-04', 370230.000, NULL);

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
  `valor` float(50,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`id`, `tipo`, `id_preparacion`, `id_producto`, `cantidad`, `valor`) VALUES
(1, 0, 1, 1, 10, 100.000),
(2, 0, 1, 1, 5, 1000.000),
(5, 0, 2, 4, 5, 100.000),
(6, 0, 7, 3, 1, 1100.000),
(7, 0, 6, 4, 2, 1200.000),
(8, 0, 4, 4, 10, 121.000),
(9, 0, 8, 5, 1, 1100.000),
(10, 0, 8, 1, 2, 1212.000),
(11, 0, 8, 3, 1, 1121211.000),
(15, 0, 9, 4, 2, 121.000),
(16, 0, 10, 3, 10, 1000.000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` int(100) NOT NULL,
  `id_producto` int(100) NOT NULL,
  `tipo` int(2) NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` double(10,3) NOT NULL,
  `motivo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `id_producto`, `tipo`, `fecha`, `cantidad`, `motivo`) VALUES
(17, 12, 1, '2023-02-15', 12.000, 'safsdf'),
(18, 7, 7, '2023-04-06', 20.000, ''),
(19, 1, 3, '2023-04-05', 1.000, ''),
(20, 1, 3, '2023-04-05', 1.000, ''),
(21, 3, 3, '2023-04-05', 1.000, ''),
(22, 3, 3, '2023-04-05', 1.000, ''),
(23, 5, 3, '2023-04-05', 1.000, ''),
(24, 5, 3, '2023-04-05', 1.000, ''),
(25, 7, 2, '2023-04-05', 10.000, ''),
(26, 7, 2, '2023-04-05', 10.000, ''),
(27, 1, 3, '2023-04-05', 4.000, ''),
(28, 1, 3, '2023-04-05', 4.000, ''),
(29, 3, 3, '2023-04-05', 4.000, ''),
(30, 3, 3, '2023-04-05', 4.000, ''),
(31, 5, 3, '2023-04-05', 4.000, ''),
(32, 5, 3, '2023-04-05', 4.000, ''),
(33, 8, 2, '2023-04-05', 4.000, ''),
(34, 8, 2, '2023-04-05', 4.000, ''),
(35, 5, 3, '2023-04-05', 5.000, ''),
(36, 5, 3, '2023-04-05', 5.000, ''),
(37, 3, 3, '2023-04-05', 5.000, ''),
(38, 3, 3, '2023-04-05', 5.000, ''),
(39, 1, 3, '2023-04-05', 5.000, ''),
(40, 1, 3, '2023-04-05', 5.000, ''),
(41, 8, 2, '2023-04-05', 5.000, ''),
(42, 8, 2, '2023-04-05', 5.000, ''),
(43, 5, 3, '2023-04-05', 10.000, ''),
(44, 5, 3, '2023-04-05', 10.000, ''),
(45, 3, 3, '2023-04-05', 10.000, ''),
(46, 3, 3, '2023-04-05', 10.000, ''),
(47, 1, 3, '2023-04-05', 10.000, ''),
(48, 1, 3, '2023-04-05', 10.000, ''),
(49, 10, 2, '2023-04-05', 10.000, ''),
(50, 10, 2, '2023-04-05', 10.000, ''),
(51, 5, 3, '2023-04-05', 10.000, ''),
(52, 3, 3, '2023-04-05', 10.000, ''),
(53, 1, 3, '2023-04-05', 10.000, ''),
(54, 11, 2, '2023-04-05', 10.000, ''),
(55, 5, 3, '2023-04-05', 10.000, ''),
(56, 3, 3, '2023-04-05', 10.000, ''),
(57, 1, 3, '2023-04-05', 10.000, ''),
(58, 11, 2, '2023-04-05', 10.000, ''),
(59, 5, 3, '2023-04-05', 25.000, ''),
(60, 3, 3, '2023-04-05', 25.000, ''),
(61, 1, 3, '2023-04-05', 25.000, ''),
(62, 11, 2, '2023-04-05', 25.000, ''),
(63, 5, 3, '2023-04-20', 20.000, ''),
(64, 3, 3, '2023-04-20', 20.000, ''),
(65, 1, 3, '2023-04-20', 20.000, ''),
(66, 11, 2, '2023-04-20', 20.000, ''),
(67, 1, 3, '2023-04-08', 100.000, ''),
(68, 1, 3, '2023-04-08', 50.000, ''),
(69, 3, 2, '2023-04-08', 10.000, ''),
(70, 1, 3, '2023-04-14', 5000.000, ''),
(71, 1, 3, '2023-04-14', 2500.000, ''),
(72, 3, 2, '2023-04-14', 500.000, ''),
(73, 3, 3, '0000-00-00', 100.000, ''),
(74, 12, 2, '0000-00-00', 10.000, ''),
(75, 3, 3, '0000-00-00', 1000.000, ''),
(76, 13, 2, '0000-00-00', 100.000, ''),
(77, 3, 3, '2023-04-13', 1000.000, ''),
(78, 13, 2, '2023-04-13', 100.000, ''),
(79, 3, 3, '2023-04-22', 100000.000, ''),
(80, 13, 2, '2023-04-22', 10000.000, ''),
(81, 14, 6, '2023-04-13', 12.000, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preparaciones`
--

CREATE TABLE `preparaciones` (
  `id` int(10) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `tipo` int(2) NOT NULL,
  `unidad` int(2) NOT NULL,
  `cantidad` float(50,3) DEFAULT NULL,
  `valor` float(50,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `preparaciones`
--

INSERT INTO `preparaciones` (`id`, `nombre`, `tipo`, `unidad`, `cantidad`, `valor`) VALUES
(1, 'prueba_sushi', 1, 1, NULL, 6000.000),
(2, 'prueba', 2, 1, NULL, 500.000),
(4, 'dilan', 2, 2, NULL, 1210.000),
(6, 'SISTEMAS DIGITALES123456', 2, 3, NULL, 2400.000),
(7, 'hola123', 2, 3, NULL, 1100.000),
(8, 'inicial', 2, 1, NULL, 1124735.000),
(9, 'holasiii', 2, 2, NULL, 242.000),
(10, 'prueba_precio', 1, 3, NULL, 10000.000);

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
  `cantidad` double(11,3) NOT NULL,
  `precio` double(50,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `status`, `tipo`, `proveedor`, `unidad`, `merma`, `cantidad`, `precio`) VALUES
(1, 'prueba', 1, 1, 'si', 1, 0, -2605.000, 2155.000),
(3, 'prueba_sushi', 1, 0, NULL, 1, 0, -101650.000, -1589.470),
(4, 'dilan', NULL, 0, NULL, 1, 0, -1798.000, 1000.000),
(5, 'inicial', NULL, 1, 'tokio', 1, 0, -70.000, 1200.000),
(8, 'prueba12345', NULL, 0, NULL, 3, 0, 18.000, 14756.000),
(11, 'pruebadilan', NULL, 0, NULL, 3, 0, 65.000, 14756.000),
(13, 'prueba_precio', NULL, 0, NULL, 3, 0, 10200.000, 2.940),
(14, 'tienen_que_pagarme', NULL, 1, 'asd', 1, 1, 12.000, 123421.000);

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
  ADD KEY `gjghjh` (`id_producto`);

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `diario`
--
ALTER TABLE `diario`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `preparaciones`
--
ALTER TABLE `preparaciones`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
