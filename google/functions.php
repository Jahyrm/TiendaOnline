<?php

function checkuser($fuid,$fimage,$ffname,$flast_name,$femail){
	
    require("../datos/conexion.php");
	
    $comprobacion = mysqli_query($coneccion, "SELECT * FROM users WHERE email='$femail' OR google_uuid='$fuid'");
	$check = mysqli_num_rows($comprobacion);
	
	if (empty($check)) { // if new user . Insert a new record
		
		$query = "INSERT INTO users (name,apellido,email,image,google_uuid) VALUES ('$ffname','$flast_name','$femail','$fimage','$fuid')";
		mysqli_query($coneccion, $query);
		
	} else {   // If Returned user . update the user record
		
		$row = mysqli_fetch_array($comprobacion);
		
		if (isset($row['image'])) {
			$query = "UPDATE users SET google_uuid='$fuid', name='$ffname', apellido='$flast_name', email='$femail' where google_uuid='$fuid' OR email='$femail'";
		} else {
			$query = "UPDATE users SET google_uuid='$fuid', image='$fimage', name='$ffname', apellido='$flast_name', email='$femail' where google_uuid='$fuid' OR email='$femail'";
		}
		mysqli_query($coneccion, $query);
		
	}
	
	$nuevaQuery = mysqli_query($coneccion, "SELECT id from users WHERE google_uuid='$fuid'");
	$row = mysqli_fetch_array($nuevaQuery);
	$_SESSION['UID'] = $row['id'];
	mysqli_close($coneccion);
}
?>