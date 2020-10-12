<?php

class dataTableEventos {
    public function listarDatatable(){
        try {

            require_once '../../includes/funciones/conexion.php';

            $key = 1;
            $stmt = $conexion->prepare("SELECT evento.id_evento, evento.descripcion, evento.fecha_evento, evento.hora_evento, categoria_evento.descripcion as categoria, invitados.nombre as nombre, invitados.apellido as apellido FROM `evento` INNER JOIN categoria_evento ON (evento.id_categoria = categoria_evento.id_categoria) INNER JOIN invitados ON (evento.id_invitado = invitados.id_invitado) ORDER BY evento.id_evento ASC");
            $stmt->execute();
            $results = $stmt->get_result();
            $row = $results->fetch_all(MYSQLI_ASSOC); 

            $datosJson = '{
                "data": [';

            for ($i=0; $i < count($row) ; $i++){

                //Definiendo variables
                $fecha = $row[$i]["fecha_evento"]." ".$row[$i]["hora_evento"];
                $invitado = $row[$i]["nombre"]." ".$row[$i]["apellido"];
                $botones = "<td><div class='btn-group'><button class='btn btn-warning btn-xs'><a href='cu-evento.php?id=".$row[$i]['id_evento']."'><i class='fa fa-pencil'></i></a></button><button class='btn bg-maroon btn-xs borrar-registro' data-id='".$row[$i]['id_evento']."'><i class='fa fa-trash'></i></button></div></td>";

                //Datos que se mostraran
                $datosJson .= '[
                    "'.$key.'",
                    "'.$row[$i]["descripcion"].'",
                    "'.$fecha.'",
                    "'.$invitado.'",
                    "'.$row[$i]["categoria"].'",
                    "'.$botones.'"
                  ],';

                $key++;
            }

            $datosJson = substr($datosJson, 0, -1);
			    
            $datosJson .= ' ] }';

            echo $datosJson;
            return;
                
            $stmt->close();
            $conexion->close();
        } catch (Exeption $e) {
            echo "Error:" . $e->getMessage();
        }
    }
}

$listarEventos = new dataTableEventos();
$listarEventos -> listarDatatable();