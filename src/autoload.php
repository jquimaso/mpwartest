<?php


define('__ROOT__AUTOLOAD__', __DIR__);

function __autoload($clase){



    $clase = str_replace( "development\\", "/", $clase );

    $ruta =  __ROOT__AUTOLOAD__ .$clase.".php";


    if (file_exists($ruta)){
        include_once $ruta;
    }

}

