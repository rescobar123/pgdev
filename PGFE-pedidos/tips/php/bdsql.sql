-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-07-2020 a las 00:42:26
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `colegio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dat_gen`
--

CREATE TABLE `dat_gen` (
  `codigo` varchar(30) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `nacimiento` date NOT NULL,
  `genero` varchar(10) NOT NULL,
  `sangre` varchar(10) NOT NULL,
  `alergico` varchar(200) NOT NULL,
  `observa` varchar(400) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `papa` varchar(60) NOT NULL,
  `mama` varchar(60) NOT NULL,
  `ecargado` varchar(60) NOT NULL,
  `telefonopa` varchar(30) NOT NULL,
  `telefonoma` varchar(30) NOT NULL,
  `telefonoen` varchar(30) NOT NULL,
  `direccionpa` varchar(30) NOT NULL,
  `direccionma` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dat_gen`
--

INSERT INTO `dat_gen` (`codigo`, `nombre`, `nacimiento`, `genero`, `sangre`, `alergico`, `observa`, `direccion`, `papa`, `mama`, `ecargado`, `telefonopa`, `telefonoma`, `telefonoen`, `direccionpa`, `direccionma`, `foto`) VALUES
('A200', 'Josu&eacute; ', '1995-02-11', 'Masculino', '0+', '', 'Tiene un lunat en la nariz', 'Ciudad capital', 'Martin', 'Juana', 'Maria', '43949868', '3576111', '5544432', 'Ciudad capital', 'Ciudad capital', '../usuarios/foto_perfil/perfil.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dat_gen`
--
ALTER TABLE `dat_gen`
  ADD PRIMARY KEY (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
