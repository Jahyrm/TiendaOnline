<?php 
session_start();
include "../globalVars.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $orden = json_decode( file_get_contents($env.'api/orden/read.php?by=orden&id='.$id), true );
    
    if(!empty($orden["records"])) {
    // if datos.
        if(isset($_COOKIE['logincookie'])) {
            if (!isset($_SESSION['Recuperado'])) {
                include 'logic/funciones.php';
                $id = dec_enc('decrypt', $_COOKIE['logincookie']);
                recuperarUser($id);
            }
        }

        $titulo = "Factura #".$orden["records"][0]["id"]." | Zibá ¡es como tú!";
        $prof = "../";
?>
<!DOCTYPE html>
<html lang="es">
    <head>
<?php include('../head.php') ?>
    </head>
    <body>
<?php include('../header.php'); ?>

<main class="container">
    <div class="row">
        <div class="col-6 offset-3 main">
            <div class="col-12">
               <div class="row">
                    <div class="col-md-4">
                        <img class="img-fluid" alt="Invoce Template" src="../Logo.jpeg" />
                    </div>
                    <div class="col-md-8 text-right">
                        <h4 style="text-align: right; color: #F81D2D;"><strong><?php echo $nombreEmpresa; ?></strong></h4>
                        <p><?php echo $direccionEmpresa; ?></p>
                        <p><?php echo $telefonoEmpresa; ?></p>
                        <p><?php echo $correoEmpresa; ?></p>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Factura</h2>
                        <h5>00000<?php echo $orden["records"][0]["id"]; ?></h5>
                    </div>
                </div>
                <br />
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th><h5>Descripción</h5></th>
                                <th><h5>Precio</h5></th>
                                <th><h5>Cantidad</h5></th>
                                <th><h5>Subtotal</h5></th>
                            </tr>
                        </thead>
                        <tbody>

<?php 
$subtotal = 0;
foreach ($orden["records"][0]["productos"] as $producto) { 
$subtotal = $subtotal + $producto["price"]; ?>
                            <tr>
                                <td class="col-md-9"><?php echo $producto["name"]; ?></td>
                                <td class="col-md-3"><i class="fa fa-usd" aria-hidden="true"></i> <?php echo $producto["price"]; ?> </td>
                                <td class="col-md-9"><?php echo $producto["cant"]; ?></td>
                                <td class="col-md-3"><i class="fa fa-usd" aria-hidden="true"></i> <?php echo $producto["price"]*$producto["cant"]; ?> </td>
                            </tr>
<?php } ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-right">
                                <p>
                                    <strong>Subtotal: </strong>
                                </p>

<?php   if(!empty($orden["records"][0]["descuento"])) { ?>
                                <p>
                                    <strong>Descuento: </strong>
                                </p>
        <?php } ?>
<?php   if(!empty($orden["records"][0]["iva"])) { ?>
							    <p>
                                    <strong>Iva: </strong>
                                </p>
<?php } ?>
							    </td>
                                <td>
                                <p>
                                    <strong><i class="fa fa-usd" aria-hidden="true"></i> <?php echo $subtotal; ?> </strong>
                                </p>


<?php   if(!empty($orden["records"][0]["descuento"])) { ?>
                                <p>
                                    <strong><i class="fa fa-usd" aria-hidden="true"></i> <?php echo $orden["records"][0]["descuento"]; ?></strong>
                                </p>
        <?php } ?>

<?php   if(!empty($orden["records"][0]["iva"])) { ?>
							    <p>
                                    <strong><i class="fa fa-usd" aria-hidden="true"></i> <?php echo $orden["records"][0]["iva"]; ?> </strong>
                                </p>

<?php } ?>
							    </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-right"><h4 style="color: #F81D2D;"><strong>Total:</strong></h4></td>
                                <td class="text-left"><h4 style="color: #F81D2D;"><strong><i class="fa fa-usd" aria-hidden="true"></i> <?php echo $orden["records"][0]["total"]; ?> </strong></h4></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div class="col-md-12">
                        <p><b>Fecha :</b> 28 June 2017</p>
                        <br />
                        <p><strong><i class="fa fa-barcode fa-5x" aria-hidden="true"></i></strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('../footer.php');?>
    </body>
</html>
<?php
    } else {
        header("Location: ../index.php");
    }
} else {
	header("Location: ../index.php");
}
?>