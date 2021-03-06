<?php 
 ?>
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

    <section class="seccion contenedor">
        <h2 class="centrar-texto mayusculas">Resumen de registro</h2>

        <?php
            if (isset($_GET['done'])) {
                if ($_GET['done'] === "1") {
                    echo '<h3 class="msg-exito">Registro Exitoso</h3>';
                }
            }
        ?>
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