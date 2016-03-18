-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-01-2016 a las 01:06:10
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ttounkyo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `idcategoria` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idcategoria`, `nombre`) VALUES
(1, 'patines'),
(2, 'patinetes'),
(3, 'heelys'),
(4, 'hombre'),
(5, 'mujer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_productos`
--

CREATE TABLE IF NOT EXISTS `categorias_productos` (
  `idcategoria` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias_productos`
--

INSERT INTO `categorias_productos` (`idcategoria`, `idproducto`) VALUES
(1, 1),
(1, 2),
(1, 3),
(5, 3),
(1, 4),
(4, 4),
(5, 4),
(2, 5),
(3, 5),
(4, 5),
(3, 6),
(4, 6),
(5, 6),
(1, 7),
(2, 7),
(3, 7),
(4, 7),
(5, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `idimagen` int(11) NOT NULL,
  `path` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `idpedido` int(11) NOT NULL,
  `idmetodopago` varchar(45) NOT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idpedido`, `idmetodopago`, `estado`, `fecha`, `username`) VALUES
(1, 'visa', 'Pedido', '2016-01-09 06:28:02', 'boss');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_has_productos`
--

CREATE TABLE IF NOT EXISTS `pedidos_has_productos` (
  `idpedido` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedidos_has_productos`
--

INSERT INTO `pedidos_has_productos` (`idpedido`, `idproducto`) VALUES
(1, 2),
(1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `idproducto` int(11) NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `precio` decimal(10,0) DEFAULT NULL,
  `marca` varchar(45) DEFAULT NULL,
  `ruta` varchar(100) DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `titulo`, `descripcion`, `precio`, `marca`, `ruta`, `cantidad`, `createdAt`) VALUES
(1, 'Patines', 'Para  Iniciacion', '50', 'Raider', '../img_products/1/patines_iniciacion.png', 42, '2016-01-09 06:22:48'),
(2, 'Patines A', 'Agresivos', '55', 'Rider-Extreme', '../img_products/2/patines-agresivo.png', 35, '2016-01-09 06:23:20'),
(3, 'Patin Fitnes', 'Fitnes', '35', 'Rider', '../img_products/3/patines-fitness.png', 33, '2016-01-09 06:23:54'),
(4, 'freeskate', 'patines-freeskate', '66', 'oxelo', '../img_products/4/patines-freeskate.png', 32, '2016-01-09 06:24:31'),
(5, 'Patines Nini', 'Nino', '65', 'Rider', '../img_products/5/patines-nino.png', 64, '2016-01-09 06:24:58'),
(6, 'slalom', 'patines-slalom', '98', 'Extrem', '../img_products/6/patines-slalom.png', 41, '2016-01-09 06:25:21'),
(7, 'P. Velocidad', 'patines-slalom', '75', 'speed', '../img_products/7/patines-velocidad_1.png', 17, '2016-01-09 06:25:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_has_media`
--

CREATE TABLE IF NOT EXISTS `productos_has_media` (
  `idproducto` int(11) NOT NULL,
  `media_idimagen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `username` varchar(45) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `datealta` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `rol` varchar(45) DEFAULT 'cliente',
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`username`, `nombre`, `apellidos`, `datealta`, `email`, `telefono`, `direccion`, `rol`, `password`) VALUES
('admin', NULL, NULL, '2016-01-09 06:15:37', NULL, NULL, NULL, 'administrador', '$2y$10$C/lJA4tl7kOZ35FtILF5sOBOloNAl0wIVEIl2apAoVLl5rT4fBgpC'),
('antonio', 'Antonio', 'Delgado', '2016-01-09 06:15:37', 'aa.antonio.delgado@gmail.com', '680840609', 'Crr Sant Carlos', 'cliente', '$2y$10$C/lJA4tl7kOZ35FtILF5sOBOloNAl0wIVEIl2apAoVLl5rT4fBgpC'),
('boss', NULL, NULL, '2016-01-09 06:15:37', NULL, NULL, NULL, 'administrador', '$2y$10$C/lJA4tl7kOZ35FtILF5sOBOloNAl0wIVEIl2apAoVLl5rT4fBgpC'),
('mello', 'miguel', 'roig', '2016-01-09 06:15:37', NULL, NULL, NULL, 'cliente', '$2y$10$GpasA7/dy80X.1C5bzYIHu75W4RsoJwLLs5lE0Xk4/VZNQ8btRtIe');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `categorias_productos`
--
ALTER TABLE `categorias_productos`
  ADD PRIMARY KEY (`idcategoria`,`idproducto`),
  ADD KEY `fk_categorias_has_productos_productos1_idx` (`idproducto`),
  ADD KEY `fk_categorias_has_productos_categorias1_idx` (`idcategoria`);

--
-- Indices de la tabla `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`idimagen`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `fk_compras_usuarios1_idx` (`username`);

--
-- Indices de la tabla `pedidos_has_productos`
--
ALTER TABLE `pedidos_has_productos`
  ADD PRIMARY KEY (`idpedido`,`idproducto`),
  ADD KEY `fk_pedidos_has_productos_productos1_idx` (`idproducto`),
  ADD KEY `fk_pedidos_has_productos_pedidos1_idx` (`idpedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproducto`);

--
-- Indices de la tabla `productos_has_media`
--
ALTER TABLE `productos_has_media`
  ADD PRIMARY KEY (`idproducto`,`media_idimagen`),
  ADD KEY `fk_productos_has_media_media1_idx` (`media_idimagen`),
  ADD KEY `fk_productos_has_media_productos1_idx` (`idproducto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `media`
--
ALTER TABLE `media`
  MODIFY `idimagen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idpedido` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias_productos`
--
ALTER TABLE `categorias_productos`
  ADD CONSTRAINT `fk_categorias_has_productos_categorias1` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`idcategoria`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_categorias_has_productos_productos1` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_compras_usuarios1` FOREIGN KEY (`username`) REFERENCES `usuarios` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedidos_has_productos`
--
ALTER TABLE `pedidos_has_productos`
  ADD CONSTRAINT `fk_pedidos_has_productos_pedidos1` FOREIGN KEY (`idpedido`) REFERENCES `pedidos` (`idpedido`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedidos_has_productos_productos1` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos_has_media`
--
ALTER TABLE `productos_has_media`
  ADD CONSTRAINT `fk_productos_has_media_media1` FOREIGN KEY (`media_idimagen`) REFERENCES `media` (`idimagen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_has_media_productos1` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `users` (
  `user_name` VARCHAR(11)NOT NULL,
  `user_pass` VARCHAR(12)
);

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_name`,`user_pass`);