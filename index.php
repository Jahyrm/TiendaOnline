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

$titulo = "Zibá ¡es como tú!";
include('mensajes.php');
?>


<!DOCTYPE html>
<html lang="es">
    <head>
<?php include('head.php') ?>
    </head>
    <body>


    <?php 
    $activado = 1;
    include('header.php'); ?>

    <main class="container">

    
        <div class="row">
            <div class="col">
<?php if (isset($mensaje)) { ?>

				<div id="mensaje" style="display: inline-block; width: 100%; background-color:<?php if ($_GET['m']==0 || $_GET['m']==2 || $_GET['m']==5) { echo ' skyblue'; } else { echo ' darkred'; } ?>; color: white;">
					<br>
					<center><h6 id="mensajeString"><?php echo $mensaje; ?></h6></center>
					<br>
				</div>
<?php } else { ?>
				<div id="mensaje" style="display: none; width: 100%; background-color: darkgreen; color: white;">
						<br>
					    <center><h6 id="mensajeString"></h6></center>
						<br>
                </div>
<?php } ?>
            </div>
        </div>


        <div class="row d-flex justify-content-around mt-3" id="promociones">
            <div class="col">
                <div id="carouselId" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselId" data-slide-to="1"></li>
                        <li data-target="#carouselId" data-slide-to="2"></li>
                        <li data-target="#carouselId" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/local.jpg" class="d-block w-100" alt="">
                            <div class="carousel-caption d-none d-md-block">
                                <h3>Calidad Premium</h3>
                                <p>En Cosméticos y Joyería</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/producto1.jpg" class="d-block w-100" alt="">
                            <div class="carousel-caption d-none d-md-block">
                                <h3>Ofertas</h3>
                                <p>Los mejores precios y descuentos.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/producto2.jpg" class="d-block w-100" alt="">
                            <div class="carousel-caption d-none d-md-block">
                                <h3>Marcas</h3>
                                <p>Encuentra siempre las mejores marcas en Ziba</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/promo.jpg" class="d-block w-100" alt="">
                            <div class="carousel-caption d-none d-md-block">
                                <h3>Envíos</h3>
                                <p>Contamos con envíos y devoluciones a todo el país.</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Siguiente</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="py-4 border-bottom">
                    <h1 class="text-center">ZIBÁ te ofrece productos de calidad</h1>
                </div>
            </div>
        </div>

        <div class="row py-4">
        <?php $products = json_decode( file_get_contents($env.'api/product/read.php'), true );?>
        <?php for ($x=0; $x<12; $x++){ 
            $product = $products["records"][$x];
        ?>
            <div class="col-3 mb-4">
                <div class="card mx-auto">
                    <img class="card-img-top" src="<?php echo $product['image'];?>" alt="" style="height: 250px;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name'];?></h5>
                        <h5 class="card-title">Precio $<?php echo $product['price'];?></h5>
                        <p class="card-text"><?php echo $product['description'];?></p>
                        <a href="logic/cart/add.php?id=<?php echo $product['id']; ?>"><button class="btn btn-dark mb-1" style="width: 100%;">Agregar al carrito</button></a>
                        <a href="producto/?id=<?php echo $product['id']; ?>"><button class="btn btn-dark" style="width: 100%;">Detalles del producto</button></a>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>

    </main>

    <?php include('footer.php');?>

    <?php if(isset($mensaje)) { ?>
		<script language="javascript" type="text/javascript">
			window.onload = function() {
				$('#mensaje').delay(4000).fadeOut('slow')
			}
		</script>
<?php } ?>
</body>

</html>