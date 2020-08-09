<?php

include_once 'funciones/funciones.php';

/* -------------------------------------------------------------------------- */
/*                            FUNCION VALIDAR FOTO                            */
/* -------------------------------------------------------------------------- */
function validarFoto($files, $fotoActual, $usuario){
    $ruta = "";
    list($ancho, $alto) = getimagesize($files["nuevaFoto"]["tmp_name"]);
    $nuevoancho = 500;
    $nuevoalto = 500;
    /* directorio de las imagenes que se guardan*/
    $directorio = "img/usuarios/administradores/".$usuario;
    /* primero preguntar si ya existe una foto*/
    if ($fotoActual != "") {
        unlink($fotoActual);
    }else{
        mkdir($directorio, 0755);
    }
    /* funciones que se ejecutan de acuerdo al tipo de imagen*/
    if ($files["nuevaFoto"]["type"] == "image/jpeg") {
        $aleatorio = mt_rand(100,999);
        $ruta = "img/usuarios/administradores/".$usuario."/".$aleatorio.".jpg";
        $origen = imagecreatefromjpeg($files["nuevaFoto"]["tmp_name"]);
        $destino = imagecreatetruecolor($nuevoancho, $nuevoalto);
        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoancho, $nuevoalto, $ancho, $alto);
        imagejpeg($destino, $ruta);
    }
    if ($files["nuevaFoto"]["type"] == "image/png") {
        $aleatorio = mt_rand(100,999);
        $ruta = "img/usuarios/administradores/".$usuario."/".$aleatorio.".png";
        $origen = imagecreatefrompng($files["nuevaFoto"]["tmp_name"]);
        $destino = imagecreatetruecolor($nuevoancho, $nuevoalto);
        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoancho, $nuevoalto, $ancho, $alto);
        imagepng($destino, $ruta);
    }
    return $ruta;
}

/* -------------------------------------------------------------------------- */
/*                             CREAR ADMINISTRADOR                            */
/* -------------------------------------------------------------------------- */
if (isset($_POST["formulario-admin"]) && $_POST["formulario-admin"] == "crear") {
    
    $nombre = $_POST["nuevoNombre"];
    $usuario = $_POST["nuevoUsuario"];
    $contraseña = $_POST["nuevoContrasena"];

    /* validacion de imagen */
    $ruta = "";
    $fotoActual = "";
    if ($_FILES["nuevaFoto"]["error"] == 0) {
        $resp = validarFoto($_FILES, $fotoActual, $usuario);
        if ($ruta != $resp) {
            $ruta = $resp;
        }
    }

     /* hola mundo */
     $ventauno = [
        'cost' => 12,
     ];
     $ventados = password_hash($contraseña, PASSWORD_DEFAULT, $ventauno);
    
    try {
        $stmt = $conexion->prepare("INSERT INTO admins(nombre, usuario, contraseña, foto) VALUES(?, ?, ?, ?);");
        $stmt->bind_param("ssss", $nombre, $usuario, $ventados, $ruta);
        $stmt->execute();
        $id_registro = (int) $stmt->insert_id;
        if ($id_registro > 0) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_admin' => $id_registro
            );
        }else{
            $respuesta = array('respuesta' => 'error');
        }
        $stmt->close();
        $conexion->close();
    } catch (Exeption $e) {
        echo "Error:" . $e->getMessage();
    }
    die(json_encode($respuesta));
}

/* -------------------------------------------------------------------------- */
/*                          INGRESO DE ADMINISTRADOR                          */
/* -------------------------------------------------------------------------- */
if (isset($_POST["btn-login-admin"])){
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contrasena"];

    try {
        $stmt = $conexion->prepare("SELECT * FROM admins WHERE usuario = ?;");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->bind_result($id_admin, $nombre_admin, $usuario_admin, $contraseña_admin, $foto_admin, $editado);
        if ($stmt->affected_rows) {
            $existe = $stmt->fetch();
            if ($existe) {
                if ($usuario == $usuario_admin &&
                    $contraseña == password_verify($contraseña, $contraseña_admin)) {
                        session_start();
                        $_SESSION["nombre"] = $nombre_admin;
                        $_SESSION["usuario"] = $usuario_admin;
                        $_SESSION["foto"] = $foto_admin;
                        $respuesta = array('respuesta' => 'logExito');
                }else{
                    $respuesta = array('respuesta' => 'logError');
                }
            }else{
                $respuesta = array('respuesta' => 'logError');
            }
        }
        $stmt->close();
        $conexion->close();
    } catch (Exeption $e) {
        echo "Error:" . $e->getMessage();
    }
    die(json_encode($respuesta));
}

/* -------------------------------------------------------------------------- */
/*                            EDITAR ADMINISTRADOR                            */
/* -------------------------------------------------------------------------- */
if (isset($_POST["formulario-admin"]) && $_POST["formulario-admin"] == "editar"){

    $nombre = $_POST["editNombre"];
    $idAdmin = (int) $_POST["editId"];
    $usuario = $_POST["editUsuario"];
    $ruta = $_POST["fotoActual"];
    $fotoActual = $_POST["fotoActual"];

    /* Validar foto */
    if ($_FILES["nuevaFoto"]["error"] == 0) {
        $resp = validarFoto($_FILES, $fotoActual, $usuario);
        if ($ruta != $resp) {
            $ruta = $resp;
        }
    }

    /* hola mundo */
    if (!empty($_POST["editContrasena"])) {
        $ventauno = [
            'cost' => 12,
        ];
        $ventados = password_hash($_POST["editContrasena"], PASSWORD_DEFAULT, $ventauno);
    }
    
    try {
        if (empty($_POST["editContrasena"])) {
            $stmt = $conexion->prepare("UPDATE admins SET nombre = ?, foto = ?, editado = NOW() WHERE id_admin = ?;");
            $stmt->bind_param("ssi", $nombre, $ruta, $idAdmin);
        }else{
            $stmt = $conexion->prepare("UPDATE admins SET nombre = ?, contraseña = ?, foto = ?, editado = NOW() WHERE id_admin = ?;");
            $stmt->bind_param("sssi", $nombre, $ventados, $ruta, $idAdmin);
        }
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'editExito',
                'id_admin' => $stmt->insert_id
            );
        }else{
            $respuesta = array('respuesta' => 'error');
        }
        $stmt->close();
        $conexion->close();
    } catch (Exeption $e) {
        $respuesta = array("Error:" => $e->getMessage());
    }
    die(json_encode($respuesta));
}

/* -------------------------------------------------------------------------- */
/*                            ELIMINAR ADMINSTRADOR                           */
/* -------------------------------------------------------------------------- */
if (isset($_POST["formulario-admin"]) && $_POST["formulario-admin"] == "borrar"){
    $idAdmin = $_POST['idAdmin'];
    try {
        $stmt = $conexion->prepare("DELETE FROM `admins` WHERE `id_admin` = ?");
        $stmt->bind_param("i", $idAdmin);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'borrarExito',
                'idAdmin' => $idAdmin
            );
        }else{
            $respuesta = array('respuesta' => 'error');
        }
        $stmt->close();
        $conexion->close();
    } catch (Exeption $e) {
        $respuesta = array("Error:" => $e->getMessage());
    }
    die(json_encode($respuesta));
}