-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2024 a las 19:17:42
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cinemapolis`
--
CREATE DATABASE IF NOT EXISTS `cinemapolis` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cinemapolis`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `remitente` varchar(50) NOT NULL,
  `receptor` varchar(50) NOT NULL,
  `mensaje` varchar(140) NOT NULL,
  `fecha_envio` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE `eventos` (
  `creador_evento` varchar(50) NOT NULL,
  `nombre_evento` varchar(100) NOT NULL,
  `descripcion_evento` varchar(500) NOT NULL,
  `fecha_evento` date NOT NULL,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

DROP TABLE IF EXISTS `foro`;
CREATE TABLE `foro` (
  `id_foro` varchar(50) NOT NULL,
  `contacto` varchar(50) NOT NULL,
  `mensaje` varchar(140) NOT NULL,
  `fecha_envio` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero_peliculas`
--

DROP TABLE IF EXISTS `genero_peliculas`;
CREATE TABLE `genero_peliculas` (
  `titulo` varchar(100) NOT NULL,
  `genero` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_foros`
--

DROP TABLE IF EXISTS `lista_foros`;
CREATE TABLE `lista_foros` (
  `id_foro` varchar(50) NOT NULL,
  `contacto` varchar(50) NOT NULL,
  `descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

DROP TABLE IF EXISTS `peliculas`;
CREATE TABLE `peliculas` (
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `fecha_estreno` date NOT NULL,
  `direccion_fotografia` varchar(200) NOT NULL,
  `alt` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resenyas`
--

DROP TABLE IF EXISTS `resenyas`;
CREATE TABLE `resenyas` (
  `contacto` varchar(50) NOT NULL,
  `pelicula` varchar(100) NOT NULL,
  `mensaje` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `nombre` varchar(50) NOT NULL,
  `contacto` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `pass` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_en_evento`
--

DROP TABLE IF EXISTS `usuario_en_evento`;
CREATE TABLE `usuario_en_evento` (
  `contacto` varchar(50) NOT NULL,
  `nombre_evento` varchar(100) NOT NULL,
  `fecha_evento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_en_foro`
--

DROP TABLE IF EXISTS `usuario_en_foro`;
CREATE TABLE `usuario_en_foro` (
  `contacto` varchar(50) NOT NULL,
  `id_foro` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

DROP TABLE IF EXISTS `valoraciones`;
CREATE TABLE `valoraciones` (
  `contacto` varchar(50) NOT NULL,
  `pelicula` varchar(100) NOT NULL,
  `puntuacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`remitente`,`receptor`,`fecha_envio`),
  ADD KEY `receptor` (`receptor`),
  ADD KEY `remitente` (`remitente`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`creador_evento`,`nombre_evento`,`fecha_evento`),
  ADD KEY `creador_evento` (`creador_evento`);

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`id_foro`,`contacto`,`fecha_envio`),
  ADD KEY `contacto` (`contacto`),
  ADD KEY `id_foro` (`id_foro`);

--
-- Indices de la tabla `genero_peliculas`
--
ALTER TABLE `genero_peliculas`
  ADD PRIMARY KEY (`titulo`,`genero`),
  ADD KEY `titulo` (`titulo`);

--
-- Indices de la tabla `lista_foros`
--
ALTER TABLE `lista_foros`
  ADD PRIMARY KEY (`id_foro`,`contacto`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`titulo`),
  ADD KEY `titulo` (`titulo`);

--
-- Indices de la tabla `resenyas`
--
ALTER TABLE `resenyas`
  ADD PRIMARY KEY (`contacto`,`pelicula`),
  ADD KEY `contacto` (`contacto`,`pelicula`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`contacto`,`pass`),
  ADD KEY `contacto` (`contacto`);

--
-- Indices de la tabla `usuario_en_evento`
--
ALTER TABLE `usuario_en_evento`
  ADD PRIMARY KEY (`contacto`,`nombre_evento`,`fecha_evento`),
  ADD KEY `contacto` (`contacto`,`nombre_evento`,`fecha_evento`);

--
-- Indices de la tabla `usuario_en_foro`
--
ALTER TABLE `usuario_en_foro`
  ADD PRIMARY KEY (`contacto`,`id_foro`),
  ADD KEY `id_foro` (`id_foro`),
  ADD KEY `contacto` (`contacto`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`contacto`,`pelicula`),
  ADD KEY `contacto` (`contacto`,`pelicula`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`remitente`) REFERENCES `usuarios` (`contacto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`receptor`) REFERENCES `usuarios` (`contacto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`creador_evento`) REFERENCES `usuarios` (`contacto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `foro`
--
ALTER TABLE `foro`
  ADD CONSTRAINT `foro_ibfk_1` FOREIGN KEY (`contacto`) REFERENCES `usuarios` (`contacto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `resenyas`
--
ALTER TABLE `resenyas`
  ADD CONSTRAINT `resenyas_ibfk_1` FOREIGN KEY (`contacto`) REFERENCES `usuarios` (`contacto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_en_evento`
--
ALTER TABLE `usuario_en_evento`
  ADD CONSTRAINT `usuario_en_evento_ibfk_1` FOREIGN KEY (`contacto`) REFERENCES `usuarios` (`contacto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_en_foro`
--
ALTER TABLE `usuario_en_foro`
  ADD CONSTRAINT `usuario_en_foro_ibfk_1` FOREIGN KEY (`contacto`) REFERENCES `usuarios` (`contacto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_en_foro_ibfk_2` FOREIGN KEY (`id_foro`) REFERENCES `foro` (`id_foro`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `valoraciones_ibfk_1` FOREIGN KEY (`contacto`) REFERENCES `usuarios` (`contacto`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
