<?php

if(!session_id()){
    session_start();
}

if (isset($_SESSION['UID'])) {
    header("location: ../index.php");
} else {
    require_once 'vendor/autoload.php';
    require 'functions.php';

    $facebook = new \Facebook\Facebook([
        'app_id' => '593907681498461',
        'app_secret' => '1bbea3f6e36096087bee8914f1606ee8',
        'default_graph_version' => 'v2.10'
    ]);


    $facebook_output = '';

    $facebook_helper = $facebook->getRedirectLoginHelper();

    if(isset($_GET['code'])) {
        if(isset($_GET['accedd_token'])) {
            $access_token = $_SESSION['access_token'];
        } else {
            $access_token = $facebook_helper->getAccessToken();

            $_SESSION['access_token'] = $access_token;

            $facebook->setDefaultAccessToken($_SESSION['access_token']);
        }

        $graph_response = $facebook->get("/me?fields=first_name,last_name,email", $access_token);

        $facebook_user_info = $graph_response->getGraphUser();

        if(!empty($facebook_user_info['id'])){
            $_SESSION[ 'FUID' ] = $facebook_user_info['id'];
            $_SESSION['Imagen'] = 'http://graph.facebook.com/'.$facebook_user_info['id'].'/picture?width=500&height=500';
        }

        if(!empty($facebook_user_info['first_name'])){
            $_SESSION['Nombre'] = $facebook_user_info['first_name'];
        }

        if(!empty($facebook_user_info['last_name'])){
            $_SESSION['Apellido'] = $facebook_user_info['last_name'];
        }

        if(!empty($facebook_user_info['email'])){
            $_SESSION['Correo'] = $facebook_user_info['email'];
        }

        checkuser(true, $facebook_user_info['id'], $_SESSION['Imagen'], $facebook_user_info['first_name'], $facebook_user_info['last_name'], $facebook_user_info['email']);
		header("Location: ../index.php");

    } else {
        $facebook_permissions = ['email'];
        $facebook_login_url = $facebook_helper->getLoginUrl('https://zibareal.herokuapp.com/fb/config.php', $facebook_permissions);
        $facebook_login_url = '<a style="display: inline;" href="'.$facebook_login_url.'"><button class="btn btn-primary"><i class="fab fa-facebook"></i> Facebook</button></a>';
    }
}
?>