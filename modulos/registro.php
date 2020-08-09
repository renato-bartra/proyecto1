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

    <!-- CABECERA -->
    <?php include_once "../includes/templates/cab-interna.php"; ?>

    <!-- SECIONDE REGISTRO -->
    <section class="seccion contenedor">
        <h2 class="centrar-texto mayusculas">Registro de usuarios</h2>
        <form id="registro" class="registro" method="post" action="../PayPalCheckoutSdk/CaptureIntentExamples/CreateOrder.php">
            <div id="datos-usuario" class="registro caja">

                <!-- Ingro de nombre -->
                <div class="campo">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>
                </div>

                <!-- Ingreso de apellido -->
                <div class="campo">
                    <label for="aprellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Ingresa tu aprellido" required>
                </div>

                <!-- Ingreso de email -->
                <div class="campo">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Ingresa tu email" required>
                </div>

                <!-- En caso de ingresar mal los datos -->
                <div id="error"></div>
            </div>

            <!-- Entrada de paquetes -->
            <div id="paquetes" class="paquetes" >
                <h3 class="centrar-texto mayusculas">Elige el número de boletos</h3>

                <!-- Lista de los precios -->
                <div class="lista-precios">

                    <!-- Tablas de los precios -->
                    <div class="tabla-precio">
                        <h3>Pase por dia (Viernes)</h3>
                        <p class="numero-grande">$30</p>
                        <ul>
                            <li>Bocadillos Gratis</li>
                            <li>Todas las conferencias</li>
                            <li>Todos los talleres</li>
                        </ul>
                        <div class="orden zona-botones">
                            <label for="pase_dia">Numero de boletos: </label>
                            <input type="number" id="pase_dia" class="numerico" name="boletos[un_dia][cantidad]" min="0" placeholder="0">
                            <input type="hidden" value="30" name="boletos[un_dia][precio]">
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
                        <div class="orden zona-botones">
                            <label for="pase_completo">Numero de boletos: </label>
                            <input type="number" id="pase_completo" class="numerico" name="boletos[completo][cantidad]" min="0" placeholder="0">
                            <input type="hidden" value="50" name="boletos[completo][precio]">
                        </div>
                    </div>

                    <div class="tabla-precio">
                        <h3>Pase por 2 días (Vie y Sab)</h3>
                        <p class="numero-grande">$45</p>
                        <ul>
                            <li>Bocadillos Gratis</li>
                            <li>Todas las conferencias</li>
                            <li>Todos los talleres</li>
                        </ul>
                        <div class="orden zona-botones">
                            <label for="dos_dias">Numero de boletos: </label>
                            <input type="number" id="dos_dias" class="numerico" name="boletos[dos_dias][cantidad]" min="0" placeholder="0">
                            <input type="hidden" value="45" name="boletos[dos_dias][precio]">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de checkoboxes de talleres -->
            <div id="eventos" class="eventos">
                <h3 class="centrar-texto mayusculas">Elige tus talleres</h3>
                <div class="caja">
                    <div id="viernes" class="contenido-dia">
                        <h4>Viernes</h4>
                        <div class="cont-dia">
                            <div>
                                <p class="centrar-texto">Talleres:</p>
                                <label><input type="checkbox" name="registro[]" id="taller_01" value="taller_01"><time>10:00</time> Responsive Web Design</label>
                                <label><input type="checkbox" name="registro[]" id="taller_02" value="taller_02"><time>12:00</time> Flexbox</label>
                                <label><input type="checkbox" name="registro[]" id="taller_03" value="taller_03"><time>14:00</time> HTML5 y CSS3</label>
                                <label><input type="checkbox" name="registro[]" id="taller_04" value="taller_04"><time>17:00</time> Drupal</label>
                                <label><input type="checkbox" name="registro[]" id="taller_05" value="taller_05"><time>19:00</time> WordPress</label>
                            </div>
                            <div>
                                <p class="centrar-texto">Conferencias:</p>
                                <label><input type="checkbox" name="registro[]" id="conf_01" value="conf_01"><time>10:00</time> Como ser Freelancer</label>
                                <label><input type="checkbox" name="registro[]" id="conf_02" value="conf_02"><time>17:00</time> Tecnologías del Futuro</label>
                                <label><input type="checkbox" name="registro[]" id="conf_03" value="conf_03"><time>19:00</time> Seguridad en la Web</label>
                            </div>
                            <div>
                                <p class="centrar-texto">Seminarios:</p>
                                <label><input type="checkbox" name="registro[]" id="sem_01" value="sem_01"><time>10:00</time> Diseño UI y UX para móviles</label>
                            </div>
                            </div>
                    </div> <!--#viernes-->
                    <div id="sabado" class="contenido-dia">
                        <h4>Sábado</h4>
                        <div class="cont-dia">
                            <div>
                                <p class="centrar-texto">Talleres:</p>
                                <label><input type="checkbox" name="registro[]" id="taller_06" value="taller_06"><time>10:00</time> AngularJS</label>
                                <label><input type="checkbox" name="registro[]" id="taller_07" value="taller_07"><time>12:00</time> PHP y MySQL</label>
                                <label><input type="checkbox" name="registro[]" id="taller_08" value="taller_08"><time>14:00</time> JavaScript Avanzado</label>
                                <label><input type="checkbox" name="registro[]" id="taller_09" value="taller_09"><time>17:00</time> SEO en Google</label>
                                <label><input type="checkbox" name="registro[]" id="taller_10" value="taller_10"><time>19:00</time> De Photoshop a HTML5 y CSS3</label>
                                <label><input type="checkbox" name="registro[]" id="taller_11" value="taller_11"><time>21:00</time> PHP Medio y Avanzado</label>
                            </div>
                            <div>
                                <p class="centrar-texto">Conferencias:</p>
                                <label><input type="checkbox" name="registro[]" id="conf_04" value="conf_04"><time>10:00</time> Como crear una tienda online que venda millones en pocos días</label>
                                <label><input type="checkbox" name="registro[]" id="conf_05" value="conf_05"><time>17:00</time> Los mejores lugares para encontrar trabajo</label>
                                <label><input type="checkbox" name="registro[]" id="conf_06" value="conf_06"><time>19:00</time> Pasos para crear un negocio rentable</label>
                            </div>
                            <div>
                                <p class="centrar-texto">Seminarios:</p>
                                <label><input type="checkbox" name="registro[]" id="sem_02" value="sem_02"><time>10:00</time> Aprende a Programar en una mañana</label>
                                <label><input type="checkbox" name="registro[]" id="sem_03" value="sem_03"><time>17:00</time> Diseño UI y UX para móviles</label>
                            </div>
                        </div>
                    </div> <!--#sabado-->
                    <div id="domingo" class="contenido-dia">
                        <h4>Domingo</h4>
                        <div class="cont-dia">
                            <div>
                                <p class="centrar-texto">Talleres:</p>
                                <label><input type="checkbox" name="registro[]" id="taller_12" value="taller_12"><time>10:00</time> Laravel</label>
                                <label><input type="checkbox" name="registro[]" id="taller_13" value="taller_13"><time>12:00</time> Crea tu propia API</label>
                                <label><input type="checkbox" name="registro[]" id="taller_14" value="taller_14"><time>14:00</time> JavaScript y jQuery</label>
                                <label><input type="checkbox" name="registro[]" id="taller_15" value="taller_15"><time>17:00</time> Creando Plantillas para WordPress</label>
                                <label><input type="checkbox" name="registro[]" id="taller_16" value="taller_16"><time>19:00</time> Tiendas Virtuales en Magento</label>
                            </div>
                            <div>
                                <p class="centrar-texto">Conferencias:</p>
                                <label><input type="checkbox" name="registro[]" id="conf_07" value="conf_07"><time>10:00</time> Como hacer Marketing en línea</label>
                                <label><input type="checkbox" name="registro[]" id="conf_08" value="conf_08"><time>17:00</time> ¿Con que lenguaje debo empezar?</label>
                                <label><input type="checkbox" name="registro[]" id="conf_09" value="conf_09"><time>19:00</time> Frameworks y librerias Open Source</label>
                            </div>
                            <div>
                                <p class="centrar-texto">Seminarios:</p>
                                <label><input type="checkbox" name="registro[]" id="sem_04" value="sem_04"><time>14:00</time> Creando una App en Android en una tarde</label>
                                <label><input type="checkbox" name="registro[]" id="sem_05" value="sem_05"><time>17:00</time> Creando una App en iOS en una tarde</label>
                            </div>
                        </div>
                    </div> <!--#domingo-->
                </div><!--.caja-->
            </div> <!--#eventos-->

            <!-- Resumen de la compra -->
            <div id="resumen" class="resumen">
                <h3 class="centrar-texto mayusculas">Pago y Extras</h3>
                <div class="caja pextras">
                    <!-- Extras a la compra -->
                    <div class="extras">

                        <!-- Camisa del evento -->
                        <div class="orden">
                            <label for="camisa_envento">Camisa de evento $10 <small>(promocion 7% dto.)</small></label>
                            <input type="number" min="0" id="camisa_envento" class="numerico" name="pedido_extra[camisas][cantidad]" placeholder="0">
                            <input type="hidden" value="10" name="pedido_extra[camisas][precio]">
                        </div>

                        <!-- Etiquetas -->
                        <div class="orden">
                            <label for="etiqueta_evento">Paquete de 10 etiquetas $2 <small>(HTML5, CSS3, JavaScript)</small></label>
                            <input type="number" min="0" id="etiqueta_evento" class="numerico" name="pedido_extra[etiquetas][cantidad]" placeholder="0">
                            <input type="hidden" value="2" name="pedido_extra[etiquetas][precio]">
                        </div>

                        <!-- Regalo -->
                        <div class="orden">
                            <label for="regalo">Seleccione regalo: </label><br><br>
                            <select id="regalo" name="regalo" required>
                                <option value="">Selecione un regalo</option>
                                <option value="2">Etiquetas</option>
                                <option value="1">Pulsera</option>
                                <option value="3">Pluma</option>
                            </select>
                        </div>
                        <div class="centrar-texto">
                            <input type="button" id="calcular" class="boton btn-naranja" value="Calcular">
                        </div>
                    </div>

                    <!-- Suma total -->
                    <div class="total centrar-texto">
                        <p>Resumen: </p>
                        <div id="lista-productos" class="texto-izquierda">

                        </div>
                        <p>Total: </p>
                        <div id="suma-total">

                        </div>

                        <input type="hidden" name="total_pedido" id="total_pedido">

                        <div id="suma-total" class="centrar-texto">
                            <input id="btnRegistro" type="submit" name="submit" class="boton btn-naranja" value="pagar">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <!-- PIECERA -->
    <?php include_once "../includes/templates/piecera.php"; ?>

<!-- JS -->
<script src="../js/vendor/modernizr-3.8.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
<script src="../js/plugins.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/fontawesome.min.js"></script>
<script src="../js/vendor/jquery.lettering.js"></script>
<script src="../js/main.js"></script>
<script src="../js/registro.js"></script>


</body>

</html>