-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2024 a las 18:49:37
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

--
-- Truncar tablas antes de insertar `eventos`
--

TRUNCATE TABLE `eventos`;
--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`creador_evento`, `nombre_evento`, `descripcion_evento`, `fecha_evento`, `fecha_creacion`) VALUES
('admin@admin.es', 'Quedada para hablar del valle de las sombras', 'Os espero en el Meet', '2024-05-12', '2024-05-07'),
('admin@admin.es', 'veamos nimona (EDITADO)', 'vamos a verlo 13 veces seguidas (EDITADO)', '2024-05-02', '2024-05-07'),
('admin@admin.es', 'Noche de pelis retro', 'Te invito a ver los mejores clásicos del cine', '2024-05-11', '2024-05-08');

--
-- Truncar tablas antes de insertar `foro`
--

TRUNCATE TABLE `foro`;
--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`id_foro`, `contacto`, `mensaje`, `fecha_envio`) VALUES
('club de odio hacia Tarot', 'admin@admin.es', 'no entiendo por que existe esta pelicula', '2024-05-07 21:09:18'),
('club de odio hacia Tarot', 'user1@gmail.com', 'Oye pues a mi me encantó;', '2024-05-07 21:11:16'),
('Fans de Nimona', 'admin@admin.es', 'simplemente la mejor', '2024-05-07 21:09:01'),
('Garfield', 'user1@gmail.com', 'yo quiero lasañaaaa !!!', '2024-05-07 21:01:43'),
('Odio hacia nimona', 'user1@gmail.com', 'Es insufrible!!!!', '2024-05-07 21:11:00'),
('Valle de las sombras (explicaciones)', 'admin@admin.es', 'que alguien me explique el final', '2024-05-07 21:09:29');

--
-- Truncar tablas antes de insertar `genero_peliculas`
--

TRUNCATE TABLE `genero_peliculas`;
--
-- Volcado de datos para la tabla `genero_peliculas`
--

INSERT INTO `genero_peliculas` (`titulo`, `genero`) VALUES
('Garfield: la pelicula', 'Animación'),
('Misión hostil', 'Acción'),
('Nimona', 'Animación'),
('Tarot', 'Terror'),
('Valle de sombras', 'Ciencia ficción'),
('Mary Poppins', 'Fantasía'),
('El bueno, el feo y el malo', 'Western'),
('Shrek', 'Animación'),
('Los juegos del hambre', 'Acción');

--
-- Truncar tablas antes de insertar `lista_foros`
--

TRUNCATE TABLE `lista_foros`;
--
-- Volcado de datos para la tabla `lista_foros`
--

INSERT INTO `lista_foros` (`id_foro`, `contacto`, `descripcion`) VALUES
('Fans de Nimona', 'admin@admin.es', 'Hablemos de nuestra cambia-formas favorita'),
('club de odio hacia Tarot', 'admin@admin.es', 'Despotriquemos sobre la pelicula'),
('Valle de las sombras (explicaciones)', 'admin@admin.es', 'Intentemos entender la pelicula'),
('Garfield', 'user1@gmail.com', 'quien mas odia los lunes y ama la lasaña'),
('Odio hacia nimona', 'user1@gmail.com', 'simplemente la detesto');

--
-- Truncar tablas antes de insertar `peliculas`
--

TRUNCATE TABLE `peliculas`;
--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`titulo`, `descripcion`, `fecha_estreno`, `direccion_fotografia`, `alt`) VALUES
('Garfield: la pelicula', 'El mundialmente famoso Garfield , el gato casero que odia los lunes y que adora la lasaña, está a punto de vivir una aventura ¡en el salvaje mundo exterior! Tras una inesperada reunión con su largamente perdido padre – el desaliñado gato callejero Vic – Garfield y su amigo canino Odie se ven forzados a abandonar sus perfectas y consentidas vidas al unirse a Vic en un hilarante y muy arriesgado atraco.', '2024-05-01', './images/2024-05-07-20-20-30-garfield.jpg', 'gato naranja sobre un sofa'),
('Misión hostil', 'Reaper es un piloto de drones de la Fuerza Aérea que apoya una misión especial en el sur de Filipinas. Tras ver movimiento en la jungla durante su reconocimiento a&eacute;reo, la situaci&oacute;n toma un vuelco inesperado. El equipo de tierra, en el que se encuentran el sargento Kinney y sus compa&ntilde;eros, es atacado de manera fulminante y capturado por un grupo de insurgentes.', '2024-05-01', './images/2024-05-07-20-41-45-Misión hostil.jpg', 'un hombre con un arma de fuego'),
('Nimona', 'En un mundo medieval futurista, el caballero Ballister Bravocorazón es acusado de un crimen que no ha cometido, y la única persona que puede ayudarlo a demostrar su inocencia es Nimona, una traviesa adolescente con inclinación por el caos… que además resulta ser el ser metamorfo al que debe destruir.', '2023-06-18', './images/2024-05-07-20-23-40-nimona.jpg', 'ni&ntilde;a con el pelo rosa y alas de demonio'),
('Tarot', 'Cuando un grupo de amigos infringe de manera imprudente la regla sagrada de la lectura de las cartas del Tarot -nunca se debe utilizar la baraja de otra persona-, desatan sin saberlo un mal atrapado en las cartas malditas. Uno a uno, se enfrentan cara a cara al destino y acaban en una carrera contra la muerte para escapar del futuro que las cartas predicen.', '2024-05-10', './images/2024-05-07-20-26-23-Tarot.jpg', 'Una mano con una carta de tarot'),
('Valle de sombras', 'Cordillera del Himalaya, año 1999. Quique, Clara y el pequeño Lucas disfrutan de sus primeras vacaciones juntos en el norte de la India. Una noche, durmiendo al raso durante una tormenta, sufren un brutal ataque por unos bandidos. Horas después, Quique es rescatado por un nativo y trasladado a una remota aldea aislada en las montañas.', '2024-05-03', './images/2024-05-07-20-48-10-valle_de_sombras.jpg', 'Un hombre mirando a la nada'),
('Mary Poppins', 'La vida de dos niños rebeldes que pretenden llamar la atención de sus padres haciendo la vida imposible a todas las niñeras, se verá alterada con la llegada de Mary Poppins, una institutriz que baja de las nubes usando su paraguas como paracaídas.', '1965-12-02', './images/mary-poppins-portada.jpg', 'Mary Poppins volando'),
('El bueno, el feo y el malo', 'Los protagonistas son tres cazadores de recompensas que buscan un tesoro que ninguno de ellos puede encontrar sin la ayuda de los otros dos. Así que los tres colaboran entre sí, al menos en apariencia.', '1968-08-07', './images/bueno-feo-y-malo.jpg', 'El bueno, el feo y el malo de pie'),
('Shrek', 'Hace mucho tiempo, en una lejana ciénaga, vivía un ogro llamado Shrek. Un día, su preciada soledad se ve interrumpida por un montón de personajes de cuento de hadas que invaden su casa. Todos fueron desterrados de su reino por el malvado Lord Farquaad.', '2001-07-13', './images/shrek.jpg', 'Shrek, Asno, Fiona y Lord Farquaad'),
('Los juegos del hambre', 'Para demostrar su poder, el régimen del estado totalitario de Panem organiza cada año "Los juegos del hambre". En ellos, 24 jóvenes compiten el uno contra el otro en una batalla en la que solo puede haber un superviviente. La joven Katniss se ofrece voluntaria para participar en los juegos para salvar a su hermana.', '2012-04-20', './images/los-juegos-del-hambre.jpg', 'Katniss apuntando con el arco');

--
-- Truncar tablas antes de insertar `resenyas`
--

TRUNCATE TABLE `resenyas`;
--
-- Volcado de datos para la tabla `resenyas`
--

INSERT INTO `resenyas` (`contacto`, `pelicula`, `mensaje`) VALUES
('admin@admin.es', 'Garfield: la pelicula', 'Está bastante chula'),
('admin@admin.es', 'Misión hostil', 'Demasiada sangre'),
('admin@admin.es', 'Nimona', 'La perfección'),
('admin@admin.es', 'Tarot', 'No está mal'),
('admin@admin.es', 'Valle de sombras', 'No me ha gustado nada'),
('user1@gmail.com', 'Tarot', 'Perfección (EDITADO)');

--
-- Truncar tablas antes de insertar `usuarios`
--

TRUNCATE TABLE `usuarios`;
--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `contacto`, `admin`, `pass`) VALUES
('admin', 'admin@admin.es', 1, '$2y$10$vHrI2ncI4/5e7yiNUV1qQO/6mAe3LtS1SLTD7czXIoecTwpjdbAUm'),
('user1', 'user1@gmail.com', 1, '$2y$10$ZjtrKCCef1pfCuewV5B/LehUrtlzlwL9179NrFgiVMuYboRRdfjk.'),
('user2', 'user2@gmail.com', 0, '$2y$10$3qoSJ./63BJpRs5ptM.jJe5PNLitQ/4scpjVFxyk2BJVojdCijUjG'),
('user3', 'user3@gmail.com', 0, '$2y$10$uDoRrrWEFqAGJrzqcXqAC.5khJSNmvzhUeH2SME82815Fd.PZ.Bfu'),
('user4', 'user4@gmail.com', 0, '$2y$10$kL1GaVHRkV1UzbiBpq5JMudhEz2HPY7ecl1wbUalLUwA23YhvyAI2'),
('user5', 'user5@gmail.com', 0, '$2y$10$qmVhLMDYv5RFx3CH0JVSHuauxoas0N6SFPiZbWDBS7/oR8IcCvxF2');

--
-- Truncar tablas antes de insertar `valoraciones`
--

TRUNCATE TABLE `valoraciones`;
--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`contacto`, `pelicula`, `puntuacion`) VALUES
('admin@admin.es', 'Garfield: la pelicula', 9),
('admin@admin.es', 'Misión hostil', 4),
('admin@admin.es', 'Nimona', 10),
('admin@admin.es', 'Tarot', 7),
('admin@admin.es', 'Valle de sombras', 3),
('user1@gmail.com', 'El bueno, el feo y el malo', 1),
('user1@gmail.com', 'Tarot', 10),
('user2@gmail.com', 'El bueno, el feo y el malo', 10),
('user5@gmail.com', 'Mary Poppins', 9);
('user4@gmail.com', 'Mary Poppins', 10);
('user3@gmail.com', 'Shrek', 10);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
