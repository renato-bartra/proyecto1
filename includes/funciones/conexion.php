<?php
    $conexion = new mysqli('localhost', 'root', '', 'uw_conference');

    if ($conexion->connect_error) {
        echo $error -> $conexion->connect_error;
    }