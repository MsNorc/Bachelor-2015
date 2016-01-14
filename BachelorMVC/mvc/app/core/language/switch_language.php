<?php

function setLanguage() {
    if (isset($_GET['lang'])) {
        if ($_GET['lang'] == 'en') {
            require_once 'lang_en.php';
            $_SESSION['language'] = 'en';
            return true;
        } else {
            require_once 'lang_no.php';
            $_SESSION['language'] = 'no';
            return true;
        }
    } else {
        if (isset($_SESSION['language'])) {
            if ($_SESSION['language'] == 'en') {
                require_once 'lang_en.php';
                return true;
            }
            if ($_SESSION['language'] == 'no') {
                require_once 'lang_no.php';
                return true;
            }
        }
        require_once 'lang_no.php';
    }
}

setLanguage();
