<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="../icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/fontawesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&family=Oswald:wght@300;400;700&family=PT+Sans:wght@400;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="../css/main.css">

    <meta name="theme-color" content="#fafafa">
</head>

<body>
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->
    
    <!-- CABECERA -->
    <?php include_once "../includes/templates/cab-interna.php" ?>

    <!-- SECCION DE MINI INFO -->
    <section class="seccion contenedor">

        <!-- Titulo section -->
        <h2 class="centrar-texto mayusculas">Calendario de eventos</h2>

        <!-- REALIZA LA CONECION -->
        <?php
            try {
                require_once('../includes/funciones/conexion.php');

                $sql = "SELECT id_evento, evento.descripcion, fecha_evento, hora_evento, categoria_evento.descripcion as cat_evento, categoria_evento.icono as icono, invitados.nombre as nombre, invitados.apellido as apellido ";
                $sql .= "FROM evento ";
                $sql .= "INNER JOIN categoria_evento ON (evento.id_categoria = categoria_evento.id_categoria) ";
                $sql .= "INNER JOIN invitados ON (evento.id_invitado = invitados.id_invitado) ";
                $sql .= "ORDER BY id_evento ";

                $resultado = $conexion->query($sql);
            } catch (\Exception $e){
                echo $e->getMessaje();
            }
        ?>

        <!-- AGRUPA LOS DATOS -->
        <div class="consulta">
            <?php
                $calendario = array();
                while( $eventos = $resultado->fetch_assoc() ){ 

                    // Agrupa por fecha
                    $fecha = $eventos['fecha_evento'];
                    
                    $evento = array(
                        'titulo' => $eventos['descripcion'],
                        'fecha' => $eventos['fecha_evento'],
                        'hora' => $eventos['hora_evento'],
                        'categoria' => $eventos['cat_evento'],
                        'icono' => "fas " . $eventos['icono'],
                        'invitado' => $eventos['nombre'] . " " . $eventos['apellido']
                    );

                    $calendario[$fecha][] = $evento;
                    ?>
                    
            <?php } ?>

        <!-- MUESTRA LOS DATOS -->
            <?php

                // Recorre las fechas agrupadas
                foreach($calendario as $dia => $lista_evento){ ?>

                    <h3><i class="fas fa-calendar-alt"></i> 
                        <?php 
                            // españolisa las fechas
                            setlocale(LC_TIME, "es_ES.UTF-8");
                            setlocale(LC_TIME, "spanish");
                            echo utf8_encode(strftime("%A, %d de %B del %Y", strtotime($dia))); 
                        ?>
                    </h3>

                    <div class="lst-eventos">
                        <?php
                        // Recorre los eventos por fecha
                        foreach($lista_evento as $evento){ ?>
                            <div class="dia">
                                <p class="titulo"> <?php echo($evento['titulo']); ?></p>
                                <p class="hora"><i class="far fa-clock" aria-hidden="true"></i> <?php echo($evento['hora']); ?></p>
                                <p class="categoria"><i class="<?php echo $evento['icono'] ?>" ></i> <?php echo($evento['categoria']); ?></p>
                                <p class="invitado"><i class="fas fa-user-tie"></i> <?php echo($evento['invitado']); ?></p>
                            </div>
                    
                <?php 
                        } // FIN foreach lista eventos
                    echo "</div>"; //fin div lst-eventos
                } //FIN foreach fechas
                ?>
            
        </div>

        
        <?php $conexion->close() ?>

    </section>

    <!-- PIECERA -->
    <?php include_once "../includes/templates/piecera.php" ?>

<!-- JS -->
<script src="../js/vendor/modernizr-3.8.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
<script src="../js/plugins.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/fontawesome.min.js"></script>
<script src="../js/vendor/jquery.lettering.js"></script>
<script src="../js/main.js"></script>

</body>

</html>