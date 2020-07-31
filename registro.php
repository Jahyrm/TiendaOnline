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

$titulo = "Registrarse | Zibá ¡es como tú!";

if (!isset($_SESSION['UID'])) {

require_once 'fb/config.php';
require_once 'google/config.php';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
<?php include('head.php') ?>
    </head>
    <body>

<?php if (isset($_GET['mensaje'])) {
	switch($_GET['mensaje']) {
		case 1:
			$mensaje = "Error en el sistema, intente más tarde.";
			break;
		case 2:
			$mensaje = "Ya exite una cuenta asociada a ese correo. Intenta iniciar sesión con facebook/google.";
			break;
		case 3:
			$mensaje = "Error: Ya existe una cuenta con ese correo.";
			break;
		case 4:
			$mensaje = "Registrado correctamente.";
			break;
	}
}
?>


<body>
    <?php include('header.php'); ?>
    <main class="container">
        <div class="row mt-4" style="margin-bottom: 100px;">
            <div class="col-12 align-items-center justify-content-center pb-3">
                <div style="display: flex;flex-direction: column; margin: auto auto;">
                    <h2 style="display: block;text-align: center;">Se parte de nuestra familia Zibá</h2>
                    <hr>

<?php if (isset($mensaje)) { ?>
							<div id="mensaje" style="display: inline-block; width: 100%; background-color:<?php if ($_GET['mensaje']==4) { echo ' darkgreen'; } else if ($_GET['mensaje']==2) { echo ' skyblue'; } else { echo ' darkred'; } ?>; color: white;">
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


                    <form action="logic/registro.php" method="POST">
                        <div class="form-group row px-4 mb-2">
                            <div class="col-12 col-md-6">
                                <label for="nombre">Nombres</label>
                                <input type="text" class="form-control" placeholder="Ingresa tus nombre" name="nombre" id="nombre" required>
                                <div class="valid-feedback">Válido</div>
                                <div class="invalid-feedback">Complete el campo</div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="apellido">Apellidos</label>
                                <input type="text" class="form-control" placeholder="Ingresa tus apellidos" name="apellido" id="apellido" required>
                                <div class="valid-feedback">Válido</div>
                                <div class="invalid-feedback">Complete el campo</div>
                            </div>

                        </div>
                        <div class="form-group row px-4 mb-2">
                            <div class="col-12 col-md-6">
                                <label for="numeroD">Usuario</label>
                                <input type="text" class="form-control" placeholder="Ingresa un nombre de usuario" name="usuario" id="usuario" required>
                                <div class="valid-feedback">Válido</div>
                                <div class="invalid-feedback">Complete el campo</div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="email">Correo electrónico</label>
                                <input type="email" class="form-control" placeholder="Ingresa tu correo electrónico" name="correo" id="correo" required>
                                <div class="valid-feedback">Válido</div>
                                <div class="invalid-feedback">Complete el campo</div>
                            </div>
                        </div>
                        <div class="form-group row px-4 mb-2">
                            <div class="col-12 col-md-6 mb-3">
                                <label for="contraseña">Contraseña</label>
                                <input type="password" class="form-control" placeholder="Ingresa tu contraseña" name="contrasena" id="contrasena" required>
                                <div class="valid-feedback">Válido</div>
                                <div class="invalid-feedback">Complete el campo</div>
                            </div>
                        </div>
                        <div class="form-group row px-4 mb-2">
                            <div class="col">
                                <label class="form-check-label">
                                    <input type="checkbox" name="terminos" id="terminos" class="form-check-input mr-2" required>
                                    He leído y acepto los términos y condiciones de uso
                                </label>
                                <div class="valid-feedback">Válido</div>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <input type="submit" class="btn btn-dark btn-block " value="Registrarse" name="registrarse">
                        </div>
                    </form>
                    <p style="display: block;text-align: center;">O</p>
                    <div>
                        <p style="display: inline;">Registrarse con </p>
                        <div style="display: inline;">
                        <?php 
                        if(isset($facebook_login_url)){
                            echo $facebook_login_url;
                        } 
                        if(isset($login_button)){
                            echo $login_button;
                        }
                        ?>
                            <!--<button class="btn btn-primary"><i class="fab fa-facebook"></i> Facebook</button>-->
                            <!-- <button class="btn btn-primary"><i class="fab fa-google-plus"></i> Google</button> -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal 
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Usuario registrado
                </div>
            </div>
        </div>
    </div> -->
    <?php include('footer.php'); ?>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

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