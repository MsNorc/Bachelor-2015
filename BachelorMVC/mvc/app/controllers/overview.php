<?php

if (!isset($_SESSION)) {
    session_start();
}



require_once 'db/mysqli_connect.php';
require_once 'mailsender.php';

class Overview extends Controller {

    public function index() {
        //echo $_SESSION['JQUERY'];
        if (!isset($_SESSION['JQUERY'])) {
            if (!isset($_POST['tempStop'])) {
                $this->view('layout/header');
                $this->view('overview/request_view');
            }
        }
        if (isset($_SESSION['JQUERY'])) {   //double check for jquery search to avoid duplicate views
            if ($_SESSION['JQUERY'] == 1) {
                if (isset($_POST['tempStop'])) {
                    $this->view('layout/header');
                    $this->view('overview/request_view');
                }
            }
        }
    }

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
    //print_r($provider_name);
    unset($provider_name[1],$provider_name[3],$provider_name[5],$provider_name[6]); 
    //print_r($provider_name);
    setProviderRequest($provider_name);
}

function setProviderRequest($provider_name) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_SESSION['request_picked'])) {
            $request_picked = $_SESSION['request_picked'];
            $request_id = $request_picked[0];
            $provider_id = getProvider_idDB($provider_name[2]); //send email, get id
          
            //print_r($provider_name);
            if (setProviderRequestDB($request_id, $provider_id)) {
                echo  "Du har valgt for ditt arrangement : " . $provider_name[0];               
                unset($_SESSION['request_picked'], $provider_name);
                //echo $provider_id;
                $information = getInformationPickedProviderEmail($request_id);
                //print_r($information);
                sendEmail_pickedProvider($information);
                
            }
        }
    }
}
