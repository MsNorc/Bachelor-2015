<?php

include 'db/mysqli_connect.php';

if (!isset($_SESSION)) {
    session_start();
}

function get_request($user_id) {
    return get_requestDB($user_id);
}

if (isset($_POST['picked_request'])) {
    $request = $_POST['picked_request'];
    show_providersForRequest($request);
}

function show_ProvidersForRequest($request) {
    $num = count($request) - 1; //remove last td, which is empty
    unset($request[$num]);
    //print_r($request);
    $request_id = $request[0];
    //unset($_SESSION['request_picked']);
    unset($_SESSION['providers']);
    $_SESSION['request_picked'] = $request;

    $providers = show_ProvidersForRequestDB($request_id);
    if ($providers != null) {
        $_SESSION['providers'] = $providers;
        echo "great success..";
    }
}

if (isset($_POST['provider_name'])) {
    
    $provider_name = $_POST['provider_name'];
    unset($provider_name[1]); //remove blank from button
    setProviderRequest($provider_name);
}

function setProviderRequest($provider_name) {
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_SESSION['request_picked'])) {
            $request_picked = $_SESSION['request_picked'];
            $request_id = $request_picked[0];
            $provider_id = getProvider_idDB($provider_name[0]);
            
            if(setProviderRequestDB($request_id, $provider_id)){
                echo "flott, du har valgt : ".$provider_name[0]." som din leverandør.";
                unset($_SESSION['request_picked']); 
            }
            
            
        }
    }
}
