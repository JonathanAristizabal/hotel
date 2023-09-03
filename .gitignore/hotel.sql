-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-09-2023 a las 18:55:46
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
  `documento` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `huespedes`
--

CREATE TABLE `huespedes` (
  `documento` int(11) NOT NULL,
  `ticket` varchar(11) NOT NULL,
  `habitacion` int(11) NOT NULL,
  `fecha_checkIN` date NOT NULL,
  `fecha_checkOUT` date NOT NULL,
  `dias_reservados` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `documento` int(11) NOT NULL,
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
(0, 'cliente'),
(1, 'administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `documento` int(11) NOT NULL,
  `correo` varchar(45) NOT NULL,
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

INSERT INTO `usuarios` (`documento`, `correo`, `nombre`, `apellido`, `telefono`, `pais`, `departamento`, `ciudad`, `contrasena`, `tipoUsuarioId`) VALUES
(1053810807, 'jhonatan901230@hotmail.com', 'Jonathan', '  Aristizabal', '3187542709', 'Colombia', 'Caldas', 'Manizales', '$2y$10$ImiqPphMum4LMSuBPoPJeuhDl0XNSJVEgepYV8oboLNpW5.ohWYYO', 1),
(1053872476, 'jeimytatianapinto@gmail.com', 'Jeimy Tatiana', 'Tapia', '3058122481', 'Colombia', 'Caldas', 'Villamaria', '$2y$10$cZ4IBk4A3DcA1D45r3Zaye1GZ1.sYjriVP/oN5XbzIr1oJyiDFfEe', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `facturaciones`
--
ALTER TABLE `facturaciones`
  ADD KEY `fk_facturaciones_huespedes` (`documento`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`numero`);

--
-- Indices de la tabla `huespedes`
--
ALTER TABLE `huespedes`
  ADD KEY `cedula` (`documento`),
  ADD KEY `fk_huespedes_habitaciones` (`habitacion`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedidos_habitaciones` (`habitacion`),
  ADD KEY `cedula` (`documento`);

--
-- Indices de la tabla `tipousuarios`
--
ALTER TABLE `tipousuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`documento`),
  ADD KEY `tipoUsuarioId` (`tipoUsuarioId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `fk_facturaciones_huespedes` FOREIGN KEY (`documento`) REFERENCES `huespedes` (`documento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `huespedes`
--
ALTER TABLE `huespedes`
  ADD CONSTRAINT `fk_huespedes_habitaciones` FOREIGN KEY (`habitacion`) REFERENCES `habitaciones` (`numero`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_huespedes_usuarios` FOREIGN KEY (`documento`) REFERENCES `usuarios` (`documento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedidos_habitaciones` FOREIGN KEY (`habitacion`) REFERENCES `habitaciones` (`numero`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pedidos_huespedes` FOREIGN KEY (`documento`) REFERENCES `huespedes` (`documento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_tipoUsuarios` FOREIGN KEY (`tipoUsuarioId`) REFERENCES `tipousuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
