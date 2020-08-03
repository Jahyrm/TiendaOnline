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
    include 'mensajes2.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
<?php include('head.php') ?>
</head>

<body class>
    
    <?php 
    $activado = 0;
    include('header.php'); ?>


    <main class="container">


        <div class="row" >
            <div class="col" id="mensaje">
<?php if (isset($mensaje)) { ?>
				<div  style="display: inline-block; width: 100%; background-color:<?php if ($colorError) { echo ' darkred'; } else { echo ' skyblue'; } ?>; color: white;">
					<br>
					<center><h6 id="mensajeString"><?php echo $mensaje; ?></h6></center>
					<br>
				</div>
<?php } else { ?>
				<div style="display: none; width: 100%; background-color: darkgreen; color: white;">
						<br>
					    <center><h6 id="mensajeString"></h6></center>
						<br>
                </div>
<?php } ?>
                <br/><br/>
            </div>
        </div>


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

<?php if(isset($mensaje)) { ?>
		<script language="javascript" type="text/javascript">
			window.onload = function() {
				$('#mensaje').delay(4000).fadeOut('slow')
			}
		</script>
<?php } ?>

    <script type="application/javascript">
        $('#image').change(function(e){
            var fileName = e.target.files[0].name;
            $('#img0').html(fileName);
        });

        $('#imagep').change(function(e){
            var fileName = e.target.files[0].name;
            $('#img1').html(fileName);
        });

        $('#eimagep').change(function(e){
            var fileName = e.target.files[0].name;
            $('#img2').html(fileName);
        });
    </script>
    <script src="logic/ajax.js"></script>
</body>

</html>
<?php
}
?>