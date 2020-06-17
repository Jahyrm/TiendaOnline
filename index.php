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
                    <h1 class="text-center">Productos en stock</h1>
                </div>
            </div>
        </div>

        <div class="row py-4">

            <div class="col-12 col-sm-6 col-lg-3 mb-4" id="productoPromo">
                <div class="card">
                    <img class="card-img-top" src="img/1.jpg" alt="" style="height: 250px;">
                    <div class="card-body">
                        <h3 class="card-title">Producto</h3>
                        <p class="card-text">Descripción del producto</p>
                        <a href="" class="btn btn-sm btn-primary">Comprar</a>
                        <button class="btn btn-dark" data-toggle="modal" data-target="#producto1">Detalles</button>
                        <div class="modal fade" id="producto1" tabindex="-1" role="dialog" aria-labelledby="producto1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detalles del producto</h4>
                                        <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="display: flex; flex-direction: column; align-items: center;">
                                        <div class="mb-2">
                                            <h3>Producto 1</h3>
                                        </div>
                                        <div class="mb-2">
                                            <img style="width: 200px;" src="img/1.jpg" alt="">
                                        </div>
                                        <div>
                                            <p>Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3 mb-4">
                <div class="card">
                    <img class="card-img-top" src="img/2.jpg" alt="" style="height: 250px;">
                    <div class="card-body">
                        <h3 class="card-title">Producto</h3>
                        <p class="card-text">Descripción del producto</p>
                        <a href="" class="btn btn-sm btn-primary">Comprar</a>
                        <button class="btn btn-dark" data-toggle="modal" data-target="#producto2">Detalles</button>
                        <div class="modal fade" id="producto2" tabindex="-1" role="dialog" aria-labelledby="producto2" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detalles del producto</h4>
                                        <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="display: flex; flex-direction: column; align-items: center;">
                                        <div class="mb-2">
                                            <h3>Producto 2</h3>
                                        </div>
                                        <div class="mb-2">
                                            <img style="width: 200px;" src="img/2.jpg" alt="">
                                        </div>
                                        <div>
                                            <p>Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3 mb-4">
                <div class="card">
                    <img class="card-img-top" src="img/3.jpg" alt="" style="height: 250px;">
                    <div class="card-body">
                        <h3 class="card-title">Producto</h3>
                        <p class="card-text">Descripción del producto</p>
                        <a href="" class="btn btn-sm btn-primary">Comprar</a>
                        <button class="btn btn-dark" data-toggle="modal" data-target="#producto3">Detalles</button>
                        <div class="modal fade" id="producto3" tabindex="-1" role="dialog" aria-labelledby="producto3" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detalles del producto</h4>
                                        <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="display: flex; flex-direction: column; align-items: center;">
                                        <div class="mb-2">
                                            <h3>Producto 3</h3>
                                        </div>
                                        <div class="mb-2">
                                            <img style="width: 200px;" src="img/3.jpg" alt="">
                                        </div>
                                        <div>
                                            <p>Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3 mb-4">
                <div class="card">
                    <img class="card-img-top" src="img/4.jpg" alt="" style="height: 250px;">
                    <div class="card-body">
                        <h3 class="card-title">Producto</h3>
                        <p class="card-text">Descripción del producto</p>
                        <a href="" class="btn btn-sm btn-primary">Comprar</a>
                        <button class="btn btn-dark" data-toggle="modal" data-target="#producto4">Detalles</button>
                        <div class="modal fade" id="producto4" tabindex="-1" role="dialog" aria-labelledby="producto4" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detalles del producto</h4>
                                        <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="display: flex; flex-direction: column; align-items: center;">
                                        <div class="mb-2">
                                            <h3>Producto 4</h3>
                                        </div>
                                        <div class="mb-2">
                                            <img style="width: 200px;" src="img/4.jpg" alt="">
                                        </div>
                                        <div>
                                            <p>Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3 mb-4">
                <div class="card">
                    <img class="card-img-top" src="img/5.jpg" alt="" style="height: 250px;">
                    <div class="card-body">
                        <h3 class="card-title">Producto</h3>
                        <p class="card-text">Descripción del producto</p>
                        <a href="" class="btn btn-sm btn-primary">Comprar</a>
                        <button class="btn btn-dark" data-toggle="modal" data-target="#producto5">Detalles</button>
                        <div class="modal fade" id="producto5" tabindex="-1" role="dialog" aria-labelledby="producto5" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detalles del producto</h4>
                                        <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="display: flex; flex-direction: column; align-items: center;">
                                        <div class="mb-2">
                                            <h3>Producto 5</h3>
                                        </div>
                                        <div class="mb-2">
                                            <img style="width: 200px;" src="img/5.jpg" alt="">
                                        </div>
                                        <div>
                                            <p>Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3 mb-4">
                <div class="card">
                    <img class="card-img-top" src="img/6.jpg" alt="" style="height: 250px;">
                    <div class="card-body">
                        <h3 class="card-title">Producto</h3>
                        <p class="card-text">Descripción del producto</p>
                        <a href="" class="btn btn-sm btn-primary">Comprar</a>
                        <button class="btn btn-dark" data-toggle="modal" data-target="#producto6">Detalles</button>
                        <div class="modal fade" id="producto6" tabindex="-1" role="dialog" aria-labelledby="producto6" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detalles del producto</h4>
                                        <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="display: flex; flex-direction: column; align-items: center;">
                                        <div class="mb-2">
                                            <h3>Producto 6</h3>
                                        </div>
                                        <div class="mb-2">
                                            <img style="width: 200px;" src="img/6.jpg" alt="">
                                        </div>
                                        <div>
                                            <p>Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3 mb-4">
                <div class="card">
                    <img class="card-img-top" src="img/7.jpg" alt="" style="height: 250px;">
                    <div class="card-body">
                        <h3 class="card-title">Producto</h3>
                        <p class="card-text">Descripción del producto</p>
                        <a href="" class="btn btn-sm btn-primary">Comprar</a>
                        <button class="btn btn-dark" data-toggle="modal" data-target="#producto7">Detalles</button>
                        <div class="modal fade" id="producto7" tabindex="-1" role="dialog" aria-labelledby="producto7" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detalles del producto</h4>
                                        <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="display: flex; flex-direction: column; align-items: center;">
                                        <div class="mb-2">
                                            <h3>Producto 7</h3>
                                        </div>
                                        <div class="mb-2">
                                            <img style="width: 200px;" src="img/7.jpg" alt="">
                                        </div>
                                        <div>
                                            <p>Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3 mb-4">
                <div class="card">
                    <img class="card-img-top" src="img/8.jpg" alt="" style="height: 250px;">
                    <div class="card-body">
                        <h3 class="card-title">Producto</h3>
                        <p class="card-text">Descripción del producto</p>
                        <a href="" class="btn btn-sm btn-primary">Comprar</a>
                        <button class="btn btn-dark" data-toggle="modal" data-target="#producto8">Detalles</button>
                        <div class="modal fade" id="producto8" tabindex="-1" role="dialog" aria-labelledby="producto8" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detalles del producto</h4>
                                        <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="display: flex; flex-direction: column; align-items: center;">
                                        <div class="mb-2">
                                            <h3>Producto 8</h3>
                                        </div>
                                        <div class="mb-2">
                                            <img style="width: 200px;" src="img/8.jpg" alt="">
                                        </div>
                                        <div>
                                            <p>Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3 mb-4">
                <div class="card">
                    <img class="card-img-top" src="img/9.jpg" alt="" style="height: 250px;">
                    <div class="card-body">
                        <h3 class="card-title">Producto</h3>
                        <p class="card-text">Descripción del producto</p>
                        <a href="" class="btn btn-sm btn-primary">Comprar</a>
                        <button class="btn btn-dark" data-toggle="modal" data-target="#producto9">Detalles</button>
                        <div class="modal fade" id="producto9" tabindex="-1" role="dialog" aria-labelledby="producto9" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detalles del producto</h4>
                                        <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="display: flex; flex-direction: column; align-items: center;">
                                        <div class="mb-2">
                                            <h3>Producto 9</h3>
                                        </div>
                                        <div class="mb-2">
                                            <img style="width: 200px;" src="img/9.jpg" alt="">
                                        </div>
                                        <div>
                                            <p>Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3 mb-4">
                <div class="card">
                    <img class="card-img-top" src="img/10.jpg" alt="" style="height: 250px;">
                    <div class="card-body">
                        <h3 class="card-title">Producto</h3>
                        <p class="card-text">Descripción del producto</p>
                        <a href="" class="btn btn-sm btn-primary">Comprar</a>
                        <button class="btn btn-dark" data-toggle="modal" data-target="#producto10">Detalles</button>
                        <div class="modal fade" id="producto10" tabindex="-1" role="dialog" aria-labelledby="producto10" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detalles del producto</h4>
                                        <button class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="display: flex; flex-direction: column; align-items: center;">
                                        <div class="mb-2">
                                            <h3>Producto 10</h3>
                                        </div>
                                        <div class="mb-2">
                                            <img style="width: 200px;" src="img/10.jpg" alt="">
                                        </div>
                                        <div>
                                            <p>Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                                Aqui va la descripcion del producto
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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