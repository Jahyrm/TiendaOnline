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

$titulo = "Envíos y devoluciones | Zibá ¡es como tú";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include('head.php') ?>
</head>

<body>
<?php include('header.php'); ?>

    <main class="container" style="margin-top: 230px; margin-bottom: 0px;">
        <div class="row" style="margin-top: 100px; margin-bottom: 180px;">
            <div class="col-12">
                <h2 class="text-left" style="color: #c20114;"><strong>Envíos y plazos de entrega</strong></h2>
            </div>
            <div class="col-12" style="text-align: justify;">
                <p>La operación de envíos de los productos se restringe solamente a la República Ecuatoriana. Problemas
                    en la entrega, retrasos, daños, pérdidas o robo son responsabilidad del operador del envío.</p>
                <p>La orden es procesada en un máximo de 7 días hábiles, siempre y cuando se cumpla con toda la
                    información requerida y el producto no haya sufrido alguna baja por causas ajenas a nuestra tienda
                    en línea. El tiempo de entrega es de 3 a 5 días hábiles después de haber realizado el envío.
                </p>
                <p>Es importante tener en cuenta que puede haber retrasos ocasionales por diversas causas en tu envío.
                    Las notificaciones de su compra, envío, entrega y otros se hará a través de correo electrónico. Sí
                    el cliente captura de manera incorrecta sus datos de envío y el pedido se retrasa, Zibá no se
                    hace responsable ya que no es un asunto imputable a la empresa, es responsabilidad del cliente
                    revisar los datos otorgados.</p>
            </div>
            <div class="col-12">
                <h2 class="text-left" style="color: #c20114;"><strong>Gastos de envío</strong></h2>
            </div>
            <div class="col-12" style="text-align: justify;">
                <p>Gastos de envío
                    El importe de estos costes lo fija la empresa de transportes utilizada. Podrás visualizarlos en el
                    momento de la tramitación del pago, justo antes de confirmar tu pedido.
                <p>
            </div> 
        </div><br>

    </main>

    <?php include('footer.php');?>
</body>

</html>