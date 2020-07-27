<?php
session_start();
if (isset($_POST['correo'])) {
	$correo = $_POST['correo'];
	$contrasena = $_POST['password'];
	//$recordarme = $_POST['recordarme'];

	include("../datos/conexion.php");

	if (!$coneccion) {
		header("Location: ../miCuenta.php?mensaje=1");
	} else {
		$comprobacion = mysqli_query($coneccion, "select * from users where email='$correo'");
		$comprobacionDos = mysqli_num_rows($comprobacion);

		if (empty($comprobacionDos)) {

			header("Location: ../miCuenta.php?mensaje=2");

		} else {

			$row = mysqli_fetch_array($comprobacion);
			if ($row['password']==NULL && ($row['fb_uuid']!=NULL || $row['google_uuid']!=NULL) ) {
				header("Location: ../miCuenta.php?mensaje=3"); //correo vinculado a red social
			} else {
				include 'funciones.php';
				$desencrypted = dec_enc('decrypt', $row['password']);
				
				if ($desencrypted===$contrasena) {
					$_SESSION['UID'] = $row['id'];
					$_SESSION[ 'Nombre' ] = $row['name'];
					$_SESSION[ 'Apellido' ] = $row['apellido'];
					$_SESSION['Username'] = $row['username'];
					$_SESSION[ 'Correo' ] = $row['email'];
					$_SESSION[ 'Imagen' ] = $row['image'];
					$_SESSION[ 'FUID' ] = $row['fb_uuid'];
					$_SESSION[ 'Google' ] = $row['google_uuid'];
					$_SESSION[ 'Recuperado' ] = true;
					/*
					if (isset($recordarme)) {
						$encrypted = dec_enc('encrypt', $_SESSION['UID']);
						setcookie('logincookie', $encrypted, time() + (86400 * 365), '/');
					}
					*/
					header('Location: ../index.php');
					return;
				} else {
					header("Location: ../miCuenta.php?mensaje=4");
				}
			}

		}

	}
	mysqli_close($coneccion);
} else {
	header("Location: ../miCuenta.php");
}
?>