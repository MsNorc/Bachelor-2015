<?php

define('DIR_BASE', dirname( dirname( __FILE__ ) ) . '/Bachelor15/');
//layout
define('DIR_LAYOUT',   DIR_BASE . 'layout/');
define('VIEW_HEADER',   DIR_LAYOUT . 'header.php');
define('VIEW_FOOTER', DIR_LAYOUT . 'footer.php');
define('VIEW_FRONTPAGE_OPTIONS', DIR_LAYOUT . 'frontpage_options.php');

//language
define('DIR_LANGUAGE', DIR_BASE . 'language/');
define('VIEW_SWITCH_LANGUAGE', DIR_LANGUAGE . 'switch_language.php');
define('VIEW_LANG_NO', DIR_LANGUAGE . 'lang_no.php');
define('VIEW_LANG_EN', DIR_LANGUAGE . 'lang_en.php');

//admin
define('DIR_ADMIN', DIR_BASE . 'admin/');
define('VIEW_ADMIN_INPUT', DIR_ADMIN . 'admin_input.php');
define('VIEW_ADMIN_HANDLING', DIR_ADMIN . 'admin_handling.php');

//db
define('DIR_DB', DIR_BASE . 'db/');
define('VIEW_DB', DIR_DB . 'mysqli_connect.php');

define('VIEW_INDEX', DIR_BASE . 'index.php');


