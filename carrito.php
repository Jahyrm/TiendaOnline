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

$titulo = "Carrito | Zibá ¡es como tú!";

if (!isset($_SESSION["UID"])){
    header('Location: index.php');
} else {
?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php include('head.php') ?>
</head>
<body class>
    <?php include('header.php'); ?>

    <main class="container">

        <div class="col-12 align-items-center justify-content-center">
            <br/><br/>
            <h2 style="display: block;text-align: center;">Carrito</h2>
            <br/>
        </div>

        <div class="row">
            <div class="col">
                <form action="logic/cart/update.php" method="post">
                <table class="table carrito">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col"> </th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$subtotal = 0;
$total = 0;
if($itemsTotales!=0) {
    foreach ($prodsInCart["records"] as $product){ 
        $subtotal = $subtotal + ($product["product"]["price"]*$product["cantidad"]);
?>
                        <tr>
                            <td><a href="logic/cart/delete.php?id=<?php echo $product["id_prod"] ?>" class="btn btn-dark">×</a></td>
                            <td><a class="aN" href="producto/index.php?id=<?php echo $product["id_prod"] ?>"><img src="<?php echo $product["product"]["image"]; ?>" width="50" height="52"/></a></td>
                            <td><a class="aN" href="producto/index.php?id=<?php echo $product["id_prod"] ?>"><?php echo $product["product"]["name"]; ?></a></td>
                            <td class="cart-price"><b><?php echo $product["product"]["price"]; ?></b></td>
                            <td>
                                <div class="form-group">
                                    <label class="text-height" for="cantidad">Cantidad: </label>
                                    <input class="cantidad" type="number" step="1" min="0" max="<?php echo $product["product"]["stock"]; ?>" name="cantidad-<?php echo $product["id_prod"]; ?>" value="<?php echo $product["cantidad"]; ?>" pattern="[0-9]*" placeholder="" inputmode="numeric">
                                </div>
                            </td>
                            <td class="cart-subtotal"><b><?php echo ($product["product"]["price"]*$product["cantidad"]); ?></b></td>
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
                            <td colspan="6" class="actions" style="text-align: right !important;">
                            <button type="submit" class="btn btn-dark" name="update_cart" value="Actualizar carrito">Actualizar carrito</button>
                            </td>
                        </tr>
<?php } ?>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <center><h2>Total del Carrito</h2></center>
                <table class="table table-striped" cellspacing="0">
                    <tbody>
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
            <div class="col-3"></div>
        </div>
<?php
if($itemsTotales!=0) { ?>
        <div class="col-12 align-items-center justify-content-center">
            <center><a href="checkout.php" class="btn btn-dark">Checkout</a></center>
        </div>
<?php } ?>
        <br/><br/><br/>
    </main>

    <?php include('footer.php'); ?>
</body>

</html>

<?php
}
?>