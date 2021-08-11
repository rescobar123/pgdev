-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 21-09-2020 a las 14:48:08
-- Versión del servidor: 5.5.60-MariaDB
-- Versión de PHP: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `seguridad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `AdminDNI` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `AdminNombre` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `AdminApellido` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `AdminTelefono` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `AdminDireccion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaCodigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `AdminDNI`, `AdminNombre`, `AdminApellido`, `AdminTelefono`, `AdminDireccion`, `CuentaCodigo`) VALUES
(1, '654654654654', 'Juan', 'Gomez', '35761111', 'Samta Maria ixhuatan Snata Rosa', 'AC4855552-13'),
(34, '2742565250610', 'Robin', 'Escobar', '3576111', 'Zona 1', 'AC6245928-2'),
(35, '2112321', 'Robin', 'Eriberto', '35761111', 'Zona 1', 'AC8575697-3'),
(36, '321654', 'Juan', 'Garcia', '35117611', '', 'AC4618677-4'),
(37, '4444', 'asdf', 'adsf', '44444', 'adsfsadf', 'AC8933907-5'),
(38, '12342134', 'adfasdf', 'asdfasdf', '', '', 'AC3786667-6'),
(39, '3333', 'asdfsadf', 'asdfdsaf', '', '', 'AC3645238-7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agente`
--

CREATE TABLE `agente` (
  `IdAgente` int(3) NOT NULL,
  `AgenteDpi` varchar(30) NOT NULL,
  `AgenteNombre` varchar(45) NOT NULL,
  `AgenteApellido` varchar(45) NOT NULL,
  `AgenteNacimiento` date DEFAULT NULL,
  `AgenteGrupo` varchar(1) NOT NULL,
  `AgenteFoto` varchar(100) DEFAULT NULL,
  `AgenteGradoAcademico` varchar(80) DEFAULT NULL,
  `AgenteSede` int(1) DEFAULT NULL,
  `AgenteTurno` varchar(2) DEFAULT NULL,
  `AgenteEstado` varchar(10) DEFAULT NULL,
  `AgenteDireccion` varchar(50) NOT NULL,
  `AgenteDpiImagen` varchar(50) NOT NULL,
  `AgenteLicenciaImagen` varchar(50) NOT NULL,
  `AgenteContantoEmergencia` int(8) NOT NULL,
  `AgenteContantoPersonal` int(8) NOT NULL,
  `AgenteCV` varchar(50) NOT NULL,
  `AgenteTatuaje` varchar(50) NOT NULL,
  `IdPuesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla que tiene los agentes de seguridad';

--
-- Volcado de datos para la tabla `agente`
--

INSERT INTO `agente` (`IdAgente`, `AgenteDpi`, `AgenteNombre`, `AgenteApellido`, `AgenteNacimiento`, `AgenteGrupo`, `AgenteFoto`, `AgenteGradoAcademico`, `AgenteSede`, `AgenteTurno`, `AgenteEstado`, `AgenteDireccion`, `AgenteDpiImagen`, `AgenteLicenciaImagen`, `AgenteContantoEmergencia`, `AgenteContantoPersonal`, `AgenteCV`, `AgenteTatuaje`, `IdPuesto`) VALUES
(69, '444', 'asdf', 'safd', '2020-05-20', 'A', 'adjuntos/fotoAgentes/AG4957629-69.jpg', 'asdf', 0, 'Si', '', '', '0', '', 0, 0, '', '', 0),
(70, '44', 'adsf', 'asdf', '2020-05-20', 'A', 'adjuntos/fotoAgentes/AG5804958-70.png', 'asdf', 1, 'Si', '1', '', '0', '', 0, 0, '', '', 1),
(71, '1212', 'asdf', 'asdfsadf', '2020-05-21', 'A', 'adjuntos/fotoAgentes/AG5272526-71.jpg', 'asdfdsaf', 2, 'Si', '2', '', '0', '', 0, 0, '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agentes_comitiva`
--

CREATE TABLE `agentes_comitiva` (
  `id_agentes_comitiva` int(11) NOT NULL,
  `id_agente` int(3) DEFAULT NULL,
  `id_comitiva` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agente_curso`
--

CREATE TABLE `agente_curso` (
  `id_agente_curso` int(5) NOT NULL,
  `id_agente` int(3) NOT NULL,
  `id_curso` int(2) NOT NULL,
  `punteo` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Agregará un curso a un agente segun el id del agente';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agente_habilidad`
--

CREATE TABLE `agente_habilidad` (
  `idagente_habilidad` int(5) NOT NULL,
  `id_agente` int(3) NOT NULL,
  `id_habilidad` int(2) NOT NULL,
  `punteo` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Encargada de agregar una habilidad a un agente';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antecedentes_medicos`
--

CREATE TABLE `antecedentes_medicos` (
  `id` int(11) NOT NULL,
  `idAgente` int(3) NOT NULL,
  `AntecedentesPeso` decimal(10,2) NOT NULL,
  `AntecedentesEstatura` decimal(10,2) NOT NULL,
  `AntecedentesPesoIdeal` decimal(10,2) NOT NULL,
  `AntecedentesProblemasMedicos` varchar(300) NOT NULL,
  `AntecedentesAlergias` varchar(200) NOT NULL,
  `AntecedentesFichaMedica` varchar(50) NOT NULL,
  `AntecedentesTipoSangre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `antecedentes_medicos`
--

INSERT INTO `antecedentes_medicos` (`id`, `idAgente`, `AntecedentesPeso`, `AntecedentesEstatura`, `AntecedentesPesoIdeal`, `AntecedentesProblemasMedicos`, `AntecedentesAlergias`, `AntecedentesFichaMedica`, `AntecedentesTipoSangre`) VALUES
(11, 68, '44.00', '44.00', '122.00', 'asdf', 'adsf', 'adjuntos/fichaMedicaAgentes/AG2491186-68.jpg', ''),
(12, 69, '33.00', '33.00', '33.00', 'asdf', 'sad', 'adjuntos/fichaMedicaAgentes/AG4957629-69.png', ''),
(13, 70, '44.00', '44.00', '44.00', 'asdf', 'asdf', 'adjuntos/fichaMedicaAgentes/AG5804958-70.png', ''),
(14, 71, '444.00', '23452345.00', '99999999.99', 'asdfasdf', 'asdfdsaf', 'adjuntos/fichaMedicaAgentes/AG5272526-71.png', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` int(10) NOT NULL,
  `BitacoraCodigo` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `BitacoraFecha` date NOT NULL,
  `BitacoraHoraInicio` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `BitacoraHoraFinal` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `BitacoraTipo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `BitacoraYear` int(4) NOT NULL,
  `CuentaCodigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id`, `BitacoraCodigo`, `BitacoraFecha`, `BitacoraHoraInicio`, `BitacoraHoraFinal`, `BitacoraTipo`, `BitacoraYear`, `CuentaCodigo`) VALUES
(38, 'CB7825511-1', '2020-05-07', '05:39:15 pm', '05:39:17 pm', 'Administrador', 2020, 'AC4855552-13'),
(39, 'CB3312921-2', '2020-05-07', '05:39:19 pm', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(40, 'CB0194522-3', '2020-05-07', '05:49:04 pm', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(41, 'CB5238751-4', '2020-05-07', '05:49:09 pm', '07:27:40 pm', 'Administrador', 2020, 'AC4855552-13'),
(42, 'CB1995938-5', '2020-05-07', '07:27:41 pm', '09:37:01 pm', 'Administrador', 2020, 'AC4855552-13'),
(43, 'CB3196497-6', '2020-05-07', '09:37:02 pm', '09:42:33 pm', 'Administrador', 2020, 'AC4855552-13'),
(44, 'CB3910629-7', '2020-05-07', '09:43:04 pm', '09:43:26 pm', 'Administrador', 2020, 'AC4855552-13'),
(45, 'CB2437762-8', '2020-05-07', '09:45:08 pm', '09:45:54 pm', 'Administrador', 2020, 'AC4855552-13'),
(46, 'CB3370121-9', '2020-05-07', '09:45:58 pm', '09:47:44 pm', 'Administrador', 2020, 'AC4855552-13'),
(47, 'CB6463421-10', '2020-05-07', '09:48:49 pm', '09:48:56 pm', 'Administrador', 2020, 'AC4855552-13'),
(48, 'CB5971229-11', '2020-05-07', '09:49:02 pm', '09:49:25 pm', 'Administrador', 2020, 'AC6245928-2'),
(49, 'CB1908605-12', '2020-05-07', '09:57:37 pm', '08:58:34 am', 'Administrador', 2020, 'AC6245928-2'),
(50, 'CB8164584-13', '2020-05-08', '08:58:49 am', '10:37:08 am', 'Administrador', 2020, 'AC6245928-2'),
(51, 'CB1577272-14', '2020-05-08', '10:37:22 am', 'Sin Registro', 'Administrador', 2020, 'AC6245928-2'),
(52, 'CB8591751-15', '2020-05-12', '10:14:45 am', '10:15:05 am', 'Administrador', 2020, 'AC4855552-13'),
(53, 'CB1395355-16', '2020-05-12', '10:15:31 am', '10:46:58 am', 'Administrador', 2020, 'AC4855552-13'),
(54, 'CB5437286-17', '2020-05-19', '10:35:43 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(55, 'CB2774276-18', '2020-05-19', '11:54:33 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(56, 'CB1336462-19', '2020-05-19', '11:55:20 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(57, 'CB7920099-20', '2020-05-19', '11:55:33 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(58, 'CB5059049-21', '2020-05-19', '12:06:08 pm', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(59, 'CB3524684-22', '2020-05-19', '12:09:57 pm', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(60, 'CB3825369-23', '2020-05-19', '12:17:31 pm', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(61, 'CB5431607-24', '2020-06-17', '10:37:21 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(62, 'CB0230990-25', '2020-06-17', '10:38:56 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(63, 'CB3767450-26', '2020-06-23', '10:15:26 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(64, 'CB0685194-27', '2020-06-23', '10:15:47 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(65, 'CB3458376-28', '2020-07-02', '09:31:19 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(66, 'CB9635702-29', '2020-07-02', '09:33:09 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(67, 'CB3778118-30', '2020-07-02', '10:41:39 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(68, 'CB8353089-31', '2020-07-02', '10:42:36 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(69, 'CB0320729-32', '2020-07-02', '10:45:10 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(70, 'CB5284632-33', '2020-07-02', '10:49:24 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(71, 'CB2965126-34', '2020-07-02', '11:03:16 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(72, 'CB6115404-35', '2020-07-02', '11:17:38 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(73, 'CB6348121-36', '2020-07-02', '11:18:39 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(74, 'CB4634193-37', '2020-07-02', '11:30:06 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(75, 'CB0884318-38', '2020-07-02', '11:36:40 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(76, 'CB4157177-39', '2020-07-02', '11:38:51 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(77, 'CB2355672-40', '2020-07-02', '11:40:53 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(78, 'CB4780198-41', '2020-07-02', '11:49:15 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(79, 'CB5809286-42', '2020-07-02', '11:50:46 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(80, 'CB4272936-43', '2020-07-07', '09:24:26 am', '09:25:15 am', 'Administrador', 2020, 'AC4855552-13'),
(81, 'CB9600986-44', '2020-07-07', '09:25:21 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(82, 'CB1072177-45', '2020-07-07', '10:07:41 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(83, 'CB4521983-46', '2020-07-07', '10:11:47 am', '12:33:43 pm', 'Administrador', 2020, 'AC4855552-13'),
(84, 'CB2594370-47', '2020-07-09', '12:34:00 pm', '12:35:19 pm', 'Administrador', 2020, 'AC4855552-13'),
(85, 'CB7916455-48', '2020-07-09', '12:43:07 pm', '12:44:48 pm', 'Administrador', 2020, 'AC4855552-13'),
(86, 'CB3064902-49', '2020-07-09', '02:27:13 pm', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(87, 'CB4171882-50', '2020-07-21', '09:58:51 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(88, 'CB4462103-51', '2020-07-21', '10:28:02 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(89, 'CB7777820-52', '2020-07-21', '10:32:25 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(90, 'CB8932068-53', '2020-08-03', '10:38:45 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(91, 'CB5860358-54', '2020-08-18', '08:27:53 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(92, 'CB7172022-55', '2020-08-26', '10:51:07 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13'),
(93, 'CB8686578-56', '2020-09-18', '11:22:00 am', 'Sin Registro', 'Administrador', 2020, 'AC4855552-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_agente`
--

CREATE TABLE `bitacora_agente` (
  `id` int(11) NOT NULL,
  `IdAgente` int(3) NOT NULL,
  `BitacoraFecha` date NOT NULL,
  `BitacoraInicioOFin` int(1) NOT NULL,
  `BitacoraTipo` int(1) NOT NULL COMMENT 'si es bitacora de comitiva, instalaciones, comision etc.',
  `BitacoraDescripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comitiva`
--

CREATE TABLE `comitiva` (
  `IdComitiva` int(3) NOT NULL,
  `IdTipoComitiva` int(2) NOT NULL,
  `ComitivaNombre` varchar(45) NOT NULL,
  `ComitivaDescripcion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Habran un tipo de comitiva';

--
-- Volcado de datos para la tabla `comitiva`
--

INSERT INTO `comitiva` (`IdComitiva`, `IdTipoComitiva`, `ComitivaNombre`, `ComitivaDescripcion`) VALUES
(1, 0, ':Nombre', ':Descripcion'),
(2, 2, 'df', 'df'),
(3, 2, 'df', 'df');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `id` int(10) NOT NULL,
  `CuentaCodigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaPrivilegio` int(1) NOT NULL,
  `CuentaUsuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaClave` varchar(535) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaEmail` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaEstado` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaTipo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaGenero` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaFoto` varchar(535) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`id`, `CuentaCodigo`, `CuentaPrivilegio`, `CuentaUsuario`, `CuentaClave`, `CuentaEmail`, `CuentaEstado`, `CuentaTipo`, `CuentaGenero`, `CuentaFoto`) VALUES
(1, 'AC4855552-13', 1, 'rescobar2010', 'WC9MZFh3SDdQTlhpamdGb1JCRHREZz09', '', 'Activo', 'Administrador', 'Masculino', 'Male1Avatar.png'),
(34, 'AC6245928-2', 1, 'rescobar2', 'VEh5bUpLYkdiaHg0TlFJczYvbDkyZz09', '', 'Activo', 'Administrador', 'Masculino', 'Male1Avatar.png'),
(35, 'AC8575697-3', 1, 'rescobar3', 'UDBjZ3h3SHJGTi9zK3dmWitqMHBmQT09', 'robinsolises@hotmail.com', 'Activo', 'Administrador', 'Masculino', 'Male1Avatar.png'),
(36, 'AC4618677-4', 2, 'jgarcia', 'enVRZmhaa1B5UHU3cmJ1T1BwWGhvZz09', '', 'Activo', 'Administrador', 'Masculino', 'Male1Avatar.png'),
(37, 'AC8933907-5', 3, 'asdfasdf', 'SEtURXA2VlFJaFpJTTJ3cWdiRVM1dz09', '', 'Activo', 'Administrador', 'Masculino', 'Male1Avatar.png'),
(38, 'AC3786667-6', 3, 'fdasfdsa', 'ajdmeTJvMVEyZDIxK1orM2w3NnhjUT09', '', 'Activo', 'Administrador', 'Masculino', 'Male1Avatar.png'),
(39, 'AC3645238-7', 3, 'qwerqwer', 'Ni9ucGN1L2srWnp4OE9QSWpCRE5WZz09', '', 'Activo', 'Administrador', 'Masculino', 'Male1Avatar.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id_cursos` int(2) NOT NULL,
  `curso` varchar(45) NOT NULL,
  `rango` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Listado de cursos que tienen los agentes de seguridad';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `IdEstado` int(11) NOT NULL,
  `EstadoNombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`IdEstado`, `EstadoNombre`) VALUES
(1, 'Activo'),
(2, 'Baja'),
(3, 'Suspendido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habilidad`
--

CREATE TABLE `habilidad` (
  `id_habilidad` int(2) NOT NULL,
  `habilidad` varchar(45) NOT NULL,
  `rango` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla que muestra el tipo de habilidad que pueden tener los agentes y un valor para cada habilidad';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebas_confianza`
--

CREATE TABLE `pruebas_confianza` (
  `id` int(4) NOT NULL,
  `id_agente` int(3) NOT NULL,
  `id_tipo_prueba` int(2) NOT NULL,
  `fecha` date NOT NULL,
  `justificacion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `IdPuesto` int(11) NOT NULL,
  `PuestoNombre` varchar(30) NOT NULL,
  `PuestoFunciones` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`IdPuesto`, `PuestoNombre`, `PuestoFunciones`) VALUES
(1, 'Instalaciones', 'Resguardar instalciones y personal de la institucion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `IdSede` int(2) NOT NULL,
  `SedeNombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`IdSede`, `SedeNombre`) VALUES
(1, 'Zona 4'),
(2, 'Zona 9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoComitiva`
--

CREATE TABLE `tipoComitiva` (
  `IdTipoComitiva` int(3) NOT NULL,
  `TipoComitivaNombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tipos de comitiva que pueden haber';

--
-- Volcado de datos para la tabla `tipoComitiva`
--

INSERT INTO `tipoComitiva` (`IdTipoComitiva`, `TipoComitivaNombre`) VALUES
(1, 'Señor Director'),
(2, 'Jefe de Inteligencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoSangre`
--

CREATE TABLE `tipoSangre` (
  `IdTipoSangre` int(2) NOT NULL,
  `TipoSangreNombre` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CuentaCodigo` (`CuentaCodigo`);

--
-- Indices de la tabla `agente`
--
ALTER TABLE `agente`
  ADD PRIMARY KEY (`IdAgente`);

--
-- Indices de la tabla `agentes_comitiva`
--
ALTER TABLE `agentes_comitiva`
  ADD PRIMARY KEY (`id_agentes_comitiva`);

--
-- Indices de la tabla `agente_curso`
--
ALTER TABLE `agente_curso`
  ADD PRIMARY KEY (`id_agente_curso`);

--
-- Indices de la tabla `agente_habilidad`
--
ALTER TABLE `agente_habilidad`
  ADD PRIMARY KEY (`idagente_habilidad`);

--
-- Indices de la tabla `antecedentes_medicos`
--
ALTER TABLE `antecedentes_medicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idAgente` (`idAgente`);

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CuentaCodigo` (`CuentaCodigo`);

--
-- Indices de la tabla `bitacora_agente`
--
ALTER TABLE `bitacora_agente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comitiva`
--
ALTER TABLE `comitiva`
  ADD PRIMARY KEY (`IdComitiva`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `CuentaCodigo` (`CuentaCodigo`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_cursos`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`IdEstado`);

--
-- Indices de la tabla `habilidad`
--
ALTER TABLE `habilidad`
  ADD PRIMARY KEY (`id_habilidad`);

--
-- Indices de la tabla `pruebas_confianza`
--
ALTER TABLE `pruebas_confianza`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`IdPuesto`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`IdSede`);

--
-- Indices de la tabla `tipoComitiva`
--
ALTER TABLE `tipoComitiva`
  ADD PRIMARY KEY (`IdTipoComitiva`);

--
-- Indices de la tabla `tipoSangre`
--
ALTER TABLE `tipoSangre`
  ADD PRIMARY KEY (`IdTipoSangre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `agente`
--
ALTER TABLE `agente`
  MODIFY `IdAgente` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `agentes_comitiva`
--
ALTER TABLE `agentes_comitiva`
  MODIFY `id_agentes_comitiva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `antecedentes_medicos`
--
ALTER TABLE `antecedentes_medicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `bitacora_agente`
--
ALTER TABLE `bitacora_agente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comitiva`
--
ALTER TABLE `comitiva`
  MODIFY `IdComitiva` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id_cursos` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `IdEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `habilidad`
--
ALTER TABLE `habilidad`
  MODIFY `id_habilidad` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pruebas_confianza`
--
ALTER TABLE `pruebas_confianza`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `IdPuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sede`
--
ALTER TABLE `sede`
  MODIFY `IdSede` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipoComitiva`
--
ALTER TABLE `tipoComitiva`
  MODIFY `IdTipoComitiva` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipoSangre`
--
ALTER TABLE `tipoSangre`
  MODIFY `IdTipoSangre` int(2) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`CuentaCodigo`) REFERENCES `cuenta` (`CuentaCodigo`);

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`CuentaCodigo`) REFERENCES `cuenta` (`CuentaCodigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
