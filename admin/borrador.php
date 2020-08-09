<?php
                try {
                    $key = 1;
                    $stmt = $conexion->query("SELECT id_admin, nombre, usuario, foto FROM admins");
                    while ($valor = $stmt->fetch_assoc()) {
                        echo '
                        
                        <tr>
                            <td>'.$key.'</td>
                            <td>'.$valor["nombre"].'</td>
                            <td>'.$valor["usuario"].'</td>'
                ?>
                            <td><img class="img-circle img-sm" src="<?php echo $valor["foto"] ?: "img/usuarios/administradores/anonima.jpg" ?>" alt="admin imagen"></td>
                <?php
                        echo '<td>
                                <div class="btn-group">
                                    <button class="btn btn-warning btn-xs"><a href="editar-admin.php?id='.$valor["id_admin"].'"><i class="fa fa-pencil"></i></a></button>
                                    <button class="btn bg-maroon btn-xs borrar-registro" data-id="'.$valor["id_admin"].'" data-tipo="admin" ><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        
                        ';
                        $key++;
                    }
                    $stmt->close();
                    $conexion->close();
                } catch (Exeption $e) {
                    echo "Error:" . $e->getMessage();
                }
                ?>