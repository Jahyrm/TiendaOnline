<?php

function checkuser($update,$fuid,$fimage,$ffname,$flast_name,$femail){
	include "../globalVars.php";
	$result = file_get_contents($env."api/user/readBySocial.php?correo=$femail&red=fb&uuid=$fuid");
	$response = json_decode( $result );
	
	if( $http_response_header[0]=="HTTP/1.1 404 Not Found" ){
       // Create JSON
		$data = array(
			'nombre' => $ffname,
			'apellido' => $flast_name,
			'correo' => $femail,
			'image' => $fimage,
			'fb_uuid' => $fuid
		);

		// Send User JSON object
		$options = array(
			'http' => array(
			'method'  => 'POST',
			'content' => json_encode( $data ),
			'header'=>  "Content-Type: application/json\r\n" .
						"Accept: application/json\r\n"
			)
		);
		$context  = stream_context_create( $options );
		$result0 = file_get_contents($env."api/user/createBySocial.php", false, $context);
		$response0 = json_decode( $result0 );

    } else {
		if($update) {
			if ($response->image!=null) {
				// Create JSON
				$data0 = array(
					'correo' => $femail,
					'fb_uuid' => $fuid
				);
			} else {
				$data0 = array(
					'correo' => $femail,
					'image' => $fimage,
					'fb_uuid' => $fuid
				);
			}

			// Send User JSON object
			$options0 = array(
				'http' => array(
				'method'  => 'POST',
				'content' => json_encode( $data0 ),
				'header'=>  "Content-Type: application/json\r\n" .
							"Accept: application/json\r\n"
				)
			);
			$context0  = stream_context_create( $options0 );
			$result1 = file_get_contents($env."api/user/updateBySocial.php", false, $context0);
			$response1 = json_decode( $result1 );
		}
	}

	$result2 = file_get_contents($env."api/user/readByUid.php?red=fb&uuid=$fuid");
	$response2 = json_decode( $result2 );

	if( $http_response_header[0]!="HTTP/1.1 404 Not Found" ){
        		$_SESSION['UID'] = $response2->id;
                $_SESSION['Tipo'] = $response2->user_type;
                $_SESSION[ 'Nombre' ] = $response2->name;
                $_SESSION[ 'Apellido' ] = $response2->apellido;
                $_SESSION['Username'] = $response2->username;
                $_SESSION['Telefono'] = $response2->telefono;
                $_SESSION['FechaNac'] = $response2->fecha_nac;
                $_SESSION[ 'Correo' ] = $response2->email;
                $_SESSION[ 'Imagen' ] = $response2->image;
                $_SESSION[ 'FUID' ] = $response2->fb_uuid;
                $_SESSION[ 'Google' ] = $response2->google_uuid;
    }
}
?>