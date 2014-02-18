-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-02-2014 a las 12:29:31
-- Versión del servidor: 5.5.34-0ubuntu2
-- Versión de PHP: 5.5.6-1ubuntu2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sirepae`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Actividad`
--

CREATE TABLE IF NOT EXISTS `Actividad` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `intervencion_id` bigint(20) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F033FA52CD79A23` (`intervencion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `Actividad`
--

INSERT INTO `Actividad` (`id`, `intervencion_id`, `nombre`, `descripcion`, `fecha_creado`) VALUES
(1, 1, '786', NULL, '2014-02-13 00:09:19'),
(2, 1, '67867', NULL, '2014-02-13 00:09:25'),
(3, 2, 'bvcbgh', NULL, '2014-02-13 00:09:32'),
(4, 1, 'bnllhju', NULL, '2014-02-13 00:09:39'),
(5, 2, ',nbgfuyu', NULL, '2014-02-13 00:09:48'),
(6, 2, 'ghjkgiuygiy', NULL, '2014-02-13 00:09:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ActividadPAE`
--

CREATE TABLE IF NOT EXISTS `ActividadPAE` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `plan_cuidado_id` bigint(20) NOT NULL,
  `actividad_id` bigint(20) NOT NULL,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_624DD8FBEB014EEA` (`plan_cuidado_id`),
  KEY `IDX_624DD8FB6014FACA` (`actividad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `ActividadPAE`
--

INSERT INTO `ActividadPAE` (`id`, `plan_cuidado_id`, `actividad_id`, `fecha_creado`) VALUES
(13, 1, 1, '2014-02-13 16:55:46'),
(14, 1, 6, '2014-02-13 16:55:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Area`
--

CREATE TABLE IF NOT EXISTS `Area` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `Area`
--

INSERT INTO `Area` (`id`, `nombre`, `descripcion`, `fecha_creado`) VALUES
(1, 'Area 1', NULL, '2014-02-10 06:33:28'),
(2, 'Area 2', NULL, '2014-02-10 07:01:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Calificacion`
--

CREATE TABLE IF NOT EXISTS `Calificacion` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pae_id` bigint(20) NOT NULL,
  `docente_id` bigint(20) NOT NULL,
  `valor` double NOT NULL,
  `observacion` longtext COLLATE utf8_unicode_ci,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_920B29E08B4AE98C` (`pae_id`),
  KEY `IDX_920B29E094E27525` (`docente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Calificacion`
--

INSERT INTO `Calificacion` (`id`, `pae_id`, `docente_id`, `valor`, `observacion`, `fecha_creado`) VALUES
(2, 1, 12, 4, 'Observa', '2014-02-13 22:03:54'),
(3, 4, 15, 4.6, NULL, '2014-02-15 21:26:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Clase`
--

CREATE TABLE IF NOT EXISTS `Clase` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dominio_id` bigint(20) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D85E83CAB105BE34` (`dominio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `Clase`
--

INSERT INTO `Clase` (`id`, `dominio_id`, `nombre`, `descripcion`, `fecha_creado`) VALUES
(1, 1, 'Clase 1', 'c1', '2014-02-13 11:55:32'),
(2, 1, 'Clase 2', 'c2', '2014-02-13 11:55:42'),
(3, 3, 'Clase 3', 'c3', '2014-02-13 11:55:52'),
(4, 2, 'Clase 4', 'c4', '2014-02-13 11:56:10'),
(5, 2, 'Clase 5', 'c5', '2014-02-13 11:56:23'),
(6, 3, 'Clase 6', 'c6', '2014-02-13 11:56:36'),
(7, 3, 'Clase 7', 'c7', '2014-02-13 11:56:48'),
(8, 2, 'Clase 8', 'c8', '2014-02-13 11:56:59'),
(9, 3, 'Clase 9', NULL, '2014-02-13 11:57:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Diagnostico`
--

CREATE TABLE IF NOT EXISTS `Diagnostico` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `clase_id` bigint(20) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `codigo` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `definicion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1D0D5B9F9F720353` (`clase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `Diagnostico`
--

INSERT INTO `Diagnostico` (`id`, `clase_id`, `nombre`, `codigo`, `definicion`, `fecha_creado`) VALUES
(1, 4, 'Diagnóstico 1', '23423', 'd1', '2014-02-13 11:58:01'),
(2, 8, 'Diagnóstico 2', '423', 'd2', '2014-02-13 11:58:14'),
(3, 4, 'Diagnóstico 4', '1009', 'd4', '2014-02-13 11:58:33'),
(4, 5, 'Diagnóstico 5', '237568', 'd5', '2014-02-13 11:58:44'),
(5, 4, 'Otro Diagnóstico', '3218', 'Otro', '2014-02-13 12:08:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DiagnosticoPAE`
--

CREATE TABLE IF NOT EXISTS `DiagnosticoPAE` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `plan_cuidado_id` bigint(20) NOT NULL,
  `diagnostico_id` bigint(20) NOT NULL,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AD983B0BEB014EEA` (`plan_cuidado_id`),
  KEY `IDX_AD983B0B7A94BA1A` (`diagnostico_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `DiagnosticoPAE`
--

INSERT INTO `DiagnosticoPAE` (`id`, `plan_cuidado_id`, `diagnostico_id`, `fecha_creado`) VALUES
(1, 1, 1, '2014-02-13 13:52:05'),
(2, 1, 3, '2014-02-13 13:52:20'),
(3, 2, 1, '2014-02-15 20:31:21'),
(4, 2, 3, '2014-02-15 20:31:27'),
(5, 4, 1, '2014-02-15 20:31:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Dominio`
--

CREATE TABLE IF NOT EXISTS `Dominio` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nanda_id` bigint(20) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fecha_creado` datetime NOT NULL,
  `codigo` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D87D72E3C9541952` (`nanda_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Dominio`
--

INSERT INTO `Dominio` (`id`, `nanda_id`, `nombre`, `descripcion`, `fecha_creado`, `codigo`) VALUES
(1, 1, 'Dominio 1', NULL, '2014-02-13 11:55:00', '432'),
(2, 1, 'Dominio 2', 'd2', '2014-02-13 11:55:10', '534'),
(3, 1, 'Dominio 3', 'd3', '2014-02-13 11:55:21', '324');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Escala`
--

CREATE TABLE IF NOT EXISTS `Escala` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `valor` decimal(10,0) NOT NULL,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C35E2CFC3A909126` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `Escala`
--

INSERT INTO `Escala` (`id`, `nombre`, `descripcion`, `valor`, `fecha_creado`) VALUES
(1, '1', '1', 1, '2014-02-13 11:03:37'),
(2, '2', '2', 2, '2014-02-13 11:03:46'),
(3, '3', '3', 3, '2014-02-13 11:03:54'),
(4, '4', '4', 4, '2014-02-13 11:04:01'),
(5, '5', '5', 5, '2014-02-13 11:04:08'),
(6, '6', '6', 6, '2014-02-13 11:04:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Estudiante`
--

CREATE TABLE IF NOT EXISTS `Estudiante` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `estudiante_id` bigint(20) NOT NULL,
  `practica_id` bigint(20) NOT NULL,
  `codigo` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `semestre` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_74623C7D59590C39` (`estudiante_id`),
  KEY `IDX_74623C7D81B1AF76` (`practica_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Estudiante`
--

INSERT INTO `Estudiante` (`id`, `estudiante_id`, `practica_id`, `codigo`, `semestre`) VALUES
(1, 10, 1, '3423567', 9),
(2, 11, 1, '84654', 8),
(3, 12, 3, '123456', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Evidencia`
--

CREATE TABLE IF NOT EXISTS `Evidencia` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `diagnostico_id` bigint(20) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DB4802DF7A94BA1A` (`diagnostico_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Evidencia`
--

INSERT INTO `Evidencia` (`id`, `diagnostico_id`, `nombre`, `descripcion`, `fecha_creado`) VALUES
(1, 1, 'Evidencia 1', 'e1', '2014-02-13 11:59:08'),
(2, 1, 'Evidencia 2', 'e2', '2014-02-13 11:59:19'),
(3, 1, 'Evidencia 3', NULL, '2014-02-13 12:07:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EvidenciaDiagnosticoPAE`
--

CREATE TABLE IF NOT EXISTS `EvidenciaDiagnosticoPAE` (
  `diagnostico_id` bigint(20) NOT NULL,
  `evidencia_id` bigint(20) NOT NULL,
  PRIMARY KEY (`diagnostico_id`,`evidencia_id`),
  KEY `IDX_2539B0387A94BA1A` (`diagnostico_id`),
  KEY `IDX_2539B038B294C73E` (`evidencia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `EvidenciaDiagnosticoPAE`
--

INSERT INTO `EvidenciaDiagnosticoPAE` (`diagnostico_id`, `evidencia_id`) VALUES
(1, 1),
(3, 2),
(3, 3),
(5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `FactorRelacionado`
--

CREATE TABLE IF NOT EXISTS `FactorRelacionado` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `diagnostico_id` bigint(20) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_947B5EEC7A94BA1A` (`diagnostico_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `FactorRelacionado`
--

INSERT INTO `FactorRelacionado` (`id`, `diagnostico_id`, `nombre`, `descripcion`, `fecha_creado`) VALUES
(1, 3, 'Factor Relacionado 1', NULL, '2014-02-13 12:07:16'),
(3, 3, 'Factor Relacionado 2', NULL, '2014-02-13 12:07:44'),
(4, 3, 'Factor Relacionado 3', NULL, '2014-02-13 12:07:52'),
(5, 3, 'Factor Relacionado 4', NULL, '2014-02-13 12:08:00'),
(6, 1, 'Factor Relacionado 5', NULL, '2014-02-13 12:08:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `FactorRelacionadoDiagnosticoPAE`
--

CREATE TABLE IF NOT EXISTS `FactorRelacionadoDiagnosticoPAE` (
  `diagnostico_id` bigint(20) NOT NULL,
  `factor_relacionado_id` bigint(20) NOT NULL,
  PRIMARY KEY (`diagnostico_id`,`factor_relacionado_id`),
  KEY `IDX_47B956007A94BA1A` (`diagnostico_id`),
  KEY `IDX_47B956004A0B6418` (`factor_relacionado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `FactorRelacionadoDiagnosticoPAE`
--

INSERT INTO `FactorRelacionadoDiagnosticoPAE` (`diagnostico_id`, `factor_relacionado_id`) VALUES
(2, 1),
(2, 5),
(4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Indicador`
--

CREATE TABLE IF NOT EXISTS `Indicador` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `resultado_esperado_id` bigint(20) NOT NULL,
  `definicion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `codigo` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4FE3BC60E1068603` (`resultado_esperado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `Indicador`
--

INSERT INTO `Indicador` (`id`, `resultado_esperado_id`, `definicion`, `codigo`, `fecha_creado`) VALUES
(1, 2, 'Definición Indicador 1', '4534tg4', '2014-02-13 11:01:53'),
(2, 1, 'Definición Indicador 2', 'gry56', '2014-02-13 11:02:11'),
(3, 3, 'Definición Indicador 3', 'tgh56875', '2014-02-13 11:02:57'),
(4, 3, 'Definición Indicador 4', 'hgf6767', '2014-02-13 11:03:05'),
(5, 3, 'Definición Indicador 4', '4547567', '2014-02-13 11:03:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `IndicadorPAE`
--

CREATE TABLE IF NOT EXISTS `IndicadorPAE` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `plan_cuidado_id` bigint(20) NOT NULL,
  `indicador_id` bigint(20) NOT NULL,
  `escala_id` bigint(20) NOT NULL,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_458DA5E0EB014EEA` (`plan_cuidado_id`),
  KEY `IDX_458DA5E047D487D1` (`indicador_id`),
  KEY `IDX_458DA5E0ED8CDAB9` (`escala_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `IndicadorPAE`
--

INSERT INTO `IndicadorPAE` (`id`, `plan_cuidado_id`, `indicador_id`, `escala_id`, `fecha_creado`) VALUES
(4, 1, 4, 5, '2014-02-13 11:52:18'),
(7, 1, 5, 3, '2014-02-13 16:56:26'),
(8, 1, 1, 3, '2014-02-13 17:43:18'),
(9, 1, 3, 3, '2014-02-13 17:58:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Intervencion`
--

CREATE TABLE IF NOT EXISTS `Intervencion` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nic_id` bigint(20) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `codigo` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4E7A075A78D9E7A` (`nic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `Intervencion`
--

INSERT INTO `Intervencion` (`id`, `nic_id`, `nombre`, `descripcion`, `codigo`, `fecha_creado`) VALUES
(1, 1, '1', NULL, '213', '2014-02-13 00:08:56'),
(2, 1, '2', NULL, '25436', '2014-02-13 00:09:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Materia`
--

CREATE TABLE IF NOT EXISTS `Materia` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `area_id` bigint(20) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A24D6B18BD0F409C` (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Materia`
--

INSERT INTO `Materia` (`id`, `area_id`, `nombre`, `descripcion`, `fecha_creado`) VALUES
(1, 1, 'Materia 1', NULL, '2014-02-10 06:57:03'),
(2, 2, 'Materia 2', NULL, '2014-02-10 07:02:34'),
(3, 2, 'Materia 3', NULL, '2014-02-10 07:10:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `NANDA`
--

CREATE TABLE IF NOT EXISTS `NANDA` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usado` tinyint(1) NOT NULL,
  `version` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `NANDA`
--

INSERT INTO `NANDA` (`id`, `isbn`, `usado`, `version`, `fecha_creado`) VALUES
(1, '45435645', 1, '97', '2014-02-13 11:54:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `NIC`
--

CREATE TABLE IF NOT EXISTS `NIC` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usado` tinyint(1) NOT NULL,
  `version` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `NIC`
--

INSERT INTO `NIC` (`id`, `isbn`, `usado`, `version`, `fecha_creado`) VALUES
(1, '4563', 1, '6756', '2014-02-13 00:08:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `NOC`
--

CREATE TABLE IF NOT EXISTS `NOC` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usado` tinyint(1) NOT NULL,
  `version` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `NOC`
--

INSERT INTO `NOC` (`id`, `isbn`, `usado`, `version`, `fecha_creado`) VALUES
(1, '4543763', 1, '234', '2014-02-13 11:00:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Nota`
--

CREATE TABLE IF NOT EXISTS `Nota` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `registro_enfermeria_id` bigint(20) NOT NULL,
  `nota` longtext COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `usuario_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_68E291332A10BF62` (`registro_enfermeria_id`),
  KEY `IDX_68E29133DB38439E` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `Nota`
--

INSERT INTO `Nota` (`id`, `registro_enfermeria_id`, `nota`, `fecha_creado`, `usuario_id`) VALUES
(1, 2, 'Nueva Nota', '2014-02-14 11:18:59', NULL),
(2, 2, 'Nota 2', '2014-02-14 11:19:44', NULL),
(3, 2, 'OBSERVACIÓN', '2014-02-14 11:48:20', NULL),
(4, 3, 'Observación de Prueba', '2014-02-16 00:15:38', 13),
(5, 1, 'Nota Nueva', '2014-02-16 01:15:20', 12),
(6, 3, 'gtj ghgdh tdfh gfhg jhgjf', '2014-02-16 02:05:13', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `OpcionRespuesta`
--

CREATE TABLE IF NOT EXISTS `OpcionRespuesta` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pregunta_id` bigint(20) NOT NULL,
  `tipo_respuesta_id` bigint(20) NOT NULL,
  `enunciado` longtext COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fecha_creado` datetime NOT NULL,
  `columna` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A199ED9531A5801E` (`pregunta_id`),
  KEY `IDX_A199ED956AE909A2` (`tipo_respuesta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `OpcionRespuesta`
--

INSERT INTO `OpcionRespuesta` (`id`, `pregunta_id`, `tipo_respuesta_id`, `enunciado`, `descripcion`, `fecha_creado`, `columna`) VALUES
(1, 3, 2, 'Opción 1', NULL, '2014-02-14 00:37:48', NULL),
(2, 3, 2, 'Opción 2', NULL, '2014-02-14 00:39:07', NULL),
(3, 2, 3, 'Opción 3', NULL, '2014-02-14 00:39:22', 0),
(4, 1, 6, 'Opción 4', NULL, '2014-02-14 00:39:41', 0),
(5, 4, 2, 'Opción 5', NULL, '2014-02-14 00:40:01', NULL),
(6, 5, 1, 'Opción 6', NULL, '2014-02-14 00:40:18', 0),
(7, 7, 2, 'Opción 8', NULL, '2014-02-14 00:40:48', NULL),
(8, 6, 2, 'Opción 9', NULL, '2014-02-14 00:40:59', NULL),
(9, 7, 2, 'Opción 10', NULL, '2014-02-14 00:41:44', NULL),
(10, 6, 2, 'Opción 11', NULL, '2014-02-14 00:41:55', NULL),
(11, 3, 2, 'Opción 12', NULL, '2014-02-14 00:42:04', 0),
(12, 6, 1, 'Opción 12', NULL, '2014-02-14 00:42:04', 0),
(13, 4, 1, 'Opción 14', NULL, '2014-02-14 00:42:21', NULL),
(14, 3, 2, 'Opción 13', NULL, '2014-02-14 00:42:37', NULL),
(15, 8, 3, 'Fecha', NULL, '2014-02-15 02:37:06', 0),
(16, 9, 6, 'Tratamiento', NULL, '2014-02-15 02:48:49', 0),
(17, 10, 1, 'Medicina', NULL, '2014-02-15 02:49:22', NULL),
(18, 11, 1, 'Enfermería', NULL, '2014-02-15 02:49:37', NULL),
(19, 12, 1, 'Odontología', NULL, '2014-02-15 02:49:53', NULL),
(20, 13, 1, 'Nutrición', NULL, '2014-02-15 02:50:05', NULL),
(21, 14, 1, 'Citología', NULL, '2014-02-15 02:50:15', NULL),
(22, 15, 1, 'Mamas', NULL, '2014-02-15 02:50:23', NULL),
(24, 16, 1, 'Próstata', NULL, '2014-02-15 02:50:35', NULL),
(25, 17, 6, 'Rta P1 Otro Registro', NULL, '2014-02-17 11:41:27', 0),
(26, 18, 3, 'Rta P2 Otro Registro', NULL, '2014-02-17 11:41:59', 0),
(27, 19, 2, 'Rta F1 Otro Registro', NULL, '2014-02-17 11:42:32', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Paciente`
--

CREATE TABLE IF NOT EXISTS `Paciente` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` longtext COLLATE utf8_unicode_ci,
  `telefonos` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_creado` datetime NOT NULL,
  `cedula` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `Paciente`
--

INSERT INTO `Paciente` (`id`, `nombres`, `apellidos`, `direccion`, `telefonos`, `fecha_creado`, `cedula`) VALUES
(1, 'Paciente 1', '1', 'Calle', '555', '2014-02-13 00:19:06', 123485),
(2, 'Paciente', 'de Registro 1', NULL, NULL, '2014-02-14 00:30:45', 159);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PAE`
--

CREATE TABLE IF NOT EXISTS `PAE` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `paciente_id` bigint(20) NOT NULL,
  `estudiante_id` bigint(20) NOT NULL,
  `val_objetiva` longtext COLLATE utf8_unicode_ci,
  `val_subjetiva` longtext COLLATE utf8_unicode_ci,
  `evaluacion` longtext COLLATE utf8_unicode_ci,
  `objetivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7C293CF97310DAD4` (`paciente_id`),
  KEY `IDX_7C293CF959590C39` (`estudiante_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `PAE`
--

INSERT INTO `PAE` (`id`, `paciente_id`, `estudiante_id`, `val_objetiva`, `val_subjetiva`, `evaluacion`, `objetivo`, `fecha_creado`) VALUES
(1, 1, 3, 'Una', 'Una', NULL, 'Objetivo', '2014-02-13 00:19:30'),
(2, 2, 3, NULL, NULL, NULL, NULL, '2014-02-14 09:43:34'),
(3, 2, 1, NULL, NULL, NULL, NULL, '2014-02-14 09:49:12'),
(4, 2, 3, NULL, NULL, NULL, NULL, '2014-02-14 09:58:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Practica`
--

CREATE TABLE IF NOT EXISTS `Practica` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `area_practica_id` bigint(20) NOT NULL,
  `docente_id` bigint(20) NOT NULL,
  `coordinador_id` bigint(20) NOT NULL,
  `sitio_id` bigint(20) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fecha_creado` datetime NOT NULL,
  `fecha_modifica` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_81F792013A909126` (`nombre`),
  KEY `IDX_81F79201AA8A0506` (`area_practica_id`),
  KEY `IDX_81F7920194E27525` (`docente_id`),
  KEY `IDX_81F79201E4517BDD` (`coordinador_id`),
  KEY `IDX_81F79201A707E1B0` (`sitio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `Practica`
--

INSERT INTO `Practica` (`id`, `area_practica_id`, `docente_id`, `coordinador_id`, `sitio_id`, `nombre`, `descripcion`, `fecha_creado`, `fecha_modifica`) VALUES
(1, 1, 3, 2, 1, 'Practica 1', 'Práctica 1', '2014-02-10 07:53:30', '2014-02-10 08:03:37'),
(2, 2, 5, 2, 1, 'Practica 2', NULL, '2014-02-10 08:01:07', '2014-02-10 08:04:55'),
(3, 1, 15, 13, 1, 'Practica 3', NULL, '2014-02-10 08:04:06', '2014-02-14 12:34:17'),
(4, 1, 5, 4, 1, 'Practica 4', NULL, '2014-02-10 08:04:32', '2014-02-10 08:04:32'),
(5, 1, 3, 13, NULL, 'Práctica Nueva', NULL, '2014-02-14 14:19:43', '2014-02-14 14:19:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pregunta`
--

CREATE TABLE IF NOT EXISTS `Pregunta` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `registro_id` bigint(20) NOT NULL,
  `enunciado` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ayuda` longtext COLLATE utf8_unicode_ci,
  `multi_rta` tinyint(1) DEFAULT NULL,
  `expandido` tinyint(1) DEFAULT NULL,
  `requerido` tinyint(1) DEFAULT NULL,
  `fecha_creado` datetime NOT NULL,
  `orden` int(11) DEFAULT NULL,
  `columna` tinyint(1) DEFAULT NULL,
  `tabla` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_579683A139C50FAE` (`registro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `Pregunta`
--

INSERT INTO `Pregunta` (`id`, `registro_id`, `enunciado`, `ayuda`, `multi_rta`, `expandido`, `requerido`, `fecha_creado`, `orden`, `columna`, `tabla`) VALUES
(1, 1, 'Pregunta 1', NULL, 0, 0, 1, '2014-02-14 00:34:28', 1, NULL, NULL),
(2, 1, 'Pregunta 2', NULL, 0, 0, 0, '2014-02-14 00:34:45', 2, NULL, NULL),
(3, 1, 'Pregunta 3', NULL, 1, 0, 0, '2014-02-14 00:34:57', 3, 0, 0),
(4, 1, 'Pregunta 4', NULL, 0, 1, 0, '2014-02-14 00:35:05', 4, NULL, NULL),
(5, 1, 'Pregunta 5', NULL, 1, 0, 1, '2014-02-14 00:35:16', 5, NULL, NULL),
(6, 1, 'Pregunta 6', NULL, 0, 1, 1, '2014-02-14 00:35:25', 6, NULL, NULL),
(7, 1, 'Pregunta 7', NULL, 1, 1, 0, '2014-02-14 00:35:41', 7, NULL, NULL),
(8, 2, 'Fecha Último', 'Fecha del Último Control', 0, 0, 0, '2014-02-15 02:36:34', 1, 1, 0),
(9, 2, 'Tratamiento', 'Tratamiendo realizado', 0, 0, 0, '2014-02-15 02:42:21', 2, 1, 0),
(10, 2, 'Medicina', 'Control de Medicina', 0, 0, 0, '2014-02-15 02:42:41', 3, NULL, NULL),
(11, 2, 'Enfermería', 'Control de Enfermería', 0, 0, 0, '2014-02-15 02:43:15', 4, NULL, NULL),
(12, 2, 'Odontología', 'Control de Odontología', 0, 0, 0, '2014-02-15 02:43:40', 5, NULL, NULL),
(13, 2, 'Nutrición', 'Control de Nutrición', 0, 0, 0, '2014-02-15 02:43:57', 6, NULL, NULL),
(14, 2, 'Citología', 'Control de Citología', 0, 0, 0, '2014-02-15 02:44:10', 7, 0, 0),
(15, 2, 'AutoEx. Mamas', 'Control de Mamas', 0, 0, 0, '2014-02-15 02:45:45', 8, 0, 0),
(16, 2, 'Ex. Próstata', 'Exámen de Próstata', 0, 0, 0, '2014-02-15 02:46:06', 9, NULL, NULL),
(17, 3, 'Pregunta 1', NULL, 0, 0, 0, '2014-02-16 13:20:49', 1, 1, 0),
(18, 3, 'Pregunta 2', NULL, 0, 0, 0, '2014-02-16 13:21:01', 2, 1, 0),
(19, 3, 'Fila 1', NULL, 0, 0, 0, '2014-02-16 13:21:13', 3, 0, 0),
(20, 3, 'Fila 2', NULL, 0, 0, 0, '2014-02-16 13:21:23', 4, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Registro`
--

CREATE TABLE IF NOT EXISTS `Registro` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tipo_id` bigint(20) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `aplicaEnPaciente` tinyint(1) NOT NULL,
  `unico` tinyint(1) NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `tabla` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C00ACA0DA9276E6C` (`tipo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Registro`
--

INSERT INTO `Registro` (`id`, `tipo_id`, `nombre`, `aplicaEnPaciente`, `unico`, `fecha_creado`, `tabla`) VALUES
(1, 1, 'Control de Medicamentos', 1, 0, '2014-02-14 00:34:00', 0),
(2, 2, 'Controles Realizados', 0, 0, '2014-02-15 02:26:00', 1),
(3, 1, 'Otro Control', 0, 1, '2014-02-16 13:20:38', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RegistroEnfermeria`
--

CREATE TABLE IF NOT EXISTS `RegistroEnfermeria` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `estudiante_id` bigint(20) NOT NULL,
  `paciente_id` bigint(20) NOT NULL,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B73790E659590C39` (`estudiante_id`),
  KEY `IDX_B73790E67310DAD4` (`paciente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `RegistroEnfermeria`
--

INSERT INTO `RegistroEnfermeria` (`id`, `estudiante_id`, `paciente_id`, `fecha_creado`) VALUES
(1, 3, 2, '2014-02-14 00:31:32'),
(2, 3, 1, '2014-02-14 01:58:39'),
(3, 3, 1, '2014-02-14 02:06:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Respuesta`
--

CREATE TABLE IF NOT EXISTS `Respuesta` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pregunta_id` bigint(20) NOT NULL,
  `respuesta_id` bigint(20) NOT NULL,
  `valor` longtext COLLATE utf8_unicode_ci,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EE9F474D31A5801E` (`pregunta_id`),
  KEY `IDX_EE9F474DD9BA57A2` (`respuesta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `Respuesta`
--

INSERT INTO `Respuesta` (`id`, `pregunta_id`, `respuesta_id`, `valor`, `fecha_creado`) VALUES
(1, 1, 4, 'Registro 4', '2014-02-17 16:46:35'),
(2, 2, 3, '2014/02/17', '2014-02-17 16:46:35'),
(3, 3, 1, '1\\#_*/|\\*_#/2\\#_*/|\\*_#/11\\#_*/|\\*_#/14', '2014-02-17 16:46:35'),
(4, 4, 13, '13', '2014-02-17 16:46:35'),
(5, 5, 6, 'bad', '2014-02-17 16:46:35'),
(6, 6, 10, '10', '2014-02-17 16:46:35'),
(7, 7, 7, '7', '2014-02-17 16:46:35'),
(8, 1, 4, 'Pregunta 2', '2014-02-17 16:50:36'),
(9, 2, 3, '2014/02/17', '2014-02-17 16:50:36'),
(10, 3, 1, '1', '2014-02-17 16:50:36'),
(11, 4, 5, '5', '2014-02-17 16:50:36'),
(12, 5, 6, 'Bad', '2014-02-17 16:50:36'),
(13, 6, 8, '8', '2014-02-17 16:50:36'),
(14, 7, 7, '7', '2014-02-17 16:50:36'),
(15, 1, 4, 'Pregunta 3 var_dump($editar);\r\n                        die;', '2014-02-17 16:57:18'),
(16, 2, 3, '2014/02/17', '2014-02-17 16:57:18'),
(17, 3, 1, '1\\#_*/|\\*_#/2\\#_*/|\\*_#/11\\#_*/|\\*_#/14', '2014-02-17 16:57:18'),
(18, 4, 13, '13', '2014-02-17 16:57:18'),
(19, 5, 6, 'ok', '2014-02-17 16:57:18'),
(20, 6, 8, '8', '2014-02-17 16:57:18'),
(21, 7, 7, '7\\#_*/|\\*_#/9', '2014-02-17 16:57:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RespuestaPaciente`
--

CREATE TABLE IF NOT EXISTS `RespuestaPaciente` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `paciente_id` bigint(20) NOT NULL,
  `respuesta_id` bigint(20) NOT NULL,
  `numero` bigint(20) NOT NULL,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_775D8AEB7310DAD4` (`paciente_id`),
  UNIQUE KEY `UNIQ_775D8AEBD9BA57A2` (`respuesta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RespuestaRegistroEnfermeria`
--

CREATE TABLE IF NOT EXISTS `RespuestaRegistroEnfermeria` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `respuesta_id` bigint(20) NOT NULL,
  `registro_enfermeria_id` bigint(20) NOT NULL,
  `numero` bigint(20) NOT NULL,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_563F2FAFD9BA57A2` (`respuesta_id`),
  KEY `IDX_563F2FAF2A10BF62` (`registro_enfermeria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `RespuestaRegistroEnfermeria`
--

INSERT INTO `RespuestaRegistroEnfermeria` (`id`, `respuesta_id`, `registro_enfermeria_id`, `numero`, `fecha_creado`) VALUES
(1, 1, 3, 1, '2014-02-17 16:46:35'),
(2, 2, 3, 1, '2014-02-17 16:46:35'),
(3, 3, 3, 1, '2014-02-17 16:46:35'),
(4, 4, 3, 1, '2014-02-17 16:46:35'),
(5, 5, 3, 1, '2014-02-17 16:46:35'),
(6, 6, 3, 1, '2014-02-17 16:46:35'),
(7, 7, 3, 1, '2014-02-17 16:46:35'),
(8, 8, 3, 2, '2014-02-17 16:50:36'),
(9, 9, 3, 2, '2014-02-17 16:50:36'),
(10, 10, 3, 2, '2014-02-17 16:50:36'),
(11, 11, 3, 2, '2014-02-17 16:50:36'),
(12, 12, 3, 2, '2014-02-17 16:50:36'),
(13, 13, 3, 2, '2014-02-17 16:50:36'),
(14, 14, 3, 2, '2014-02-17 16:50:36'),
(15, 15, 3, 3, '2014-02-17 16:57:18'),
(16, 16, 3, 3, '2014-02-17 16:57:18'),
(17, 17, 3, 3, '2014-02-17 16:57:18'),
(18, 18, 3, 3, '2014-02-17 16:57:18'),
(19, 19, 3, 3, '2014-02-17 16:57:18'),
(20, 20, 3, 3, '2014-02-17 16:57:18'),
(21, 21, 3, 3, '2014-02-17 16:57:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ResultadoEsperado`
--

CREATE TABLE IF NOT EXISTS `ResultadoEsperado` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `noc_id` bigint(20) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `definicion` longtext COLLATE utf8_unicode_ci,
  `dominio` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `clase` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `codigo` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A60A329F28CD6BDA` (`noc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `ResultadoEsperado`
--

INSERT INTO `ResultadoEsperado` (`id`, `noc_id`, `nombre`, `definicion`, `dominio`, `clase`, `codigo`, `fecha_creado`) VALUES
(1, 1, 'Resultado Esperado 1', 'Define 1', 'Dominio 1', 'Clase 3', '4536t', '2014-02-13 11:01:04'),
(2, 1, 'Resultado Esperado 2', 'fdswerwtq efiw', '2453', '2342', '345645', '2014-02-13 11:01:21'),
(3, 1, 'ghdu yujytfj jgjg', NULL, '43563', '435ghfhfg', 'tfgh', '2014-02-13 11:01:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ResultadoEsperadoEscala`
--

CREATE TABLE IF NOT EXISTS `ResultadoEsperadoEscala` (
  `escala_id` bigint(20) NOT NULL,
  `resultado_esperado_id` bigint(20) NOT NULL,
  PRIMARY KEY (`escala_id`,`resultado_esperado_id`),
  KEY `IDX_46C7A23AED8CDAB9` (`escala_id`),
  KEY `IDX_46C7A23AE1068603` (`resultado_esperado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ResultadoEsperadoEscala`
--

INSERT INTO `ResultadoEsperadoEscala` (`escala_id`, `resultado_esperado_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(5, 2),
(5, 3),
(6, 1),
(6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rol`
--

CREATE TABLE IF NOT EXISTS `Rol` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `Rol`
--

INSERT INTO `Rol` (`id`, `nombre`, `descripcion`, `fecha_creado`) VALUES
(1, 'Coordinador', NULL, '2014-02-10 03:36:48'),
(2, 'Docente', 'Docente Jefe', '2014-02-10 04:06:15'),
(3, 'Estudiante', 'Estudiante Practicante', '2014-02-10 04:06:42'),
(4, 'Usuario', 'Rol General', '2014-02-10 04:15:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sede`
--

CREATE TABLE IF NOT EXISTS `Sede` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fecha_creado` datetime NOT NULL,
  `direccion` longtext COLLATE utf8_unicode_ci,
  `telefonos` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_director` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `Sede`
--

INSERT INTO `Sede` (`id`, `nombre`, `descripcion`, `fecha_creado`, `direccion`, `telefonos`, `correo`, `nombre_director`) VALUES
(1, 'SedeA', NULL, '2014-02-10 07:18:49', 'Calle y Avenida', '555', 'sedea@email.com', 'Director Sede A'),
(2, 'Sede B', NULL, '2014-02-10 07:26:33', NULL, NULL, NULL, 'Director Sede B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sitio`
--

CREATE TABLE IF NOT EXISTS `Sitio` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sede_id` bigint(20) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fecha_creado` datetime NOT NULL,
  `nombre_director` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C5759624E19F41BF` (`sede_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Sitio`
--

INSERT INTO `Sitio` (`id`, `sede_id`, `nombre`, `descripcion`, `fecha_creado`, `nombre_director`) VALUES
(1, 1, 'Sitio 1', NULL, '2014-02-12 02:19:32', 'Director 1'),
(2, 1, 'Sitio 2', NULL, '2014-02-12 02:19:48', 'Director 5'),
(3, 2, 'Sitio 2B', NULL, '2014-02-15 22:52:51', 'Director Sitio2B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SitioArea`
--

CREATE TABLE IF NOT EXISTS `SitioArea` (
  `area_id` bigint(20) NOT NULL,
  `sitio_id` bigint(20) NOT NULL,
  PRIMARY KEY (`area_id`,`sitio_id`),
  KEY `IDX_182ED5F1BD0F409C` (`area_id`),
  KEY `IDX_182ED5F1A707E1B0` (`sitio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `SitioArea`
--

INSERT INTO `SitioArea` (`area_id`, `sitio_id`) VALUES
(1, 1),
(2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipo`
--

CREATE TABLE IF NOT EXISTS `Tipo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `Tipo`
--

INSERT INTO `Tipo` (`id`, `nombre`, `descripcion`, `fecha_creado`) VALUES
(1, 'Control de Medicamentos', NULL, '2014-02-14 00:33:36'),
(2, 'Controles Realizados', NULL, '2014-02-15 02:25:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoRespuesta`
--

CREATE TABLE IF NOT EXISTS `TipoRespuesta` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_campo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creado` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `TipoRespuesta`
--

INSERT INTO `TipoRespuesta` (`id`, `nombre`, `tipo_campo`, `fecha_creado`) VALUES
(1, 'Texto', 'text', '2014-02-14 00:36:07'),
(2, 'Selección', 'choice', '2014-02-14 00:36:27'),
(3, 'Fecha', 'date', '2014-02-14 00:36:35'),
(4, 'Hora', 'time', '2014-02-14 00:36:42'),
(5, 'Fecha y Hora', 'datetime', '2014-02-14 00:36:59'),
(6, 'Texto Largo', 'textarea', '2014-02-15 05:40:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rol_id` bigint(20) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `nombres` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellidos` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefonos` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` longtext COLLATE utf8_unicode_ci,
  `fecha_creado` datetime DEFAULT NULL,
  `ingresos` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EDD889C192FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_EDD889C1A0D96FBF` (`email_canonical`),
  KEY `IDX_EDD889C14BAB96C` (`rol_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`id`, `rol_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `nombres`, `apellidos`, `telefonos`, `direccion`, `fecha_creado`, `ingresos`) VALUES
(1, NULL, 'superadmin', 'superadmin', 'hender.puello@gmail.com', 'hender.puello@gmail.com', 1, 'smg068c88pc8o848coccsog0gs4gos8', 'ITfaWQYV41XZs+fKukrqYJhCI/qS+ewGiRvWOQpKW8qGPyhRnN8rKh42qDDHeJybxY1iMXfq9JawSrusVzW0Tw==', '2014-02-15 18:00:01', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, 'Super', 'Administrador', '555', 'Calle y Avenida', NULL, 6),
(2, 1, 'Coordinador 1', 'coordinador 1', 'coordinador1@email.com', 'coordinador1@email.com', 1, 'dapa9y3cpg8cwok84ws04cgk0osk8kg', 'Y7h538GzrUPauJ2CUmbdxCsMaAd+R41TzfhhFcDaB4Tm49AGySwqDdaTz7AUuvEWrEyyhR/Aj+AU3ivMp5EnAA==', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_COORDINADOR";}', 0, NULL, 'Coordinador', '1', NULL, NULL, NULL, 0),
(3, 2, 'Docente 1', 'docente 1', 'docente1@email.com', 'docente1@email.com', 1, '692j6ok8cf408o8sws088o4cw4808kg', '6AI9Hj0R6eiJcwQwNr69jZTHlM9c/IQssCy5A76yn5H3gAHi07K/gXesYPZt4nElJUfTjGBX18XVue8qlfHbeQ==', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:12:"ROLE_DOCENTE";}', 0, NULL, 'Docente', '1', NULL, NULL, NULL, 0),
(4, 1, 'coordinador 2', 'coordinador 2', 'coordinador2@email.com', 'coordinador2@email.com', 1, 'smg068c88pc8o848coccsog0gs4gos8', 'ITfaWQYV41XZs+fKukrqYJhCI/qS+ewGiRvWOQpKW8qGPyhRnN8rKh42qDDHeJybxY1iMXfq9JawSrusVzW0Tw==', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_COORDINADOR";}', 0, NULL, 'Coordinador', '2', NULL, NULL, NULL, 0),
(5, 2, 'Docente 2', 'docente 2', 'docente2@email.com', 'docente2@email.com', 1, 'smg068c88pc8o848coccsog0gs4gos8', 'ITfaWQYV41XZs+fKukrqYJhCI/qS+ewGiRvWOQpKW8qGPyhRnN8rKh42qDDHeJybxY1iMXfq9JawSrusVzW0Tw==', '2014-02-11 00:41:54', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:12:"ROLE_DOCENTE";}', 0, NULL, 'Docente', '2', NULL, NULL, NULL, 0),
(10, 3, 'Estudiate 1', 'estudiate 1', 'estudiante1@email.com', 'estudiante1@email.com', 1, 'ectgu4zlrpk4ogo4w4sko088sc408s8', 'GN7wxC1MJS0edNxk2hN4Qe0MNcMAdmq2b/XT+NIV+XFp3HXTKxbIS7Km2bH+eWOTTXiawkyw1tVa0M4dJLpSDg==', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_ESTUDIANTE";}', 0, NULL, 'Estudiante', '1', NULL, NULL, NULL, 0),
(11, 3, 'Estudiante 2', 'estudiante 2', 'estudiante2@email.com', 'estudiante2@email.com', 1, 'smg068c88pc8o848coccsog0gs4gos8', 'ITfaWQYV41XZs+fKukrqYJhCI/qS+ewGiRvWOQpKW8qGPyhRnN8rKh42qDDHeJybxY1iMXfq9JawSrusVzW0Tw==', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_ESTUDIANTE";}', 0, NULL, 'Estudiante', '2', '555', 'Calle y Avenida', NULL, 0),
(12, 3, 'Estudiante 3', 'estudiante 3', 'estudiante3@email.com', 'estudiante3@email.com', 1, 'afr68emscu0wggk80wwkgwgcskwkgk4', 'fbF7Q2oiZE7eQ34UIIs4JWGeegVAqLGmC7n3+C7omAZBIGTz/9/eWXA1q+XzihxhQv4x8aYT0BdTdWSlwRKxzg==', '2014-02-17 12:29:43', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_ESTUDIANTE";}', 0, NULL, 'Estudiante', '3', NULL, NULL, NULL, 18),
(13, 1, 'Coordinador 3', 'coordinador 3', 'coordinador3@email.com', 'coordinador3@email.com', 1, 'mhvyxgym5rkok8s88sogws80sc0cs48', '0aLu/fHqzFzI4YQmsOCGggK0Kc5Z/w68lpH29eQnNRxkTKVFG0s2HlFm3VLgk2I0foz1GYY7VDOsHKY2RhuqlQ==', '2014-02-17 12:09:03', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_COORDINADOR";}', 0, NULL, 'Coordinador', '3', NULL, NULL, NULL, 16),
(14, 1, 'Coordinador', 'coordinador', 'coordinador@email.com', 'coordinador@email.com', 1, 'i212fzu7wvcoc4cowggo0cgwkck0ok0', 'BlC9GOQmJvCoKclzcS4c/YCtp6x/qz71vWFEsI2K7oaeW0d4m+r6bJ6XEJkKI+iNGvph071EqZUxn6AasH65MA==', '2014-02-16 21:29:05', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_COORDINADOR";}', 0, NULL, 'Coordinador', NULL, NULL, NULL, NULL, 5),
(15, 2, 'Docente', 'docente', 'docente@email.com', 'docente@email.com', 1, '1dmopsp8m340wsog80ckosws08g0kwo', 'KmlNz1ZCArkd0zM3GtUD0uUaScXjZ5KbyxqTAXVPwnE+i+fp9ygwkGDDFT/CFcBHd12SLwlr8f1BJ0Ww0yLHIA==', '2014-02-15 21:14:21', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:12:"ROLE_DOCENTE";}', 0, NULL, 'Docente', NULL, NULL, NULL, NULL, 2);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Actividad`
--
ALTER TABLE `Actividad`
  ADD CONSTRAINT `FK_F033FA52CD79A23` FOREIGN KEY (`intervencion_id`) REFERENCES `Intervencion` (`id`);

--
-- Filtros para la tabla `ActividadPAE`
--
ALTER TABLE `ActividadPAE`
  ADD CONSTRAINT `FK_624DD8FB6014FACA` FOREIGN KEY (`actividad_id`) REFERENCES `Actividad` (`id`),
  ADD CONSTRAINT `FK_624DD8FBEB014EEA` FOREIGN KEY (`plan_cuidado_id`) REFERENCES `PAE` (`id`);

--
-- Filtros para la tabla `Calificacion`
--
ALTER TABLE `Calificacion`
  ADD CONSTRAINT `FK_920B29E08B4AE98C` FOREIGN KEY (`pae_id`) REFERENCES `PAE` (`id`),
  ADD CONSTRAINT `FK_920B29E094E27525` FOREIGN KEY (`docente_id`) REFERENCES `Usuario` (`id`);

--
-- Filtros para la tabla `Clase`
--
ALTER TABLE `Clase`
  ADD CONSTRAINT `FK_D85E83CAB105BE34` FOREIGN KEY (`dominio_id`) REFERENCES `Dominio` (`id`);

--
-- Filtros para la tabla `Diagnostico`
--
ALTER TABLE `Diagnostico`
  ADD CONSTRAINT `FK_1D0D5B9F9F720353` FOREIGN KEY (`clase_id`) REFERENCES `Clase` (`id`);

--
-- Filtros para la tabla `DiagnosticoPAE`
--
ALTER TABLE `DiagnosticoPAE`
  ADD CONSTRAINT `FK_AD983B0B7A94BA1A` FOREIGN KEY (`diagnostico_id`) REFERENCES `Diagnostico` (`id`),
  ADD CONSTRAINT `FK_AD983B0BEB014EEA` FOREIGN KEY (`plan_cuidado_id`) REFERENCES `PAE` (`id`);

--
-- Filtros para la tabla `Dominio`
--
ALTER TABLE `Dominio`
  ADD CONSTRAINT `FK_D87D72E3C9541952` FOREIGN KEY (`nanda_id`) REFERENCES `NANDA` (`id`);

--
-- Filtros para la tabla `Estudiante`
--
ALTER TABLE `Estudiante`
  ADD CONSTRAINT `FK_74623C7D59590C39` FOREIGN KEY (`estudiante_id`) REFERENCES `Usuario` (`id`),
  ADD CONSTRAINT `FK_74623C7D81B1AF76` FOREIGN KEY (`practica_id`) REFERENCES `Practica` (`id`);

--
-- Filtros para la tabla `Evidencia`
--
ALTER TABLE `Evidencia`
  ADD CONSTRAINT `FK_DB4802DF7A94BA1A` FOREIGN KEY (`diagnostico_id`) REFERENCES `Diagnostico` (`id`);

--
-- Filtros para la tabla `EvidenciaDiagnosticoPAE`
--
ALTER TABLE `EvidenciaDiagnosticoPAE`
  ADD CONSTRAINT `FK_2539B0387A94BA1A` FOREIGN KEY (`diagnostico_id`) REFERENCES `DiagnosticoPAE` (`id`),
  ADD CONSTRAINT `FK_2539B038B294C73E` FOREIGN KEY (`evidencia_id`) REFERENCES `Evidencia` (`id`);

--
-- Filtros para la tabla `FactorRelacionado`
--
ALTER TABLE `FactorRelacionado`
  ADD CONSTRAINT `FK_947B5EEC7A94BA1A` FOREIGN KEY (`diagnostico_id`) REFERENCES `Diagnostico` (`id`);

--
-- Filtros para la tabla `FactorRelacionadoDiagnosticoPAE`
--
ALTER TABLE `FactorRelacionadoDiagnosticoPAE`
  ADD CONSTRAINT `FK_47B956004A0B6418` FOREIGN KEY (`factor_relacionado_id`) REFERENCES `FactorRelacionado` (`id`),
  ADD CONSTRAINT `FK_47B956007A94BA1A` FOREIGN KEY (`diagnostico_id`) REFERENCES `DiagnosticoPAE` (`id`);

--
-- Filtros para la tabla `Indicador`
--
ALTER TABLE `Indicador`
  ADD CONSTRAINT `FK_4FE3BC60E1068603` FOREIGN KEY (`resultado_esperado_id`) REFERENCES `ResultadoEsperado` (`id`);

--
-- Filtros para la tabla `IndicadorPAE`
--
ALTER TABLE `IndicadorPAE`
  ADD CONSTRAINT `FK_458DA5E047D487D1` FOREIGN KEY (`indicador_id`) REFERENCES `Indicador` (`id`),
  ADD CONSTRAINT `FK_458DA5E0EB014EEA` FOREIGN KEY (`plan_cuidado_id`) REFERENCES `PAE` (`id`),
  ADD CONSTRAINT `FK_458DA5E0ED8CDAB9` FOREIGN KEY (`escala_id`) REFERENCES `Escala` (`id`);

--
-- Filtros para la tabla `Intervencion`
--
ALTER TABLE `Intervencion`
  ADD CONSTRAINT `FK_4E7A075A78D9E7A` FOREIGN KEY (`nic_id`) REFERENCES `NIC` (`id`);

--
-- Filtros para la tabla `Materia`
--
ALTER TABLE `Materia`
  ADD CONSTRAINT `FK_A24D6B18BD0F409C` FOREIGN KEY (`area_id`) REFERENCES `Area` (`id`);

--
-- Filtros para la tabla `Nota`
--
ALTER TABLE `Nota`
  ADD CONSTRAINT `FK_68E291332A10BF62` FOREIGN KEY (`registro_enfermeria_id`) REFERENCES `RegistroEnfermeria` (`id`),
  ADD CONSTRAINT `FK_68E29133DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuario` (`id`);

--
-- Filtros para la tabla `OpcionRespuesta`
--
ALTER TABLE `OpcionRespuesta`
  ADD CONSTRAINT `FK_A199ED9531A5801E` FOREIGN KEY (`pregunta_id`) REFERENCES `Pregunta` (`id`),
  ADD CONSTRAINT `FK_A199ED956AE909A2` FOREIGN KEY (`tipo_respuesta_id`) REFERENCES `TipoRespuesta` (`id`);

--
-- Filtros para la tabla `PAE`
--
ALTER TABLE `PAE`
  ADD CONSTRAINT `FK_7C293CF959590C39` FOREIGN KEY (`estudiante_id`) REFERENCES `Estudiante` (`id`),
  ADD CONSTRAINT `FK_7C293CF97310DAD4` FOREIGN KEY (`paciente_id`) REFERENCES `Paciente` (`id`);

--
-- Filtros para la tabla `Practica`
--
ALTER TABLE `Practica`
  ADD CONSTRAINT `FK_81F7920194E27525` FOREIGN KEY (`docente_id`) REFERENCES `Usuario` (`id`),
  ADD CONSTRAINT `FK_81F79201A707E1B0` FOREIGN KEY (`sitio_id`) REFERENCES `Sitio` (`id`),
  ADD CONSTRAINT `FK_81F79201AA8A0506` FOREIGN KEY (`area_practica_id`) REFERENCES `Area` (`id`),
  ADD CONSTRAINT `FK_81F79201E4517BDD` FOREIGN KEY (`coordinador_id`) REFERENCES `Usuario` (`id`);

--
-- Filtros para la tabla `Pregunta`
--
ALTER TABLE `Pregunta`
  ADD CONSTRAINT `FK_579683A139C50FAE` FOREIGN KEY (`registro_id`) REFERENCES `Registro` (`id`);

--
-- Filtros para la tabla `Registro`
--
ALTER TABLE `Registro`
  ADD CONSTRAINT `FK_C00ACA0DA9276E6C` FOREIGN KEY (`tipo_id`) REFERENCES `Tipo` (`id`);

--
-- Filtros para la tabla `RegistroEnfermeria`
--
ALTER TABLE `RegistroEnfermeria`
  ADD CONSTRAINT `FK_B73790E659590C39` FOREIGN KEY (`estudiante_id`) REFERENCES `Estudiante` (`id`),
  ADD CONSTRAINT `FK_B73790E67310DAD4` FOREIGN KEY (`paciente_id`) REFERENCES `Paciente` (`id`);

--
-- Filtros para la tabla `Respuesta`
--
ALTER TABLE `Respuesta`
  ADD CONSTRAINT `FK_EE9F474D31A5801E` FOREIGN KEY (`pregunta_id`) REFERENCES `Pregunta` (`id`),
  ADD CONSTRAINT `FK_EE9F474DD9BA57A2` FOREIGN KEY (`respuesta_id`) REFERENCES `OpcionRespuesta` (`id`);

--
-- Filtros para la tabla `RespuestaPaciente`
--
ALTER TABLE `RespuestaPaciente`
  ADD CONSTRAINT `FK_775D8AEB7310DAD4` FOREIGN KEY (`paciente_id`) REFERENCES `Paciente` (`id`),
  ADD CONSTRAINT `FK_775D8AEBD9BA57A2` FOREIGN KEY (`respuesta_id`) REFERENCES `Respuesta` (`id`);

--
-- Filtros para la tabla `RespuestaRegistroEnfermeria`
--
ALTER TABLE `RespuestaRegistroEnfermeria`
  ADD CONSTRAINT `FK_563F2FAF2A10BF62` FOREIGN KEY (`registro_enfermeria_id`) REFERENCES `RegistroEnfermeria` (`id`),
  ADD CONSTRAINT `FK_563F2FAFD9BA57A2` FOREIGN KEY (`respuesta_id`) REFERENCES `Respuesta` (`id`);

--
-- Filtros para la tabla `ResultadoEsperado`
--
ALTER TABLE `ResultadoEsperado`
  ADD CONSTRAINT `FK_A60A329F28CD6BDA` FOREIGN KEY (`noc_id`) REFERENCES `NOC` (`id`);

--
-- Filtros para la tabla `ResultadoEsperadoEscala`
--
ALTER TABLE `ResultadoEsperadoEscala`
  ADD CONSTRAINT `FK_46C7A23AE1068603` FOREIGN KEY (`resultado_esperado_id`) REFERENCES `ResultadoEsperado` (`id`),
  ADD CONSTRAINT `FK_46C7A23AED8CDAB9` FOREIGN KEY (`escala_id`) REFERENCES `Escala` (`id`);

--
-- Filtros para la tabla `Sitio`
--
ALTER TABLE `Sitio`
  ADD CONSTRAINT `FK_C5759624E19F41BF` FOREIGN KEY (`sede_id`) REFERENCES `Sede` (`id`);

--
-- Filtros para la tabla `SitioArea`
--
ALTER TABLE `SitioArea`
  ADD CONSTRAINT `FK_182ED5F1A707E1B0` FOREIGN KEY (`sitio_id`) REFERENCES `Sitio` (`id`),
  ADD CONSTRAINT `FK_182ED5F1BD0F409C` FOREIGN KEY (`area_id`) REFERENCES `Area` (`id`);

--
-- Filtros para la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `FK_EDD889C14BAB96C` FOREIGN KEY (`rol_id`) REFERENCES `Rol` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
