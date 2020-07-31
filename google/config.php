<?php

//start session on web page
if(!session_id()){
    session_start();
}

if (isset($_SESSION['UID'])) {
    header("location: ../index.php");
} else {
//config.php

//Include Google Client Library for PHP autoload file
require_once __DIR__ . '/vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('33520381037-139j0kh55q8dvhgaa1re6451soci3gte.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('FBDfkr8l-Spj-aPF-UtlEg38');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri($env.'google/config.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

    if(isset($_GET["code"])) {
        $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
        
        if(!isset($token['error'])) {
            require 'functions.php';

            $google_client->setAccessToken($token['access_token']);
            $_SESSION['access_token'] = $token['access_token'];
            $google_service = new Google_Service_Oauth2($google_client);
            $data = $google_service->userinfo->get();

            if(!empty($data['id'])) {
                $_SESSION['UID'] = $data['id'];
            }
            
            if(!empty($data['given_name'])) {
                $_SESSION['Nombre'] = $data['given_name'];
            }
            
            if(!empty($data['family_name'])) {
                $_SESSION['Apellido'] = $data['family_name'];
            }
            
            if(!empty($data['email'])) {
                $_SESSION['Correo'] = $data['email'];
            }
            
            if(!empty($data['picture'])) {
                $_SESSION['Imagen'] = $data['picture'];
            }

            $_SESSION['G'] = true;
        }

        checkuser(true, $data['id'],$data['picture'],$data['given_name'],$data['family_name'],$data['email']);
        header("Location: ../index.php");

    }


    if(!isset($_SESSION['access_token'])) {
        $login_button = '<a style="display: inline;margin-left: 5px;" href="'.$google_client->createAuthUrl().'"><button class="btn btn-primary"><i class="fab fa-google-plus"></i> Google</button></a>';
    }


}
?>