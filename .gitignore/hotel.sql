-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-09-2023 a las 09:14:07
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

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

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`numero`, `tipo`, `estado`, `descripcion`, `valor_diario`) VALUES
(100, 'Individual', 1, 'Cama cómoda, baño privado, Wi-Fi, TV, aire acondic', 50000),
(101, 'Individual', 0, 'Cama cómoda, baño privado, Wi-Fi, TV, aire acondic', 50000),
(103, 'Individual', 0, 'Cama cómoda, baño privado, Wi-Fi, TV, aire acondic', 50000),
(104, 'Individual', 0, 'Cama cómoda, baño privado, Wi-Fi, TV, aire acondic', 50000),
(200, 'Doble', 0, 'habitación doble con dos camas ofrece espacio ', 120000),
(201, 'Doble', 0, 'habitación doble con dos camas ofrece espacio ', 120000),
(300, 'Doble', 0, 'habitación espaciosa y lujosa con cama grande y sa', 200000),
(301, 'Suite', 0, 'habitación espaciosa y lujosa con cama grande y sa', 200000);

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

--
-- Volcado de datos para la tabla `huespedes`
--

INSERT INTO `huespedes` (`documento`, `ticket`, `habitacion`, `fecha_checkIN`, `fecha_checkOUT`, `dias_reservados`) VALUES
(987654321, 'FGXZ02', 100, '2023-09-05', '2023-09-07', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `documento` int(11) NOT NULL,
  `ticket` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `habitacion` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `categoria`, `precio`, `stock`) VALUES
(58, 'Agua Mineral', 'Botella de agua mineral de 500 ml.', 'Bebidas', 3000, 100),
(59, 'Refresco de Cola', 'Lata de refresco de cola de 355 ml.', 'Bebidas', 2500, 100),
(60, 'Jugo de Naranja', 'Jugo de naranja natural de 250 ml.', 'Bebidas', 3500, 100),
(61, 'Cerveza Nacional', 'Botella de cerveza nacional de 330 ml.', 'Bebidas', 4000, 100),
(62, 'Café Americano', 'Taza de café americano recién preparado.', 'Bebidas', 2000, 100),
(63, 'Té de Manzanilla', 'Taza de té de manzanilla caliente.', 'Bebidas', 2500, 100),
(64, 'Mojito', 'Cóctel de mojito con hierbabuena y ron.', 'Bebidas', 8000, 100),
(65, 'Coctel de Frutas', 'Cóctel de frutas frescas en vaso grande.', 'Bebidas', 4500, 100),
(66, 'Agua con Gas', 'Botella de agua con gas de 500 ml.', 'Bebidas', 3500, 100),
(67, 'Smoothie de Frutas', 'Smoothie de frutas mixtas en vaso grande.', 'Bebidas', 5500, 100),
(68, 'Papas Fritas', 'Porción de papas fritas crujientes.', 'Aperitivos', 3500, 100),
(69, 'Nachos con Queso', 'Nachos con salsa de queso fundido.', 'Aperitivos', 4500, 100),
(70, 'Alitas de Pollo', 'Alitas de pollo picantes con salsa.', 'Aperitivos', 6000, 100),
(71, 'Tostadas de Guacamole', 'Tostadas de guacamole fresco.', 'Aperitivos', 4200, 100),
(72, 'Rollitos de Primavera', 'Rollitos de primavera con salsa agridulce.', 'Aperitivos', 4800, 100),
(73, 'Mini Hamburguesas', 'Mini hamburguesas con queso y vegetales.', 'Aperitivos', 5500, 100),
(74, 'Palitos de Mozzarella', 'Palitos de mozzarella con salsa de tomate.', 'Aperitivos', 4800, 100),
(75, 'Calamares Fritos', 'Calamares fritos con salsa tártara.', 'Aperitivos', 6500, 100),
(76, 'Empanadas de Carne', 'Empanadas de carne colombianas.', 'Aperitivos', 3800, 100),
(77, 'Brochetas de Camarones', 'Brochetas de camarones a la parrilla.', 'Aperitivos', 7500, 100),
(78, 'Pasta Alfredo', 'Pasta alfredo con salsa cremosa y pollo.', 'Platos Principales', 12000, 100),
(79, 'Filete de Salmón', 'Filete de salmón a la parrilla con verduras.', 'Platos Principales', 18000, 100),
(80, 'Lomo de Res', 'Lomo de res a la parrilla con papas y ensalada.', 'Platos Principales', 16000, 100),
(81, 'Pollo a la Parrilla', 'Pechuga de pollo a la parrilla con arroz y vegetales.', 'Platos Principales', 14000, 100),
(82, 'Pizza Margarita', 'Pizza margarita con tomate y mozzarella.', 'Platos Principales', 10000, 100),
(83, 'Tacos de Carne', 'Tacos de carne con guarniciones.', 'Platos Principales', 11000, 100),
(84, 'Risotto de Champiñones', 'Risotto de champiñones con parmesano.', 'Platos Principales', 13000, 100),
(85, 'Enchiladas de Pollo', 'Enchiladas de pollo con salsa roja y queso.', 'Platos Principales', 12000, 100),
(86, 'Sushi Variado', 'Selección variada de sushi fresco.', 'Platos Principales', 16000, 100),
(87, 'Paella de Mariscos', 'Paella de mariscos con arroz y azafrán.', 'Platos Principales', 20000, 100),
(88, 'Tiramisú', 'Tiramisú casero con café y mascarpone.', 'Postres', 6000, 100),
(89, 'Helado de Chocolate', 'Helado de chocolate con salsa de caramelo.', 'Postres', 4500, 100),
(90, 'Cheesecake de Fresa', 'Cheesecake de fresa con coulis de frambuesa.', 'Postres', 5500, 100),
(91, 'Flan de Caramelo', 'Flan de caramelo casero.', 'Postres', 5000, 100),
(92, 'Mousse de Chocolate', 'Mousse de chocolate con crema batida.', 'Postres', 5500, 100),
(93, 'Crepe de Nutella', 'Crepe relleno de Nutella y plátano.', 'Postres', 4800, 100),
(94, 'Pastel de Manzana', 'Pastel de manzana con helado de vainilla.', 'Postres', 5200, 100),
(95, 'Frutas Frescas', 'Selección de frutas frescas de temporada.', 'Postres', 4000, 100),
(96, 'Brownie con Nuez', 'Brownie de chocolate con nueces y helado.', 'Postres', 5800, 100),
(97, 'Tarta de Limón', 'Tarta de limón con merengue tostado.', 'Postres', 5200, 100),
(98, 'Desayuno Continental', 'Café, jugo de naranja, croissant y frutas.', 'Desayuno', 7000, 100),
(99, 'Huevos Revueltos', 'Huevos revueltos con bacon y tostadas.', 'Desayuno', 7500, 100),
(100, 'Omelette de Champiñones', 'Omelette de champiñones con queso.', 'Desayuno', 7000, 100),
(101, 'Panqueques', 'Panqueques con sirope de arce y frutas.', 'Desayuno', 8000, 100),
(102, 'Desayuno Saludable', 'Yogur, granola, miel y frutas.', 'Desayuno', 6500, 100),
(103, 'Arepas con Queso', 'Arepas rellenas de queso fresco.', 'Desayuno', 6000, 100),
(104, 'Desayuno Colombiano', 'Arepa de huevo, chorizo y café.', 'Desayuno', 7500, 100),
(105, 'Tostadas Francesas', 'Tostadas francesas con canela y azúcar glas.', 'Desayuno', 7000, 100),
(106, 'Café Expreso', 'Café expreso recién hecho.', 'Desayuno', 2500, 100),
(107, 'Té de Hierbas', 'Taza de té de hierbas caliente.', 'Desayuno', 3000, 100);

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
(123456789, 'admin@gmail.com', 'prueba', 'admin', '3112235555', 'Colombia', 'Caldas', 'Manizales', '$2y$10$NkakX.BI13WTm.3LskZVyeJk8SzLnMoE/dlimssBqoBPZzPv.ZotG', 1),
(987654321, 'cliente@gmail.com', 'prueba', 'cliente', '3124560987', 'Colombia', 'Caldass', 'Manizales', '', 0);

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
  ADD KEY `fk_pedidos_productos` (`producto_id`),
  ADD KEY `ticket` (`ticket`),
  ADD KEY `documento` (`documento`),
  ADD KEY `habitacion` (`habitacion`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

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
  ADD CONSTRAINT `fk_pedidos_productos` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_tipoUsuarios` FOREIGN KEY (`tipoUsuarioId`) REFERENCES `tipousuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
