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

$titulo = "Mi Cuenta | Zibá ¡es como tú!";

if (!isset($_SESSION['UID'])) {

require_once 'fb/config.php';
require_once 'google/config.php';
?>


<!DOCTYPE html>
<html lang="es">
    <head>
<?php include('head.php') ?>
    <style>
        .error{
            display: none;
        }
    </style>
    </head>

<body>
    <?php if (isset($_GET['mensaje'])) {
        switch($_GET['mensaje']) {
            case 1:
                $mensaje = "Error en el sistema, intente más tarde.";
                break;
            case 2:
                $mensaje = "No existe una cuenta con ese correo.";
                break;
            case 3:
                $mensaje = "El correo está vinculado a una red social. Intenta iniciar sesión con Facebook/Google.";
                break;
            case 4:
                $mensaje = "La contraseña es incorrecta.";
                break;
        }
    }
    ?>
    <?php include('header.php'); ?>
    <main class="container">
        <div class="row mt-4 mb-4 align-items-center" style="height: 658px;">
<?php if (isset($mensaje)) { ?>
							<div id="mensaje" style="display: inline-block; width: 100%; background-color:<?php if ($_GET['mensaje']==3) { echo ' skyblue'; } else { echo ' darkred'; } ?>; color: white;">
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
            <div class="col-12 col-lg-6 align-items-center justify-content-center pb-3">
                <div style="display: flex;flex-direction: column; margin: auto auto;">
                    <h2 style="display: block;text-align: center;">Iniciar sesión</h2>
                    <p style="display: block;text-align: center;">Bienvenido de regreso</p>
                    <form action="logic/ingreso.php" id="formSesion" name="formSesion" method="POST">
                        <div class="form-group row px-4 ">
                            <div class="col-12 mb-3">
                                <label for="correo">Correo</label>
                                <input type="email" class="form-control" placeholder="Ingresa tu correo" name="correo"
                                    id="correo">
                            </div>
                            <div class="col-12">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" placeholder="Ingresa tu password"
                                    name="password" id="password">
                            </div>
                            <div class="col-12">
                                <label for="recordarme">Recordarme: </label>
                                <input style="display: inline-block; height: auto; width: auto;" type="checkbox" class="form-control" placeholder="Recordarme"
                                    name="recordarme" id="recordarme">
                            </div>
                            <div class="col-12">
                                <ul class="error" id="error">
                                </ul>
                            </div>
                            <div class="col-12 mt-3">
                                <input type="submit" class="btn btn-dark btn-block " value="Ingresar">
                            </div>
                        </div>
                       

                    </form>
                    <p style="display: block;text-align: center;">O</p>
                    <div>
                        <p style="display: inline;">Iniciar sesión con</p>
                        <div style="display: inline;">
                        <?php 
                        if(isset($facebook_login_url)){
                            echo $facebook_login_url;
                        } 
                        if(isset($login_button)){
                            echo $login_button;
                        }
                        ?>
                            <!-- <button class="btn btn-primary"><i class="fab fa-facebook"></i> Facebook</button>
                            <button class="btn btn-primary"><i class="fab fa-google-plus"></i> Google</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 align-items-center justify-content-center">
                <div style="display: flex;flex-direction: column; justify-content: center; margin: 30px;">
                    <h2 style="display: block;text-align: center;">¿No estás registrado?</h2>
                    <p style="display: block;text-align: center;">Con tu cuenta podrás realizar compras en línea,
                        obtener descuentos y una gran variadad de promociones.
                        Tendrás acceso a todos los servicios que ZIBÁ tiene para tí.</p>
                    <form action="">
                        <div class="col-12 mt-3 " style="display: block;text-align: center;">
                            <a href="registro.php" class="btn btn-dark w-100">Registrarse </a>
                        </div>
                    </form>
                </div>
            </div>
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

<?php
} else {
    header("Location: index.php");
}
?>