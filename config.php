<?php

require_once 'vendor/autoload.php';

if (!session_id())
{
    session_start();
}

// Call Facebook API

$facebook = new \Facebook\Facebook([
    'app_id' => '578068732879707',
    'app_secret' => '83affb90e47046b413dd0e84c26ebc20',
    'default_graph_version' => 'v2.3',
]);

?>