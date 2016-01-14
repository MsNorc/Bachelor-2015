<?php

include 'config_include.php';
//$model = new model();
//$page = VIEW_INDEX;

function setPageIndex(){
    include (VIEW_HEADER);
    include (VIEW_INDEX);
    include (VIEW_FRONTPAGE_OPTIONS);
    include (VIEW_FOOTER);
}
//  include (VIEW_HEADER);
function setPageAdmin(){
    include (VIEW_DB);
    include (VIEW_ADMIN_HANDLING);
    include (VIEW_ADMIN_INPUT);
}
 //   include (VIEW_FOOTER);


