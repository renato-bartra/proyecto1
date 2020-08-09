<?php 

session_start();
if (isset($_GET["cerrar_sesion"])) {
    session_destroy();
}
include_once 'funciones/funciones.php';
include_once 'templates/header.php'; 

?>

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="../index2.html"><b>UXWD</b>WebCamp</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Inicia sesión aquí</p>

        <form method="post" name="login-admin" id="login-admin" role="form">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="usuario" placeholder="Usuario">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="contrasena" placeholder="Contraseña">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <input type="hidden" name="btn-login-admin" value="1">
                    <button type="submit"  class="btn btn-primary btn-block btn-flat">Ingresar</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php include_once 'templates/footer.php' ?>
