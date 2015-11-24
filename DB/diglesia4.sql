-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-11-2015 a las 04:29:31
-- Versión del servidor: 5.1.41
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `diglesia4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archiprestazgo`
--

CREATE TABLE IF NOT EXISTS `archiprestazgo` (
  `codigoArchiPrestazgo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigoArchiPrestazgo`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `archiprestazgo`
--

INSERT INTO `archiprestazgo` (`codigoArchiPrestazgo`, `nombre`, `Estatus`) VALUES
(1, 'ACARIGUA NORTE', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificado`
--

CREATE TABLE IF NOT EXISTS `certificado` (
  `codigo` int(11) NOT NULL,
  `codigo_sacra` int(11) NOT NULL,
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `codigo_sacra` (`codigo_sacra`),
  KEY `fsacra_codigo_idx` (`codigo_sacra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `certificado`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE IF NOT EXISTS `ciudad` (
  `cod_ciudad` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `cod_foraneo` int(11) NOT NULL,
  `Estatus` char(1) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`cod_ciudad`),
  UNIQUE KEY `descripcion` (`descripcion`),
  KEY `cod_foraneo` (`cod_foraneo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=13 ;

--
-- Volcar la base de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`cod_ciudad`, `descripcion`, `cod_foraneo`, `Estatus`) VALUES
(1, 'ACARIGUA', 1, '1'),
(12, 'MARACAIBO', 17, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_grupo`
--

CREATE TABLE IF NOT EXISTS `detalle_grupo` (
  `Detalle_Grupocol` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_persona` int(11) NOT NULL,
  `codigo_grupo` int(11) NOT NULL,
  `idFparroquiaIglesia` int(11) NOT NULL,
  `FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Detalle_Grupocol`),
  UNIQUE KEY `codigo_persona` (`codigo_persona`,`codigo_grupo`,`idFparroquiaIglesia`),
  KEY `codigo_idx` (`codigo_grupo`),
  KEY `fk_codigoPersona_idx` (`codigo_persona`),
  KEY `idFparroquiaIglesia` (`idFparroquiaIglesia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Volcar la base de datos para la tabla `detalle_grupo`
--

INSERT INTO `detalle_grupo` (`Detalle_Grupocol`, `codigo_persona`, `codigo_grupo`, `idFparroquiaIglesia`, `FechaRegistro`, `Estatus`) VALUES
(1, 980, 2, 2, '2015-11-02 11:05:13', '1'),
(2, 974, 2, 2, '2015-11-02 11:05:13', '1'),
(5, 975, 3, 4, '2015-11-02 11:21:44', '0'),
(6, 984, 3, 2, '2015-11-02 11:21:44', '1'),
(9, 1000, 3, 2, '2015-11-02 15:35:43', '1'),
(19, 1030, 3, 2, '2015-11-02 15:50:21', '1'),
(20, 1031, 1, 3, '2015-11-02 16:16:58', '1'),
(21, 2, 2, 4, '2015-11-03 00:55:11', '1'),
(22, 1033, 1, 2, '2015-11-03 01:05:11', '1'),
(24, 948, 2, 4, '2015-11-08 23:19:05', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pastoral`
--

CREATE TABLE IF NOT EXISTS `detalle_pastoral` (
  `Detalle_Pastoralcol` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_persona` int(11) NOT NULL,
  `codigo_pastoral` int(11) NOT NULL,
  `FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Detalle_Pastoralcol`),
  UNIQUE KEY `codigo_persona` (`codigo_persona`,`codigo_pastoral`),
  KEY `fk_codigo_pastoral_idx` (`codigo_pastoral`),
  KEY `fk_codigo_persona_idx` (`codigo_persona`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Volcar la base de datos para la tabla `detalle_pastoral`
--

INSERT INTO `detalle_pastoral` (`Detalle_Pastoralcol`, `codigo_persona`, `codigo_pastoral`, `FechaRegistro`, `Estatus`) VALUES
(1, 983, 2, '0000-00-00 00:00:00', '1'),
(2, 975, 2, '0000-00-00 00:00:00', '1'),
(3, 982, 2, '0000-00-00 00:00:00', '1'),
(10, 981, 3, '2015-11-08 23:12:09', '1'),
(11, 948, 3, '2015-11-08 23:14:17', '1'),
(15, 1, 3, '2015-11-08 23:23:05', '1'),
(25, 1040, 3, '2015-11-08 23:43:20', '1'),
(26, 1135, 1, '2015-11-08 23:49:15', '1'),
(36, 945, 4, '2015-11-09 00:08:58', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `cod_estado` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cod_estado`),
  UNIQUE KEY `descripcion` (`descripcion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcar la base de datos para la tabla `estado`
--

INSERT INTO `estado` (`cod_estado`, `descripcion`, `Estatus`) VALUES
(1, 'ZULIA', '1'),
(17, 'PORTUGUESA', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE IF NOT EXISTS `municipio` (
  `cod_municipio` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `cod_foraneo` int(11) NOT NULL,
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cod_municipio`),
  UNIQUE KEY `descripcion` (`descripcion`),
  KEY `cod_estado` (`cod_foraneo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Volcar la base de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`cod_municipio`, `descripcion`, `cod_foraneo`, `Estatus`) VALUES
(1, 'ARAURE', 17, '1'),
(29, 'PAEZ', 17, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parentescorepre`
--

CREATE TABLE IF NOT EXISTS `parentescorepre` (
  `idTparentescoRepre` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `Estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idTparentescoRepre`),
  UNIQUE KEY `Nombre` (`Nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `parentescorepre`
--

INSERT INTO `parentescorepre` (`idTparentescoRepre`, `Nombre`, `Estatus`) VALUES
(1, 'MAMA', 1),
(2, 'PAPA', 1),
(3, 'TIO', 1),
(4, 'TIA', 1),
(5, 'ABUELA', 1),
(6, 'ABUELO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquia`
--

CREATE TABLE IF NOT EXISTS `parroquia` (
  `cod_parroquia` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `cod_foraneo` int(11) NOT NULL,
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cod_parroquia`),
  UNIQUE KEY `descripcion` (`descripcion`),
  KEY `cod_municipio` (`cod_foraneo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Volcar la base de datos para la tabla `parroquia`
--

INSERT INTO `parroquia` (`cod_parroquia`, `descripcion`, `cod_foraneo`, `Estatus`) VALUES
(1, 'ARAURE', 29, '1'),
(48, 'ACARIGUA', 29, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `idTRol` int(11) NOT NULL AUTO_INCREMENT,
  `Prefijo` char(1) COLLATE utf8_spanish2_ci NOT NULL,
  `Descripcion` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `Estatus` char(1) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`idTRol`),
  UNIQUE KEY `Prefijo` (`Prefijo`),
  UNIQUE KEY `Descripcion` (`Descripcion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `rol`
--

INSERT INTO `rol` (`idTRol`, `Prefijo`, `Descripcion`, `Estatus`) VALUES
(1, 'S', 'Sacerdote', '1'),
(2, 'A', 'Administrador', '1'),
(3, 'O', 'Operador', '1'),
(4, 'F', 'Feligres', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tactividad`
--

CREATE TABLE IF NOT EXISTS `tactividad` (
  `codigoActividad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `tipo_actividad` int(11) NOT NULL,
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigoActividad`),
  KEY `tipo_actividad` (`tipo_actividad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcar la base de datos para la tabla `tactividad`
--

INSERT INTO `tactividad` (`codigoActividad`, `nombre`, `tipo_actividad`, `Estatus`) VALUES
(1, 'Curso bla bla', 1, '1'),
(3, 'Juegos Varios', 3, '1'),
(4, 'CHARADAS', 3, '0'),
(5, 'Fiesta', 3, '1'),
(6, 'Baile ', 1, '1'),
(7, 'QWEQWE', 2, '1'),
(8, 'REGHGFD', 3, '1'),
(9, 'qweqw', 1, '1'),
(10, 'qwe', 2, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tagendadiocesana`
--

CREATE TABLE IF NOT EXISTS `tagendadiocesana` (
  `codigoAgenda` int(11) NOT NULL AUTO_INCREMENT,
  `idFcodigo_actividad` int(11) NOT NULL,
  `fecha_act_Inicio` date NOT NULL,
  `hora_act_Inicio` time NOT NULL,
  `fecha_act_Fin` date NOT NULL,
  `hora_act_Fin` time NOT NULL,
  `idFcodigo_pastoral` int(11) DEFAULT NULL,
  `lugar` varchar(100) NOT NULL,
  `idFcodigo_grupo` int(11) DEFAULT NULL,
  `FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `EstadoAgenda` bit(1) NOT NULL,
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigoAgenda`),
  UNIQUE KEY `idFcodigo_actividad` (`idFcodigo_actividad`,`fecha_act_Inicio`,`hora_act_Inicio`,`fecha_act_Fin`,`hora_act_Fin`,`idFcodigo_pastoral`,`lugar`,`idFcodigo_grupo`),
  KEY `idFcodigo_actividad_2` (`idFcodigo_actividad`),
  KEY `idFcodigo_pastoral` (`idFcodigo_pastoral`),
  KEY `idFcodigo_grupo` (`idFcodigo_grupo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Volcar la base de datos para la tabla `tagendadiocesana`
--

INSERT INTO `tagendadiocesana` (`codigoAgenda`, `idFcodigo_actividad`, `fecha_act_Inicio`, `hora_act_Inicio`, `fecha_act_Fin`, `hora_act_Fin`, `idFcodigo_pastoral`, `lugar`, `idFcodigo_grupo`, `FechaRegistro`, `EstadoAgenda`, `Estatus`) VALUES
(2, 5, '2015-10-14', '11:22:00', '0000-00-00', '00:00:00', 2, 'qweqweq', 1, '2015-10-17 00:00:00', b'0', '1'),
(10, 1, '2015-10-15', '02:03:00', '0000-00-00', '00:00:00', 2, 'wedqwedasdasd', 1, '2015-10-27 12:56:02', b'0', '1'),
(11, 3, '2015-10-15', '02:13:00', '0000-00-00', '00:00:00', 2, 'wqeqweqwe', 1, '2015-10-27 12:57:44', b'0', '0'),
(12, 4, '2015-10-15', '12:03:00', '0000-00-00', '00:00:00', 2, 'sdsdfadsadsads', 1, '2015-10-27 12:58:23', b'0', '1'),
(13, 4, '2015-11-11', '02:13:00', '0000-00-00', '00:00:00', 2, 'asdasdawqe', 1, '2015-10-27 13:16:31', b'0', '0'),
(16, 1, '2015-10-16', '02:11:00', '0000-00-00', '00:00:00', 2, 'sadasdasd', 1, '2015-10-27 13:23:25', b'0', '1'),
(19, 3, '2015-10-20', '00:32:00', '0000-00-00', '00:00:00', 2, 'wqeqweqweqwe', 1, '2015-10-27 13:24:49', b'0', '1'),
(21, 3, '2015-10-21', '03:31:00', '0000-00-00', '00:00:00', 2, 'eqweqqweqwe', 1, '2015-10-27 13:26:39', b'0', '1'),
(22, 3, '2015-11-19', '15:24:00', '0000-00-00', '00:00:00', 2, 'sdffdssfdfsdasfd', 1, '2015-10-27 13:27:24', b'0', '1'),
(23, 3, '2015-10-08', '02:13:00', '0000-00-00', '00:00:00', 2, 'asdsdaasd asd', 1, '2015-10-27 13:28:32', b'0', '0'),
(24, 3, '2015-12-01', '04:51:00', '0000-00-00', '00:00:00', 2, 'gjgjghy', 1, '2015-10-28 02:02:11', b'0', '1'),
(25, 1, '2015-04-01', '15:24:00', '0000-00-00', '00:00:00', 2, 'werwer', 1, '2015-10-28 02:02:30', b'0', '1'),
(26, 3, '2015-10-05', '02:34:00', '0000-00-00', '00:00:00', 2, 'qweqweqwe', 1, '2015-10-28 02:03:23', b'0', '1'),
(27, 6, '2015-10-05', '00:21:00', '0000-00-00', '00:00:00', 2, 'qweqweqwe', 1, '2015-10-28 02:07:16', b'0', '1'),
(28, 1, '2015-10-05', '00:21:00', '0000-00-00', '00:00:00', 2, 'qweqweqwe', 1, '2015-10-28 02:07:49', b'0', '1'),
(29, 3, '2015-11-05', '15:24:00', '0000-00-00', '00:00:00', 2, 'wqeqweqwe', 1, '2015-10-28 02:08:57', b'0', '1'),
(30, 1, '2015-12-02', '14:34:00', '0000-00-00', '00:00:00', 2, 'reqwqweqwe', 1, '2015-10-28 02:09:23', b'0', '0'),
(32, 6, '2015-10-06', '00:33:00', '0000-00-00', '00:00:00', 2, 'Centro', 1, '2015-10-28 03:26:42', b'0', '1'),
(33, 3, '2015-10-07', '02:33:00', '0000-00-00', '00:00:00', 2, 'weqqwe', 1, '2015-10-28 03:35:42', b'0', '0'),
(34, 1, '2015-10-06', '00:32:00', '0000-00-00', '00:00:00', 2, 'eqweqwe', 1, '2015-10-28 04:30:14', b'0', '1'),
(37, 1, '2015-10-08', '12:31:00', '0000-00-00', '00:00:00', 2, 'wqeqweqwe', 1, '2015-10-28 17:47:29', b'0', '1'),
(38, 1, '2015-11-04', '00:52:00', '0000-00-00', '00:00:00', 3, 'LA CAPILLA', 1, '2015-11-02 22:37:37', b'0', '1'),
(39, 1, '2015-11-04', '00:58:00', '0000-00-00', '00:00:00', 3, 'LA CAPILLA', 1, '2015-11-02 22:38:49', b'0', '1'),
(40, 4, '2015-11-04', '00:58:00', '0000-00-00', '00:00:00', 3, 'LA CAPILLA', 1, '2015-11-02 22:40:48', b'0', '0'),
(41, 4, '2015-11-02', '19:00:00', '0000-00-00', '00:00:00', 3, 'CAPILLA', 1, '2015-11-02 22:51:04', b'0', '1'),
(42, 3, '2015-11-10', '12:03:00', '0000-00-00', '00:00:00', 1, 'qweqweq', 1, '2015-11-05 16:11:34', b'1', '0'),
(43, 9, '2015-11-10', '12:03:00', '0000-00-00', '00:00:00', 1, 'wqeqwe', 2, '2015-11-05 16:11:58', b'1', '1'),
(44, 4, '2015-11-12', '14:13:00', '0000-00-00', '00:00:00', 1, 'qweqwe', 3, '2015-11-05 16:23:19', b'1', '1'),
(45, 3, '2015-11-02', '12:31:00', '0000-00-00', '00:00:00', 3, 'sdfsdfs', 2, '2015-11-09 21:19:08', b'1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tagendaparroquial`
--

CREATE TABLE IF NOT EXISTS `tagendaparroquial` (
  `codigoAgenda` int(11) NOT NULL AUTO_INCREMENT,
  `idFcodigo_actividad` int(11) NOT NULL,
  `fecha_act_Inicio` date NOT NULL,
  `hora_act_Inicio` time NOT NULL,
  `fecha_act_Fin` date NOT NULL,
  `hora_act_Fin` time NOT NULL,
  `idFcodigo_pastoral` int(11) DEFAULT NULL,
  `lugar` varchar(100) NOT NULL,
  `idFcodigo_grupo` int(11) DEFAULT NULL,
  `FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `EstadoAgenda` bit(1) NOT NULL,
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigoAgenda`),
  UNIQUE KEY `idFcodigo_actividad` (`idFcodigo_actividad`,`fecha_act_Inicio`,`hora_act_Inicio`,`fecha_act_Fin`,`hora_act_Fin`,`idFcodigo_pastoral`,`lugar`,`idFcodigo_grupo`),
  KEY `idFcodigo_actividad_2` (`idFcodigo_actividad`),
  KEY `idFcodigo_pastoral` (`idFcodigo_pastoral`),
  KEY `idFcodigo_grupo` (`idFcodigo_grupo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `tagendaparroquial`
--

INSERT INTO `tagendaparroquial` (`codigoAgenda`, `idFcodigo_actividad`, `fecha_act_Inicio`, `hora_act_Inicio`, `fecha_act_Fin`, `hora_act_Fin`, `idFcodigo_pastoral`, `lugar`, `idFcodigo_grupo`, `FechaRegistro`, `EstadoAgenda`, `Estatus`) VALUES
(1, 7, '2015-11-05', '23:03:00', '0000-00-00', '00:00:00', 1, 'qweqwe', 2, '2015-11-05 16:23:36', b'1', '1'),
(2, 10, '2015-11-05', '23:03:00', '0000-00-00', '00:00:00', 1, 'qweqwe', 1, '2015-11-05 16:24:18', b'1', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbautizo`
--

CREATE TABLE IF NOT EXISTS `tbautizo` (
  `idTbautizo` int(11) NOT NULL AUTO_INCREMENT,
  `FechaInscri` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FechaBautizo` datetime NOT NULL,
  `ReferenciaInfante` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Nombres` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Apellidos` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Sexo` char(1) COLLATE utf8_spanish2_ci NOT NULL,
  `FechaNaci` date NOT NULL,
  `Bautizado` int(11) NOT NULL DEFAULT '0',
  `Direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `idFestado` int(11) NOT NULL,
  `idFciudad` int(11) NOT NULL,
  `idFmunicipio` int(11) NOT NULL,
  `idFparroquia` int(11) NOT NULL,
  `idFrepresentante` int(11) NOT NULL,
  `idFparentescoRep` int(11) NOT NULL,
  `idFmama` int(11) NOT NULL,
  `idFpapa` int(11) NOT NULL,
  `idFsacerdote` int(11) NOT NULL,
  `idFministro` int(11) NOT NULL,
  `NotaMarginal` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `PrefectuDe` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `PresentadoEl` date NOT NULL,
  `NumPartidaNac` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `Libro_registro` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Folio_registro` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Numero_registro` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idTbautizo`),
  UNIQUE KEY `NumPartidaNac` (`NumPartidaNac`),
  KEY `idFministro` (`idFministro`),
  KEY `idFrepresentante` (`idFrepresentante`),
  KEY `idFparentescoRep` (`idFparentescoRep`),
  KEY `idFmama` (`idFmama`),
  KEY `idFpapa` (`idFpapa`),
  KEY `idFsacerdote` (`idFsacerdote`),
  KEY `idFestado` (`idFestado`),
  KEY `idFciudad` (`idFciudad`),
  KEY `idFmunicipio` (`idFmunicipio`),
  KEY `idFparroquia` (`idFparroquia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `tbautizo`
--

INSERT INTO `tbautizo` (`idTbautizo`, `FechaInscri`, `FechaBautizo`, `ReferenciaInfante`, `Nombres`, `Apellidos`, `Sexo`, `FechaNaci`, `Bautizado`, `Direccion`, `idFestado`, `idFciudad`, `idFmunicipio`, `idFparroquia`, `idFrepresentante`, `idFparentescoRep`, `idFmama`, `idFpapa`, `idFsacerdote`, `idFministro`, `NotaMarginal`, `PrefectuDe`, `PresentadoEl`, `NumPartidaNac`, `Libro_registro`, `Folio_registro`, `Numero_registro`, `Estatus`) VALUES
(2, '2015-10-24 17:00:12', '2016-04-12 09:40:00', '3123121980', 'werwerwer', 'werwerewrwe', 'M', '1979-03-12', 1, 'eqweqweqwe', 17, 12, 29, 48, 945, 1, 945, 1, 12, 11, 'wqeqweqwe', '23112312', '1980-03-23', '312312', '311231', '23123123', '123123123', 0),
(3, '2015-11-03 11:20:05', '0000-00-00 00:00:00', '321323123213231212-1', 'juan', 'infante', 'M', '0000-00-00', 1, 'acarigua', 17, 1, 29, 1, 1036, 2, 1035, 1034, 12, 11, 'SFGFH', '231231231', '0000-00-00', '3213231232132312', '1', '1', '1', 1),
(4, '2015-11-03 14:16:02', '2016-09-25 21:12:00', '122015', 'jose', 'figueroa', 'M', '2015-09-12', 1, 'acarigua', 17, 12, 29, 48, 1088, 2, 1089, 1034, 11, 11, '', '12', '2015-09-20', '12', '1', '1', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbautizopadrino`
--

CREATE TABLE IF NOT EXISTS `tbautizopadrino` (
  `idTbautizoPadrino` int(11) NOT NULL AUTO_INCREMENT,
  `idFbautizo` int(11) NOT NULL,
  `idFpadrino` int(11) NOT NULL,
  `Tipo` char(1) COLLATE utf8_spanish2_ci NOT NULL,
  `FechaRegistroPadri` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idTbautizoPadrino`),
  KEY `idFkbautizo_idx` (`idFbautizo`),
  KEY `idFkpadrino_idx` (`idFpadrino`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `tbautizopadrino`
--

INSERT INTO `tbautizopadrino` (`idTbautizoPadrino`, `idFbautizo`, `idFpadrino`, `Tipo`, `FechaRegistroPadri`, `Estatus`) VALUES
(1, 2, 983, 'C', '2015-10-24 17:00:12', 1),
(2, 2, 984, 'C', '2015-10-24 17:00:12', 1),
(3, 3, 1037, '', '2015-11-03 11:20:05', 1),
(4, 3, 1038, '', '2015-11-03 11:20:05', 1),
(5, 4, 1090, '', '2015-11-03 14:16:02', 1),
(6, 4, 1091, '', '2015-11-03 14:16:02', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcapilla`
--

CREATE TABLE IF NOT EXISTS `tcapilla` (
  `codigoCapilla` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `idFestado` int(11) NOT NULL,
  `idFciudad` int(11) NOT NULL,
  `idFmunicipio` int(11) NOT NULL,
  `idFparroquia` int(11) NOT NULL,
  `codigo_parroquia` int(11) NOT NULL,
  `telefono` char(12) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `correo` varchar(45) NOT NULL,
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigoCapilla`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `codigo_idx` (`codigo_parroquia`),
  KEY `idFestado` (`idFestado`),
  KEY `idFciudad` (`idFciudad`),
  KEY `idFmunicipio` (`idFmunicipio`),
  KEY `idFparroquia` (`idFparroquia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcar la base de datos para la tabla `tcapilla`
--

INSERT INTO `tcapilla` (`codigoCapilla`, `nombre`, `direccion`, `idFestado`, `idFciudad`, `idFmunicipio`, `idFparroquia`, `codigo_parroquia`, `telefono`, `fecha_creacion`, `correo`, `Estatus`) VALUES
(3, 'ASDASDAS', 'QWEQWEQ', 17, 1, 29, 1, 3, '(123)1231231', '1980-03-12', 'QWEQWEQWE', '1'),
(6, 'ASDASDWEQ', 'QWEQWE', 17, 1, 29, 1, 3, '(123)1231231', '1980-03-12', 'QWEQWEQW', '1'),
(8, 'QWEQWER', 'QWEQWE', 17, 1, 29, 1, 2, '(231)1231231', '1980-03-12', 'QWEQWEQ@ASDASD', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcitas_dias_desactivados`
--

CREATE TABLE IF NOT EXISTS `tcitas_dias_desactivados` (
  `codigoDiasDesactivados` int(11) NOT NULL AUTO_INCREMENT,
  `idFresponsableDes` int(11) NOT NULL,
  `FechaInicioDes` date NOT NULL,
  `HoraInicioDes` time NOT NULL,
  `FechaFinDes` date NOT NULL,
  `HoraFinDes` time NOT NULL,
  `motivoDes` varchar(100) NOT NULL,
  `FechaRegistroDes` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigoDiasDesactivados`),
  UNIQUE KEY `FechaInicioDes` (`FechaInicioDes`,`HoraInicioDes`),
  UNIQUE KEY `FechaFinDes` (`FechaFinDes`,`HoraFinDes`),
  KEY `idFresponsableDes` (`idFresponsableDes`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `tcitas_dias_desactivados`
--

INSERT INTO `tcitas_dias_desactivados` (`codigoDiasDesactivados`, `idFresponsableDes`, `FechaInicioDes`, `HoraInicioDes`, `FechaFinDes`, `HoraFinDes`, `motivoDes`, `FechaRegistroDes`, `Estatus`) VALUES
(1, 70, '2015-11-01', '08:00:00', '2015-11-17', '06:00:00', 'Dias de Remodelacion', '2015-11-20 22:11:52', '1'),
(2, 40, '2015-11-26', '14:00:00', '2015-11-26', '16:00:00', 'Visita al medico', '2015-11-20 22:12:46', '1'),
(3, 64, '2015-11-26', '15:40:00', '2015-11-26', '17:30:00', 'cita de pasaporte', '2015-11-21 04:21:35', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tconfiguracion`
--

CREATE TABLE IF NOT EXISTS `tconfiguracion` (
  `idTconfiguracion` int(11) NOT NULL AUTO_INCREMENT,
  `maximo_intentosClave` int(11) NOT NULL,
  `maximo_citasDia` int(11) NOT NULL,
  `maximo_actividadesDia` int(11) NOT NULL,
  `maximo_solicitudDia` int(11) NOT NULL,
  `maximo_DiasAsignablesCitas` int(11) NOT NULL,
  PRIMARY KEY (`idTconfiguracion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `tconfiguracion`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tgrupo`
--

CREATE TABLE IF NOT EXISTS `tgrupo` (
  `codigoGrupo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `mision` varchar(100) NOT NULL,
  `vision` varchar(100) NOT NULL,
  `FechaRegistroGrupo` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigoGrupo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `tgrupo`
--

INSERT INTO `tgrupo` (`codigoGrupo`, `nombre`, `mision`, `vision`, `FechaRegistroGrupo`, `Estatus`) VALUES
(1, 'DISAASD', 'ASDQW EQEQW EQWE QW', 'ASASD QWEQWEQWE QWEQWEQ E', '0000-00-00 00:00:00', '1'),
(2, 'SENOR', 'ADQW EQW EQWE ÑÑÑE QWEQW EQW E', 'ASDQWE QWEQW EQW EQW EQWE', '2015-11-01 19:29:13', '1'),
(3, 'NUESTRA SEÑORA', 'QQWEQWE', 'EQWEQWE', '2015-11-01 19:30:51', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_actividad`
--

CREATE TABLE IF NOT EXISTS `tipo_actividad` (
  `idtipo_actividad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(160) NOT NULL,
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipo_actividad`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `tipo_actividad`
--

INSERT INTO `tipo_actividad` (`idtipo_actividad`, `nombre`, `descripcion`, `Estatus`) VALUES
(1, 'CURSO', 'REALIZADOS PARA ASD', '1'),
(2, 'CLASE', 'WEQWE', '1'),
(3, 'DASDSAD', 'WQEWEQ', '1'),
(4, 'CURSOWE', 'DASD', '1'),
(5, 'CASDAQ', 'QWEQW', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_solicitud`
--

CREATE TABLE IF NOT EXISTS `tipo_solicitud` (
  `idTipoSolicitud` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `cod_foraneo` int(11) NOT NULL,
  `requisitos` varchar(100) NOT NULL,
  `SolicitudUnica` bit(1) NOT NULL,
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idTipoSolicitud`),
  KEY `cod_foraneo` (`cod_foraneo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `tipo_solicitud`
--

INSERT INTO `tipo_solicitud` (`idTipoSolicitud`, `descripcion`, `cod_foraneo`, `requisitos`, `SolicitudUnica`, `Estatus`) VALUES
(1, 'Inscripción de Matrimonio', 2, 'blablabla insc', b'0', '1'),
(2, 'Inscripción de Bautizo', 1, 'blablabla insc baut', b'0', '1'),
(3, 'Certificado de Bautizo', 1, 'certificado requisitos bau ', b'0', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmatrimonio`
--

CREATE TABLE IF NOT EXISTS `tmatrimonio` (
  `idTmatrimonio` int(11) NOT NULL AUTO_INCREMENT,
  `FechaInscri` datetime NOT NULL,
  `FechaMatrimonio` datetime NOT NULL,
  `idFsacerdote` int(11) NOT NULL,
  `idFnovia` int(11) NOT NULL,
  `idFnovio` int(11) NOT NULL,
  `FechaProclamaUno` datetime DEFAULT NULL,
  `FechaProclamaDos` datetime DEFAULT NULL,
  `FechaProclamaTres` datetime DEFAULT NULL,
  `EstadoMatrimonio` int(11) NOT NULL,
  `Motivo` text COLLATE utf8_spanish2_ci,
  `Libro_registro` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Folio_registro` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Numero_registro` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `NotaMarginal` varchar(300) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ReferenciaMatrimonio` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `Estatus` char(1) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`idTmatrimonio`),
  KEY `idFsacerdote` (`idFsacerdote`),
  KEY `idFnovia` (`idFnovia`),
  KEY `idFnovio` (`idFnovio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=316 ;

--
-- Volcar la base de datos para la tabla `tmatrimonio`
--

INSERT INTO `tmatrimonio` (`idTmatrimonio`, `FechaInscri`, `FechaMatrimonio`, `idFsacerdote`, `idFnovia`, `idFnovio`, `FechaProclamaUno`, `FechaProclamaDos`, `FechaProclamaTres`, `EstadoMatrimonio`, `Motivo`, `Libro_registro`, `Folio_registro`, `Numero_registro`, `NotaMarginal`, `ReferenciaMatrimonio`, `Estatus`) VALUES
(314, '2015-10-04 00:00:00', '2015-12-18 04:52:00', 11, 1, 2, '2015-12-13 09:00:00', '2015-12-13 09:00:00', '2015-12-13 09:00:00', 3, '', '', '', '', '', '314oE', '1'),
(315, '2015-11-03 00:00:00', '2016-03-12 00:00:00', 11, 1040, 2, '2016-02-21 09:00:00', '2016-02-28 09:00:00', '2016-03-06 09:00:00', 0, NULL, '213123', '321123', '213123', 'qweqweqwe', '315zK', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmatrimoniopadrinos`
--

CREATE TABLE IF NOT EXISTS `tmatrimoniopadrinos` (
  `idTmatrimonioPadrinos` int(11) NOT NULL AUTO_INCREMENT,
  `idFmatrimonio` int(11) NOT NULL,
  `idFpadrino` int(11) NOT NULL,
  `Tipo` char(1) COLLATE utf8_spanish2_ci NOT NULL,
  `FechaRegistroPadri` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Estatus` char(1) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`idTmatrimonioPadrinos`),
  KEY `idFmatrimonio` (`idFmatrimonio`),
  KEY `idFpadrino` (`idFpadrino`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=164 ;

--
-- Volcar la base de datos para la tabla `tmatrimoniopadrinos`
--

INSERT INTO `tmatrimoniopadrinos` (`idTmatrimonioPadrinos`, `idFmatrimonio`, `idFpadrino`, `Tipo`, `FechaRegistroPadri`, `Estatus`) VALUES
(158, 314, 946, 'C', '2015-10-04 15:39:46', '1'),
(159, 314, 947, 'C', '2015-10-04 15:39:46', '1'),
(160, 314, 948, 'C', '2015-10-23 17:58:21', '1'),
(161, 314, 949, 'C', '2015-10-23 17:58:21', '1'),
(162, 315, 1041, '', '2015-11-03 11:29:44', '1'),
(163, 315, 1042, '', '2015-11-03 11:29:44', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tnoticia`
--

CREATE TABLE IF NOT EXISTS `tnoticia` (
  `codigo` int(11) NOT NULL,
  `tipo` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `descripccion` varchar(4000) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_ini` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `hora_ini` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `titulo` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='	';

--
-- Volcar la base de datos para la tabla `tnoticia`
--

INSERT INTO `tnoticia` (`codigo`, `tipo`, `descripccion`, `fecha_ini`, `fecha_fin`, `hora_ini`, `hora_fin`, `titulo`) VALUES
(1, '3', 'ENCUENTRO CON JESUS SACRAMENTADO CON LA PARTICIPACIÓN DEL CLERO DIOCESANO Y LOS FIELES DE TODAS LAS PAROQUIAS DE NUESTRA DIÓCESIS DIA 22 DE NOVIEMBRE DEL 2014 PARTIENDO DE LA IGLESIA SACRADA FAMILIA HASTA LA CATEDRAR DE NUESTRA SEÑORA DE LA CORTEZA', '2014-10-11', '2014-11-23', '09:00:00', '10:00:00', 'ENCUENTRO EUCARISTICO'),
(2, '3', 'ENCUENTRO CON LAS DIFERENTES PASTORALES QUE FUNCIONAN EN LAS DIFERENTESPAROQUIAS DE NUESTRAS DIÓCESIS Y SUS ASENTES DEPASTORAL EL DIA 28 DE NOVIEMBRE DEL 2014', '2014-10-10', '2014-11-29', '09:00:00', '10:00:00', 'ASAMBLEA DIOCESA DE PASTORAL'),
(3, '2', 'GLORIA A TI, SEÑOR.\r\nEN AQUEL TIEMPO, LA MULTITUD SE ''APIÑABA ALREDEDOR DE JESÚS Y ÉSTE COMENZÓ A DECIRLES: "LA GENTE DE ESTE TIEMPO ES UNA GENTE PERVERSA. PIDE UNA SEÑAL, PERO NO SE LE DARÁ MAS SEÑAL QUE LA DE JONÁS. PUES ASÍ COMO JONÁS FUÉ UNA SEÑAL PARA LOS HABITANTES DE NÍNIVE, LO MISMO SERÁ EL HIJO DEL HOMBRE PARA LA GENTE DE ESTE TIEMPO.\r\nCUANDO SEAN JUZGADOS LOS HOMBRES DE ESTE TIEMPO, LA REINA DEL SUR SE LEVANTARÁ EL DÍA DEL JUICIO PARA CONDENARLOS, PORQUE ELLA VINO DESDE LOS ULTIMOS RINCONES DE LA TIERRA PARA ESCUCHAR LA SABIDURÍA DE SALOMÓN, Y AQUÍ HAY UNO QUE ES MÁS DE SALOMÓN.\r\nCUANDO SEA JUZGADA LA GENTE DE ESTE TIEMPO, LOS HOMBRES DE NÍNIVE SE LEVANTARÁN EL DÍA DEL JUICIO PARA CONDENARLA, PORQUE ELLOS SE CONVIRTIERON CON LA PREDICACIÓN DE JONÁS Y AQUÍ HAY UNO QUE ES MÁS QUE JÓNAS"''.\r\nPALABRA DEL SEÑOR. "GLORIA A TI, SEÑOR JESÚS".', '2014-10-12', '2014-10-13', '12:00:00', '11:59:00', 'LECTURA DEL SANTO EVANGELIO SEGÚN SAN LUCAS. GLORIA A TÍ SEÑOR'),
(4, '1', 'JESÚS NO CEDÍO ANTE QUIENES LE RECLAMABAN MAYORES EVIDENCIAS PARA CREER EN ÉL. \r\nLAS SEÑALES QUE LO AUTETIFICABAN ERAS SUFICIENTES. CADA QUIEN ASUME EL RIESGO DE CREER O NO CREER.', '2014-10-12', '2014-10-13', '12:00:00', '11:59:00', '"¿QUE OÍSTE? - ¿QUÉ ESCUCHASTE?"');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tobispo`
--

CREATE TABLE IF NOT EXISTS `tobispo` (
  `idTsacerdote` int(11) NOT NULL AUTO_INCREMENT,
  `idFpersona` int(11) NOT NULL,
  `FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FechaInicioDiocesis` date NOT NULL,
  `FechaFinDiocesis` date DEFAULT NULL,
  `Observacion` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idTsacerdote`),
  KEY `idFpersona` (`idFpersona`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `tobispo`
--

INSERT INTO `tobispo` (`idTsacerdote`, `idFpersona`, `FechaRegistro`, `FechaInicioDiocesis`, `FechaFinDiocesis`, `Observacion`, `Estatus`) VALUES
(1, 980, '2015-10-24 04:29:41', '1970-03-12', '1990-04-15', 'QWEQWEQWE', 1),
(2, 981, '2015-10-24 04:43:21', '1970-03-12', '1972-03-12', 'EQWE BQEWQWEQ EQW', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tparroquiaiglesia`
--

CREATE TABLE IF NOT EXISTS `tparroquiaiglesia` (
  `codigoParroquiaIglesia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `mision` varchar(100) NOT NULL,
  `vision` varchar(100) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `telefono` char(12) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `idFestado` int(11) NOT NULL,
  `idFciudad` int(11) NOT NULL,
  `idFmunicipio` int(11) NOT NULL,
  `idFparroquia` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `codigo_archi` int(11) NOT NULL,
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigoParroquiaIglesia`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `codigo_idx` (`codigo_archi`),
  KEY `idFestado` (`idFestado`),
  KEY `idFciudad` (`idFciudad`),
  KEY `idFmunicipio` (`idFmunicipio`),
  KEY `idFparroquia` (`idFparroquia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `tparroquiaiglesia`
--

INSERT INTO `tparroquiaiglesia` (`codigoParroquiaIglesia`, `nombre`, `mision`, `vision`, `direccion`, `telefono`, `correo`, `idFestado`, `idFciudad`, `idFmunicipio`, `idFparroquia`, `fecha_creacion`, `codigo_archi`, `Estatus`) VALUES
(2, 'SAN ROQUES', 'ASDAS', 'ASDASD', 'DIREC', '21312313', 'ASDASDASD@GMAIL.COM', 17, 12, 29, 48, '1997-10-13', 1, '1'),
(3, 'LA CORTEZA', 'QWEQWE', 'QWEQWEQWE', 'QWEQWEQWE', '(321)3123131', 'QWEQWE@SDFSDFSD', 17, 12, 29, 48, '1980-12-23', 1, '1'),
(4, 'SAN MIGUEL', 'MISION', 'VISION', 'QWEQWEQWEQ', '(123)1241241', 'QWEQWEQWE@ASDASD', 17, 1, 29, 1, '1970-03-12', 1, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpastoral`
--

CREATE TABLE IF NOT EXISTS `tpastoral` (
  `codigoPastoral` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `mision` varchar(100) NOT NULL,
  `vision` varchar(100) NOT NULL,
  `FechaRegistroPastoral` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigoPastoral`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `tpastoral`
--

INSERT INTO `tpastoral` (`codigoPastoral`, `nombre`, `mision`, `vision`, `FechaRegistroPastoral`, `Estatus`) VALUES
(1, 'SAN MIGUEL', 'QWEQWE', 'QWEQWE', '2015-11-01 13:20:58', '1'),
(2, 'SAN ROQUE', 'MISION1', 'VISION1', '2015-11-01 13:25:34', '1'),
(3, 'LA CORTEZA', 'ASDEQWE', 'ADASDA', '2015-11-01 13:29:27', '1'),
(4, 'EWQEQWE', 'QWEQQWE', 'QWEQWE', '2015-11-08 23:25:36', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpersonas`
--

CREATE TABLE IF NOT EXISTS `tpersonas` (
  `idTpersonas` int(11) NOT NULL AUTO_INCREMENT,
  `Nacionalidad` char(1) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Cedula` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `Nombres` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `Apellidos` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `Sexo` varchar(1) COLLATE utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `idFestado` int(11) DEFAULT NULL,
  `idFciudad` int(11) DEFAULT NULL,
  `idFmunicipio` int(11) DEFAULT NULL,
  `idFparroquia` int(11) DEFAULT NULL,
  `Telefono` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Correo` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `idFpadre` int(11) DEFAULT NULL,
  `idFmadre` int(11) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idFparroquiaCodigo` int(11) DEFAULT NULL,
  `Estatus` char(1) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`idTpersonas`),
  UNIQUE KEY `Cedula` (`Cedula`),
  KEY `idFmadre` (`idFmadre`),
  KEY `idFpadre` (`idFpadre`),
  KEY `idFestado` (`idFestado`),
  KEY `idFciudad` (`idFciudad`),
  KEY `idFmunicipio` (`idFmunicipio`),
  KEY `idFparroquia` (`idFparroquia`),
  KEY `idFparroquiaCodigo` (`idFparroquiaCodigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1136 ;

--
-- Volcar la base de datos para la tabla `tpersonas`
--

INSERT INTO `tpersonas` (`idTpersonas`, `Nacionalidad`, `Cedula`, `Nombres`, `Apellidos`, `Sexo`, `Direccion`, `idFestado`, `idFciudad`, `idFmunicipio`, `idFparroquia`, `Telefono`, `Correo`, `idFpadre`, `idFmadre`, `FechaNacimiento`, `FechaRegistro`, `idFparroquiaCodigo`, `Estatus`) VALUES
(1, 'V', 'V-12345678', 'GABRIELA', 'FERNANDEZ', 'F', 'PUES', 17, 12, 29, 48, '(412)2312312', 'ASDASDASD@EWRWER.COM', 947, 974, '1990-03-12', '2015-10-04 02:15:30', 3, '1'),
(2, 'V', 'V-20390749', 'FRANCISCO', 'HERNANDEZE', 'M', 'ACARIIGUA', NULL, NULL, NULL, NULL, '(412)5279313', 'ASDASDASD@EWRWER.COM', NULL, NULL, '1992-12-01', '2015-10-04 14:58:29', 3, '1'),
(945, 'V', 'V-123456', 'ESTEBAN', 'GONZALES', 'M', 'ASDASDASDASDA', 17, 12, 29, 48, '(412)5786523', 'ASDASDASD@EWRWER.COM', NULL, NULL, '1980-05-22', '2015-10-04 15:38:21', 2, '1'),
(946, 'V', 'V-654365', 'MANUEL', 'PEREZ', 'M', 'ASDASDASD', NULL, NULL, NULL, NULL, '(412)5656888', 'asdasdasd@ewrwer.com', NULL, NULL, '1990-10-04', '0000-00-00 00:00:00', 2, '1'),
(947, 'V', 'V-987698', 'PEDRO', 'BARRIOS', 'M', 'WQEWEQWE', 17, 12, 29, 48, '(412)5878777', 'asdasdasd@ewrwer.com', NULL, NULL, '1992-10-04', '0000-00-00 00:00:00', 2, '1'),
(948, 'V', 'V-654321', 'JOSE', 'PEREZ', 'M', NULL, NULL, NULL, NULL, NULL, '(342)3423423', 'EWRWERW@SADASD', NULL, NULL, NULL, '2015-10-23 17:58:20', 2, '1'),
(949, 'V', 'V-987654', 'MANUEL', 'BARRIOS', 'M', 'WQEQWE QWE', 17, 12, 29, 48, '(412)5477877', 'asdasdasd@ewrwer.com', 2, 1, '1970-03-12', '2015-10-23 17:58:20', 2, '1'),
(974, 'V', 'V-321314', 'MARIAX', 'PARRA', 'F', 'QWEQWEQEQW', 17, 12, 29, 48, '(412)2312312', 'asdasdasd@ewrwer.com', NULL, NULL, '1970-03-12', '2015-10-24 01:52:14', 4, '1'),
(975, 'V', 'V-342342', 'FRANCISCO', 'ESCALONA', 'M', 'ASDASDA', 17, 12, 29, 48, '(412)5742125', 'asdasdasd@ewrwer.com', NULL, NULL, '1975-10-09', '2015-10-24 04:06:24', 2, '1'),
(980, 'V', 'V-34246345', 'YTAS', 'QWE', 'M', 'QWEQWEQWE', 17, 12, 29, 48, '(412)5888778', 'asdasdasd@ewrwer.com', NULL, NULL, '1970-03-12', '2015-10-24 04:29:41', 3, '1'),
(981, 'V', 'V-123123', 'WQEQWE', 'QWEQWEQWE', 'M', 'QWEQWEQWE', 17, 12, 29, 48, '(412)5787874', 'ASDASDASD@EWRWER.COM', NULL, NULL, '1970-03-12', '2015-10-24 04:43:21', 4, '1'),
(982, 'V', 'V-32434234', 'rwqerwer', 'werwer', 'M', NULL, NULL, NULL, NULL, NULL, '(457)8787878', 'asdasdasd@ewrwer.com', NULL, NULL, NULL, '2015-10-24 16:47:28', 2, '1'),
(983, 'V', 'V-23112312', 'wqeqweqwe', 'qweqweqwe', 'F', '', NULL, NULL, NULL, NULL, '(457)4545778', 'asdasdasd@ewrwer.com', NULL, NULL, '0000-00-00', '0000-00-00 00:00:00', 4, '1'),
(984, 'V', 'V-21312312', 'jesus', 'escalona', 'M', '', NULL, NULL, NULL, NULL, '(342)2423424', 'asdasdasd@ewrwer.com', NULL, NULL, '0000-00-00', '0000-00-00 00:00:00', 4, '1'),
(989, 'V', 'V-1231231', 'QWEQW', 'QWEQWE', 'M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-10-29 00:24:50', NULL, '1'),
(992, 'V', 'V-612345', 'JOSEA', 'NIEVESA', 'M', 'SADASDAAS', NULL, NULL, NULL, NULL, '(412)8778784', 'asdasdasd@ewrwer.com', NULL, NULL, '1970-03-12', '2015-10-29 02:09:40', NULL, '1'),
(1000, 'V', 'V-23423456', 'rafael', 'blanco', 'M', NULL, NULL, NULL, NULL, NULL, '(234)2342342', 'weqweqwe@sdfaaf', NULL, NULL, NULL, '2015-11-02 15:35:43', 3, '1'),
(1030, 'V', 'V-48775565', 'Jessica', 'Dash', 'F', NULL, NULL, NULL, NULL, NULL, '(234)2342342', 'dqweqweqa@asddasd', NULL, NULL, NULL, '2015-11-02 15:50:21', 3, '1'),
(1031, 'V', 'V-43234234', 'ASDASDA', 'WEQQWEQ', 'F', NULL, NULL, NULL, NULL, NULL, '(324)2342342', '23ERQW@ASDAD', NULL, NULL, NULL, '2015-11-02 16:16:58', 2, '1'),
(1033, 'V', 'V-32423443', 'QWEQWE', 'QWEQWE', 'F', NULL, NULL, NULL, NULL, NULL, '(234)2342342', 'QWEQWEEQWE', NULL, NULL, NULL, '2015-11-03 01:05:11', 3, '1'),
(1034, 'V', 'V-20642644', 'JOSE', 'FIGUEROA', 'M', 'ACARIGUA', NULL, NULL, NULL, NULL, '(416)0599041', NULL, NULL, NULL, '1990-12-27', '2015-11-03 11:11:04', NULL, '1'),
(1035, 'V', 'V-21057849', 'YETZINET', 'RODRIGUEZ', 'F', 'ARAURE', 17, 1, 29, 1, '(343)2546546', NULL, NULL, NULL, '1988-12-12', '2015-11-03 11:13:38', 2, '1'),
(1036, 'V', 'V-29642644', 'jose', 'FIGUEROA', 'M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-11-03 11:20:05', NULL, '1'),
(1037, 'V', 'V-22100831', 'JAINI', 'PEREIRA', 'F', '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '0000-00-00', '0000-00-00 00:00:00', NULL, '1'),
(1038, 'V', 'V-20363699', 'AARON', 'RODRRGUEZ', 'F', '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '0000-00-00', '0000-00-00 00:00:00', NULL, '1'),
(1039, 'V', 'V-21057847', 'A', 'A', 'F', 'SAFSA', 17, 12, 29, 48, '(121)2321434', NULL, NULL, NULL, '1988-12-12', '2015-11-03 11:26:24', 2, '1'),
(1040, 'V', 'V-7581523', 'ANA', 'DORANTE', 'F', 'ASDQWEQWEQWE', 17, 12, 29, 48, '(123)1231234', '', NULL, NULL, '1970-03-21', '2015-11-03 11:26:32', 2, '1'),
(1041, 'V', '12345678', 'GABRIELA', 'FERNANDEZ', 'F', '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '2015-11-03', '0000-00-00 00:00:00', NULL, '1'),
(1042, 'V', '123456', 'ESTEBAN', 'GONZALES', 'M', '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '2015-11-03', '0000-00-00 00:00:00', NULL, '1'),
(1058, 'V', 'V-321432', 'ESTETTTTTTT', 'AAAAAAAAA', 'M', 'EQWEQWEQWE', 17, 12, 29, 48, '(123)4514124', NULL, NULL, NULL, '1970-03-12', '2015-11-03 11:40:27', 3, '1'),
(1060, 'V', 'V-1245466', 'DADASDASD', 'QWEQWE', 'M', 'QWEQWE', 17, 1, 29, 1, '(123)1231231', NULL, NULL, NULL, '1970-03-12', '2015-11-03 11:44:53', 4, '1'),
(1061, 'V', 'V-5323523', 'QWEQWE', 'QWEQWE', 'M', 'QWEQWEQWE', 17, 12, 29, 48, '(123)2312312', NULL, NULL, NULL, '1970-03-21', '2015-11-03 11:45:53', 4, '1'),
(1062, 'V', 'V-456123', 'MARIA', 'PAEZ', 'F', 'ZOOM PRINCIPAL DE ACARIGUA, EDO-PORTUGUESA.', NULL, NULL, NULL, NULL, '(545)4534534', 'rodescobar44@gmail.com', NULL, NULL, '1980-11-10', '2015-11-03 11:49:35', NULL, '1'),
(1064, 'V', 'V-34234234', 'QWEQWEQWE', 'QWEQWE', 'M', '2QEWQWEQW', NULL, NULL, NULL, NULL, '(213)1231231', NULL, NULL, NULL, '1970-03-12', '2015-11-03 11:59:02', NULL, '1'),
(1068, 'V', 'V-324234', 'QEDQWE', 'QWE', 'M', 'QWEQWEQWE', NULL, NULL, NULL, NULL, '(123)1231231', NULL, NULL, NULL, '1970-03-21', '2015-11-03 12:04:37', NULL, '1'),
(1071, 'V', 'V-6564646', 'HJHY', 'HHH', 'F', '12QWEQW', NULL, NULL, NULL, NULL, '(213)1231231', NULL, NULL, NULL, '1970-03-12', '2015-11-03 12:12:46', NULL, '1'),
(1072, 'V', 'V-65646434', 'HJHY', 'HHH', 'F', '12QWEQW', NULL, NULL, NULL, NULL, '(213)1231231', NULL, NULL, NULL, '1970-03-12', '2015-11-03 12:14:44', NULL, '1'),
(1073, 'V', 'V-1234123', 'HJGHJGHJ', 'BVNVNVB', 'F', 'ASDASDSDA', 17, 12, 29, 48, '(123)1231231', NULL, NULL, NULL, '1989-02-12', '2015-11-03 12:17:33', 3, '1'),
(1076, 'V', 'V-12345665', 'ASDADS', 'ADSASDQWE', 'M', 'QWEQWEQWEQWE', NULL, NULL, NULL, NULL, '(655)6576655', NULL, NULL, NULL, '1978-03-12', '2015-11-03 12:37:06', NULL, '1'),
(1079, 'V', 'V-575776', ' BVBVBV', 'FHFHG', 'M', 'GUGJJHJHJ', NULL, NULL, NULL, NULL, '(434)5354354', NULL, NULL, NULL, '1990-01-12', '2015-11-03 13:26:59', NULL, '1'),
(1080, 'V', 'V-23466336', 'ASDASD', 'ASDASD', 'M', 'ASDASDASD', NULL, NULL, NULL, NULL, '(213)1231231', NULL, NULL, NULL, '1990-03-12', '2015-11-03 13:27:48', NULL, '1'),
(1082, 'V', 'V-21057848', 'MARIA', 'RODRIGUEZ', 'F', 'ACARIGUA', NULL, NULL, NULL, NULL, '(223)1231231', NULL, NULL, NULL, '1991-08-23', '2015-11-03 13:34:27', NULL, '1'),
(1084, 'V', 'V-21057840', 'AARON', 'RODRIGUEZ', 'M', 'ACARIGUA', 17, 12, 29, 48, '(892)7389273', NULL, NULL, NULL, '1990-12-12', '2015-11-03 13:41:13', 4, '1'),
(1087, 'V', 'V-32423423', 'QWEQWE', 'QWEQWE', 'M', 'QWEQWEQWE', NULL, NULL, NULL, NULL, '(123)1541515', NULL, NULL, NULL, '1970-03-12', '2015-11-03 14:03:16', NULL, '1'),
(1088, 'V', 'V-2108744', 'JAINI', 'RODRIGUEZ', 'F', 'QWEQWEQW', NULL, NULL, NULL, NULL, '(312)3123123', NULL, NULL, NULL, '1990-03-12', '2015-11-03 14:16:02', NULL, '1'),
(1089, 'V', 'V-10504601', 'ana', 'yanet', 'F', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-11-03 14:16:02', NULL, '1'),
(1090, 'V', 'V-43254365', 'fhfhg', 'fhjhfgkh', 'F', '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '0000-00-00', '0000-00-00 00:00:00', NULL, '1'),
(1091, 'V', 'V-52346676', 'jnghk', 'dfdgfjkgjh', 'F', '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '0000-00-00', '0000-00-00 00:00:00', NULL, '1'),
(1093, 'V', 'V-23423452', 'FOPOOOOOOO', 'POOIIIIII', 'M', 'QWEQWEQWEQWE', 17, 12, 29, 48, '(455)4545545', NULL, NULL, NULL, '1946-03-12', '2015-11-04 00:31:07', 3, '1'),
(1094, 'V', 'V-23423666', 'QUEESES', 'ESOSOOO', 'M', 'QWEQWEQWEQWE', 17, 12, 29, 48, '(562)5325235', NULL, NULL, NULL, '1980-03-12', '2015-11-04 00:36:48', 4, '1'),
(1135, 'V', 'V-2312313', 'qweqwe', 'qweqwe', 'F', NULL, NULL, NULL, NULL, NULL, '(435)3453534', '345werwe', NULL, NULL, NULL, '2015-11-08 23:49:15', 3, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tsacerdote`
--

CREATE TABLE IF NOT EXISTS `tsacerdote` (
  `idTsacerdote` int(11) NOT NULL AUTO_INCREMENT,
  `idFiglesia` int(11) NOT NULL,
  `idFpersona` int(11) NOT NULL,
  `FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FechaInicioParroquia` date NOT NULL,
  `FechaFinParroquia` date DEFAULT NULL,
  `Observacion` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `Estatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idTsacerdote`),
  KEY `idFpersona` (`idFpersona`),
  KEY `idFiglesia_idx` (`idFiglesia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=13 ;

--
-- Volcar la base de datos para la tabla `tsacerdote`
--

INSERT INTO `tsacerdote` (`idTsacerdote`, `idFiglesia`, `idFpersona`, `FechaRegistro`, `FechaInicioParroquia`, `FechaFinParroquia`, `Observacion`, `Estatus`) VALUES
(11, 2, 945, '2015-10-04 15:38:21', '2000-10-12', '2015-04-12', 'SADASDA', 1),
(12, 2, 975, '2015-10-24 04:06:24', '2015-09-12', '2015-09-15', 'QWEQWEQWE', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tsacramento`
--

CREATE TABLE IF NOT EXISTS `tsacramento` (
  `codigoSacramento` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`codigoSacramento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `tsacramento`
--

INSERT INTO `tsacramento` (`codigoSacramento`, `descripcion`, `Estatus`) VALUES
(1, 'Bautizo', '1'),
(2, 'Matrimonio', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tsolicitud`
--

CREATE TABLE IF NOT EXISTS `tsolicitud` (
  `idTSolicitud` int(11) NOT NULL AUTO_INCREMENT,
  `idFSolicitante` int(11) NOT NULL,
  `idFtipoSolicitud` int(11) NOT NULL,
  `FechaCita` date NOT NULL,
  `HoraCita` time NOT NULL,
  `FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `EstadoSolicitud` char(1) NOT NULL DEFAULT '0',
  `Estatus` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idTSolicitud`),
  UNIQUE KEY `FechaCita` (`FechaCita`,`HoraCita`),
  KEY `idFsolicitante_idx` (`idFSolicitante`),
  KEY `idFtipoSolicitud_idx` (`idFtipoSolicitud`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- Volcar la base de datos para la tabla `tsolicitud`
--

INSERT INTO `tsolicitud` (`idTSolicitud`, `idFSolicitante`, `idFtipoSolicitud`, `FechaCita`, `HoraCita`, `FechaRegistro`, `EstadoSolicitud`, `Estatus`) VALUES
(1, 1062, 2, '2015-11-26', '14:00:00', '2015-11-14 16:55:28', '0', '1'),
(2, 1062, 1, '2015-11-26', '08:00:00', '2015-11-14 18:17:30', '3', '1'),
(3, 1062, 3, '2015-11-26', '09:00:00', '2015-11-14 18:20:53', '3', '1'),
(71, 1062, 2, '2015-11-26', '17:30:00', '2015-11-21 05:13:54', '0', '1'),
(72, 1062, 2, '2015-11-26', '18:00:00', '2015-11-23 23:02:42', '0', '1'),
(73, 1062, 2, '2015-11-27', '08:00:00', '2015-11-24 03:54:35', '0', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusuarios`
--

CREATE TABLE IF NOT EXISTS `tusuarios` (
  `idTusuario` int(11) NOT NULL AUTO_INCREMENT,
  `idFpersonas` int(11) NOT NULL,
  `Usuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `Clave` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `Rol` int(1) NOT NULL,
  `PreguntaSecreta` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `RespuestaSecreta` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `UltimoIngreso` datetime NOT NULL,
  `FechaRegistro` datetime NOT NULL,
  `Estatus` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idTusuario`),
  UNIQUE KEY `Usuario` (`Usuario`),
  UNIQUE KEY `idFpersonas` (`idFpersonas`),
  KEY `Rol` (`Rol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=87 ;

--
-- Volcar la base de datos para la tabla `tusuarios`
--

INSERT INTO `tusuarios` (`idTusuario`, `idFpersonas`, `Usuario`, `Clave`, `Rol`, `PreguntaSecreta`, `RespuestaSecreta`, `UltimoIngreso`, `FechaRegistro`, `Estatus`) VALUES
(35, 2, '20390749', '3ea48a72acdcd768cbc56e5fdaf3580da935e1bb', 1, 'Mi primera mascota?', 'TEEMO', '2015-05-26 00:00:00', '2015-11-03 14:36:17', 1),
(39, 992, '612345', '2d8b4b5b1d50ccb2887d0f8f9e04eaaf86347314', 4, 'COMO QUE?', 'ALO', '0000-00-00 00:00:00', '2015-10-29 02:58:58', 1),
(40, 1034, '20642644', '4937a6c28433d7d918bb6aed450f111cc0c517a0', 1, 'bla', 'BLO', '0000-00-00 00:00:00', '2015-11-03 11:11:28', 1),
(41, 1039, '21057847', '02B312C882D0A7A910B7C0100E72B93246D3A83F', 4, '123', '123', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(57, 1058, '321432', '10470C3B4B1FED12C3BAAC014BE15FAC67C6E815', 4, 'EWQ', 'EWQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(58, 1060, '1245466', '234AC936FA59F96A70F91882EB66A6BD', 4, 'AS', 'AS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(59, 1061, '5323523', '3EA48A72ACDCD768CBC56E5FDAF3580DA935E1BB', 4, '12', '12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(60, 1062, '456123', 'b58a4e82cc4694e5abb4b75cfe2ed371a8d158c8', 4, 'DA', 'DA', '2015-11-14 10:14:12', '2015-11-14 15:41:42', 1),
(61, 1064, '34234234', 'adcd7048512e64b48da55b027577886ee5a36350', 3, 'qwe', 'QWE', '0000-00-00 00:00:00', '2015-11-03 11:59:26', 1),
(62, 1068, '324234', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 4, 'qw', 'QW', '0000-00-00 00:00:00', '2015-11-03 12:05:01', 1),
(63, 1071, '6564646', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 4, 'ew', 'EW', '0000-00-00 00:00:00', '2015-11-03 12:13:10', 1),
(64, 1072, '65646434', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 4, 'ew', 'EW', '0000-00-00 00:00:00', '2015-11-03 12:15:08', 1),
(65, 1073, '1234123', 'adcd7048512e64b48da55b027577886ee5a36350', 4, 'EW', 'EW', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(66, 1076, '12345665', 'adcd7048512e64b48da55b027577886ee5a36350', 4, 'qw', 'QW', '0000-00-00 00:00:00', '2015-11-03 12:37:30', 1),
(67, 1079, '575776', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 4, 're', 'RE', '0000-00-00 00:00:00', '2015-11-03 13:27:23', 1),
(68, 1080, '23466336', 'adcd7048512e64b48da55b027577886ee5a36350', 4, 're', 'RE', '0000-00-00 00:00:00', '2015-11-03 13:28:12', 1),
(69, 1082, '21057848', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 4, 'asdasd', 'DSLKDLSKDS', '0000-00-00 00:00:00', '2015-11-03 13:34:51', 0),
(70, 1084, '21057840', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 4, 'DONDE VIVO', 'ACARIGUA', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(71, 1087, '32423423', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 4, 'wqeqweqwe', 'QWEQWEQWE', '0000-00-00 00:00:00', '2015-11-03 14:03:40', 1),
(76, 1040, '7581523', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 4, 'RE', 'RE', '0000-00-00 00:00:00', '2015-11-03 14:35:46', 1),
(78, 1088, '2108744', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 4, 'EW', 'EW', '0000-00-00 00:00:00', '2015-11-03 14:39:02', 1),
(80, 1038, '20363699', '9593f3a5a8c8167704f8906ea6f4407b6e2a4478', 1, 'EWQ', 'EWQ', '0000-00-00 00:00:00', '2015-11-03 14:41:10', 1),
(84, 989, '1231231', '8c986d1489801af6ade738178c1c72560559c255', 3, 'ew', 'EW', '0000-00-00 00:00:00', '2015-11-03 15:32:34', 1),
(86, 1093, '23423452', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 4, 'EWQ', 'EWQ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `certificado`
--
ALTER TABLE `certificado`
  ADD CONSTRAINT `fsacra_codigo` FOREIGN KEY (`codigo_sacra`) REFERENCES `tsacramento` (`codigoSacramento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `ciudad_ibfk_1` FOREIGN KEY (`cod_foraneo`) REFERENCES `estado` (`cod_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_grupo`
--
ALTER TABLE `detalle_grupo`
  ADD CONSTRAINT `detalle_grupo_ibfk_1` FOREIGN KEY (`idFparroquiaIglesia`) REFERENCES `tparroquiaiglesia` (`codigoParroquiaIglesia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_codigoGrupo` FOREIGN KEY (`codigo_grupo`) REFERENCES `tgrupo` (`codigoGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_codigoPersona` FOREIGN KEY (`codigo_persona`) REFERENCES `tpersonas` (`idTpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_pastoral`
--
ALTER TABLE `detalle_pastoral`
  ADD CONSTRAINT `detalle_pastoral_ibfk_1` FOREIGN KEY (`codigo_pastoral`) REFERENCES `tpastoral` (`codigoPastoral`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_codigo_persona` FOREIGN KEY (`codigo_persona`) REFERENCES `tpersonas` (`idTpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `municipio_ibfk_1` FOREIGN KEY (`cod_foraneo`) REFERENCES `estado` (`cod_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `parroquia`
--
ALTER TABLE `parroquia`
  ADD CONSTRAINT `parroquia_ibfk_1` FOREIGN KEY (`cod_foraneo`) REFERENCES `municipio` (`cod_municipio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tactividad`
--
ALTER TABLE `tactividad`
  ADD CONSTRAINT `tactividad_ibfk_1` FOREIGN KEY (`tipo_actividad`) REFERENCES `tipo_actividad` (`idtipo_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tagendadiocesana`
--
ALTER TABLE `tagendadiocesana`
  ADD CONSTRAINT `tagendadiocesana_ibfk_1` FOREIGN KEY (`idFcodigo_actividad`) REFERENCES `tactividad` (`codigoActividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tagendadiocesana_ibfk_2` FOREIGN KEY (`idFcodigo_pastoral`) REFERENCES `tpastoral` (`codigoPastoral`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tagendadiocesana_ibfk_3` FOREIGN KEY (`idFcodigo_grupo`) REFERENCES `tgrupo` (`codigoGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tagendaparroquial`
--
ALTER TABLE `tagendaparroquial`
  ADD CONSTRAINT `tagendaparroquial_ibfk_1` FOREIGN KEY (`idFcodigo_actividad`) REFERENCES `tactividad` (`codigoActividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tagendaparroquial_ibfk_3` FOREIGN KEY (`idFcodigo_grupo`) REFERENCES `tgrupo` (`codigoGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tagendaparroquial_ibfk_4` FOREIGN KEY (`idFcodigo_pastoral`) REFERENCES `tpastoral` (`codigoPastoral`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbautizo`
--
ALTER TABLE `tbautizo`
  ADD CONSTRAINT `tbautizo_ibfk_1` FOREIGN KEY (`idFrepresentante`) REFERENCES `tpersonas` (`idTpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbautizo_ibfk_2` FOREIGN KEY (`idFparentescoRep`) REFERENCES `parentescorepre` (`idTparentescoRepre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbautizo_ibfk_3` FOREIGN KEY (`idFmama`) REFERENCES `tpersonas` (`idTpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbautizo_ibfk_4` FOREIGN KEY (`idFpapa`) REFERENCES `tpersonas` (`idTpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbautizo_ibfk_5` FOREIGN KEY (`idFsacerdote`) REFERENCES `tsacerdote` (`idTsacerdote`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbautizo_ibfk_6` FOREIGN KEY (`idFestado`) REFERENCES `estado` (`cod_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbautizo_ibfk_7` FOREIGN KEY (`idFciudad`) REFERENCES `ciudad` (`cod_ciudad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbautizo_ibfk_8` FOREIGN KEY (`idFmunicipio`) REFERENCES `municipio` (`cod_municipio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbautizo_ibfk_9` FOREIGN KEY (`idFparroquia`) REFERENCES `parroquia` (`cod_parroquia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbautizopadrino`
--
ALTER TABLE `tbautizopadrino`
  ADD CONSTRAINT `idFkbautizo` FOREIGN KEY (`idFbautizo`) REFERENCES `tbautizo` (`idTbautizo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idFkpadrino` FOREIGN KEY (`idFpadrino`) REFERENCES `tpersonas` (`idTpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tcapilla`
--
ALTER TABLE `tcapilla`
  ADD CONSTRAINT `parrocodigo` FOREIGN KEY (`codigo_parroquia`) REFERENCES `tparroquiaiglesia` (`codigoParroquiaIglesia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tcapilla_ibfk_1` FOREIGN KEY (`idFestado`) REFERENCES `estado` (`cod_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tcapilla_ibfk_2` FOREIGN KEY (`idFciudad`) REFERENCES `ciudad` (`cod_ciudad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tcapilla_ibfk_3` FOREIGN KEY (`idFmunicipio`) REFERENCES `municipio` (`cod_municipio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tcapilla_ibfk_4` FOREIGN KEY (`idFparroquia`) REFERENCES `parroquia` (`cod_parroquia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tcitas_dias_desactivados`
--
ALTER TABLE `tcitas_dias_desactivados`
  ADD CONSTRAINT `tcitas_dias_desactivados_ibfk_1` FOREIGN KEY (`idFresponsableDes`) REFERENCES `tusuarios` (`idTusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tipo_solicitud`
--
ALTER TABLE `tipo_solicitud`
  ADD CONSTRAINT `tipo_solicitud_ibfk_1` FOREIGN KEY (`cod_foraneo`) REFERENCES `tsacramento` (`codigoSacramento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tmatrimonio`
--
ALTER TABLE `tmatrimonio`
  ADD CONSTRAINT `tmatrimonio_ibfk_1` FOREIGN KEY (`idFsacerdote`) REFERENCES `tsacerdote` (`idTsacerdote`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tmatrimonio_ibfk_2` FOREIGN KEY (`idFnovia`) REFERENCES `tpersonas` (`idTpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tmatrimonio_ibfk_3` FOREIGN KEY (`idFnovio`) REFERENCES `tpersonas` (`idTpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tmatrimoniopadrinos`
--
ALTER TABLE `tmatrimoniopadrinos`
  ADD CONSTRAINT `idFmatrimonio` FOREIGN KEY (`idFmatrimonio`) REFERENCES `tmatrimonio` (`idTmatrimonio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idFpadrino` FOREIGN KEY (`idFpadrino`) REFERENCES `tpersonas` (`idTpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tobispo`
--
ALTER TABLE `tobispo`
  ADD CONSTRAINT `idFpersona0` FOREIGN KEY (`idFpersona`) REFERENCES `tpersonas` (`idTpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tparroquiaiglesia`
--
ALTER TABLE `tparroquiaiglesia`
  ADD CONSTRAINT `codigo` FOREIGN KEY (`codigo_archi`) REFERENCES `archiprestazgo` (`codigoArchiPrestazgo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tparroquiaiglesia_ibfk_1` FOREIGN KEY (`idFestado`) REFERENCES `estado` (`cod_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tparroquiaiglesia_ibfk_2` FOREIGN KEY (`idFciudad`) REFERENCES `ciudad` (`cod_ciudad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tparroquiaiglesia_ibfk_3` FOREIGN KEY (`idFmunicipio`) REFERENCES `municipio` (`cod_municipio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tparroquiaiglesia_ibfk_4` FOREIGN KEY (`idFparroquia`) REFERENCES `parroquia` (`cod_parroquia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tpersonas`
--
ALTER TABLE `tpersonas`
  ADD CONSTRAINT `tpersonas_ibfk_1` FOREIGN KEY (`idFpadre`) REFERENCES `tpersonas` (`idTpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tpersonas_ibfk_2` FOREIGN KEY (`idFmadre`) REFERENCES `tpersonas` (`idTpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tpersonas_ibfk_3` FOREIGN KEY (`idFestado`) REFERENCES `estado` (`cod_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tpersonas_ibfk_4` FOREIGN KEY (`idFciudad`) REFERENCES `ciudad` (`cod_ciudad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tpersonas_ibfk_5` FOREIGN KEY (`idFmunicipio`) REFERENCES `municipio` (`cod_municipio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tpersonas_ibfk_6` FOREIGN KEY (`idFparroquia`) REFERENCES `parroquia` (`cod_parroquia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tpersonas_ibfk_7` FOREIGN KEY (`idFparroquiaCodigo`) REFERENCES `tparroquiaiglesia` (`codigoParroquiaIglesia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tsacerdote`
--
ALTER TABLE `tsacerdote`
  ADD CONSTRAINT `idFiglesia` FOREIGN KEY (`idFiglesia`) REFERENCES `tparroquiaiglesia` (`codigoParroquiaIglesia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idFpersona` FOREIGN KEY (`idFpersona`) REFERENCES `tpersonas` (`idTpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tsolicitud`
--
ALTER TABLE `tsolicitud`
  ADD CONSTRAINT `idFsolicitante` FOREIGN KEY (`idFSolicitante`) REFERENCES `tpersonas` (`idTpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idFtipoSolicitud` FOREIGN KEY (`idFtipoSolicitud`) REFERENCES `tipo_solicitud` (`idTipoSolicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tusuarios`
--
ALTER TABLE `tusuarios`
  ADD CONSTRAINT `tusuarios_ibfk_1` FOREIGN KEY (`idFpersonas`) REFERENCES `tpersonas` (`idTpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tusuarios_ibfk_2` FOREIGN KEY (`Rol`) REFERENCES `rol` (`idTRol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
