<?php

spl_autoload_register(function($Nameclass){
    $filename = "class". DIRECTORY_SEPARATOR . $Nameclass.".php";
    if (file_exists($filename)){
        require_once $filename;
    }
})

?>