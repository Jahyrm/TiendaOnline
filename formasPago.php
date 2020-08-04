<?php 
session_start();
include "globalVars.php";

if(isset($_COOKIE['logincookie'])) {
	if (!isset($_SESSION['Recuperado'])) {
		include 'logic/funciones.php';
		$id = dec_enc('decrypt', $_COOKIE['logincookie']);
		recuperarUser($id, $env);
	}
}

$titulo = "Formas de pago | Zibá ¡es como tú";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include('head.php') ?>
</head>

<body> 
<?php include('header.php'); ?>

    <main class="container" style="margin-top: 260px; margin-bottom: 200px;">
        <div class="row">
            <div class="col-12">
                <div class="col-12">
                    <h2 class="text-left" style="color: #c20114;"><strong>Registro y pagos con tarjeta</strong></h2>
                </div>
                <div class="col-12" style="text-align: justify;">
                    <p>Al realizar tu registro en nuestra tienda en línea Zibá para hacer uso de la misma plataforma,
                        tendrás que hacer el llenado de forma para proporcionar tus datos. Únicamente se solicita un
                        nombre de usuario, correo electrónico y algunos datos personales; es responsabilidad del cliente
                        mantener en secreto la información de su cuenta privada, incluyendo su contraseña, para toda la
                        actividad que ocurra en su cuenta. Usted deberá notificar a Zibá por cualquier uso
                        desautorizado de la misma.</p>
                    <p>Mediante este registro el usuario queda completamente de acuerdo a los precios establecidos en el
                        sitio web. Es obligación del cliente mantenerse informado sobre la actualización de los mismos,
                        los cuales estarán siempre publicados en nuestra tienda en línea.
                    </p>
                    <p>Los cargos en tarjeta de crédito ó débito del Cliente se realizarán al momento de finalizar la
                        compra, donde se le solicitará ingresar sus datos personales para la entrega de los productos
                        comprados. Zibá nunca solicitará datos como el número de tarjeta de crédito o débito por
                        correo electrónico o cualquier otro medio; la información proporcionada es estrictamente
                        confidencial, por lo que no puede ser difundida ni transmitida, salvo con la autorización del
                        consumidor o requerimiento de la autoridad.</p>
                </div>
            </div>



    </main>
    <?php include('footer.php');?>
</body>

</html>