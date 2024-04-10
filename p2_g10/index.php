<?php 
session_start();

    if(isset($_SESSION['loginFallido'])){

        unset($_SESSION['loginFallido']);
    }
    if(isset($_SESSION['signupFallido'])){

        unset($_SESSION['signupFallido']);
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Cinemapolis.io</title>
    </head>

    <body>

        <div id="contenedor"> <!-- Inicio del contenedor -->

            <?php
                require("cabecera.php");
            ?>

            <main>
                <article>
                    <h1>Página principal</h1>
                    
                    <!-- Descripción de Cinemapolis -->
                    <p>En un mundo dominado por las plataformas de streaming, <strong>Cinemapolis.io</strong> ha demostrado ser la solución perfecta para los amantes del cine que anhelan compartir experiencias con amigos. ¿Cuántas veces has querido organizar una noche de cine con tus amigos y te has encontrado con el dilema de elegir la película perfecta? ¡No busques más!</p>

                    <p><strong>Cinemapolis.io</strong> es una plataforma diseñada para facilitar encuentros cinéfilos. Aquí, los usuarios pueden:</p>
                    <ul>
                        <li><strong>Organizar quedadas:</strong> Reúnete con tus amigos y disfrutad juntos de una película en la gran pantalla. 🎥🌟</li>
                        <li><strong>Explorar reseñas:</strong> Lee las opiniones de otros cinéfilos antes de tomar una decisión. ¿Es esa película de acción realmente épica o solo un fiasco? Descúbrelo con las reseñas de la comunidad.</li>
                        <li><strong>Valorar las reseñas de otros usuarios:</strong> ¿No estás de acuerdo con una reseña? ¡Valórala para que otros usuarios vean cuan fiable es esa reseña!</li>
                        <li><strong>Participar en foros:</strong> Únete a discusiones apasionantes sobre tus películas favoritas, comparte tus teorías y descubre nuevas perspectivas. 🗣️🎞️</li>
                        <li><strong>Chatear con otros usuarios:</strong> ¿Quieres hablar en privado con un amigo sobre una película o simplemente pasar un buen rato? Utiliza nuestra funcionalidad de chat para conectar con otros amantes del cine. 💬👥</li>
                    </ul>

                    <p>En <strong>Cinemapolis.io</strong>, la magia del cine se combina con la comodidad de la tecnología. ¡Únete a nuestra comunidad y descubre la mejor película para tu próxima quedada! 🎬🍿</p>
                </article>
            </main>

        </div> <!-- Fin del contenedor -->

    </body>
</html>