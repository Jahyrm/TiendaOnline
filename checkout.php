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

$titulo = "Checkout | Zibá ¡es como tú!";

if (!isset($_SESSION["UID"])){
    header('Location: index.php');
} else {
?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php include('head.php') ?>
<link rel="stylesheet" href="css/bootstrap-select.min.css">
<link rel="stylesheet" href="css/bootstrap-select-country.min.css" />

</head>
<body class>
    <?php include('header.php'); ?>

    <main class="container">

        <div class="col-12 align-items-center justify-content-center">
            <br/><br/>
            <h2 style="display: block;text-align: center;">Checkout</h2>
            <br/>
        </div>

        <form action="logic/orden/create.php" method="post">
        <div class="row form-group">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <h3>Detalles de Facturación</h3>
                        <label for="pais">País: </label>
                        <select class="form-control selectpicker countrypicker" data-live-search="true" data-flag="true" id="pais" name="pais" required></select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="provincia">Provincia: </label>
                        <input class="form-control" type="text" id="provincia" name="provincia" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="ciudad">Ciudad: </label>
                        <input class="form-control" type="text" id="ciudad" name="ciudad" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="cp">Código Postal: </label>
                        <input class="form-control" type="number" id="cp" name="cp" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="calle">Calle: </label>
                        <input class="form-control" type="text" id="calle" name="calle" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="calledos">Calle Secundaria: </label>
                        <input class="form-control" type="text" id="calledos" name="calledos"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="referencia">Referencia: </label>
                        <textarea class="form-control" id="referencia" name="referencia"></textarea>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <h3>Tu orden</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>


                        <?php
if($itemsTotales!=0) {
    $subtotal = 0;
    foreach ($prodsInCart["records"] as $product){ 
        $subtotal = $subtotal + ($product["product"]["price"]*$product["cantidad"]);
?>
                            <tr>
                                <td><?php echo $product["product"]["name"]; ?> <span class="product_quantity">x <?php echo $product["cantidad"]; ?></span></td>
                                <td><?php echo ($product["product"]["price"]*$product["cantidad"]); ?></td>
                            </tr>
<?php } 
        if(isset($iva)) {
            if(isset($descuento)) {
                $total = ($subtotal-$descuento)+(($subtotal-$descuento)*($iva)/100);
            } else {
                $total = $subtotal + ($subtotal*($iva)/100);
            }
        } else {
            if(isset($descuento)) {
                $total = $subtotal - $descuento;
            } else {
                $total = $subtotal;
            }
        }
    ?>
                            <tr>
                                <th>Subtotal: </th>
                                <td><?php echo $subtotal; ?></td>
                            </tr>

    <?php   if($subtotal!=0 && isset($descuento)) { ?>
                            <tr>
                                <th>Descuento: </th>
                                <td><?php echo $descuento; ?></td>
                            </tr>
            <?php } ?>

    <?php   if($subtotal!=0 && isset($iva)) { ?>
                            <tr>
                                <th>Iva <?php echo $iva."%: "; ?></th>
                    <?php if(isset($descuento)) { ?>
                                <td><?php echo round((($subtotal-$descuento)*($iva/100)), 2); ?></td>
                    <?php } else { ?>
                                <td><?php echo round(($subtotal*($iva/100)), 2); ?></td>
                    <?php } ?>
                            </tr>
    <?php } ?>
                            <tr>
                                <th>Total: </th>
                                <td><?php echo round($total, 2); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
<?php } ?>

                <div class="row">
                    <div class="col">
                        <h5>Método de pago</h5>
<?php $metodos = json_decode( file_get_contents($env.'api/metodo/read.php'), true );
$ft = true;
foreach ($metodos["records"] as $metodo) { ?>
                        <div class="form-check radio">
                            <input class="form-check-input " type="radio" name="gridRadios" id="gridRadios<?php echo $metodo["id"] ?>" value="<?php echo $metodo["id"] ?>" <?php if($ft) {echo "checked"; $ft=false; } ?>>
                            <label class="form-check-label" for="gridRadios<?php echo $metodo["id"] ?>">
                                <?php echo $metodo["name"] ?>
                            </label>
                        </div>
<?php } ?>
                    </div>
                </div>

                <br/>

                <div class="row">
                    <div class="col">
                        Sus datos personales se utilizarán para procesar su pedido, respaldar su experiencia en este sitio web y para otros fines descritos en nuestra <a class="aN" href="politica.php">política de privacidad.</a>
                    </div>
                </div>

                <br/>

                <div class="row">
                    <div class="col">
                        <label class="form-check-label">
                            <input type="checkbox" name="terminos" id="terminos" class="form-check-input mr-2" required>
                            He leído y acepto los <a class="aN" style="display: inline;" href="terminos.php">términos y condiciones de uso</a>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <br/><br/>

        <div class="row">
            <div class="col-12">
                <input type="submit" class="btn btn-dark btn-block " value="Realizar pedido" name="order">
            </div>
        </div>
        <input type="hidden" value="<?php echo round($total, 2); ?>" name="total" id="total">
        <input type="hidden" value="<?php if(isset($descuento)){echo round($descuento, 2); } ?>" name="descuento" id="descuento">
        <input type="hidden" value="<?php if(isset($iva)){
            if(isset($descuento)) {
                echo round((($subtotal-$descuento)*($iva/100)), 2);
            } else {
                echo round(($subtotal*($iva/100)), 2);
            }
            } 
        ?>" name="iva" id="iva">
        <input type="hidden" value="" name="cupon" id="cupon">
        </form>
    </main>

    <br/><br/><br/>

    <?php include('footer.php'); ?>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap-select-country.min.js"></script>
</body>

</html>

<?php
}
?>