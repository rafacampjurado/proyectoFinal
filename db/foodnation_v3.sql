-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Servidor: sql307.epizy.com
-- Tiempo de generación: 13-06-2019 a las 03:21:46
-- Versión del servidor: 5.6.41-84.1
-- Versión de PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `epiz_23036069_foodnation`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones_usuario`
--

CREATE TABLE IF NOT EXISTS `direcciones_usuario` (
  `idDireccion` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT 'casa',
  `calle` varchar(255) NOT NULL,
  `codigoPostal` int(5) NOT NULL,
  `telefono` int(12) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `pais` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idDireccion`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `direcciones_usuario`
--

INSERT INTO `direcciones_usuario` (`idDireccion`, `idUsuario`, `alias`, `calle`, `codigoPostal`, `telefono`, `ciudad`, `pais`) VALUES
(3, 1, 'casa', 'ejemplo', 11111, 2147483647, 'ejemplo', 'ejemplo'),
(4, 7, 'casa', 'invierno', 1, 2147483647, 'invernalia', 'poniente'),
(8, 17, 'casita', 'charco n12', 19482, 2147483647, 'MÃ¡laga', 'EspaÃ±a'),
(6, 11, 'Norte', 'Calle helada 13', 10101, 2147483647, 'Invernalia', 'Poniente'),
(9, 18, 'ejemplo de calle', 'calle ejemplo', 19483, 2147483647, 'malaga', 'espaÃ±a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE IF NOT EXISTS `facturas` (
  `idFactura` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idTarjetaCredito` int(11) DEFAULT NULL,
  `idDireccion` int(11) DEFAULT NULL,
  `Fecha` date NOT NULL,
  PRIMARY KEY (`idFactura`),
  KEY `FK_idUsuario` (`idUsuario`),
  KEY `idDireccion` (`idDireccion`),
  KEY `facturas_ibfk_1` (`idTarjetaCredito`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`idFactura`, `idUsuario`, `idTarjetaCredito`, `idDireccion`, `Fecha`) VALUES
(2, 2, 1, 3, '2019-04-16'),
(3, 1, 1, 3, '2019-04-18'),
(15, 1, 1, 3, '2019-04-16'),
(17, 1, 1, 3, '2019-05-02'),
(18, 1, 1, 3, '2019-06-02'),
(19, 7, 3, 4, '2019-06-05'),
(20, 1, 2, 3, '2019-06-06'),
(21, 1, 2, 3, '2019-06-07'),
(22, 1, 1, 3, '2019-06-07'),
(23, 11, 5, 6, '2019-06-09'),
(24, 1, 1, 3, '2019-06-11'),
(25, 17, 8, 8, '2019-06-11'),
(26, 1, 1, 3, '2019-06-12'),
(27, 18, 9, 9, '2019-06-12'),
(28, 18, NULL, NULL, '2019-06-12'),
(29, 18, NULL, NULL, '2019-06-12'),
(30, 18, NULL, NULL, '2019-06-12'),
(31, 18, 9, 9, '2019-06-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_productos`
--

CREATE TABLE IF NOT EXISTS `facturas_productos` (
  `idFactura` int(100) NOT NULL,
  `idProducto` int(100) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idFactura`,`idProducto`),
  KEY `fk_idproducto` (`idProducto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facturas_productos`
--

INSERT INTO `facturas_productos` (`idFactura`, `idProducto`, `cantidad`) VALUES
(3, 1, 4),
(3, 4, 1),
(15, 1, 1),
(15, 2, 7),
(17, 1, 1),
(17, 4, 2),
(18, 4, 1),
(19, 45, 3),
(20, 13, 1),
(21, 47, 5),
(22, 8, 1),
(23, 31, 3),
(24, 25, 1),
(24, 98, 1),
(25, 93, 3),
(25, 60, 5),
(26, 98, 1),
(27, 1, 6),
(31, 12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opiniones`
--

CREATE TABLE IF NOT EXISTS `opiniones` (
  `idOpinion` int(100) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(100) NOT NULL,
  `idProducto` int(100) NOT NULL,
  `Opinion` varchar(255) NOT NULL,
  `Fecha` date NOT NULL,
  `Puntuacion` int(5) NOT NULL DEFAULT '3',
  `Aprobado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idOpinion`),
  KEY `fk_idusuarios` (`idUsuario`),
  KEY `fk_idproductos` (`idProducto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `opiniones`
--

INSERT INTO `opiniones` (`idOpinion`, `idUsuario`, `idProducto`, `Opinion`, `Fecha`, `Puntuacion`, `Aprobado`) VALUES
(1, 1, 1, 'Estaba muy bueno', '2019-04-16', 3, 1),
(3, 2, 1, 'No estaban mal', '2019-04-19', 3, 1),
(4, 1, 5, 'dwadawdwa', '2019-05-01', 3, 1),
(5, 1, 4, 'Platanico', '2019-05-06', 2, 1),
(6, 7, 1, 'Patatas', '2019-04-16', 3, 1),
(7, 5, 1, 'Patatoides', '2019-04-16', 5, 1),
(8, 1, 94, 'Sabe a cheeesse', '2019-06-04', 3, 1),
(9, 1, 100, 'Buen vino mejor fruta.', '2019-06-06', 5, 1),
(11, 1, 47, 'Queso', '2019-06-07', 5, 1),
(12, 1, 71, 'Tomaticos con tomate', '2019-06-08', 4, 1),
(13, 11, 31, 'No venÃ­a frÃ­o.', '2019-06-09', 4, 1),
(21, 1, 18, 'test', '2019-06-12', 1, 0),
(19, 17, 60, 'Para el bocadillo de la tarde.', '2019-06-11', 4, 1),
(20, 17, 1, 'Quinto comentario en este producto (1)', '2019-06-11', 5, 1),
(22, 18, 1, 'Muy buena patata', '2019-06-12', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) NOT NULL,
  `Precio` double(10,2) NOT NULL,
  `Tipo` varchar(100) NOT NULL,
  `Img` varchar(255) NOT NULL DEFAULT 'img/product01.jpg',
  PRIMARY KEY (`idProducto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=111 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `Nombre`, `Precio`, `Tipo`, `Img`) VALUES
(1, 'Patata', 0.10, 'Hortaliza', 'img/productHortaliza.jpg'),
(2, 'Tomate', 0.50, 'Hortaliza', 'img/productHortaliza.jpg'),
(4, 'Platano', 1.00, 'Fruta', 'img/productFruta.jpg'),
(5, 'Wine - Red, Pinot Noir, Chateau', 59.30, 'Carne', 'img/productCarne.jpg'),
(6, 'Syrup - Golden, Lyles', 85.91, 'Dulce', 'img/productDulce.jpg'),
(7, 'Juice - Orange, Concentrate', 15.33, 'Pescado', 'img/productPescado.jpg'),
(8, 'Pasta - Cappellini, Dry', 44.03, 'Aperitivos', 'img/productSnacks.jpg'),
(9, 'Cumin - Whole', 29.62, 'Hortaliza', 'img/productHortaliza.jpg'),
(10, 'Potatoes - Yukon Gold, 80 Ct', 45.99, 'Hortaliza', 'img/productHortaliza.jpg'),
(11, 'Cocoa Powder - Natural', 70.85, 'Carne', 'img/productCarne.jpg'),
(12, 'Knife Plastic - White', 16.84, 'Fruta', 'img/productFruta.jpg'),
(13, 'Cod - Black Whole Fillet', 85.88, 'Carne', 'img/productCarne.jpg'),
(14, 'Cream - 18%', 22.83, 'Hortaliza', 'img/productHortaliza.jpg'),
(15, 'Chips Potato Salt Vinegar 43g', 55.61, 'Hortaliza', 'img/productHortaliza.jpg'),
(16, 'Cabbage Roll', 71.90, 'Hortaliza', 'img/productHortaliza.jpg'),
(17, 'Wine - Savigny - Les - Beaune', 52.69, 'Carne', 'img/productCarne.jpg'),
(18, 'Pop - Club Soda Can', 2.18, 'Fruta', 'img/productFruta.jpg'),
(19, 'Paper - Brown Paper Mini Cups', 49.54, 'Aperitivos', 'img/productSnacks.jpg'),
(20, 'Flour - All Purpose', 90.93, 'Pescado', 'img/productPescado.jpg'),
(21, 'Wine - Magnotta, Merlot Sr Vqa', 84.61, 'Fruta', 'img/productFruta.jpg'),
(22, 'Bagelers', 81.90, 'Pescado', 'img/productPescado.jpg'),
(23, 'Sardines', 79.13, 'Fruta', 'img/productFruta.jpg'),
(24, 'Soup - Knorr, Chicken Gumbo', 35.29, 'Hortaliza', 'img/productHortaliza.jpg'),
(25, 'Vinegar - White', 82.13, 'Carne', 'img/productCarne.jpg'),
(26, 'Wine - Red, Pinot Noir, Chateau', 44.59, 'Hortaliza', 'img/productHortaliza.jpg'),
(27, 'Maintenance Removal Charge', 51.90, 'Dulce', 'img/productDulce.jpg'),
(28, 'Pork Ham Prager', 34.50, 'Fruta', 'img/productFruta.jpg'),
(29, 'Sauce - Salsa', 76.16, 'Fruta', 'img/productFruta.jpg'),
(30, 'Paper Towel Touchless', 79.53, 'Carne', 'img/productCarne.jpg'),
(31, 'Wine - Wyndham Estate Bin 777', 14.66, 'Dulce', 'img/productDulce.jpg'),
(32, 'Broom - Corn', 18.94, 'Fruta', 'img/productFruta.jpg'),
(33, 'Pork Loin Cutlets', 30.46, 'Fruta', 'img/productFruta.jpg'),
(34, 'Pate - Peppercorn', 18.83, 'Carne', 'img/productCarne.jpg'),
(35, 'Flavouring - Orange', 81.86, 'Fruta', 'img/productFruta.jpg'),
(36, 'Olives - Kalamata', 99.99, 'Fruta', 'img/productFruta.jpg'),
(37, 'Shrimp - Black Tiger 13/15', 20.93, 'Aperitivos', 'img/productSnacks.jpg'),
(38, 'Melon - Watermelon, Seedless', 31.15, 'Pescado', 'img/productPescado.jpg'),
(39, 'Beef - Chuck, Boneless', 30.87, 'Carne', 'img/productCarne.jpg'),
(40, 'Wine - Ej Gallo Sierra Valley', 95.60, 'Aperitivos', 'img/productSnacks.jpg'),
(41, 'Wine - Cahors Ac 2000, Clos', 91.18, 'Fruta', 'img/productFruta.jpg'),
(42, 'Red Snapper - Fresh, Whole', 42.95, 'Aperitivos', 'img/productSnacks.jpg'),
(43, 'Vinegar - Raspberry', 54.61, 'Carne', 'img/productCarne.jpg'),
(44, 'Wine - Magnotta - Pinot Gris Sr', 21.46, 'Hortaliza', 'img/productHortaliza.jpg'),
(45, 'Vol Au Vents', 83.37, 'Hortaliza', 'img/productHortaliza.jpg'),
(46, 'Apron', 90.26, 'Hortaliza', 'img/productHortaliza.jpg'),
(47, 'Cheese - Mozzarella, Shredded', 39.92, 'Aperitivos', 'img/productSnacks.jpg'),
(48, 'Sage - Fresh', 93.75, 'Fruta', 'img/productFruta.jpg'),
(49, 'Appetizer - Chicken Satay', 77.12, 'Pescado', 'img/productPescado.jpg'),
(50, 'Soup - Campbells Bean Medley', 63.09, 'Aperitivos', 'img/productSnacks.jpg'),
(51, 'Gatorade - Fruit Punch', 26.32, 'Carne', 'img/productCarne.jpg'),
(52, 'Tea - Black Currant', 80.78, 'Fruta', 'img/productFruta.jpg'),
(53, 'Glucose', 98.80, 'Fruta', 'img/productFruta.jpg'),
(54, 'Persimmons', 32.20, 'Carne', 'img/productCarne.jpg'),
(55, 'Lettuce - Romaine, Heart', 70.28, 'Carne', 'img/productCarne.jpg'),
(56, 'Parsnip', 10.50, 'Hortaliza', 'img/productHortaliza.jpg'),
(57, 'Papadam', 73.95, 'Aperitivos', 'img/productSnacks.jpg'),
(58, 'Potatoes - Yukon Gold 5 Oz', 89.93, 'Fruta', 'img/productFruta.jpg'),
(59, 'Whmis - Spray Bottle Trigger', 95.15, 'Carne', 'img/productCarne.jpg'),
(60, 'Mortadella', 60.02, 'Aperitivos', 'img/productSnacks.jpg'),
(61, 'Breadfruit', 47.93, 'Hortaliza', 'img/productHortaliza.jpg'),
(62, 'Seaweed Green Sheets', 80.59, 'Fruta', 'img/productFruta.jpg'),
(63, 'Ginger - Crystalized', 79.50, 'Carne', 'img/productCarne.jpg'),
(64, 'Squid - Tubes / Tenticles 10/20', 19.82, 'Pescado', 'img/productPescado.jpg'),
(65, 'Jack Daniels', 55.04, 'Pescado', 'img/productPescado.jpg'),
(66, 'Mustard - Individual Pkg', 56.61, 'Carne', 'img/productCarne.jpg'),
(67, 'Sauce - Hp', 26.05, 'Pescado', 'img/productPescado.jpg'),
(68, 'Soupfoamcont12oz 112con', 7.38, 'Hortaliza', 'img/productHortaliza.jpg'),
(69, 'Wine - Toasted Head', 39.28, 'Aperitivos', 'img/productSnacks.jpg'),
(70, 'Sauce - Oyster', 48.49, 'Pescado', 'img/productPescado.jpg'),
(71, 'Tomatoes - Vine Ripe, Red', 25.94, 'Carne', 'img/productCarne.jpg'),
(72, 'Chicken - Thigh, Bone In', 80.47, 'Dulce', 'img/productDulce.jpg'),
(73, 'Nantucket Cranberry Juice', 10.85, 'Hortaliza', 'img/productHortaliza.jpg'),
(74, 'Venison - Denver Leg Boneless', 32.48, 'Pescado', 'img/productPescado.jpg'),
(75, 'Turnip - White', 14.32, 'Dulce', 'img/productDulce.jpg'),
(76, 'Food Colouring - Blue', 53.54, 'Hortaliza', 'img/productHortaliza.jpg'),
(77, 'Longos - Greek Salad', 25.59, 'Fruta', 'img/productFruta.jpg'),
(78, 'Potatoes - Yukon Gold, 80 Ct', 3.82, 'Hortaliza', 'img/productHortaliza.jpg'),
(79, 'Potatoes - Idaho 100 Count', 10.74, 'Carne', 'img/productCarne.jpg'),
(80, 'External Supplier', 16.05, 'Dulce', 'img/productDulce.jpg'),
(81, 'Cheese - Camembert', 33.99, 'Fruta', 'img/productFruta.jpg'),
(82, 'Cranberry Foccacia', 45.40, 'Pescado', 'img/productPescado.jpg'),
(83, 'Cookies Almond Hazelnut', 51.53, 'Aperitivos', 'img/productSnacks.jpg'),
(84, 'Soup - Cream Of Potato / Leek', 62.02, 'Dulce', 'img/productDulce.jpg'),
(85, 'Sauce - Thousand Island', 82.56, 'Aperitivos', 'img/productSnacks.jpg'),
(86, 'Squash - Guords', 61.19, 'Aperitivos', 'img/productSnacks.jpg'),
(87, 'Soup - Campbells, Lentil', 55.95, 'Aperitivos', 'img/productSnacks.jpg'),
(88, 'Bacardi Limon', 63.36, 'Carne', 'img/productCarne.jpg'),
(89, 'Cake Circle, Paprus', 90.52, 'Aperitivos', 'img/productSnacks.jpg'),
(90, 'Swiss Chard - Red', 32.52, 'Dulce', 'img/productDulce.jpg'),
(91, 'Tomatoes - Heirloom', 57.87, 'Aperitivos', 'img/productSnacks.jpg'),
(92, 'Tuna - Canned, Flaked, Light', 73.22, 'Carne', 'img/productCarne.jpg'),
(93, 'Dish Towel', 56.28, 'Aperitivos', 'img/productSnacks.jpg'),
(94, 'Cheese - Provolone', 78.87, 'Pescado', 'img/productPescado.jpg'),
(95, 'Appetizer - Asian Shrimp Roll', 43.27, 'Dulce', 'img/productDulce.jpg'),
(96, 'Jam - Raspberry,jar', 75.21, 'Aperitivos', 'img/productSnacks.jpg'),
(97, 'Garam Marsala', 45.44, 'Carne', 'img/productCarne.jpg'),
(98, 'Bread - Focaccia Quarter', 15.61, 'Carne', 'img/productCarne.jpg'),
(99, 'Salt And Pepper Mix - Black', 61.52, 'Fruta', 'img/productFruta.jpg'),
(100, 'Wine - Chateauneuf Du Pape', 88.53, 'Fruta', 'img/productFruta.jpg'),
(101, 'Shrimp - Tiger 21/25', 19.95, 'Dulce', 'img/productDulce.jpg'),
(102, 'Mahi Mahi', 82.33, 'Dulce', 'img/productDulce.jpg'),
(103, 'Oil - Safflower', 82.32, 'Carne', 'img/productCarne.jpg'),
(104, 'Vinegar - Tarragon', 95.72, 'Carne', 'img/productCarne.jpg'),
(108, 'ejemploProducto', 47.10, 'Hortaliza', 'img/HenryHTB1840.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetasdecredito`
--

CREATE TABLE IF NOT EXISTS `tarjetasdecredito` (
  `idTarjetaCredito` int(11) NOT NULL AUTO_INCREMENT,
  `numeroTarjeta` varchar(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idTarjetaCredito`),
  UNIQUE KEY `numeroTarjeta` (`numeroTarjeta`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `tarjetasdecredito`
--

INSERT INTO `tarjetasdecredito` (`idTarjetaCredito`, `numeroTarjeta`, `tipo`, `idUsuario`) VALUES
(1, 'A0123BCPM5A', 'VISA', 1),
(2, 'A1A2A3A4A5A', 'MASTETRCARD', 1),
(3, '14872438385', 'MASTERCARD', 7),
(5, '10MAD0B94IA', 'MASTERCARD', 11),
(8, '11111111112', 'UNICAJA', 17),
(9, 'MA95MA8CIA0', 'VISA', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(125) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) DEFAULT 'default.png',
  `rol` varchar(100) DEFAULT 'usuario',
  `usuario` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `apellidos`, `email`, `fecha`, `imagen`, `rol`, `usuario`, `password`) VALUES
(1, 'Roomb', 'Oppo', 'admin@admin.com', '2018-11-23', 'gustavo.jpg', 'admin', 'admin', '2f1767dc31e7a8dc68b2c21bf07984ff'),
(2, 'EjemploDos', 'DosEjemplo', 'ejemplo2@ejemplo2.com', '2019-01-09', 'default.png', 'usuario', 'ejemplo2', 'c1a2cffb24ed92823e966e1af12dd045'),
(5, 'testta', 'testt', 'testing@testing.es', '2019-02-08', 'default.png', 'usuario', 'testing', 'ae2b1fca515949e5d54fb22b8ed95575'),
(7, 'Arya', 'Stark', 'arya@stark.com', '2019-05-20', 'default.png', 'usuario', 'Arya', '2fbb71b04b02738300427866d6e3181a'),
(11, 'John', 'Nieve', 'john@nieve.com', '2019-06-09', 'user.jpg', 'usuario', 'John', '8db8c4b64d661710ce1fa380a71aef89'),
(18, 'Test', 'testeador2', 'test2@test2.com', '2019-06-12', 'manta.JPG', 'usuario', 'test2', '098f6bcd4621d373cade4e832627b4f6'),
(15, 'Mrhtaccess', 'htacess', 'pruebaht@ht.com', '2019-06-11', 'PSP370.jpg', 'usuario', 'htaccess', 'dc1f12c99f7fef3c56e4c512e51cee47'),
(17, 'Test', 'numero', 'test11@test.com', '2019-06-11', 'thinking.jpg', 'usuario', 'test', '098f6bcd4621d373cade4e832627b4f6');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
