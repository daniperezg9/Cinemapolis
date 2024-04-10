<?php //TODO Comprobar si funciona con la base de datos
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Parametros de acceso de la base de datos
    
    //abrimos conexión 
    if(isset($_SESSION['login']) && $_SESSION['login']) {
        $app = Aplicacion::getInstance();
        $conn = $app->getConexionBd();
        if ($conn->connect_error) {
            die("La conexión ha fallado" . $conn->connect_error);
        }
        // Creamos la consulta
        $query = "SELECT * FROM eventos";
        // Realizamos la consulta
        $result = $conn->query($query);

    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>LISTADO DE EVENTOS</title>
</head>
<?php require "./includes/vistas/comun/cabecera.php";?>
<body>
    <?php
        if($result){
            while($row = $result->fetch_array()){
                $creador = $row['creador_evento'];
                $nombre = $row['nombre_evento'];
                $descripcion = $row['descripcion_evento'];
                $fecha = $row['fecha_evento'];
                $creacion = $row['fecha_creacion'];
            ?>
                <div>
                    <h2><?php echo $nombre; ?></h2>
                    <div>
                        <p>
                            <b>Descripcion: </b><?php echo $descripcion; ?> <br>
                            <b>Creador: </b><?php echo $creador; ?> <br>
                            <b>Fecha de inicio: </b> <?php echo $fecha; ?><br>
                            <b>Fecha de creacion: </b> <?php echo $creacion; ?><br>
                        </p>
                    </div>
                </div>
            <?php

            }
        }
    ?>


</body>
</html>