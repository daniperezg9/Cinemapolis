-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-03-2024 a las 21:02:55
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET FOREIGN_KEY_CHECKS=0;
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

--
-- Truncar tablas antes de insertar `chat`
--

TRUNCATE TABLE `chat`;
--
-- Truncar tablas antes de insertar `eventos`
--

TRUNCATE TABLE `eventos`;
--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`creador_evento`, `nombre_evento`, `descripcion_evento`, `fecha_evento`, `fecha_creacion`) VALUES
('user1@gmail.com', 'evento generico', 'no tiene', '2024-03-08', '2024-03-07');

--
-- Truncar tablas antes de insertar `foro`
--

TRUNCATE TABLE `foro`;
--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`id_foro`, `contacto`, `mensaje`, `fecha_envio`) VALUES
('lloreria', 'user1@gmail.com', 'hasta las 9 pm', '2024-03-07');

--
-- Truncar tablas antes de insertar `genero_peliculas`
--

TRUNCATE TABLE `genero_peliculas`;
--
-- Volcado de datos para la tabla `genero_peliculas`
--

INSERT INTO `genero_peliculas` (`titulo`, `genero`) VALUES
('patata', 'patata'),
('peliculanumero1', 'peliculanumero1'),
('peliculanumero2', 'peliculanumero2');

--
-- Truncar tablas antes de insertar `lista_foros`
--

TRUNCATE TABLE `lista_foros`;
--
-- Volcado de datos para la tabla `lista_foros`
--

INSERT INTO `lista_foros` (`id_foro`, `contacto`, `descripcion`) VALUES
('lloreria', 'user1@gmail.com', 'no tiene');

--
-- Truncar tablas antes de insertar `peliculas`
--

TRUNCATE TABLE `peliculas`;
--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`titulo`, `descripcion`, `fecha_estreno`, `direccion_fotografia`) VALUES
('patata', 'patata', '2024-03-05', 'patata'),
('pelicula', 'pelicula', '2024-03-11', ''),
('peliculanumero1', 'peliculanumero1', '2024-03-19', 'peliculanumero1'),
('peliculanumero2', 'peliculanumero2', '2024-03-21', 'peliculanumero2');

--
-- Truncar tablas antes de insertar `resenyas`
--

TRUNCATE TABLE `resenyas`;
--
-- Volcado de datos para la tabla `resenyas`
--

INSERT INTO `resenyas` (`contacto`, `pelicula`, `mensaje`) VALUES
('user1@gmail.com', 'patata', 'asd');

--
-- Truncar tablas antes de insertar `usuarios`
--

TRUNCATE TABLE `usuarios`;
--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `contacto`, `admin`, `pass`) VALUES
('patata', 'patata', 0, '$2y$10$EBWWNGz0VzetgRpYjz6RSOJvs3L8TJx3o5AIYu0qTHb.IDtw3YwfW'),
('user1', 'user1@gmail.com', 1, '$2y$10$nwh.rwu4HBJ4YCqLpDVNAu.E3SK3DUTeJJxOIiPssnXFce6U2BPgq'),
('user2', 'user2@gmail.com', 0, '$2y$10$PQBG6TKuB2vgokELqJEEBeKnEUDcFbwYrjB5oRHNQYa1ug6fB.UkS'),
('user3', 'user3@gmail.com', 0, '$2y$10$Xyhjrh0psrJp6LdCvzdqZ.4Q0X3GBaz11PSdoQCK2IT7elbECn7QW'),
('user4', 'user4@gmail.com', 0, '$2y$10$VSC4v5YBwd2rJ5X0BjbphuSQjpAGAVpxQ0MDujYAMvxNGoSuJEtOm'),
('user5', 'user5@gmail.com', 0, '$2y$10$v6Q9g2xVticzqL9Nljqk2uDn8rRbDRBfToDgvkJk3eKPUBCjSs9oe');

--
-- Truncar tablas antes de insertar `usuario_en_evento`
--

TRUNCATE TABLE `usuario_en_evento`;
--
-- Volcado de datos para la tabla `usuario_en_evento`
--

INSERT INTO `usuario_en_evento` (`contacto`, `nombre_evento`, `fecha_evento`) VALUES
('user1@gmail.com', 'evento generico', '2024-03-08');

--
-- Truncar tablas antes de insertar `usuario_en_foro`
--

TRUNCATE TABLE `usuario_en_foro`;
--
-- Volcado de datos para la tabla `usuario_en_foro`
--

INSERT INTO `usuario_en_foro` (`contacto`, `id_foro`) VALUES
('user1@gmail.com', 'lloreria');

--
-- Truncar tablas antes de insertar `valoraciones`
--

TRUNCATE TABLE `valoraciones`;
--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`contacto`, `pelicula`, `puntuacion`) VALUES
('user1@gmail.com', 'patata', 2);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
