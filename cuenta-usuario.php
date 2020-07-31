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

$titulo = "Mi Cuenta | Zibá ¡es como tú";

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

        <!-- <div class="row d-flex justify-content-around mt-3">
            <img src="img/promociones.jpg" class="d-block w-100" alt="dcfvbn">
        </div>-->

        <div class="col-12 align-items-center justify-content-center pb-3">
                <h2 style="display: block;text-align: center;">Mi Cuenta</h2>
                <hr/>
        </div>

        <div class="col-12 pb-3">
            <div style="display: flex;flex-direction: column; margin: auto auto;">
                <h2 style="display: block;">Bienvenido, <?php echo $_SESSION["Nombre"]." ".$_SESSION["Apellido"]; ?></h2>
            </div>
        </div>

        <div class="row d-flex justify-content-around mt-3">


<?php include("panel/user.php"); ?>


<?php
if($_SESSION["Tipo"]==1) {
?>
        <div class="col-12 align-items-center justify-content-center pb-3">
                <br/><br/>
                <h2 style="display: block;text-align: center;">Panel de administración</h2>
                <hr/>
        </div>
<?php
include("panel/product.php");

include("panel/marca.php");

include("panel/categoria.php");

include("panel/subcategoria.php");

}
?>

            <br/><br/>
        </div>
    </main>

    <?php include('footer.php'); ?>

    <script type="application/javascript">
        $('#image').change(function(e){
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });

        $('#imagep').change(function(e){
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });
    </script>
    <script src="logic/ajax.js"></script>
</body>

</html>
<?php
}
?>