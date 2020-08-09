<?php 

include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
include_once 'templates/header.php'; 
include_once 'templates/barra.php'; 
include_once 'templates/navegador.php'; 

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Crear Admnistrador
        <small>Llena el formulario para crear un administrador</small>
      </h1>
    </section>

    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                    <h3 class="box-title">Crear Administrador</h3>
                    </div>
                    <div class="box-body">
                        <form role="form" method="post" name="crear-admin" id="crear-admin" enctype="multipart/form-data">

                            <!-- Entrada para el Nombre-->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control input-md" name="nuevoNombre" placeholder="Ingresar Nombre" required>
                                </div>
                            </div>

                            <!-- Entrada para el Usuario-->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="text" class="form-control input-md" name="nuevoUsuario" id="nuevoUsuario" placeholder="Ingresar Usuario" required>
                                </div>
                            </div>

                            <!-- Entrada para la Contraseña-->
                            <div class="form-group validar-pass">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control input-md" name="nuevoContrasena" id="nuevoContrasena" placeholder="Ingresar Contraseña" required>
                                </div>
                            </div>

                            <!-- Entrada para la repetir contraseña-->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control input-md" name="repetirContrasena" id= "repetirContrasena" placeholder="Repetir Contraseña" required>
                                </div>
                                <span id="resultado-contrasena" class="help-block"></span>
                            </div>

                            <!-- Entrada para la imagen-->
                            <div class="form-group">
                                <div class="panel"> Subir Foto</div>
                                <input type="file" class="nuevaFoto" name="nuevaFoto">
                                <p class="help-block">Peso maximo 2 MB</p>
                                <img src="img/usuarios/administradores/anonima.jpg" class="img-thumbnail previsualizar" width="100px">
                            </div>

                            <!-- FOOTER -->
                            <div class="box-footer">
                                <div class="pull-right">
                                    <input type="hidden" name="formulario-admin" value="crear">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check-circle-o"></i> Añadir</button>
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
