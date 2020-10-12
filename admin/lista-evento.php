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
        Lista de administradores
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabla para administrar los usuarios</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="registros-eventos" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width: 10px;">Nº</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Invitado</th>
                    <th>Categoría</th>
                    <th style="width:100px;">Acciones</th>
                </tr>
                </thead>
                
                <tfoot>
                <tr>
                    <th>Nº</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Foto</th>
                    <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

<?php include_once 'templates/footer.php' ?>