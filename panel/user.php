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
                                                    <input type="file" class="custom-file-input" id="image" name="image" accept=".jpg,.png,.jpeg,.gif">
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>