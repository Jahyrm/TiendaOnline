<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Mi cuenta</title>
    <style>
        .error{
            display: none;
        }
    </style>

</head>

<body>
    <?php include('../headerSecudario.php'); ?>

    <main class="container">
        <div class="row mt-4 mb-4 align-items-center" style="height: 658px;">
            <div class="col-12 col-lg-6 align-items-center justify-content-center pb-3">
                <div style="display: flex;flex-direction: column; margin: auto auto;">
                    <h2 style="display: block;text-align: center;">Iniciar sesión</h2>
                    <p style="display: block;text-align: center;">Bienvenido de regreso</p>
                    <form action="" id="formSesion" name="formSesion">
                        <div class="form-group row px-4 ">
                            <div class="col-12 mb-3">
                                <label for="correo">Correo</label>
                                <input type="email" class="form-control" placeholder="Ingresa tu correo" name="correo"
                                    id="correo">
                            </div>
                            <div class="col-12">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" placeholder="Ingresa tu password"
                                    name="password" id="password">
                            </div>
                            <div class="col-12">
                                <ul class="error" id="error">
                                </ul>
                            </div>
                            <div class="col-12 mt-3">
                                <input type="submit" class="btn btn-dark btn-block " value="Ingresar">
                            </div>
                        </div>
                    </form>
                    <p style="display: block;text-align: center;">O</p>
                    <div>
                        <p style="display: inline;">Iniciar sesión con</p>
                        <div style="display: inline;">
                            <button class="btn btn-primary"><i class="fab fa-facebook"></i> Facebook</button>
                            <button class="btn btn-primary"><i class="fab fa-google-plus"></i> Google</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 align-items-center justify-content-center">
                <div style="display: flex;flex-direction: column; justify-content: center; margin: 30px;">
                    <h2 style="display: block;text-align: center;">¿No estás registrado?</h2>
                    <p style="display: block;text-align: center;">Con tu cuenta podrás realizar compras en línea,
                        obtener descuentos y una gran variadad de promociones.
                        Tendrás acceso a todos los servicios que ZIBÁ tiene para tí.</p>
                    <form action="">
                        <div class="col-12 mt-3 " style="display: block;text-align: center;">
                            <a href="registro.php" class="btn btn-dark w-100">Registrarse </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include('../footer2.php');?>

    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/5b9c980490.js" crossorigin="anonymous"></script>
    <script src="../js/formularioCuenta.js"></script>
</body>

</html>