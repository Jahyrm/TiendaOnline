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
?>


<!DOCTYPE html>
<html lang="es">
    <head>
<?php include('head.php') ?>
    </head>
    <body>


    <?php include('header.php'); ?>

    <main class="container">
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
                                <h3>Title</h3>
                                <p>Description</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/producto1.jpg" class="d-block w-100" alt="">
                            <div class="carousel-caption d-none d-md-block">
                                <h3>Title</h3>
                                <p>Description</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/producto2.jpg" class="d-block w-100" alt="">
                            <div class="carousel-caption d-none d-md-block">
                                <h3>Title</h3>
                                <p>Description</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/promo.jpg" class="d-block w-100" alt="">
                            <div class="carousel-caption d-none d-md-block">
                                <h3>Title</h3>
                                <p>Description</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
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
        <?php foreach ($products["records"] as $product){ ?>
            <div class="col-12 col-sm-6 col-lg-3 mb-4">
                <div class="card mx-auto">
                    <img class="card-img-top" src=<?php echo $product['image'];?> alt="" style="height: 250px;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name'];?></h5>
                        <h5 class="card-title">Precio $<?php echo $product['price'];?></h5>
                        <p class="card-text"><?php echo $product['description'];?></p>
                        <button class="btn btn-dark mb-1" style="width: 100%;">Agregar al carrito</button>
                        <a href="producto/index.php?id=<?php echo $product['id']; ?>"><button class="btn btn-dark" style="width: 100%;" data-toggle="modal" data-target="#producto<?php echo $product['id'];?>">Detalles del producto</button></a>
                        <div class="modal fade" id="producto<?php echo $product['id'];?>" tabindex="-1" role="dialog" aria-labelledby="producto<?php echo $product['id'];?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detalles del producto</h5>
                                        <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="display: flex; flex-direction: column; align-items: center;">
                                        <div class="mb-2">
                                            <h3><?php echo $product['name'];?></h3>
                                        </div>
                                        <div class="mb-2">
                                            <img style="width: 200px;" src=<?php echo $product['image'];?> alt="">
                                        </div>
                                        <div>
                                            <p><?php echo $product['description'];?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
        

    </main>

    <?php include('footer.php');?>
</body>

</html>