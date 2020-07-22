<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Registrarse</title>

</head>

<body>
    <?php include('header1.php'); ?>
    <main class="container">
        <div class="row mt-4" style="margin-bottom: 100px;">
            <div class="col-12 align-items-center justify-content-center pb-3">
                <div style="display: flex;flex-direction: column; margin: auto auto;">
                    <h2 style="display: block;text-align: center;">Se parte de nuestra familia Zibá</h2>
                    <hr>
                    <form action="" method="post">
                        <div class="form-group row px-4 mb-2">
                            <div class="col-12 col-md-6">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" placeholder="Ingresa tus nombre" name="nombre" id="nombre">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" placeholder="Ingresa tus apellidos" name="apellido" id="apellido">
                            </div>

                        </div>
                        <div class="form-group row px-4 mb-2">
                            <div class="col-12 col-md-6">
                                <label for="numeroD">Usuario</label>
                                <input type="text" class="form-control" placeholder="Ingresa un nombre de usuario" name="usuario" id="usuario">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="email">Correo electrónico</label>
                                <input type="email" class="form-control" placeholder="Ingresa tu correo electrónico" name="correo" id="correo">
                            </div>
                        </div>
                        <div class="form-group row px-4 mb-2">
                            <div class="col-12 col-md-6 mb-3">
                                <label for="contraseña">Contraseña</label>
                                <input type="password" class="form-control" placeholder="Ingresa tu contraseña" name="contraseña" id="contraseña">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="Ccontraseña">Confirmar contraseña</label>
                                <input type="password" class="form-control" placeholder="Confirmar contraseña" name="Ccontraseña" id="Ccontraseña">
                            </div>
                        </div>
                        <div class="form-group row px-4 mb-2">
                            <div class="col">
                                <label class="form-check-label">
                                    <input type="checkbox" name="terminos" id="terminos" class="form-check-input mr-2">
                                    He leído y acepto los términos y condiciones de uso
                                </label>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <input type="submit" class="btn btn-dark btn-block " value="Registrarse" name="registrarse">
                        </div>
                    </form>
                    <p style="display: block;text-align: center;">O</p>
                    <div>
                        <p style="display: inline;">Registrarse con </p>
                        <div style="display: inline;">
                            <button class="btn btn-primary"><i class="fab fa-facebook"></i> Facebook</button>
                            <button class="btn btn-primary"><i class="fab fa-google-plus"></i> Google</button>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('footer.php'); ?>

    <script src="validar-registro.php"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/5b9c980490.js" crossorigin="anonymous"></script>
</body>

</html>