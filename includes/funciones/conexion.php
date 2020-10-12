<?php
    $conexion = new mysqli('localhost', 'root', 'renatito', 'uw_conference');

    if ($conexion->connect_errno) {
        echo "Falló la conexión a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
    }