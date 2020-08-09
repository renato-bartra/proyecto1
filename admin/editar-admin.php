<?php 

include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
$id = $_GET["id"];
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("¡Error!");
}
$id = (int) $id;
include_once 'templates/header.php'; 
include_once 'templates/barra.php'; 
include_once 'templates/navegador.php'; 

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Admnistrador
        <small>Remplaze los campos que desea editar</small>
      </h1>
    </section>

    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Editar Administrador</h3>
                    </div>
                    <div class="box-body">
                    <?php
                    try {
                        $stmt = $conexion->prepare("SELECT id_admin, nombre, usuario, foto FROM admins WHERE id_admin = ?");
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $results = $stmt->get_result();
                        $row = $results->fetch_array(MYSQLI_ASSOC);
                        $stmt->close();
                        $conexion->close();
                    } catch (Exception $e){
                        echo $e->getMessaje();
                    }
                    $nombre = $row["nombre"];
                    $nombre = $row["usuario"];
                    $nombre = $row["foto"];
                    ?>
                        <form role="form" method="post" name="editar-admin" id="editar-admin" enctype="multipart/form-data">

                            <!-- Entrada para el Nombre-->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control input-md" name="editNombre" placeholder="Ingresar Nombre" value="<?php echo $row["nombre"] ?>" required>
                                </div>
                            </div>

                            <!-- Entrada para el Usuario-->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="text" class="form-control input-md" placeholder="Ingresar Usuario" value="<?php echo $row["usuario"] ?>" required disabled>
                                    <input type="hidden" name="editUsuario" value="<?php echo $row["usuario"] ?>">
                                </div>
                            </div>

                            <!-- Entrada para la Contraseña-->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control input-md" name="editContrasena" placeholder="Ingresar Contraseña">
                                </div>
                            </div>

                            <!-- Entrada para la imagen-->
                            <div class="form-group">
                                <div class="panel"> Subir Foto</div>
                                <input type="file" class="nuevaFoto" name="nuevaFoto">
                                <p class="help-block">Peso maximo 2 MB</p>
                                <img src="<?php echo $row["foto"] ?: "img/usuarios/administradores/anonima.jpg" ?>" class="img-thumbnail previsualizar" width="100px">
                                <input type="hidden" name="fotoActual" value="<?php echo $row["foto"] ?>">
                            </div>

                            <!-- FOOTER -->
                            <div class="box-footer">
                                <div class="pull-right">
                                    <input type="hidden" name="formulario-admin" value="editar">
                                    <input type="hidden" name="editId" value="<?php echo $row["id_admin"] ?>">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check-circle-o"></i> Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </section>
            <!-- /.content -->
        </div>
    </div>

  </div>
  <!-- /.content-wrapper -->

<?php include_once 'templates/footer.php' ?>
