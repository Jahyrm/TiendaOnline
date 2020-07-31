<?php 
session_start();

if(isset($_COOKIE['logincookie'])) {
	if (!isset($_SESSION['Recuperado'])) {
		include 'logic/funciones.php';
		$id = dec_enc('decrypt', $_COOKIE['logincookie']);
		recuperarUser($id);
	}
}

$titulo = "Contactos | Zibá ¡es como tú";
?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php include('head.php') ?>
</head>

<body>
    <?php include('header.php'); ?>
    <main class="container">
        <div class="row" style="margin-top: 240px; margin-bottom: 200px;">
            <div class="col-12 col-lg-8">
                <div style="display: flex;flex-direction: column; margin: auto auto;">
                    <h3 style="display: block;text-align: center;"><strong>Comunicate directamente con nosotros</strong></h3>
                    <hr>
                    <form action="">
                        <div class="form-group row px-4 mb-2">
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control" placeholder="Ingresa tu nombre" name="nombre"
                                    id="nombre">
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control" placeholder="Ingresa tu correo electrónico"
                                    name="correo" id="correo">
                            </div>
                        </div>
                        <div class="form-group row px-4 mb-2">
                            <textarea class="form-control" rows="5" id="comment" placeholder="Mensaje"></textarea>
                        </div>
                        <div class="col-12 mt-3">
                            <input type="submit" class="btn btn-dark btn-block " value="Enviar">
                        </div><br>
                    </form>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div style="display: flex;flex-direction: column; margin: auto auto 100px auto;">
                    <h3 style=" display: block;text-align: center;">Más información</h3>
                    <p style="display: block;text-align: justify;">Zibá tiene para ti las mejores marcas en maquillaje, cuidado
                        personal,
                        productos de para
                        peluquería, cuidado capilar, etc. Visítanos en nuestro local.</p>
                    <h5 style="display: block;color: #c20114;; text-align: center;">Nuestro local</h5>
                    <p style="display: block;">Llamadas y WhatsApp: </p>
                    <p style="display: block;">Correo electrónico: </p>
                </div>
            </div>

        </div>
    </main>

    <?php include('footer.php');?>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/5b9c980490.js" crossorigin="anonymous"></script>
</body>

</html>