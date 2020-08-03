<?php 
session_start();
include "globalVars.php";

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
        <div class="row" style="margin-top: 240px; margin-bottom: 50px;">
            <div class="col-8">
                <div class="row">
                    <div class="col-12">
                    <h3 style="display: block;text-align: center;"><strong>Ubícanos</strong></h3>
                    <br/>
                    <div id="map"></div>
                    <script>
                        // Initialize and add the map
                        function initMap() {
                        // The location of Cuenca
                        var cuenca = {lat: -2.897385, lng: -79.004559};
                        // The map, centered at Cuenca
                        var map = new google.maps.Map(
                            document.getElementById('map'), {zoom: 15, center: cuenca});
                        // The marker, positioned at Cuenca
                        var marker = new google.maps.Marker({position: cuenca, map: map});
                        }
                    </script>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div style="display: flex;flex-direction: column; margin: auto auto 100px auto;">
                    <h3 style=" display: block;text-align: center;">Más información</h3>
                    <p style="display: block;text-align: justify;">Zibá tiene para ti las mejores marcas en maquillaje, cuidado
                        personal,
                        productos de para
                        peluquería, cuidado capilar, etc. Visítanos en nuestro local.</p>
                    <h5 style="display: block;color: #c20114;; text-align: center;">Nuestro local: <?php echo $direccionEmpresa; ?></h5>
                    <p style="display: block;">Llamadas y WhatsApp:<br> <?php echo $telefonoEmpresa; ?></p>
                    <p style="display: block;">Correo electrónico:<br> <?php echo $correoEmpresa; ?></p>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 240px; margin-bottom: 50px !important; display: flex;flex-direction: column; margin: auto auto;">
                    <div class="col">
                    <h3 style="display: block;text-align: center;"><strong>Comunicate directamente con nosotros</strong></h3>
                    <hr>
                    <form action="phpmailer/email.php" method="post">
                        <div class="form-group row px-4 mb-2">
                            <div class="col-6">
                                <input type="text" class="form-control" placeholder="Ingresa tu nombre" name="nombre"
                                    id="nombre" required>
                            </div>
                            <div class="col-6">
                                <input type="email" class="form-control" placeholder="Ingresa tu correo electrónico"
                                    name="correo" id="correo" required>
                            </div>
                        </div>
                        <div class="form-group row px-4 mb-2">
                            <textarea class="form-control" rows="5" id="mensaje" name="mensaje" placeholder="Mensaje" required></textarea>
                        </div>
                        <div class="col-12 mt-3">
                            <input type="submit" class="btn btn-dark btn-block " value="Enviar">
                        </div><br>
                    </form>
                    </div>
        </div>
    </main>

    <script defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7SZg8tt9O_vjBc_9a8gh6oJpElOO9caA&callback=initMap">
    </script>
    <?php include('footer.php');?>

</body>

</html>