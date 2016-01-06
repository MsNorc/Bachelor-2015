<?php
include 'db/mysqli_connect.php';

if(!isset($_SESSION)){
    session_start();
}

if(isset($_POST['picked_job'])){
    $list = $_POST['picked_job'];
    display_pickedJob($list);
}

function display_pickedJob($list){
    $last_index = count($list)-1; //not working 
    unset($list[$last_index]); //preferably last_index
    $_SESSION['job_picked'] = $list;
    return true;
}

if(isset($_POST['send_offer'])){
    setJobOffer(); 
    
}
function setJobOffer(){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_SESSION['job_picked'])){
            $job_picked = $_SESSION['job_picked'];
            $request_id = $job_picked[0];
            //echo "<a>".$request_id."<a>";
            $provider_id = $_SESSION['user_id'];
            
            
            //$provider_id = $_SESSION['user']; when provider is made <-
            if(setJobOfferDB($provider_id,$request_id)){
                echo "Du har registrert din interesse, vent på svar fra kunde..";//msg_providerOffer;
                unset($_SESSION['job_picked']); 
            }
        }
    }
}

function get_providerAppliedJobs($provider_id){
    return get_providerAppliedJobsDB($provider_id);
}

function getZipUser($user_id){
    return getZipUserDB($user_id);
}

function setRange(){
    $radius = 1;
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['search_radius'])){
        $radius = filter_input(INPUT_POST, 'search_radius');
        //$adress_event = filter_input(INPUT_POST, 'adress_event');
        
        }
        
    }
   
    
    return $radius;
}

