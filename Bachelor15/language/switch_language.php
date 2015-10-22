<?php

function setLanguage() {
    if (isset($_GET['lang'])){
        if($_GET['lang'] == 'en'){
            require_once 'language/lang_en.php';
        }else{
            require_once 'language/lang_no.php';
        }
    }else{
        require_once 'language/lang_no.php';
    }   
}

setLanguage();  
