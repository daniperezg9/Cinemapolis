-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2024 a las 21:27:48
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
('user1@gmail.com', 'Quedada para ver la nueva pelicula', 'A las 8pm en el centro', '2024-04-15', '2024-04-14');

--
-- Truncar tablas antes de insertar `foro`
--

TRUNCATE TABLE `foro`;
--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`id_foro`, `contacto`, `mensaje`, `fecha_envio`) VALUES
('Sakra', 'user1@gmail.com', 'La mejor pelicula que he visto', '2024-04-15 00:00:00');

--
-- Truncar tablas antes de insertar `genero_peliculas`
--

TRUNCATE TABLE `genero_peliculas`;
--
-- Volcado de datos para la tabla `genero_peliculas`
--

INSERT INTO `genero_peliculas` (`titulo`, `genero`) VALUES
('El mundo de ayer', 'Drama'),
('Paisaje con mano invisible', 'Ciencia ficción'),
('Sakra', 'Animación'),
('Yakitori: Soldados de la desdicha', 'Animación');

--
-- Truncar tablas antes de insertar `lista_foros`
--

TRUNCATE TABLE `lista_foros`;
--
-- Volcado de datos para la tabla `lista_foros`
--

INSERT INTO `lista_foros` (`id_foro`, `contacto`, `descripcion`) VALUES
('Sakra', 'user1@gmail.com', 'Foro para opinar sobre la pelicula Sakra');

--
-- Truncar tablas antes de insertar `peliculas`
--

TRUNCATE TABLE `peliculas`;
--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`titulo`, `descripcion`, `fecha_estreno`, `direccion_fotografia`, `alt`) VALUES
('El mundo de ayer', 'Mientras se prepara para dejar la política, Elisabeth de Raincy, presidenta de Francia, descubre que un escándalo afectará a su sucesor designado y dará la victoria al candidato de extrema derecha. ', '2023-10-11', './images/2024-04-10-21-11-38-El mundo de ayer.jpg', 'una señora mirando por la ventana'),
('Paisaje con mano invisible', 'Adam es un artista adolescente que llega a la mayoría de edad después de una invasión alienígena. ', '2023-01-20', './images/2024-04-10-21-10-13-Paisaje con mano invisible.jpg', 'Un cangrejo con el cielo de fondo'),
('Sakra', 'Cuando un artista marcial respetado es acusado de asesinato, emprende un viaje en busca de respuestas sobre su misterioso pasado y los enemigos que buscan destruirlo.', '2023-05-18', './images/2024-04-10-21-08-11-sakra.jpg', 'personaje principal rodeado de enemigos y amenazando con una'),
('Yakitori: Soldados de la desdicha', 'Con la Tierra colonizada por una civilización alienígena superior, Akira solo tiene una oportunidad de tener un futuro mejor: alistarse como soldado Yakitori.', '2023-05-18', './images/2024-04-10-21-06-57-yakitori.jpg', 'personajes principales posando');

--
-- Truncar tablas antes de insertar `resenyas`
--

TRUNCATE TABLE `resenyas`;
--
-- Volcado de datos para la tabla `resenyas`
--

INSERT INTO `resenyas` (`contacto`, `pelicula`, `mensaje`) VALUES
('user1@gmail.com', 'Sakra', 'Muy buena pelicula, la recomiendo a todo el mundo');

--
-- Truncar tablas antes de insertar `usuarios`
--

TRUNCATE TABLE `usuarios`;
--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `contacto`, `admin`, `pass`) VALUES
('admin', 'admin@admin.es', 1, '$2y$10$KWXhxyHlnNCAeJUC/rgDTe8CGCUPulPSawCWweiW4fk2NuYzR1.f6'),
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
-- Truncar tablas antes de insertar `usuario_en_foro`
--

TRUNCATE TABLE `usuario_en_foro`;

--
-- Truncar tablas antes de insertar `valoraciones`
--

TRUNCATE TABLE `valoraciones`;
--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`contacto`, `pelicula`, `puntuacion`) VALUES
('user1@gmail.com', 'Sakra', 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
