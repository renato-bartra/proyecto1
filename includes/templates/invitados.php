<!-- REALIZA LA CONECION -->
<?php
    try {

        // VERIFICA DONDE SE ENCUENTRA
        $archivo = basename($_SERVER['PHP_SELF']);
        $pagina = str_replace(".php", "", $archivo);

        if ($pagina == 'index') {
            require_once('includes/funciones/conexion.php');
            $images = 'images/';
        }else{
            require_once('../includes/funciones/conexion.php');
            $images = '../images/';
        }

        // INICIA LA CONECCION
        $sql = "SELECT * FROM `invitados`";

        $resultado = $conexion->query($sql);
    } catch (\Exception $e){
        echo $e->getMessaje();
    }
?>

<section class="invitados seccion">
    <h2 class="centrar-texto mayusculas">Nuestros invitados</h2>
    <div class="lista-invitados contenedor">

        <!-- lista de invitados -->
        <?php while( $invitados = $resultado->fetch_assoc() ){ ?>
                
        <div class="invitado">
            <a class="invitado-info" href="#invitado<?php echo $invitados['id_invitado'] ?>">
                <img src="<?php echo $images . $invitados['imagen'] ?>" alt="invitado">
                <p><?php echo $invitados['nombre'] . " " . $invitados['apellido'] ?></p>
            </a>
        </div>

        <?php 
            if ($pagina == 'invitados') { ?>
                <div style="display:none;">
                    <div id="invitado<?php echo $invitados['id_invitado'] ?>" class="invitado-info">
                        <div class="caja-invitado-i">
                            <div class="ajustar">
                            <img src="<?php echo $images . $invitados['imagen'] ?>" alt="invitado">
                            </div>
                            <h3><?php echo $invitados['nombre'] . " " . $invitados['apellido'] ?></h3>
                            <p><?php echo $invitados['descripcion'] ?></p>
                        </div>
                        <div class="caja-invitado">
                            <div class="redes-invitados">
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-pinterest-p"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
        <?php }?>
                
        <?php } ?>
    </div>
</section>

<?php $conexion->close() ?>