-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-08-2023 a las 04:27:09
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturaciones`
--

CREATE TABLE `facturaciones` (
  `cedula` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `valor` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `numero` int(11) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `valor_diario` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`numero`, `tipo`, `estado`, `descripcion`, `valor_diario`) VALUES
(1, 'Individual', 0, 'asdfvg', 45000),
(2, 'Doble', 0, 'sdfg', 70000),
(3, 'Suite', 1, 'rtbyyw', 150000),
(4, 'Individual', 0, 'qqqqqqqqqqq', 60000),
(5, 'Doble', 0, 'lctm', 50000),
(6, 'Suite', 0, 'aÃ±Ã±aaÃ±y', 150000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `huespedes`
--

CREATE TABLE `huespedes` (
  `cedula` int(11) NOT NULL,
  `ticket` int(11) NOT NULL,
  `dias_reservados` int(11) NOT NULL,
  `habitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `cedula` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `habitacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuarios`
--

CREATE TABLE `tipousuarios` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipousuarios`
--

INSERT INTO `tipousuarios` (`id`, `tipo`) VALUES
(0, 'administrador'),
(1, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cedula` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellido` varchar(15) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `pais` varchar(15) NOT NULL,
  `departamento` varchar(15) NOT NULL,
  `ciudad` varchar(15) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `tipoUsuarioId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cedula`, `nombre`, `apellido`, `telefono`, `pais`, `departamento`, `ciudad`, `contrasena`, `tipoUsuarioId`) VALUES
(0, '', '', '', '', '', '', '$2y$10$/9y1/YZ0Tap0I7OHHqrKUOkSvInTeIcv0qILFPKXRJUZcspj0BZ.2', 1),
(30281508, 'Flor', 'Tapia', '3058145692', 'Colombia', 'Caldas', 'Villamaria', '$2y$10$UQOpbCWwZHmigU7uRsLNpeNcWEsJTIFAmbIirA2vC6.TkXRuhxS.K', 1),
(1002633713, 'Willy Jhoan', 'Pinto', '123456789', 'Ecuador', 'Caldas', 'Manizales', '$2y$10$MIzfge6kpToXDSpRuz3F/e3x.6yxmkJKBp3s/tvtclE8BbMU5iXIW', 1),
(1053872476, 'Jeimy Tatiana', 'Tapia', '+573058122481', 'Colombia', 'Caldas', 'Villamaria', '$2y$10$CEzkpHMfEM4gHIIAQ1J35.yIcLYheSMl8Ew7hBJ2Hc/arpG27gayK', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `facturaciones`
--
ALTER TABLE `facturaciones`
  ADD KEY `fk_facturaciones_huespedes` (`cedula`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`numero`);

--
-- Indices de la tabla `huespedes`
--
ALTER TABLE `huespedes`
  ADD KEY `cedula` (`cedula`),
  ADD KEY `fk_huespedes_habitaciones` (`habitacion`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD KEY `fk_pedidos_habitaciones` (`habitacion`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `tipousuarios`
--
ALTER TABLE `tipousuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `fk_usuarios_tipoUsuarios` (`tipoUsuarioId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tipousuarios`
--
ALTER TABLE `tipousuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `facturaciones`
--
ALTER TABLE `facturaciones`
  ADD CONSTRAINT `fk_facturaciones_huespedes` FOREIGN KEY (`cedula`) REFERENCES `huespedes` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `huespedes`
--
ALTER TABLE `huespedes`
  ADD CONSTRAINT `fk_huespedes_habitaciones` FOREIGN KEY (`habitacion`) REFERENCES `habitaciones` (`numero`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_huespedes_usuarios` FOREIGN KEY (`cedula`) REFERENCES `usuarios` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedidos_habitaciones` FOREIGN KEY (`habitacion`) REFERENCES `habitaciones` (`numero`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pedidos_huespedes` FOREIGN KEY (`cedula`) REFERENCES `huespedes` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_tipoUsuarios` FOREIGN KEY (`tipoUsuarioId`) REFERENCES `tipousuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
