<?php 
session_start();

if(isset($_COOKIE['logincookie'])) {
	if (!isset($_SESSION['Recuperado'])) {
		include 'logic/funciones.php';
		$id = dec_enc('decrypt', $_COOKIE['logincookie']);
		recuperarUser($id);
	}
}

$titulo = "Acerca de Nosotros | Zibá ¡es como tú";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include('head.php') ?>
</head>

<body>
    
<?php include('header.php'); ?>
    <main class="container">
        <div class="row mt-5" style="height: 200px;">
            <div class="col-12">
                <h1 class="text-center"><strong>¿Quiénes somos?</strong></h1>
                <hr style="background-color: #fff;
                border-top: 2px dotted #c20114;">
            </div>
            <div class="col-12" style="text-align: center;">
                <p>Somos una empresa orgullosamente ecuatoriana dedicada a la comercialización e importación de los
                    mejores productos de belleza. Contamos con una amplia gama de productos capilares, de uñas,
                    maquillaje y accesorios a los mejores precios.</p>
            </div>
        </div><br>

        <div class="row" style="height: 200px;">
            <div class="col-12">
                <h1 class="text-center"><strong>Misión</strong></h1>
                <hr style="background-color: #fff;
                border-top: 2px dotted #c20114;">
            </div>
            <div class="col-12" style="text-align: center;">
                <p>Buscar y seleccionar los mejores productos para ofrecerlos a nuestros clientes, brindar un precio
                    accesible para que toda persona pueda adquirirlos y sobretodo contar con personas que asesoren para
                    que cada cliente cuando salga de la tienda se sienta emocionado, libre y bello.</p>
            </div>
        </div><br>

        <div class="row mb-5" style="height: 190px;">
            <div class="col-12">
                <h1 class="text-center"><strong>Visión</strong></h1>
                <hr style="background-color: #fff;
                border-top: 2px dotted #c20114;">
            </div>
            <div class="col-12" style="text-align: center;">
                <p>Ser líder a nivel Nacional de tiendas Beauty mediante la comercialización y distribución de productos
                    cosméticos, maquillaje, cuidado capilar, cuiado facial y corporal.</p>
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