<?php

/* -------------------------------------------------------------------------- */
/*                      PRODUCTOS ELEGIDOS EN EL REGISTRO                     */
/* -------------------------------------------------------------------------- */
function productos_json(&$boletos, &$camisas = 0, &$etiquetas = 0){
    $dias = array(0 => "un_dia", 1 => "pase_completo", 2 => "pase_2dias");
    $total_boletos = array_combine($dias, $boletos);
    $json = array();

    // Valida los boletos
    foreach ($total_boletos as $key => $boleto) {
        if ((int) $boleto > 1) {
            $json[$key] = (int) $boleto;
        }
    }

    // valida  las camisas
    $camisas = (int) $camisas;
    if ($camisas > 0) {
        $json['camisas'] = $camisas;
    }

    // Valida las etiquetas
    $etiquetas = (int) $etiquetas;
    if ($etiquetas > 0) {
        $json['etiquetas'] = $etiquetas;
    }

    return json_encode($json);
}

/* -------------------------------------------------------------------------- */
/*                       EVENTOS ELEGIDOS EN EL REGISTRO                      */
/* -------------------------------------------------------------------------- */
function eventos_json(&$eventos){
    $eventos_json = array();
    foreach ($eventos as $evento) {
        $eventos_json['eventos'][] = $evento;
    }

    return json_encode($eventos_json);
}

/* -------------------------------------------------------------------------- */
/*                                VALIDAR EMAIL                               */
/* -------------------------------------------------------------------------- */
if(isset($_POST["validarEmail"])){
    $email = $_POST["validarEmail"];
    try {
        require_once "conexion.php";
        $stmt = $conexion->prepare("SELECT * FROM registrados WHERE email_registrado = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $results = $stmt->get_result();
        $row = $results->fetch_array(MYSQLI_ASSOC); 
        echo json_encode($row);
        $stmt->close();
        $conexion->close();
    } catch (Exception $e){
        echo $e->getMessaje();
    }
}