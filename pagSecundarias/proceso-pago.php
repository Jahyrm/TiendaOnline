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
        <div class="row mt-4 mb-4 align-items-center" style="height: 658px;">
            <div class="col-12">
                <h2 class="text-capitalize text-center"><strong>Proceso de pago</strong></h2>
            </div>
            <div class="col-12 col-lg-6 align-items-center justify-content-center pb-3">
                <div style="display: flex;flex-direction: column; margin: auto auto;">
                    <form action="" id="" name="">
                        <div class="form-group row px-6">
                            <div class="col-12 mb-3">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline1">Tarjeta de crédito</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline2">Tarjeta de débito</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="numTarjeta">Número de tarjeta</label>
                                <input type="text" class="form-control" placeholder="Ingresa el número de tu tarjeta" name="numero" id="numTarjeta">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="titular">Nombre de titular</label>
                                <input type="text" class="form-control" placeholder="Ingresa el nombre del titular" name="nombreTitular" id="titular">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="codigo">Código de seguridad</label>
                                <input type="text" class="form-control" placeholder="Ingresa el código del celular" name="codSeguridad" id="codigo">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="fecha">Fecha de vencimiento</label>
                                <input id="date" class="form-control" type="date">
                            </div>
                            <div class="col-12 mt-3">
                                <input type="submit" class="btn btn-dark btn-block " value="Confirmar pago">
                            </div>
                        </div>
                    </form>
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