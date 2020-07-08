<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilos.css">
    
    <title>Mi cuenta</title>
</head>

<body class>
    <?php include('../headerSecudario.php'); ?>
    <main class="container">

        <div class="row d-flex justify-content-around mt-3">
            <img src="../img/promociones.jpg" class="d-block w-100" alt="dcfvbn">
        </div>

        <div class="row d-flex justify-content-around mt-3">
            <div class="col-12">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header">
                            <a class="collapsed card-link text-black-50" data-toggle="collapse" href="#collapseOne">
                                Tu cuenta
                            </a>
                        </div>
                        <div id="collapseOne" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <h2 class="text-capitalize"><strong>Bienvenido ....</strong></h2>

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
                                <form action="">
                                    <div class="form-group row px-4 mb-2">
                                        <div class="col-12 col-md-6">
                                            <label for="nombre">Nombres</label>
                                            <input type="text" class="form-control" placeholder="Ingresa tus nombre" name="nombre" id="nombre">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="apellido">Apellidos</label>
                                            <input type="text" class="form-control" placeholder="Ingresa tus apellidos" name="password" id="password">
                                        </div>
                                    </div>
                                    <div class="form-group row px-4 mb-2">
                                        <div class="col-12 col-md-6">
                                            <label for="tipoD">Teléfono</label>
                                            <input type="text" class="form-control" placeholder="Ingresa tu teléfono">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="fecha">Fecha de nacimiento</label>
                                            <input id="date" class="form-control" type="date">
                                        </div>

                                    </div>
                                    <div class="form-group row px-4 mb-2">
                                        <div class="col-12 col-md-6">
                                            <label for="perfil">Actualizar foto de perfil</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="customFileLang" accept=".jpg,.png,.jpeg,.gif" value="">
                                                    <label class="custom-file-label" for="customFileLang">Escoger archivo</label>
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
                                Lista de productos
                            </a>
                        </div>
                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include('../footer2.php'); ?>

    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/5b9c980490.js" crossorigin="anonymous"></script>
</body>

</html>