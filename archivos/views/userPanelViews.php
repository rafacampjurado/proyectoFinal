<?php



class userPanelViews {



    function __construct() {

        

    }



    public static function verDatosPersonales($datosUsuario) {

        /////////////////////////////////////////////////////////////// ESTOS DATOS SON FIJOS

        $usuario = $_SESSION['usuario']->getUsuario();

        $email = $_SESSION['usuario']->getEmail();

        $idUsuario = $_SESSION['usuario']->getIdUsuario();

        $fechaUsuario = $_SESSION['usuario']->getFecha();

        $rolUsuario = $_SESSION['usuario']->getRol();

        /////////////////////////////////////////////////////////////////

        $imagenUsuario =  $_SESSION['usuario']->getImagen();

        $nombreUsuario = $datosUsuario[0]['nombre'];

        $apellidosUsuario = $datosUsuario[0]['apellidos'];

        ?> 

        <div class="h1 text-center">Datos personales</div>

        <div class="separador"></div>

        <div class="col-xs-12 col-md-12 col-lg-12 col-xs-offset-3 col-lg-offset-5 col-md-offset-5">

            <form method="POST" action="forms-action/formEditarUsuario.php" name="formAñadirFoto" enctype="multipart/form-data" id="formAñadirFoto">

                <img id="imagen-usuario" src="./img/user-images/<?php echo ($imagenUsuario != 'default.png') ? $idUsuario . '-' . $imagenUsuario : 'default.png' ?> ">

                <input type="file" class="imagenUsuario" name="imagenUsuario"  onchange="enviarImagen()()">

                <button type="submit"  hidden="" id="botonEnviarFoto" form="formAñadirFoto">Enviar</button>

            </form>

        </div>

        <div class="col-xs-12 col-md-9 col-lg-9 bloque col-lg-offset-2 col-md-offset-1 col-xs-offset-0">

            <div class="col-xs-12 col-md-6 col-lg-6">

                <div class="form-group">

                    <label>Nombre de usuario</label>

                    <input type="text" class="form-control" name="nickUsuario" value="<?php echo $usuario ?>" disabled="">

                </div>

            </div>

            <div class="col-xs-12 col-md-6 col-lg-6">

                <div class="form-group">

                    <label >Correo Electrónico</label>

                    <input type="email" class="form-control" value="<?php echo $email ?>" disabled="">

                </div>

            </div>

            <div class="col-xs-12 col-md-6 col-lg-6">

                <div class="form-group">

                    <label >Fecha de registro</label>

                    <input type="text" class="form-control" value="<?php echo $fechaUsuario ?>" disabled="">

                </div>

            </div>

            <div class="col-xs-12 col-md-6 col-lg-6">

                <div class="form-group">

                    <label >Rol</label>

                    <input type="text" class="form-control" value="<?php echo $rolUsuario ?>" disabled="">

                </div>

            </div>

        </div>

        <div class="col-xs-12 col-md-9 col-lg-9 bloque col-lg-offset-2 col-md-offset-1 col-xs-offset-0">

            <form method="POST" action="forms-action/formEditarUsuario.php" name="formEditarUsuario" id="formEditarUsuario">

                <div class="col-xs-12 col-md-6 col-lg-6">

                    <div class="form-group">

                        <label >Nombre  <span class="fa fa-pencil spanClick" onclick="desbloquearCampo('nombreUsuario')"></span></label>

                        <input type="text" class="form-control" name="nombreUsuario" value="<?php echo $nombreUsuario ?>" disabled="" >

                    </div>

                </div>

                <div class="col-xs-12 col-md-6 col-lg-6">

                    <div class="form-group">

                        <label >Apellidos  <span class="fa fa-pencil spanClick" onclick="desbloquearCampo('apellidosUsuario')"></span></label>

                        <input type="text" class="form-control" name="apellidosUsuario"  value="<?php echo $apellidosUsuario ?>" disabled="">

                    </div>

                </div>

                <div class="col-xs-12 col-md-12 col-lg-6 col-lg-offset-3 col-xs-offset-0 col-md-offset-0">

                    <span id="enviarFormEditarUsuario" onclick="enviarDatosForm();" class="btn btn-primary spanClick">Guardar</span>

                    <input type="submit" form="formEditarUsuario" hidden="" name="enviarFormEditarUsuario">

                </div>

            </form>

        </div>





        <?php

    }



    public static function verInfoCuenta() {

        ?> 

        <div class="h1">Info de la cuenta</div>

        <?php

    }



    public static function verFacturas($facturas) {

        $tablasFacturas = pintarFacturas($facturas);

        $nombreUsuario = $_SESSION['usuario']->getUsuario();

        ?>

        <div class="h1 text-center">Facturas <?php echo $nombreUsuario ?></div>

        <div class="col-xs-12 col-md-12 col-lg-12">

        <?php

        if ($tablasFacturas != '') {



            echo $tablasFacturas;

        } else {

            echo "No se ha efectuado ninguna compra.";

        }

        ?>

        </div>

            <?php

        }



        public static function listadoComentarios($comentarios) {

            $listacomentarios = (!empty($comentarios)) ? pintarComentariosUsuario($comentarios) : 'No existen comentarios.';

            $nombreUsuario = $_SESSION['usuario']->getUsuario();

            ?>

        <div class="h1 text-center">Comentarios de <?php echo $nombreUsuario ?>.</div>

        <div class="col-xs-12 col-md-12 col-lg-12">

        <?php echo $listacomentarios ?>

        </div>

        <div id="modal-editar-comentario" class="dialogo ui-widget-content ui-corner-all text-center">

            <form method="POST" action="forms-action/formEditComentUsuario.php">

                <div class="form-group">

                    <label>Comentario: </label>

                    <input type="text" name="comentarioProducto" value="" id="formComentarioProducto">

                </div>

                <div class="form-group">

                    <label>Puntuación: </label>

                    <input type="number" name="puntuacionProducto" value="" id="formPuntuacionProducto" max="5">

                </div>

                <input type="number" name="idOpinion" value="" id="formIdOpinion" hidden="">

                <button type="submit">Enviar</button>

            </form>

        </div>

        <div id="modal-eliminar-comentario" class="dialogo ui-widget-content ui-corner-all text-center">

            <form method="POST" action="forms-action/formDelComentUsuario.php">

                <div class="form-group">

                    <label >¿Quieres eliminar el comentario? </label>

                    <input type="number" name="idOpinion" value="" id="formIdOpinion" hidden="">

                </div>

                <button type="submit">Aceptar</button>

            </form>

        </div>



        <?php

    }



    public static function listadoMetodosPagos($metodosPagos, $direccionesGuardadas) {

        ?>

        <div class="h1 text-center">Métodos de pagos registrados</div>

        <div class="col-xs-12 col-md-12 col-lg-12 separador"></div>



        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="h2 text-center">Tarjetas de crédito</div>

            <div class="col-xs-12 col-md-12 col-lg-12 separador"></div>



        <?php

        if (!empty($metodosPagos)) {

            foreach ($metodosPagos as $metodoPago) {

                $numeroTarjeta = $metodoPago['numeroTarjeta'];

                $marcaTarjeta = $metodoPago['tipo'];

                $idTarjeta = $metodoPago['idTarjetaCredito'];

                ?>

                    <div class="col-xs-12 col-md-12 col-lg-12 col-xs-offset-0 col-md-offset-2 col-lg-offset-2 columTarjetas">



                        <div class="col-xs-12 col-md-7 col-lg-7 bloque">

                            <div class="col-xs-2 col-md-2 col-lg-2">

                                <span class="fa fa-credit-card tarjetaCredito"></span>

                            </div>

                            <div class="col-xs-10 col-md-10 col-lg-10 text-center">

                                <button class="btn fa fa-close accion closeTarjeta" value="eliminar-tarjeta-<?php echo $idTarjeta ?> "></button>

                                <div class="col-xs-10 col-md-10 col-lg-10">

                                    <table class="table tabla-pagos">

                                        <thead>

                                            <tr>

                                                <th>Número de la tarjeta</th>

                                                <th>Marca</th>

                                            </tr>

                                        </thead>

                                        <tbody class="text-left">

                                            <tr>

                                                <td><?php echo $numeroTarjeta ?></td>

                                                <td><?php echo $marcaTarjeta ?></td>



                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>





                <?php

            }

        } else {

            ?>

                <div class="col-xs-12 col-md-12 col-lg-12 col-xs-offset-0 col-md-offset-2 col-lg-offset-2 columTarjetas">No se ha registrado ninguna tarjeta.</div>

            <?php } ?>

        </div>

        <div id="modal-eliminar-tarjeta" class="dialogo ui-widget-content ui-corner-all text-center">

            <form method="POST" action="forms-action/formEliminarTarjeta.php">

                <div class="form-group">

                    <label >¿Quieres eliminar esta tarjeta de crédito? </label>

                    <input type="number" name="idTarjeta" value="" id="formIdOpinion" hidden="">

                </div>

                <button type="submit">Aceptar</button>

            </form>

        </div>

        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="col-xs-8 col-md-7 col-lg-7 col-xs-offset-2">

                <button class="btn btn-primary btn-max  fa fa-plus-circle botonAñadirNuevo" value="tarjeta"> Añadir nueva tarjeta</button>

            </div>

        </div>

        <!--//////////////////////////////////////////-->



        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="h2 text-center">Direcciones registradas</div>

            <div class="col-xs-12 col-md-12 col-lg-12 separador"></div>

        <?php

        if (!empty($direccionesGuardadas)) {

            foreach ($direccionesGuardadas as $direccion) {

                $idDireccion = $direccion['idDireccion'];

                $calle = $direccion['calle'];

                $ciudad = $direccion['ciudad'];

                $pais = $direccion['pais'];

                $codigoPostal = $direccion['codigoPostal'];

                $telefono = $direccion['telefono'];

                $alias = $direccion['alias'];

                ?>

                    <div class="col-xs-12 col-md-12 col-lg-12 col-xs-offset-1 col-md-offset-1 col-lg-offset-1 columDirecciones" >

                        <div class="col-xs-9 col-md-9 col-lg-9 bloque">

                            <div class="col-xs-12 col-md-2 col-lg-2">

                                <span class="fa fa-home tarjetaCredito"></span>

                            </div>

                            <div class="col-xs-12 col-md-10 col-lg-10 text-center">

                                <button class="btn fa fa-close accion boton-eliminar closeDireccion" value="eliminar-direccion-<?php echo $idDireccion ?> "></button>

                            </div>

                            <div class="col-xs-12 col-md-10 col-lg-10 text-center">

                                <div class="col-xs-12 col-md-12 col-lg-12">

                                    <h2 style="color: white;"><?php echo $alias ?></h2>

                                    <table class="table paddingBottom3">

                                        <tbody class="text-left">

                                            <tr>

                                                <th>Calle</th>

                                                <td><?php echo $calle ?></td>

                                            </tr>

                                            <tr>

                                                <th>Ciudad</th>

                                                <td><?php echo $ciudad ?></td>

                                            </tr>

                                            <tr>

                                                <th>País</th>

                                                <td><?php echo $pais ?></td>

                                            </tr>

                                            <tr>

                                                <th>Código Postal</th>

                                                <td><?php echo $codigoPostal ?></td>

                                            </tr>

                                            <tr>

                                                <th>Teléfono</th>

                                                <td><?php echo $telefono ?></td>

                                            </tr>

                                            <tr><th></th><td></td></tr>

                                        </tbody>

                                    </table>



                                </div>

                            </div>

                        </div>

                    </div>



                <?php

            }

        } else {

            ?>

                <div class="col-xs-12 col-md-12 col-lg-12 col-xs-offset-0 col-md-offset-2 col-lg-offset-2 columTarjetas">No se ha registrado ninguna tarjeta.</div>

            <?php } ?>

            <div id="modal-eliminar-direccion" class="dialogo ui-widget-content ui-corner-all text-center">

                <form method="POST" action="forms-action/formEliminarDireccion.php">

                    <div class="form-group">

                        <label >¿Quieres eliminar esta dirección? </label>

                        <input type="number" name="idDireccion" value="" id="formIdOpinion" hidden="">

                    </div>

                    <button type="submit">Aceptar</button>

                </form>

            </div>

            <div class="col-xs-12 col-md-12 col-lg-12">

                <div class="col-xs-12 col-md-7 col-lg-7 col-md-offset-2">

                    <button class="btn btn-primary btn-max fa fa-plus-circle botonAñadirNuevo" value="direccion"> Añadir nueva direccion</button>

                </div>

            </div>

        </div>

        <div id="modal-nueva-tarjeta" class="dialogo ui-widget-content ui-corner-all text-center">

            <form method="POST" action="forms-action/formAñadirTarjeta.php">

                <div class="form-group">

                    <label>Número de la tarjeta</label>

                    <input type="text" name="numTarjeta" value="" required="" maxlength="11" onkeyup="this.value = this.value.toUpperCase();">

                </div>

                <label>Marca de la tarjeta</label>

                <select name="marcaTarjeta" required="">

                    <option>-- Selecciona una marca -- </option>

                    <option value="VISA">VISA</option>

                    <option value="MASTERCARD">MASTERCARD</option>

                    <option value="UNICAJA">UNICAJA</option>

                    <option value="CAIXA">CAIXA</option>

                </select>

                <button type="submit">Enviar</button>

            </form>

        </div>

        <div id="modal-nueva-direccion" class="dialogo ui-widget-content ui-corner-all text-center">

            <form method="POST" action="forms-action/formAñadirDireccion.php">

                <div class="form-group">

                    <label>Nombre de la dirección</label>

                    <input type="text" name="alias" value="" required="">

                </div>

                <div class="form-group">

                    <label>Calle</label>

                    <input type="text" name="calle" value="" required="">

                </div>

                <div class="form-group">

                    <label>Ciudad</label>

                    <input type="text" name="ciudad" value="" required="">

                </div>

                <div class="form-group">

                    <label>País</label>

                    <input type="text" name="pais" value="" required="">

                </div>

                <div class="form-group">

                    <label>Código postal</label>

                    <input type="text" name="codigoPostal" value="" required="" maxlength="5">

                </div>

                <div class="form-group">

                    <label>Teléfono</label>

                    <input type="text" name="telefono" value="" required="" maxlength="12">

                </div>



                <button type="submit">Enviar</button>

            </form>

        </div>

        <?php

    }



}

