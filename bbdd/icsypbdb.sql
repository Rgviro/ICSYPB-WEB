-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-07-2015 a las 20:32:28
-- Versión del servidor: 5.6.24-0ubuntu2
-- Versión de PHP: 5.6.4-4ubuntu6

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
  `POSICION` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `TEXTO_ID` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ESTROPEADO` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `baliza`
--

INSERT INTO `baliza` (`IDBALIZA`, `MAC`, `POSICION`, `TEXTO_ID`, `ESTROPEADO`) VALUES
(1, '94:51:03:1C:C7:3C', 'pepe estropeado', 'Baliza Galaxy S2 RGV', 0),
(2, '99:99:99:99:99:99', '1', 'prieba de baliza', 0),
(3, '99:99:99:99:99:AA', '1', 'Baliza Prueba 2', 0),
(4, '58:B0:35:82:1B:69', '3', 'Macbook Carlos', 0),
(6, 'AA:BB:CC:DD:EE:FF', '3', 'prueba de baliza sin usuario', 0),
(7, 'AC:F7:F3:94:DD:51', '3', 'Xiaomi Carlos', 0),
(8, '4C:3C:16:CC:64:3E', '1', 'Galaxy S4 RGV', 0),
(9, '94:D7:71:DB:FB:9B', 'ysdgfiyfugiosau', 'Sergio', 0),
(10, 'A8:66:7F:74:8D:32', '1', 'iPhone Trilce', 0),
(11, 'D4:87:D8:6D:91:36', '2', 'Galaxy S2 Carlos', 0),
(12, '4C:74:03:5D:4D:DD', '4', 'BQ Aquaris E5', 0);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `balizasrutagestor`
--
CREATE TABLE IF NOT EXISTS `balizasrutagestor` (
`GESTOR` int(11)
,`USER` varchar(50)
,`IDRUTA` varchar(50)
,`DESCRIPCION` varchar(100)
,`IDBALIZA` varchar(50)
,`BALIZA` varchar(50)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `balizastojson`
--
CREATE TABLE IF NOT EXISTS `balizastojson` (
`IDRUTA` varchar(50)
,`IDBALIZA` int(11)
,`TEXTO_ID` varchar(50)
,`MAC` varchar(17)
,`POSICION` varchar(50)
,`IDUSUARIO` int(50)
,`ESTROPEADO` int(1)
,`EMAIL` varchar(50)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `balizastojson2`
--
CREATE TABLE IF NOT EXISTS `balizastojson2` (
`IDRUTA` varchar(50)
,`DESCRIPCION` varchar(100)
,`IDBALIZA` int(11)
,`TEXTO_ID` varchar(50)
,`MAC` varchar(17)
,`POSICION` varchar(50)
,`IDUSUARIO` int(50)
,`ESTROPEADO` int(1)
,`EMAIL` varchar(50)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `balizausuario`
--
CREATE TABLE IF NOT EXISTS `balizausuario` (
`IDBALIZA` int(50)
,`IDUSUARIO` int(11)
,`USER` varchar(50)
,`EMAIL` varchar(50)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactobaliza`
--

CREATE TABLE IF NOT EXISTS `contactobaliza` (
`IDRB` int(11) NOT NULL,
  `IDUSUARIO` int(50) NOT NULL,
  `IDBALIZA` int(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `contactobaliza`
--

INSERT INTO `contactobaliza` (`IDRB`, `IDUSUARIO`, `IDBALIZA`) VALUES
(2, 2, 2),
(3, 3, 3),
(5, 5, 6),
(7, 2, 7),
(8, 1, 8),
(9, 5, 9),
(14, 7, 12),
(15, 7, 11),
(16, 7, 10),
(17, 7, 4);

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
-- Estructura Stand-in para la vista `gestores`
--
CREATE TABLE IF NOT EXISTS `gestores` (
`IDUSUARIO` int(11)
,`USER` varchar(50)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE IF NOT EXISTS `ruta` (
`IDRUTA` int(11) NOT NULL,
  `DESCRIPCION` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ruta`
--

INSERT INTO `ruta` (`IDRUTA`, `DESCRIPCION`) VALUES
(1, 'grupo 1'),
(2, 'Ruta1'),
(3, 'Ruta2'),
(4, 'Examen'),
(5, 'TEST 1'),
(6, 'Casa S'),
(7, 'Zona de pruebas final');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutabaliza`
--

CREATE TABLE IF NOT EXISTS `rutabaliza` (
`IDRB` int(11) NOT NULL,
  `IDRUTA` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `IDBALIZA` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ORDEN` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rutabaliza`
--

INSERT INTO `rutabaliza` (`IDRB`, `IDRUTA`, `IDBALIZA`, `ORDEN`) VALUES
(1, '1', '1', 1),
(2, '2', '1', 1),
(3, '3', '1', 2),
(4, '2', '2', 3),
(5, '1', '2', 4),
(6, '2', '1', 5),
(7, '3', '3', 3),
(9, '2', '4', 5),
(10, '2', '7', 6),
(11, '2', '8', 8),
(12, '4', '8', 1),
(13, '4', '7', 2),
(14, '4', '9', 3),
(15, '4', '1', 5),
(16, '5', '4', 1),
(17, '5', '8', 2),
(18, '5', '1', 3),
(19, '5', '7', 4),
(20, '6', '12', 1),
(21, '6', '11', 2),
(22, '6', '10', 3),
(23, '6', '4', 4),
(24, '7', '10', 1),
(25, '7', '11', 2),
(26, '7', '4', 3),
(27, '7', '12', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutagestor`
--

CREATE TABLE IF NOT EXISTS `rutagestor` (
`IDRG` int(11) NOT NULL,
  `IDRUTA` int(11) NOT NULL,
  `IDUSUARIO` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rutagestor`
--

INSERT INTO `rutagestor` (`IDRG`, `IDRUTA`, `IDUSUARIO`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 4, 5),
(4, 6, 6),
(5, 7, 6);

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
  `MAC_USUARIO` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `ID_RUTA` int(11) NOT NULL,
  `ID_BALIZA` int(11) NOT NULL,
  `MAC_BALIZA` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `FECHA` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `IDTRACKPUB` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `DESC_BALIZA` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `POSICION` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tracking`
--

INSERT INTO `tracking` (`IDTRACK`, `MAC_USUARIO`, `ID_RUTA`, `ID_BALIZA`, `MAC_BALIZA`, `FECHA`, `IDTRACKPUB`, `DESC_BALIZA`, `POSICION`) VALUES
(1, '94:51:03:1C:C7:3C', 2, 2, '99:99:99:99:99:99', '30/06/2015 19:06:20', 'pepe', '', 0),
(2, '94:51:03:1C:C7:3C', 2, 2, '99:99:99:99:99:99', '30/06/2015 19:06:20', 'juan', '', 0),
(3, '99:99:99:99:99:99', 1, 1, '94:51:03:1C:C7:3C', '30/06/2015 19:06:20', '', '', 0),
(4, 'D4:87:D8:6D:91:36', 2, 8, '4C:3C:16:CC:64:3E', '01/07/2015 02:21:53', NULL, 'Galaxy S4 RGV', 1),
(5, 'D4:87:D8:6D:91:36', 2, 8, '4C:3C:16:CC:64:3E', '01/07/2015 02:21:53', NULL, 'Galaxy S4 RGV', 1),
(6, 'D4:87:D8:6D:91:36', 2, 8, '4C:3C:16:CC:64:3E', '01/07/2015 02:21:53', NULL, 'Galaxy S4 RGV', 1),
(7, 'D4:87:D8:6D:91:36', 2, 8, '4C:3C:16:CC:64:3E', '01/07/2015 02:21:53', NULL, 'Galaxy S4 RGV', 1),
(8, 'D4:87:D8:6D:91:36', 2, 8, '4C:3C:16:CC:64:3E', '01/07/2015 02:21:53', NULL, 'Galaxy S4 RGV', 1),
(9, 'D4:87:D8:6D:91:36', 2, 8, '4C:3C:16:CC:64:3E', '01/07/2015 02:21:53', NULL, 'Galaxy S4 RGV', 1),
(10, 'D4:87:D8:6D:91:36', 2, 8, '4C:3C:16:CC:64:3E', '01/07/2015 02:21:53', NULL, 'Galaxy S4 RGV', 1),
(11, 'D4:87:D8:6D:91:36', 2, 8, '4C:3C:16:CC:64:3E', '01/07/2015 02:21:53', NULL, 'Galaxy S4 RGV', 1),
(12, 'D4:87:D8:6D:91:36', 2, 8, '4C:3C:16:CC:64:3E', '01/07/2015 02:21:53', NULL, 'Galaxy S4 RGV', 1),
(13, 'D4:87:D8:6D:91:36', 2, 8, '4C:3C:16:CC:64:3E', '01/07/2015 02:21:53', NULL, 'Galaxy S4 RGV', 1),
(14, 'D4:87:D8:6D:91:36', 2, 8, '4C:3C:16:CC:64:3E', '01/07/2015 02:21:53', NULL, 'Galaxy S4 RGV', 1),
(15, 'D4:87:D8:6D:91:36', 2, 8, '4C:3C:16:CC:64:3E', '01/07/2015 02:21:53', NULL, 'Galaxy S4 RGV', 1),
(16, 'D4:87:D8:6D:91:36', 2, 8, '4C:3C:16:CC:64:3E', '01/07/2015 02:21:53', NULL, 'Galaxy S4 RGV', 1),
(17, 'D4:87:D8:6D:91:36', 2, 8, '4C:3C:16:CC:64:3E', '01/07/2015 02:21:53', NULL, 'Galaxy S4 RGV', 1),
(18, 'D4:87:D8:6D:91:36', 2, 4, '58:B0:35:82:1B:69', '01/07/2015 05:06:56', NULL, 'Macbook CCVals', 2),
(19, '4C:3C:16:CC:64:3E', 2, 4, '58:B0:35:82:1B:69', '01/07/2015 06:44:53', NULL, 'Macbook CCVals', 2),
(20, 'AC:F7:F3:94:DD:51', 4, 9, '94:D7:71:DB:FB:9B', '01/07/2015 09:54:56', NULL, 'Sergio', 0),
(21, 'AC:F7:F3:94:DD:51', 4, 9, '94:D7:71:DB:FB:9B', '01/07/2015 09:54:56', NULL, 'Sergio', 0),
(22, 'AC:F7:F3:94:DD:51', 4, 9, '94:D7:71:DB:FB:9B', '01/07/2015 09:54:56', NULL, 'Sergio', 0),
(23, 'AC:F7:F3:94:DD:51', 4, 9, '94:D7:71:DB:FB:9B', '01/07/2015 09:54:56', NULL, 'Sergio', 0),
(24, 'AC:F7:F3:94:DD:51', 2, 4, '58:B0:35:82:1B:69', '04/07/2015 07:41:39', NULL, 'Macbook CCVals', 2),
(25, 'AC:F7:F3:94:DD:51', 2, 4, '58:B0:35:82:1B:69', '04/07/2015 07:54:12', NULL, 'Macbook CCVals', 2),
(26, 'AC:F7:F3:94:DD:51', 2, 4, '58:B0:35:82:1B:69', '04/07/2015 08:02:41', '7ceb4ae9dfb8b07f68c5b73664a17e0', 'Macbook CCVals', 2),
(27, 'AC:F7:F3:94:DD:51', 2, 4, '58:B0:35:82:1B:69', '04/07/2015 08:22:03', '3943f476d27b2df0fd35a880a34b9aeb', 'Macbook CCVals', 2),
(28, 'AC:F7:F3:94:DD:51', 6, 4, '58:B0:35:82:1B:69', '05/07/2015 01:51:36', 'd655dd1fe217aa320a1c295b6245f28', 'Macbook Carlos', 0),
(29, 'AC:F7:F3:94:DD:51', 6, 11, 'D4:87:D8:6D:91:36', '05/07/2015 01:51:12', 'd655dd1fe217aa320a1c295b6245f28', 'Galaxy S2 Carlos', 0),
(30, 'AC:F7:F3:94:DD:51', 6, 12, '4C:74:03:5D:4D:DD', '05/07/2015 01:51:11', 'd655dd1fe217aa320a1c295b6245f28', 'BQ Aquaris E5', 0),
(31, 'AC:F7:F3:94:DD:51', 6, 11, 'D4:87:D8:6D:91:36', '05/07/2015 01:51:12', 'cca1d884b3b52839c2667241eed77320', 'Galaxy S2 Carlos', 0),
(32, 'AC:F7:F3:94:DD:51', 6, 12, '4C:74:03:5D:4D:DD', '05/07/2015 01:51:11', 'cca1d884b3b52839c2667241eed77320', 'BQ Aquaris E5', 0),
(33, 'AC:F7:F3:94:DD:51', 6, 4, '58:B0:35:82:1B:69', '05/07/2015 01:51:36', 'cca1d884b3b52839c2667241eed77320', 'Macbook Carlos', 0),
(34, 'AC:F7:F3:94:DD:51', 6, 4, '58:B0:35:82:1B:69', '05/07/2015 02:02:29', 'e06a94c549a1b3e7cfc69ca9edd7df42', 'Macbook Carlos', 0),
(35, 'AC:F7:F3:94:DD:51', 6, 11, 'D4:87:D8:6D:91:36', '05/07/2015 02:02:24', 'e06a94c549a1b3e7cfc69ca9edd7df42', 'Galaxy S2 Carlos', 0),
(36, 'AC:F7:F3:94:DD:51', 6, 12, '4C:74:03:5D:4D:DD', '05/07/2015 02:02:22', 'e06a94c549a1b3e7cfc69ca9edd7df42', 'BQ Aquaris E5', 0),
(37, 'AC:F7:F3:94:DD:51', 6, 10, 'A8:66:7F:74:8D:32', '05/07/2015 02:12:05', '6c5b23301bb94cc8782191c04e2ad56a', 'iPhone Trilce', 1),
(38, 'AC:F7:F3:94:DD:51', 6, 11, 'D4:87:D8:6D:91:36', '05/07/2015 02:11:48', '6c5b23301bb94cc8782191c04e2ad56a', 'Galaxy S2 Carlos', 2),
(39, 'AC:F7:F3:94:DD:51', 6, 12, '4C:74:03:5D:4D:DD', '05/07/2015 02:11:47', '6c5b23301bb94cc8782191c04e2ad56a', 'BQ Aquaris E5', 4),
(40, 'AC:F7:F3:94:DD:51', 6, 4, '58:B0:35:82:1B:69', '05/07/2015 02:11:46', '6c5b23301bb94cc8782191c04e2ad56a', 'Macbook Carlos', 3),
(41, 'AC:F7:F3:94:DD:51', 7, 10, 'A8:66:7F:74:8D:32', '05/07/2015 02:39:25', '746d146e3a47a8de53f19f332056e473', 'iPhone Trilce', 1),
(42, 'AC:F7:F3:94:DD:51', 7, 12, '4C:74:03:5D:4D:DD', '05/07/2015 02:39:25', '746d146e3a47a8de53f19f332056e473', 'BQ Aquaris E5', 4),
(43, 'AC:F7:F3:94:DD:51', 7, 4, '58:B0:35:82:1B:69', '05/07/2015 02:39:24', '746d146e3a47a8de53f19f332056e473', 'Macbook Carlos', 3),
(44, 'AC:F7:F3:94:DD:51', 7, 11, 'D4:87:D8:6D:91:36', '05/07/2015 02:39:24', '746d146e3a47a8de53f19f332056e473', 'Galaxy S2 Carlos', 2);

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
  `IDTIPO` int(11) NOT NULL,
  `EMAIL` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `TFNO` varchar(14) COLLATE utf8_spanish_ci NOT NULL,
  `PASSWD` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IDUSUARIO`, `USER`, `NOMBRE`, `APELLIDO1`, `APELLIDO2`, `IDTIPO`, `EMAIL`, `TFNO`, `PASSWD`) VALUES
(1, 'Rafa', 'Rafael', 'Garrido', 'Viro', 1, 'rgviro@hotmail.com', '651083287', '4eeef8fe6b93589e035ec15fe261b8aaefa258c7'),
(2, 'CarlosA', 'Carlos', 'Crisóstomo', 'Vals', 1, 'ccvals@gmail.com', '678904079', '4eeef8fe6b93589e035ec15fe261b8aaefa258c7'),
(3, 'RafaG', 'Rafael', 'Garrido', 'Viro', 2, 'rgviro@hotmail.com', '651083287', '4eeef8fe6b93589e035ec15fe261b8aaefa258c7'),
(4, 'RafaU', 'Rafael', 'Garrido', 'Viro', 3, 'rgviro@hotmail.com', '651083287', '32c20d0b481f9818a20c085d6df8438837103b69'),
(5, 'Sergio', 'Sergio', 'Rios', 'Aguilar', 1, 'srios@upsam.es', '666555444', '4eeef8fe6b93589e035ec15fe261b8aaefa258c7'),
(6, 'CarlosG', 'Carlos', 'Crisóstomo', 'Vals', 2, 'ccvals@gmail.com', '678904079', '4eeef8fe6b93589e035ec15fe261b8aaefa258c7'),
(7, 'CarlosU', 'Carlos', 'Crisóstomo', 'Vals', 3, 'ccvals@gmail.com', '678904079', '4eeef8fe6b93589e035ec15fe261b8aaefa258c7');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `verbalizas`
--
CREATE TABLE IF NOT EXISTS `verbalizas` (
`GESTOR` int(11)
,`USER` varchar(50)
,`IDRUTA` varchar(50)
,`DESCRIPCION` varchar(100)
,`IDBALIZA` varchar(50)
,`MAC` varchar(17)
,`BALIZA` varchar(50)
,`POSICION` varchar(50)
,`ESTROPEADO` int(1)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewtrackpub`
--
CREATE TABLE IF NOT EXISTS `viewtrackpub` (
`IDTRACK` int(6)
,`MAC_USUARIO` varchar(20)
,`ID_RUTA` int(11)
,`DESCRIPCION` varchar(100)
,`GESTOR` varchar(50)
,`EMAIL_GESTOR` varchar(50)
,`ID_BALIZA` int(11)
,`MAC_BALIZA` varchar(20)
,`TEXTO_ID` varchar(50)
,`POSICION` varchar(50)
,`RESPONSABLE_BALIZA` varchar(50)
,`EMAIL_RESPONSABLE` varchar(50)
,`FECHA` varchar(30)
,`IDTRACKPUB` varchar(100)
,`DESC_BALIZA` varchar(100)
,`POS_TRACKING` int(100)
);
-- --------------------------------------------------------

--
-- Estructura para la vista `balizasrutagestor`
--
DROP TABLE IF EXISTS `balizasrutagestor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `balizasrutagestor` AS (select distinct `rutagestor`.`IDUSUARIO` AS `GESTOR`,`usuario`.`USER` AS `USER`,`rutabaliza`.`IDRUTA` AS `IDRUTA`,`ruta`.`DESCRIPCION` AS `DESCRIPCION`,`rutabaliza`.`IDBALIZA` AS `IDBALIZA`,`baliza`.`TEXTO_ID` AS `BALIZA` from ((((`rutagestor` join `usuario`) join `ruta`) join `rutabaliza`) join `baliza`) where ((`rutagestor`.`IDUSUARIO` = `usuario`.`IDUSUARIO`) and (`rutagestor`.`IDRUTA` = `ruta`.`IDRUTA`) and (`ruta`.`IDRUTA` = `rutabaliza`.`IDRUTA`) and (`rutabaliza`.`IDBALIZA` = `baliza`.`IDBALIZA`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `balizastojson`
--
DROP TABLE IF EXISTS `balizastojson`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `balizastojson` AS select `rutabaliza`.`IDRUTA` AS `IDRUTA`,`baliza`.`IDBALIZA` AS `IDBALIZA`,`baliza`.`TEXTO_ID` AS `TEXTO_ID`,`baliza`.`MAC` AS `MAC`,`baliza`.`POSICION` AS `POSICION`,`contactobaliza`.`IDUSUARIO` AS `IDUSUARIO`,`baliza`.`ESTROPEADO` AS `ESTROPEADO`,`usuario`.`EMAIL` AS `EMAIL` from (((`rutabaliza` join `baliza`) join `contactobaliza`) join `usuario`) where ((`rutabaliza`.`IDBALIZA` = `baliza`.`IDBALIZA`) and (`baliza`.`IDBALIZA` = `contactobaliza`.`IDBALIZA`) and (`contactobaliza`.`IDUSUARIO` = `usuario`.`IDUSUARIO`)) order by `rutabaliza`.`IDRUTA`,`baliza`.`IDBALIZA`;

-- --------------------------------------------------------

--
-- Estructura para la vista `balizastojson2`
--
DROP TABLE IF EXISTS `balizastojson2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `balizastojson2` AS select `rutabaliza`.`IDRUTA` AS `IDRUTA`,`ruta`.`DESCRIPCION` AS `DESCRIPCION`,`baliza`.`IDBALIZA` AS `IDBALIZA`,`baliza`.`TEXTO_ID` AS `TEXTO_ID`,`baliza`.`MAC` AS `MAC`,`baliza`.`POSICION` AS `POSICION`,`contactobaliza`.`IDUSUARIO` AS `IDUSUARIO`,`baliza`.`ESTROPEADO` AS `ESTROPEADO`,`usuario`.`EMAIL` AS `EMAIL` from ((((`rutabaliza` join `ruta`) join `baliza`) join `contactobaliza`) join `usuario`) where ((`rutabaliza`.`IDRUTA` = `ruta`.`IDRUTA`) and (`rutabaliza`.`IDBALIZA` = `baliza`.`IDBALIZA`) and (`baliza`.`IDBALIZA` = `contactobaliza`.`IDBALIZA`) and (`contactobaliza`.`IDUSUARIO` = `usuario`.`IDUSUARIO`)) order by `rutabaliza`.`IDRUTA`,`baliza`.`IDBALIZA`;

-- --------------------------------------------------------

--
-- Estructura para la vista `balizausuario`
--
DROP TABLE IF EXISTS `balizausuario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `balizausuario` AS select `contactobaliza`.`IDBALIZA` AS `IDBALIZA`,`usuario`.`IDUSUARIO` AS `IDUSUARIO`,`usuario`.`USER` AS `USER`,`usuario`.`EMAIL` AS `EMAIL` from (`contactobaliza` join `usuario`) where (`contactobaliza`.`IDUSUARIO` = `usuario`.`IDUSUARIO`) order by `contactobaliza`.`IDBALIZA`,`usuario`.`IDUSUARIO`;

-- --------------------------------------------------------

--
-- Estructura para la vista `gestores`
--
DROP TABLE IF EXISTS `gestores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `gestores` AS (select distinct `usuario`.`IDUSUARIO` AS `IDUSUARIO`,`usuario`.`USER` AS `USER` from `usuario` where ((`usuario`.`IDTIPO` = 2) or (`usuario`.`IDTIPO` = 1)));

-- --------------------------------------------------------

--
-- Estructura para la vista `verbalizas`
--
DROP TABLE IF EXISTS `verbalizas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `verbalizas` AS (select distinct `rutagestor`.`IDUSUARIO` AS `GESTOR`,`usuario`.`USER` AS `USER`,`rutabaliza`.`IDRUTA` AS `IDRUTA`,`ruta`.`DESCRIPCION` AS `DESCRIPCION`,`rutabaliza`.`IDBALIZA` AS `IDBALIZA`,`baliza`.`MAC` AS `MAC`,`baliza`.`TEXTO_ID` AS `BALIZA`,`baliza`.`POSICION` AS `POSICION`,`baliza`.`ESTROPEADO` AS `ESTROPEADO` from ((((`rutagestor` join `usuario`) join `ruta`) join `rutabaliza`) join `baliza`) where ((`rutagestor`.`IDUSUARIO` = `usuario`.`IDUSUARIO`) and (`rutagestor`.`IDRUTA` = `ruta`.`IDRUTA`) and (`ruta`.`IDRUTA` = `rutabaliza`.`IDRUTA`) and (`rutabaliza`.`IDBALIZA` = `baliza`.`IDBALIZA`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `viewtrackpub`
--
DROP TABLE IF EXISTS `viewtrackpub`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewtrackpub` AS (select `tracking`.`IDTRACK` AS `IDTRACK`,`tracking`.`MAC_USUARIO` AS `MAC_USUARIO`,`tracking`.`ID_RUTA` AS `ID_RUTA`,`ruta`.`DESCRIPCION` AS `DESCRIPCION`,`usuario_1`.`USER` AS `GESTOR`,`usuario_1`.`EMAIL` AS `EMAIL_GESTOR`,`tracking`.`ID_BALIZA` AS `ID_BALIZA`,`tracking`.`MAC_BALIZA` AS `MAC_BALIZA`,`baliza`.`TEXTO_ID` AS `TEXTO_ID`,`baliza`.`POSICION` AS `POSICION`,`usuario`.`USER` AS `RESPONSABLE_BALIZA`,`usuario`.`EMAIL` AS `EMAIL_RESPONSABLE`,`tracking`.`FECHA` AS `FECHA`,`tracking`.`IDTRACKPUB` AS `IDTRACKPUB`,`tracking`.`DESC_BALIZA` AS `DESC_BALIZA`,`tracking`.`POSICION` AS `POS_TRACKING` from (`usuario` join (`contactobaliza` join (`usuario` `usuario_1` join (`rutagestor` join (`ruta` join (`baliza` join `tracking` on((`baliza`.`IDBALIZA` = `tracking`.`ID_BALIZA`))) on((`ruta`.`IDRUTA` = `tracking`.`ID_RUTA`))) on((`rutagestor`.`IDRUTA` = `ruta`.`IDRUTA`))) on((`usuario_1`.`IDUSUARIO` = `rutagestor`.`IDUSUARIO`))) on((`contactobaliza`.`IDBALIZA` = `baliza`.`IDBALIZA`))) on((`usuario`.`IDUSUARIO` = `contactobaliza`.`IDUSUARIO`))));

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `baliza`
--
ALTER TABLE `baliza`
 ADD PRIMARY KEY (`IDBALIZA`);

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
-- Indices de la tabla `rutagestor`
--
ALTER TABLE `rutagestor`
 ADD PRIMARY KEY (`IDRG`);

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
MODIFY `IDBALIZA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `contactobaliza`
--
ALTER TABLE `contactobaliza`
MODIFY `IDRB` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `dispositivo`
--
ALTER TABLE `dispositivo`
MODIFY `IDDISP` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
MODIFY `IDRUTA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `rutabaliza`
--
ALTER TABLE `rutabaliza`
MODIFY `IDRB` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `rutagestor`
--
ALTER TABLE `rutagestor`
MODIFY `IDRG` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
MODIFY `IDTIPO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tracking`
--
ALTER TABLE `tracking`
MODIFY `IDTRACK` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `IDUSUARIO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
