<?php
session_start();
if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $username = $_POST['usuario'];
	$correo = $_POST['correo'];
	$contrasena = $_POST['contrasena'];

	include("../datos/conexion.php");

	if (!$coneccion) {

		header("Location: ../registro.php?mensaje=1"); //Error en el sistema, intente más tarde.

	} else {

		$comprobacion = mysqli_query($coneccion, "select * from users where email='$correo'");
		$comprobacion = mysqli_num_rows($comprobacion);

		if (!empty($comprobacion)) {

			$check = mysqli_query($coneccion, "select fb_uuid, google_uuid from users where email='$correo'");
			$row = mysqli_fetch_array($check);
			if (isset($row['fb_uuid']) || isset($row['google_uuid'])) {
				header("Location: ../registro.php?mensaje=2");
			} else {
				header("Location: ../registro.php?mensaje=3");
			}

		} else {

            include 'funciones.php';
		
		    $encrypted = dec_enc('encrypt', $contrasena);

			$query = "INSERT INTO users (name,apellido,username,email,password) VALUES ('$nombre','$apellido','$username','$correo','$encrypted')";
            mysqli_query($coneccion, $query);
            
            // Prueba
            $comp = mysqli_query($coneccion, "select * from users where email='$correo'");
            $rows = mysqli_fetch_array($comp);

            echo $rows['id'];

            $desencrypted = dec_enc('decrypt', $rows['password']);
				
				if ($desencrypted===$contrasena) {
					$_SESSION['UID'] = $rows['id'];
					$_SESSION[ 'Nombre' ] = $rows['name'];
					$_SESSION[ 'Apellido' ] = $rows['apellido'];
					$_SESSION['Username'] = $rows['username'];
					$_SESSION[ 'Correo' ] = $rows['email'];
					$_SESSION[ 'Imagen' ] = $rows['image'];
					$_SESSION[ 'FUID' ] = $rows['fb_uuid'];
					$_SESSION[ 'Google' ] = $rows['google_uuid'];
					$_SESSION[ 'Recuperado' ] = true;
					/*
					if (isset($recordarme)) {
						$encrypted = dec_enc('encrypt', $_SESSION['UID']);
						setcookie('logincookie', $encrypted, time() + (86400 * 365), '/');
					}
					*/
					header('Location: ../index.php');
                    return;
                }
            
			//header("Location: ../registro.php?mensaje=4");

		}

	}
    mysqli_close($coneccion);
    



} else {
	header("Location: ../registro.php");
}
?>