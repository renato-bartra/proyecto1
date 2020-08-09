<?php

class dataTableAdmins {
    public function listarDatatable(){
        try {

            require_once '../../includes/funciones/conexion.php';

            $key = 1;
            $stmt = $conexion->prepare("SELECT id_admin, nombre, usuario, foto FROM admins");
            $stmt->execute();
            $results = $stmt->get_result();
            $row = $results->fetch_all(MYSQLI_ASSOC); 

            $datosJson = '{
                "data": [';

            for ($i=0; $i < count($row) ; $i++){

                //Definiendo variables
                $foto = $row[$i]["foto"] ?: 'img/usuarios/administradores/anonima.jpg';
                $foto = "<img class='img-circle img-sm' src='".$foto."' alt='admin imagen'>";
                $botones = "<td><div class='btn-group'><button class='btn btn-warning btn-xs'><a href='editar-admin.php?id=".$row[$i]['id_admin']."'><i class='fa fa-pencil'></i></a></button><button class='btn bg-maroon btn-xs borrar-registro' data-id='".$row[$i]['id_admin']."' data-tipo='admin' ><i class='fa fa-trash'></i></button></div></td>";

                //Datos que se mostraran
                $datosJson .= '[
                    "'.$key.'",
                    "'.$row[$i]["nombre"].'",
                    "'.$row[$i]["usuario"].'",
                    "'.$foto.'",
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

$listarAdmins = new dataTableAdmins();
$listarAdmins -> listarDatatable();