-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2015 a las 13:19:42
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `icsypbdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `baliza`
--

CREATE TABLE IF NOT EXISTS `baliza` (
  `IDBALIZA` int(11) NOT NULL,
  `MAC` varchar(17) COLLATE utf8_spanish_ci NOT NULL,
  `POSICION` int(11) NOT NULL,
  `TEXTO_ID` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ID_CONTACTO` int(11) NOT NULL,
  `ESTROPEADO` int(1) NOT NULL,
  `MAIL` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `baliza`
--

INSERT INTO `baliza` (`IDBALIZA`, `MAC`, `POSICION`, `TEXTO_ID`, `ID_CONTACTO`, `ESTROPEADO`, `MAIL`) VALUES
(1, '94:51:03:1C:C7:3C', 0, 'Baliza Galaxy S2 RGV', 1, 0, 'rgviro@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactobaliza`
--

CREATE TABLE IF NOT EXISTS `contactobaliza` (
  `IDRB` int(11) NOT NULL,
  `IDUSUARIO` int(50) NOT NULL,
  `IDBALIZA` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ORDEN` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivo`
--

CREATE TABLE IF NOT EXISTS `dispositivo` (
  `IDDISP` int(11) NOT NULL,
  `MAC` varchar(17) COLLATE utf8_spanish_ci NOT NULL,
  `DESCRIPCION` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dispositivo`
--

INSERT INTO `dispositivo` (`IDDISP`, `MAC`, `DESCRIPCION`) VALUES
(1, '94:51:03:1C:C7:3C', 'Baliza Samsung Galaxy S2 RGV');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `jsonenvio1`
--
CREATE TABLE IF NOT EXISTS `jsonenvio1` (
`DESCRIPCION` varchar(100)
,`IDRUTA` int(11)
,`ORDEN` int(11)
,`IDBALIZA` int(11)
,`TEXTO_ID` varchar(50)
,`MAC` varchar(17)
,`POSICION` int(11)
,`ID_CONTACTO` int(11)
,`ESTROPEADO` int(1)
,`MAIL` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `prueba`
--
CREATE TABLE IF NOT EXISTS `prueba` (
`DESCRIPCION` varchar(100)
,`IDRUTA` int(11)
,`ORDEN` int(11)
,`IDBALIZA` int(11)
,`TEXTO_ID` varchar(50)
,`MAC` varchar(17)
,`POSICION` int(11)
,`ID_CONTACTO` int(11)
,`ESTROPEADO` int(1)
,`MAIL` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE IF NOT EXISTS `ruta` (
  `IDRUTA` int(11) NOT NULL,
  `DESCRIPCION` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ruta`
--

INSERT INTO `ruta` (`IDRUTA`, `DESCRIPCION`) VALUES
(1, 'grupo 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutabaliza`
--

CREATE TABLE IF NOT EXISTS `rutabaliza` (
  `IDRB` int(11) NOT NULL,
  `IDRUTA` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `IDBALIZA` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ORDEN` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rutabaliza`
--

INSERT INTO `rutabaliza` (`IDRB`, `IDRUTA`, `IDBALIZA`, `ORDEN`) VALUES
(1, '1', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE IF NOT EXISTS `tipousuario` (
  `IDTIPO` int(11) NOT NULL,
  `DESCRIPCION` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `IDPRIVILEGIO` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`IDTIPO`, `DESCRIPCION`, `IDPRIVILEGIO`) VALUES
(1, 'Administrador', 1),
(2, 'Gestor', 2),
(3, 'Usuario', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tracking`
--

CREATE TABLE IF NOT EXISTS `tracking` (
  `IDTRACK` int(6) NOT NULL,
  `IDUSUARIO` int(11) NOT NULL,
  `IDRUTA` int(11) NOT NULL,
  `IDDISP` int(11) NOT NULL,
  `IDBALIZA` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `DIA` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trackingpublico`
--

CREATE TABLE IF NOT EXISTS `trackingpublico` (
  `IDTRACKPUBLICO` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `IDTRACK` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `IDUSUARIO` int(11) NOT NULL,
  `USER` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `NOMBRE` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDO1` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDO2` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ID_TIPO` int(11) NOT NULL,
  `EMAIL` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `TFNO` varchar(14) COLLATE utf8_spanish_ci NOT NULL,
  `PASSWD` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IDUSUARIO`, `USER`, `NOMBRE`, `APELLIDO1`, `APELLIDO2`, `ID_TIPO`, `EMAIL`, `TFNO`, `PASSWD`) VALUES
(1, 'Rafa', 'Rafael', 'Garrido', 'Viro', 1, 'rgviro@hotmail.com', '651083287', 'ICSYPB');

-- --------------------------------------------------------

--
-- Estructura para la vista `jsonenvio1`
--
DROP TABLE IF EXISTS `jsonenvio1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `jsonenvio1` AS (select `ruta`.`DESCRIPCION` AS `DESCRIPCION`,`ruta`.`IDRUTA` AS `IDRUTA`,`rutabaliza`.`ORDEN` AS `ORDEN`,`baliza`.`IDBALIZA` AS `IDBALIZA`,`baliza`.`TEXTO_ID` AS `TEXTO_ID`,`baliza`.`MAC` AS `MAC`,`baliza`.`POSICION` AS `POSICION`,`baliza`.`ID_CONTACTO` AS `ID_CONTACTO`,`baliza`.`ESTROPEADO` AS `ESTROPEADO`,`baliza`.`MAIL` AS `MAIL` from ((`ruta` left join `rutabaliza` on((`ruta`.`IDRUTA` = `rutabaliza`.`IDRUTA`))) left join `baliza` on((`rutabaliza`.`IDBALIZA` = `baliza`.`IDBALIZA`))) order by `ruta`.`IDRUTA`,`rutabaliza`.`ORDEN`,`baliza`.`IDBALIZA`);

-- --------------------------------------------------------

--
-- Estructura para la vista `prueba`
--
DROP TABLE IF EXISTS `prueba`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `prueba` AS (select `ruta`.`DESCRIPCION` AS `DESCRIPCION`,`ruta`.`IDRUTA` AS `IDRUTA`,`rutabaliza`.`ORDEN` AS `ORDEN`,`baliza`.`IDBALIZA` AS `IDBALIZA`,`baliza`.`TEXTO_ID` AS `TEXTO_ID`,`baliza`.`MAC` AS `MAC`,`baliza`.`POSICION` AS `POSICION`,`baliza`.`ID_CONTACTO` AS `ID_CONTACTO`,`baliza`.`ESTROPEADO` AS `ESTROPEADO`,`baliza`.`MAIL` AS `MAIL` from ((`ruta` left join `rutabaliza` on((`ruta`.`IDRUTA` = `rutabaliza`.`IDRUTA`))) left join `baliza` on((`rutabaliza`.`IDBALIZA` = `baliza`.`IDBALIZA`))) order by `ruta`.`IDRUTA`,`rutabaliza`.`ORDEN`,`baliza`.`IDBALIZA`);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `baliza`
--
ALTER TABLE `baliza`
  ADD PRIMARY KEY (`IDBALIZA`), ADD KEY `CONVOCATORIA_ibfk_1` (`ID_CONTACTO`);

--
-- Indices de la tabla `contactobaliza`
--
ALTER TABLE `contactobaliza`
  ADD PRIMARY KEY (`IDRB`);

--
-- Indices de la tabla `dispositivo`
--
ALTER TABLE `dispositivo`
  ADD PRIMARY KEY (`IDDISP`);

--
-- Indices de la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD PRIMARY KEY (`IDRUTA`);

--
-- Indices de la tabla `rutabaliza`
--
ALTER TABLE `rutabaliza`
  ADD PRIMARY KEY (`IDRB`), ADD KEY `IDRUTA` (`IDRUTA`), ADD KEY `IDBALIZA` (`IDBALIZA`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`IDTIPO`);

--
-- Indices de la tabla `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`IDTRACK`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IDUSUARIO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `baliza`
--
ALTER TABLE `baliza`
  MODIFY `IDBALIZA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `contactobaliza`
--
ALTER TABLE `contactobaliza`
  MODIFY `IDRB` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dispositivo`
--
ALTER TABLE `dispositivo`
  MODIFY `IDDISP` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `IDRUTA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `rutabaliza`
--
ALTER TABLE `rutabaliza`
  MODIFY `IDRB` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `IDTIPO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tracking`
--
ALTER TABLE `tracking`
  MODIFY `IDTRACK` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IDUSUARIO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
