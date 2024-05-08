-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2024 a las 15:11:59
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
('admin@admin.es', 'Veamos Nimona', 'Vamos a ver nimona a las 5PM', '2024-05-10', '2024-05-07'),
('user4@gmail.com', 'Noche de pelis retro', 'Te invito a ver los mejores clásicos del cine', '2024-05-11', '2024-05-08');

--
-- Truncar tablas antes de insertar `foro`
--

TRUNCATE TABLE `foro`;
--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`id_foro`, `contacto`, `mensaje`, `fecha_envio`) VALUES
('club de odio hacia Tarot', 'admin@admin.es', 'no entiendo por que existe esta pelicula', '2024-05-07 21:09:18'),
('club de odio hacia Tarot', 'user1@gmail.com', 'Oye pues a mi me encant&oacute;', '2024-05-07 21:11:16'),
('Fans de Nimona', 'admin@admin.es', 'simplemente la mejor', '2024-05-07 21:09:01'),
('Garfield', 'user1@gmail.com', 'yo quiero lasa&ntilde;aaaa !!!', '2024-05-07 21:01:43'),
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
('El bueno, el feo y el malo', 'Western'),
('Garfield: la pelicula', 'Animaci&oacute;n'),
('Mary Poppins', 'Fantasía'),
('Misi&oacute;n hostil', 'Acci&oacute;n'),
('Nimona', 'Animaci&oacute;n'),
('Tarot', 'Terror'),
('Valle de sombras', 'Ciencia ficci&oacute;n');

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
('Garfield', 'user1@gmail.com', 'quien mas odia los lunes y ama la lasa&ntilde;a'),
('Odio hacia nimona', 'user1@gmail.com', 'simplemente la detesto');

--
-- Truncar tablas antes de insertar `peliculas`
--

TRUNCATE TABLE `peliculas`;
--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`titulo`, `descripcion`, `fecha_estreno`, `direccion_fotografia`, `alt`) VALUES
('El bueno, el feo y el malo', 'Los protagonistas son tres cazadores de recompensas que buscan un tesoro que ninguno de ellos puede encontrar sin la ayuda de los otros dos. Así que los tres colaboran entre sí, al menos en apariencia.', '1968-08-07', './images/bueno-feo-y-malo.jpg', 'El bueno, el feo y el malo de pie'),
('Garfield: la pelicula', 'El mundialmente famoso Garfield, el gato casero que odia los lunes y que adora la lasa&ntilde;a, est&aacute; a punto de vivir una aventura &iexcl;en el salvaje mundo exterior! Tras una inesperada reuni&oacute;n con su largamente perdido padre &ndash;el desali&ntilde;ado gato callejero Vic&ndash; Garfield y su amigo canino Odie se ven forzados a abandonar sus perfectas y consentidas vidas al unirse a Vic en un hilarante y muy arriesgado atraco.', '2024-05-01', './images/2024-05-07-20-20-30-garfield.jpg', 'gato naranja sobre un sofa'),
('Mary Poppins', 'La vida de dos niños rebeldes que pretenden llamar la atención de sus padres haciendo la vida imposible a todas las niñeras, se verá alterada con la llegada de Mary Poppins, una institutriz que baja de las nubes usando su paraguas como paracaídas.', '1965-12-02', './images/mary-poppins-portada.jpg', 'Mary Poppins volando'),
('Misi&oacute;n hostil', 'Reaper es un piloto de drones de la Fuerza A&eacute;rea que apoya una misi&oacute;n especial en el sur de Filipinas. Tras ver movimiento en la jungla durante su reconocimiento a&eacute;reo, la situaci&oacute;n toma un vuelco inesperado. El equipo de tierra, en el que se encuentran el sargento Kinney y sus compa&ntilde;eros, es atacado de manera fulminante y capturado por un grupo de insurgentes.', '2024-05-01', './images/2024-05-07-20-41-45-Misión hostil.jpg', 'un hombre con un arma de fuego'),
('Nimona', 'En un mundo medieval futurista, el caballero Ballister Bravocoraz&oacute;n es acusado de un crimen que no ha cometido, y la &uacute;nica persona que puede ayudarlo a demostrar su inocencia es Nimona, una traviesa adolescente con inclinaci&oacute;n por el caos&hellip; que adem&aacute;s resulta ser el ser metamorfo al que debe destruir', '2023-06-18', './images/2024-05-07-20-23-40-nimona.jpg', 'ni&ntilde;a con el pelo rosa y alas de demonio'),
('Tarot', 'Cuando un grupo de amigos infringe de manera imprudente la regla sagrada de la lectura de las cartas del Tarot -nunca se debe utilizar la baraja de otra persona-, desatan sin saberlo un mal atrapado en las cartas malditas. Uno a uno, se enfrentan cara a cara al destino y acaban en una carrera contra la muerte para escapar del futuro que las cartas predicen.', '2024-05-10', './images/2024-05-07-20-26-23-Tarot.jpg', 'Una mano con una carta de tarot'),
('Valle de sombras', 'Cordillera del Himalaya, a&ntilde;o 1999. Quique, Clara y el peque&ntilde;o Lucas disfrutan de sus primeras vacaciones juntos en el norte de la India. Una noche, durmiendo al raso durante una tormenta, sufren un brutal ataque por unos bandidos. Horas despu&eacute;s, Quique es rescatado por un nativo y trasladado a una remota aldea aislada en las monta&ntilde;as', '2024-05-03', './images/2024-05-07-20-48-10-valle_de_sombras.jpg', 'Un hombre mirando a la nada');

--
-- Truncar tablas antes de insertar `resenyas`
--

TRUNCATE TABLE `resenyas`;
--
-- Volcado de datos para la tabla `resenyas`
--

INSERT INTO `resenyas` (`contacto`, `pelicula`, `mensaje`) VALUES
('admin@admin.es', 'Garfield: la pelicula', 'Est&aacute; bastante chula'),
('admin@admin.es', 'Misi&oacute;n hostil', 'Demasiada sangre'),
('admin@admin.es', 'Nimona', 'La perfecci&oacute;n'),
('admin@admin.es', 'Tarot', 'No est&aacute; mal'),
('admin@admin.es', 'Valle de sombras', 'No me ha gustado nada'),
('user1@gmail.com', 'Tarot', 'Perfecci&oacute;n (EDITADO)');

--
-- Truncar tablas antes de insertar `usuarios`
--

TRUNCATE TABLE `usuarios`;
--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `contacto`, `admin`, `pass`) VALUES
('admin', 'admin@admin.es', 1, '$2y$10$vHrI2ncI4/5e7yiNUV1qQO/6mAe3LtS1SLTD7czXIoecTwpjdbAUm'),
('user1', 'user1@gmail.com', 0, '$2y$10$ZjtrKCCef1pfCuewV5B/LehUrtlzlwL9179NrFgiVMuYboRRdfjk.'),
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
('admin@admin.es', 'Misi&oacute;n hostil', 4),
('admin@admin.es', 'Nimona', 10),
('admin@admin.es', 'Tarot', 7),
('admin@admin.es', 'Valle de sombras', 3),
('user1@gmail.com', 'Tarot', 10),
('user2@gmail.com', 'El bueno, el feo y el malo', 10),
('user5@gmail.com', 'Mary Poppins', 9);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
