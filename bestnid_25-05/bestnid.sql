-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-05-2015 a las 01:13:51
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bestnid`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `email` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `fechaAlta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`email`, `password`, `fechaAlta`) VALUES
('admin1@administracion.com', 'admin1', '2015-05-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `nombre` varchar(50) NOT NULL,
`idCategoria` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria-publicacion`
--

CREATE TABLE IF NOT EXISTS `categoria-publicacion` (
  `idPublicacion` int(10) NOT NULL,
  `idCategoria` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE IF NOT EXISTS `localidad` (
  `nombre` varchar(100) NOT NULL,
  `codigoPostal` int(10) NOT NULL,
`idLocalidad` int(10) NOT NULL,
  `provincia` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `nombre` varchar(255) NOT NULL,
`idPais` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE IF NOT EXISTS `provincia` (
  `nombre` varchar(255) NOT NULL,
`idProvincia` int(10) NOT NULL,
  `pais` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE IF NOT EXISTS `publicacion` (
`numeroPublicacion` int(20) NOT NULL,
  `titulo` int(11) NOT NULL,
  `fechaCreacion` date NOT NULL,
  `fechaFinalizacion` date NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrado`
--

CREATE TABLE IF NOT EXISTS `registrado` (
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `dni` int(8) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fechaAlta` date NOT NULL,
  `fechaNacimiento` text NOT NULL,
  `borrado` int(1) NOT NULL DEFAULT '0',
  `sexo` varchar(1) NOT NULL,
  `calle` varchar(255) NOT NULL,
  `numCalle` int(7) NOT NULL,
  `departamento` varchar(4) DEFAULT NULL,
  `piso` int(4) DEFAULT NULL,
  `localidad` int(10) DEFAULT NULL,
  `tarjeta` bigint(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeta`
--

CREATE TABLE IF NOT EXISTS `tarjeta` (
  `numero` bigint(16) NOT NULL,
  `codSeguridad` int(4) NOT NULL,
  `empresa` varchar(50) DEFAULT NULL,
  `banco` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fechaVencimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `email` varchar(255) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
 ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
 ADD PRIMARY KEY (`idCategoria`), ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `categoria-publicacion`
--
ALTER TABLE `categoria-publicacion`
 ADD UNIQUE KEY `numeroPublicacion` (`idPublicacion`,`idCategoria`), ADD KEY `idCategoria` (`idCategoria`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
 ADD PRIMARY KEY (`idLocalidad`), ADD UNIQUE KEY `codigoPostal` (`codigoPostal`), ADD UNIQUE KEY `provincia` (`provincia`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
 ADD PRIMARY KEY (`idPais`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
 ADD PRIMARY KEY (`idProvincia`), ADD UNIQUE KEY `pais` (`pais`);

--
-- Indices de la tabla `publicacion`
--
ALTER TABLE `publicacion`
 ADD PRIMARY KEY (`numeroPublicacion`), ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `registrado`
--
ALTER TABLE `registrado`
 ADD PRIMARY KEY (`email`), ADD UNIQUE KEY `dni` (`dni`), ADD UNIQUE KEY `tarjeta` (`tarjeta`), ADD UNIQUE KEY `localidad` (`localidad`);

--
-- Indices de la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
 ADD PRIMARY KEY (`numero`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
MODIFY `idCategoria` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
MODIFY `idLocalidad` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
MODIFY `idPais` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
MODIFY `idProvincia` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
MODIFY `numeroPublicacion` int(20) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria-publicacion`
--
ALTER TABLE `categoria-publicacion`
ADD CONSTRAINT `categoria-publicacion_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`);

--
-- Filtros para la tabla `localidad`
--
ALTER TABLE `localidad`
ADD CONSTRAINT `localidad_ibfk_1` FOREIGN KEY (`provincia`) REFERENCES `provincia` (`idProvincia`);

--
-- Filtros para la tabla `provincia`
--
ALTER TABLE `provincia`
ADD CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`pais`) REFERENCES `pais` (`idPais`);

--
-- Filtros para la tabla `publicacion`
--
ALTER TABLE `publicacion`
ADD CONSTRAINT `publicacion_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `registrado` (`email`);

--
-- Filtros para la tabla `registrado`
--
ALTER TABLE `registrado`
ADD CONSTRAINT `registrado_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`),
ADD CONSTRAINT `registrado_ibfk_3` FOREIGN KEY (`tarjeta`) REFERENCES `tarjeta` (`numero`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
