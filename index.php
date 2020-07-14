<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Zibá ¡es como tú!</title>
</head>


<body class>
    <?php include('header1.php'); ?>
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
        <?php $lista = json_decode( file_get_contents('http://localhost:5000/api/products/productos'), true );?>
        <?php foreach ($lista as $product){ ?>
            <div class="col-12 col-sm-6 col-lg-3 mb-4">
                <div class="card mx-auto">
                    <img class="card-img-top" src=<?php echo $product['imagen'];?> alt="" style="height: 250px;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['nombre'];?></h5>
                        <h5 class="card-title">Precio $<?php echo $product['precio'];?></h5>
                        <p class="card-text"><?php echo $product['descripcion'];?></p>
                        <button class="btn btn-dark mb-1" style="width: 100%;">Agregar al carrito</button>
                        <button class="btn btn-dark" style="width: 100%;" data-toggle="modal" data-target="#producto<?php echo $product['id_producto'];?>">Detalles del producto</button>
                        <div class="modal fade" id="producto<?php echo $product['id_producto'];?>" tabindex="-1" role="dialog" aria-labelledby="producto<?php echo $product['id_producto'];?>" aria-hidden="true">
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
                                            <h3><?php echo $product['nombre'];?></h3>
                                        </div>
                                        <div class="mb-2">
                                            <img style="width: 200px;" src=<?php echo $product['imagen'];?> alt="">
                                        </div>
                                        <div>
                                            <p><?php echo $product['descripcion'];?>
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
   

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/5b9c980490.js" crossorigin="anonymous"></script>
</body>

</html>