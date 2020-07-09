<?php


$data = array(
    'usernameOrEmail' => $_POST['correo'],
    'password' => $_POST['password']
);
 
$payload = json_encode($data);
 
// Prepare new cURL resource
$ch = curl_init('https://zibawebfinal.herokuapp.com/api/auth/signin');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
 
// Set HTTP Header for POST request 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($payload))
);
 
// Submit the POST request
$result = curl_exec($ch);
$lista = json_decode($result); 
$nombre = "";

foreach ($lista as $tokenI){
 $nombre = $tokenI;
 echo($tokenI."\n");

}
if(strlen($nombre) > 50){
    echo("Usuario logeado");
    
}
else{
    echo("Usuario no logeado");
}


// Close cURL session handle
curl_close($ch);
 
?>