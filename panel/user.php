            <div class="col-12">


                <div id="accordion">


                    <div class="card">

                        <div class="card-header">
                            <a class="collapsed card-link text-black-50" data-toggle="collapse" href="#collapseOne">
                                Información
                            </a>
                        </div>

                        <div id="collapseOne" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img class="perfil" src=<?php if(isset($_SESSION["Imagen"])){echo "\"".$_SESSION["Imagen"]."\"";} else { echo "\"img/user.png\""; } ?> class="rounded-circle" alt="Pofile Image">
                                </div>
                                <div class="col-md-4">
                                    <h5>Nombre</h5>
                                    <?php echo $_SESSION["Nombre"]; ?>
                                    <br/><br/>
                                    <h5>Username</h5>
                                    <?php if(isset($_SESSION["Username"])) {echo $_SESSION["Username"];} else { if(isset($_SESSION["FUID"])) {echo "Registrado con Facebook.";} else { echo "Registrado con Google.";} } ?>
                                    <br/><br/>
                                    <h5>Teléfono</h5>
                                    <?php if(isset($_SESSION["Telefono"])) {echo $_SESSION["Telefono"];} else { echo "";} ?>
                                </div>
                                <div class="col-md-4">
                                    <h5>Apellido</h5>
                                    <?php echo $_SESSION["Apellido"]; ?>
                                    <br/><br/>
                                    <h5>Correo</h5>
                                    <?php echo $_SESSION["Correo"]; ?>
                                    <br/><br/>
                                    <h5>Fecha de nacimiento</h5>
                                    <?php if(isset($_SESSION["FechaNac"])) {echo $_SESSION["FechaNac"];} else { echo "";} ?>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="card">

                        <div class="card-header">
                            <a class="card-link text-black-50" data-toggle="collapse" href="#collapseTwo">
                                Actualiza tu información
                            </a>
                        </div>

                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <form action="logic/user/updateUser.php" method="POST" enctype="multipart/form-data">
                                    <input id="id" name="id" type="hidden" value="<?php echo $_SESSION['UID']; ?>">
                                    <div class="form-group row px-4 mb-2">
                                        <div class="col-12 col-md-6">
                                            <label for="name">Nombres</label>
                                            <input type="text" class="form-control" placeholder="Ingresa tus nombre" name="name" id="name">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="apellido">Apellidos</label>
                                            <input type="text" class="form-control" placeholder="Ingresa tus apellidos" name="apellido" id="apellido">
                                        </div>
                                    </div>
                                    <div class="form-group row px-4 mb-2">
                                        <div class="col-12 col-md-6">
                                            <label for="telefono">Teléfono</label>
                                            <input type="number" class="form-control" placeholder="Ingresa tu teléfono" name="telefono" id="telefono">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="fecha_nac">Fecha de nacimiento</label>
                                            <input class="form-control" type="date" name="fecha_nac" id="fecha_nac">
                                        </div>

                                    </div>
                                    <div class="form-group row px-4 mb-2">
                                        <div class="col-12 col-md-6">
                                            <label for="perfil">Actualizar foto de perfil</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="image" name="image" lang="es" accept=".jpg,.png,.jpeg,.gif">
                                                    <label id="img0" class="custom-file-label" for="image">Escoger archivo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <input type="submit" class="btn btn-dark btn-block " value="Guardar">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    
                    <div class="card">
                        <div class="card-header">
                            <a class="collapsed card-link text-black-50" data-toggle="collapse" href="#collapseThree">
                                Mis Pedidos
                            </a>
                        </div>
                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                            <div class="card-body">




<?php
set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context) {
    throw new ErrorException( $err_msg, 0, $err_severity, $err_file, $err_line );
}, E_WARNING);
try {
    $contador = 0;
    $userOrders = json_decode( file_get_contents($env.'api/orden/read.php?by=user&id='.$_SESSION["UID"]), true );

    for ($x=0; $x<count($userOrders["records"]); $x++) {
        if($contador==0) {
?>
                                <div class="row">
<?php   } ?>
                                    <div class="col-3">
                                    <div class="card">
                                        <img class="card-img-top" src="<?php echo $userOrders["records"][$x]["productos"][0]["image"];?>" alt="" style="height: 250px;">
                                        <div class="card-body">
                                            <h5 class="card-title">Factura #<?php echo $userOrders["records"][$x]["id"]; ?></h5>
                                            <p class="card-text">Fecha: <?php echo $userOrders["records"][$x]["fecha"];?></p>
                                            <p class="card-text">Total: <?php echo $userOrders["records"][$x]["total"];?></p>
                                            <?php $pdfid = $userOrders['records'][$x]['id']; ?>
                                            <button type="button" onclick="printJS('<?php echo $env; ?>factura/pdfGenerator.php?id=<?php echo $pdfid; ?>&c=true')" class="btn btn-dark mb-1" style="width: 100%;">Imprimir Factura</button>
                                            <a href="factura/email.php?id=<?php echo $userOrders["records"][$x]["id"]; ?>"><button type="button" class="btn btn-dark mb-1" style="width: 100%;">Enviar al correo</button></a>
                                            <!--<a href="logic/factura/imprimir.php?id=<?php echo $userOrders["records"][$x]["id"]; ?>"><button class="btn btn-dark mb-1" style="width: 100%;">Imprimir Factura</button></a>-->
                                            <a href="factura/index.php?id=<?php echo $userOrders["records"][$x]["id"]; ?>"><button class="btn btn-dark" style="width: 100%;">Detalles de la factura</button></a>
                                        </div>
                                    </div>
                                    </div>
<?php   $contador=$contador+1;
        if($contador==4 || $x==(count($userOrders["records"])-1)) { ?>
                                </div>
<?php       $contador=0;
        }
    }
} catch (Exception $e) { ?>
    <script>cosole.log("No hay pedidos.");</script>
<?php } 
restore_error_handler();
?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>