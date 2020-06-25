<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/fontawesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&family=Oswald:wght@300;400;700&family=PT+Sans:wght@400;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="crossorigin=""/>
    <link rel="stylesheet" href="css/main.css">

    <meta name="theme-color" content="#fafafa">
</head>

<body>
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->
    
    <!-- CABECERA -->
    <?php include_once 'includes/templates/cabecera.php'; ?>

    <!-- SECCION DE MINI INFO -->
    <section class="seccion contenedor">

        <!-- Titulo section -->
        <h2 class="centrar-texto mayusculas">La mejor conferencia de UX y WD en español</h2>
        <p class="centrar-texto">Morbi at commodo dui, pharetra semper orci. Integer nec leo sit amet velit auctor condimentum. Mauris at massa vel justo malesuada ultricies. Aliquam condimentum nisl ac nisi dictum elementum. In in diam quis nisl varius porta sed sit amet orci. Ut at dui porttitor elit molestie feugiat sit amet vel enim. Etiam at nisl eu elit rhoncus efficitur sit amet et erat. Nunc pellentesque dolor suscipit ipsum maximus consequat. </p>
    </section>

    <section class="programa">

        <!-- Zona video -->
        <div class="contenedor-video">
            <video autoplay loop poster="images/bg-talleres.jpg">
                <source src="videos/video.mp4" type="video/mp4">
                <source src="videos/video.webm" type="video/webm">
                <source src="videos/video.ogv" type="video/ogv">
            </video>
        </div>

        <!-- Zona contenido -->
        <div class="contenido-programa">
            <div class="contenedor">
                <div class="programa-evento">

                <?php
                    try {
                        require_once('includes/funciones/conexion.php');

                        $sql = "SELECT * FROM `categoria_evento`";

                        $resultado = $conexion->query($sql);
                    } catch (\Exception $e){
                        echo $e->getMessaje();
                    }
                ?>

                    <!-- Zona programacion -->
                    <h2 class="centrar-texto mayusculas">Programa del evento</h2>
                    <nav class="menu-programa">
                        <?php while($cat = $resultado->fetch_array(MYSQLI_ASSOC)){ ?>
                            <a href="#<?php echo $cat['descripcion'] ?>">
                                <i class="fas <?php echo $cat['icono'] ?>"></i> <?php echo strtoupper($cat['descripcion']) ?>
                            </a>
                        <?php } ?>
                    </nav>

                    <?php
                        try {
                            require_once('includes/funciones/conexion.php');

                            $sql = "SELECT `id_evento`, evento.`descripcion`, `fecha_evento`, `hora_evento`, categoria_evento.`descripcion` as 'cat_evento', categoria_evento.`icono` as 'icono', invitados.`nombre` as 'nombre', invitados.`apellido` as 'apellido' ";
                            $sql .= "FROM evento ";
                            $sql .= "INNER JOIN categoria_evento ON (evento.id_categoria = categoria_evento.id_categoria) ";
                            $sql .= "INNER JOIN invitados ON (evento.id_invitado = invitados.id_invitado) ";
                            $sql .= "AND evento.id_categoria = 1 ";
                            $sql .= "ORDER BY id_evento LIMIT 2;";
                            $sql .= "SELECT `id_evento`, evento.`descripcion`, `fecha_evento`, `hora_evento`, categoria_evento.`descripcion` as 'cat_evento', categoria_evento.`icono` as 'icono', invitados.`nombre` as 'nombre', invitados.`apellido` as 'apellido' ";
                            $sql .= "FROM evento ";
                            $sql .= "INNER JOIN categoria_evento ON (evento.id_categoria = categoria_evento.id_categoria) ";
                            $sql .= "INNER JOIN invitados ON (evento.id_invitado = invitados.id_invitado) ";
                            $sql .= "AND evento.id_categoria = 2 ";
                            $sql .= "ORDER BY id_evento LIMIT 2;";
                            $sql .= "SELECT `id_evento`, evento.`descripcion`, `fecha_evento`, `hora_evento`, categoria_evento.`descripcion` as 'cat_evento', categoria_evento.`icono` as 'icono', invitados.`nombre` as 'nombre', invitados.`apellido` as 'apellido' ";
                            $sql .= "FROM evento ";
                            $sql .= "INNER JOIN categoria_evento ON (evento.id_categoria = categoria_evento.id_categoria) ";
                            $sql .= "INNER JOIN invitados ON (evento.id_invitado = invitados.id_invitado) ";
                            $sql .= "AND evento.id_categoria = 3 ";
                            $sql .= "ORDER BY id_evento LIMIT 2;";

                        } catch (\Exception $e){
                            echo $e->getMessaje();
                        }

                        // Realiza la conexxion multi query
                        $conexion->multi_query($sql);

                        do { 
                            $resultado = $conexion->store_result();
                            $row = $resultado->fetch_all(MYSQLI_ASSOC); 
                    ?>
                    <?php  
                        setlocale(LC_TIME, "es_ES.UTF-8");
                        setlocale(LC_TIME, "spanish");
                        $i = 0;
                        foreach($row as $evento){
                            if ($i % 2 == 0) {   
                    ?>
                            <!-- Programacion de talleres -->
                            <div id="<?php echo $evento['cat_evento'] ?>" class="info-curso ocultar">
                            <?php } ?>
        
                                <!-- Zona detalle de la programacion -->
                                <div class="detale-evento">
                                    <h3><?php echo ($evento['descripcion']) ?></h3>
                                    <p><i class="fas fa-clock"></i> <?php echo $evento['hora_evento'] ?> hrs</p>
                                    <p><i class="fas fa-calendar-alt"></i> <?php echo utf8_encode(strftime("%d de %B", strtotime($evento['fecha_evento']))) ?></p>
                                    <p><i class="fas fa-user-tie"></i> <?php echo $evento['nombre']." ".$evento['apellido'] ?></p>
                                </div>

                            <?php if($i % 2 == 1){ ?>
                                <div class="zona-botones texto-derecha">
                                    <a href="modulos/calendario.php" class="boton btn-naranja">Ver todos</a>
                                </div>
                            </div>
                            <?php } ?>
                            <?php $i++ ?>
                        <?php } ?>
                        <?php $resultado->free(); ?>
                    <?php } while ($conexion->more_results() && $conexion->next_result()); ?>

                   
                    
                </div>
            </div>
        </div>
    </section>

    <!-- SECCION INVITADOS -->
    <?php require_once('includes/templates/invitados.php') ?>
    
    <!-- SECCION REUMEN DEL EVENTO CON SU CONTADOR -->
    <div class="contador paralax">
        <div class="contenedor">
            <div class="resumen-evento resumen-evento-anmt">
                <div>
                    <p class="numero-grande"></p>Invitados
                </div>
                <div>
                    <p class="numero-grande"></p>Talleres
                </div>
                <div>
                    <p class="numero-grande"></p>Días
                </div>
                <div>
                    <p class="numero-grande"></p>Conferencias
                </div>
            </div>
        </div>
    </div>
    
    <!-- SECCION PRECIOS DE LA CONFERENCIA -->
    <section class="precios seccion">
        <h2 class="mayusculas centrar-texto">Precios</h2>
        <div class="contenedor">

            <!-- Lista de los precios -->
            <div class="lista-precios">

                <!-- Tablas de los precios -->
                <div class="tabla-precio">
                    <h3>Pase por dia</h3>
                    <p class="numero-grande">$30</p>
                    <ul>
                        <li>Bocadillos Gratis</li>
                        <li>Todas las conferencias</li>
                        <li>Todos los talleres</li>
                    </ul>
                    <div class="zona-botones">
                        <a href="" class="boton btn-blanco hollow">Comprar</a>
                    </div>
                </div>

                <div class="tabla-precio">
                    <h3>Todos los días</h3>
                    <p class="numero-grande">$50</p>
                    <ul>
                        <li>Bocadillos Gratis</li>
                        <li>Todas las conferencias</li>
                        <li>Todos los talleres</li>
                    </ul>
                    <div class="zona-botones">
                        <a href="" class="boton btn-naranja">Comprar</a>
                    </div>
                </div>

                <div class="tabla-precio">
                    <h3>Pase por 2 días</h3>
                    <p class="numero-grande">$45</p>
                    <ul>
                        <li>Bocadillos Gratis</li>
                        <li>Todas las conferencias</li>
                        <li>Todos los talleres</li>
                    </ul>
                    <div class="zona-botones">
                        <a href="" class="boton btn-blanco hollow">Comprar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- SECCION DE LA UBICACION -->
    <div id="mapa" class="mapa">
        
    </div>
    
    <!-- SECCION DE TESTIMONIALES -->
    <section class="seccion">
        <h2 class="centrar-texto mayusulas">Testimoniales</h2>
        <div class="testimoniales contenedor">

            <!-- Testimonios -->
            <blockquote>
                <p>Etiam vitae lobortis odio. Etiam consectetur ipsum ac metus interdum, at aliquam nunc porta. Duis in libero enim. Phasellus interdum justo a pretium ultricies. Integer feugiat velit ut odio luctus dignissim.</p>
                <footer class="footer-testimonial">
                    <img src="images/testimonial.jpg" alt="imagen del bloguero">
                    <div>
                        <cite>Oswaldo Aponte Escudero</cite><span>Diseñador en @prisma</span>
                    </div>
                </footer>
            </blockquote>
            <blockquote>
                <p>In rutrum, augue at finibus vehicula, nisl erat egestas purus, varius mollis risus sem placerat lacus. Nullam vitae nunc dui. Quisque eu ipsum nisl. Cras rhoncus euismod lorem eget egestas.</p>
                <footer class="footer-testimonial">
                    <img src="images/testimonial.jpg" alt="imagen del bloguero">
                    <div>
                        <cite>Oswaldo Aponte Escudero</cite><span>Diseñador en @prisma</span>
                    </div>
                </footer>
            </blockquote>
            <blockquote>
                <p>Cras vestibulum neque pellentesque lorem imperdiet, ut vehicula enim lacinia. Mauris dignissim libero nec erat finibus ornare. Sed bibendum velit ut massa aliquet lacinia. In bibendum et lectus eget convallis.</p>
                <footer class="footer-testimonial">
                    <img src="images/testimonial.jpg" alt="imagen del bloguero">
                    <div>
                        <cite>Oswaldo Aponte Escudero</cite><span>Diseñador en @prisma</span>
                    </div>
                </footer>
            </blockquote>
        </div>
    </section>
    
    <!-- SECCION PARA REGISTRO -->
    <section class="newsletter">
        <div class="contenido-newsletter contenedor centrar-texto">
            <p>Regístrate al newsletter:</p>
            <h3 class="mayusculas ">UXandWD COnference</h3>
            <a href="#" class="boton btn-transparente">Registrate</a>
        </div>
    </section>

    <!-- SECCION PARA CUENTA REGRESIVA -->
    <section class="seccion">
        <h2 class="centrar-texto mayusculas">Falta</h2>
        <div class="cuenta-regresiva contenedor">
            <div class="resumen-evento reloj">
                <div>
                    <p id="dias" class="numero-grande"></p>Días
                </div>
                <div>
                    <p id="horas" class="numero-grande"></p>Horas
                </div>
                <div>
                    <p id="minutos" class="numero-grande"></p>Minutos
                </div>
                <div>
                    <p id="segundos" class="numero-grande"></p>Segundos
                </div>
            </div>
        </div>
    </section>

    <!-- PIECERA -->
    <?php include_once "includes/templates/piecera.php"; ?>

<!-- JS -->
<script src="js/vendor/modernizr-3.8.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
<script src="js/plugins.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/fontawesome.min.js"></script>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
<script src="js/vendor/leaftletmap.js"></script>
<script src="js/vendor/jquery.animateNumber.min.js"></script>
<script src="js/vendor/jquery.countdown.min.js"></script>
<script src="js/vendor/jquery.lettering.js"></script>
<script src="js/main.js"></script>
<script src="js/inicio.js"></script>


</body>

</html>
